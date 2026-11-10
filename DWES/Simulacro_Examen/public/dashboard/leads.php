<?php

use App\Model\Lead;

require_once __DIR__ . '/../../config/bootstrap.php';

requereixLogin();

$errorBD = null;
$llistaLeads = [];

try {
    // Si ve d'un POST: avançar l'estat d'un lead
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accio = $_POST['accio'] ?? '';
        $idLead = (int) ($_POST['id'] ?? 0);
        $lead = $idLead !== 0 ? $leadDAO->findById($idLead) : null;

        if ($lead !== null && $accio === 'avancar') {
            $lead->avancarEstat();
            $leadDAO->update($lead);
        } elseif ($lead !== null && $accio === 'eliminar') {
            $leadDAO->delete($idLead);

            // Primer la fila de la base de dades; després l'arxiu
            eliminarArxiu(CARPETA_PUJADES, $lead->getDocument());
        }

        header('Location: leads.php');
        exit;
    }

    $llistaLeads = $leadDAO->findAll();
    $totalNotesPerLead = $notaDAO->comptarPerLead(); //Afegim el contador de notes
} catch (PDOException $e) {
    error_log($e->getMessage());
    $errorBD = 'No s\'ha pogut accedir a la base de dades.';
}

$titol = 'TechLeads - Panell de leads';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>


<!-- Contingut Principal -->
<main class="max-w-6xl mx-auto px-6 py-8 flex-1 w-full space-y-6">
    <?php if ($errorBD !== null): ?>
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
            <?= e($errorBD) ?>
        </div>
    <?php endif; ?>

    <!-- Capçalera de pàgina -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Leads rebuts</h1>
            <p class="text-sm text-slate-500 mt-1">Gestió, seguiment i actualització d'oportunitats comercials.</p>
        </div>
        <a href="../index.php" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold border border-indigo-200/80 transition-colors w-fit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Nou formulari públic</span>
        </a>
    </div>

    <!-- Targetes d'estadístiques ràpides -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Leads</div>
            <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= count($llistaLeads) ?></div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
            <div class="text-xs font-semibold text-sky-600 uppercase tracking-wider">Nous</div>
            <div class="text-2xl font-extrabold text-sky-700 mt-1">
                <?= count(array_filter($llistaLeads, function ($lead) {
                    return $lead->getEstat() === Lead::ESTAT_NOU;
                })) ?>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
            <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Contactats</div>
            <div class="text-2xl font-extrabold text-amber-700 mt-1">
                <?= count(array_filter($llistaLeads, function ($lead) {
                    return $lead->getEstat() === Lead::ESTAT_CONTACTAT;
                })) ?>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
            <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Tancats</div>
            <div class="text-2xl font-extrabold text-emerald-700 mt-1">
                <?= count(array_filter($llistaLeads, function ($lead) {
                    return $lead->getEstat() === Lead::ESTAT_TANCAT;
                })) ?>
            </div>
        </div>
    </div>

    <!-- Taula de Leads -->
    <?php if (count($llistaLeads) > 0): ?>
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-3.5 px-4">Id</th>
                            <th class="py-3.5 px-4">Nom / Contacte</th>
                            <th class="py-3.5 px-4">Empresa</th>
                            <th class="py-3.5 px-4">Serveis</th>
                            <th class="py-3.5 px-4 text-right">Pressupost</th>
                            <th class="py-3.5 px-4">Document</th>
                            <th class="py-3.5 px-4 text-center">Notes</th>
                            <th class="py-3.5 px-4 text-center">Estat</th>
                            <th class="py-3.5 px-4 text-right">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php
                        foreach ($llistaLeads as $lead):
                            $color = colorEstat($lead->getEstat());
                        ?>
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-semibold text-slate-500 text-xs">#<?= e($lead->getId()) ?></td>
                                <td class="py-3.5 px-4 font-semibold text-slate-800"><?= e($lead->getNom()) ?></td>
                                <td class="py-3.5 px-4 text-slate-600"><?= e($lead->getEmpresa() ?? '--') ?></td>
                                <td class="py-3.5 px-4">
                                    <div class="flex flex-wrap gap-1">
                                        <?php
                                        foreach ($lead->getServeis() as $servei):
                                        ?>
                                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-xs font-medium"><?= e($servei) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-right font-bold text-slate-800"><?= e(number_format(($lead->getPressupost() ?? 0), 0, ',', '.')) . ' €' ?></td>
                                <td class="py-3.5 px-4">
                                    <?php if (!empty($lead->getDocument())): ?>
                                        <a href="../pujades/<?= $lead->getDocument() ?>" class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span><?= $lead->getDocument() ?></span>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <?php $numNotes = $totalNotesPerLead[$lead->getId()] ?? 0; ?>
                                    <a href="lead.php?id=<?= $lead->getId() ?>" class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $numNotes > 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-slate-100 text-slate-400' ?>">
                                        <?= $numNotes ?>
                                    </a>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-<?= $color ?>-50 text-<?= $color ?>-700 border border-<?= $color ?>-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-<?= $color ?>-500"></span>
                                        <?= $lead->getEstat() ?>
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="lead.php?id=<?= $lead->getId() ?>"
                                            class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 transition-colors">
                                            Detall
                                        </a>
                                        <form method="POST" action="leads.php">
                                            <input type="hidden" name="id" value="<?= $lead->getId() ?>">
                                            <?php if ($lead->getEstat() === Lead::ESTAT_TANCAT): ?>
                                                <button type="submit" name="accio" value="avancar" disabled
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>tancat</span>
                                                </button>
                                            <?php else: ?>
                                                <button type="submit" name="accio" value="avancar"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 transition-colors">
                                                    <span>Avança estat</span>
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                        <form method="POST" action="leads.php" onsubmit="return confirm('Segur que vols eliminar este lead? No es pot desfer.');">
                                            <input type="hidden" name="id" value="<?= $lead->getId() ?>">
                                            <button type="submit" name="accio" value="eliminar"
                                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition-colors">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <!-- Exemple per quan encara no hi ha cap lead -->
        <div class="bg-white p-12 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 text-center space-y-4">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-800">Encara no hi ha cap sol·licitud</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Quan els clients envien el formulari de contacte públic, apareixeran ací per al seu seguiment comercial.</p>
            </div>
            <div>
                <a href="../index.php" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-md shadow-indigo-500/20 transition-all">
                    <span>Obrir formulari públic</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php';
