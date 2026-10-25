<?php

require_once __DIR__ . '/../../config/bootstrap.php';

requereixLogin();

// L'id ve de la URL: s'ha de validar com a enter
if (!isset($_GET['id']) || !ctype_digit($_GET['id']) || (int) $_GET['id'] <= 0) {
    header('Location: leads.php');
    exit;
}

$id = (int) $_GET['id'];

$errorBD = null;
$lead = null;

try {
    $lead = $leadDAO->findById($id);
} catch (PDOException $e) {
    error_log($e->getMessage());
    $errorBD = 'No s\'ha pogut accedir a la base de dades.';
}

if ($lead === null && $errorBD === null) {
    http_response_code(404);
}

$titol = 'TechLeads - Detall del lead';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>
<main class="max-w-3xl mx-auto px-6 py-8 flex-1 w-full space-y-6">

    <a href="leads.php"
        class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
        &larr; Tornar al llistat
    </a>
    <?php if (isset($_GET['desat'])): ?>
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            Els canvis s'han desat correctament.
        </div>
    <?php endif; ?>

    <?php if ($errorBD !== null): ?>
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
            <?= e($errorBD) ?>
        </div>

    <?php elseif ($lead === null): ?>
        <div
            class="bg-white p-12 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 text-center space-y-2">
            <h1 class="text-xl font-extrabold text-slate-900">Lead no trobat</h1>
            <p class="text-sm text-slate-500">No existeix cap lead amb l'identificador indicat.</p>
        </div>

    <?php else: ?>
        <?php $color = colorEstat($lead->getEstat()); ?>
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden">

            <div class="flex items-start justify-between gap-4 px-6 py-5 border-b border-slate-100">
                <div>
                    <div class="font-mono text-xs font-semibold text-slate-400">#<?= $lead->getId() ?></div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight"><?= e($lead->getNom()) ?></h1>
                </div>
                <span
                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-<?= $color ?>-50 text-<?= $color ?>-700 border border-<?= $color ?>-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-<?= $color ?>-500"></span>
                    <?= e($lead->getEstat()) ?>
                </span>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 px-6 py-6 text-sm">
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Correu electrònic</dt>
                    <dd class="mt-1">
                        <a href="mailto:<?= e($lead->getEmail()) ?>"
                            class="text-indigo-600 hover:underline"><?= e($lead->getEmail()) ?></a>
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Telèfon</dt>
                    <dd class="mt-1 text-slate-800"><?= e($lead->getTelefon() ?: '--') ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Empresa</dt>
                    <dd class="mt-1 text-slate-800"><?= e($lead->getEmpresa() ?: '--') ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Pressupost</dt>
                    <dd class="mt-1 font-bold text-slate-800"><?= e(number_format($lead->getPressupost(), 2, ',', '.')) ?> €
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Serveis</dt>
                    <dd class="mt-1 flex flex-wrap gap-1">
                        <?php foreach ($lead->getServeis() as $servei): ?>
                            <span
                                class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-xs font-medium"><?= e($servei) ?></span>
                        <?php endforeach; ?>
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Missatge</dt>
                    <dd class="mt-1 text-slate-800"><?= nl2br(e($lead->getMissatge() ?: '--')) ?></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-bold uppercase tracking-wider text-slate-500">Document</dt>
                    <dd class="mt-1">
                        <?php if (!empty($lead->getDocument())): ?>
                            <a href="../pujades/<?= e($lead->getDocument()) ?>"
                                class="text-indigo-600 hover:underline"><?= e($lead->getDocument()) ?></a>
                        <?php else: ?>
                            <span class="text-slate-800">--</span>
                        <?php endif; ?>
                    </dd>
                </div>
            </dl>
            <div class="flex justify-end px-6 py-4 border-t border-slate-100 bg-slate-50/60">
                <a href="editar.php?id=<?= $lead->getId() ?>"
                    class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-md shadow-indigo-500/20 transition-all">
                    Editar
                </a>
            </div>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php';