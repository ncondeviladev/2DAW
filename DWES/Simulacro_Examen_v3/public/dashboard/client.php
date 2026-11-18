<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: clients.php');
    exit;
}

$client = $clientDAO->findById($id);
if (!$client) {
    http_response_code(404);
    echo "<h1>404 Client no trobat</h1><p><a href='clients.php'>Tornar</a></p>";
    exit;
}

$classes = $classeDAO->findByClient($id);

// =========================================================================
// TASCA D'EXAMEN (Punt 2):
// Recuperar els bons del client:
 $bons = $bonDAO->findByClient($id);
$bons = [];
// =========================================================================

$titolPagina = 'Fitxa de ' . $client->getNomComplet() . ' - FitLife';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <a href="clients.php" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-600 transition">
            &larr; Tornar al llistat de clients
        </a>
        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase border <?= $client->getBadgeNivell() ?>">
            Nivell: <?= e($client->getNivell()) ?>
        </span>
    </div>

    <?php if ($msg = getFlash('exit')): ?>
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
            <?= e($msg) ?>
        </div>
    <?php endif; ?>
    <?php if ($msg = getFlash('error')): ?>
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium">
            <?= e($msg) ?>
        </div>
    <?php endif; ?>

    <!-- Targeta de dades del client -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="flex items-baseline justify-between border-b border-slate-100 pb-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900"><?= e($client->getNomComplet()) ?></h1>
                <p class="text-xs text-slate-500"><?= e($client->getEmail()) ?> &bull; <?= e($client->getTelefon()) ?> &bull; <?= e($client->getEdatAprox()) ?></p>
            </div>
        </div>
    </div>

    <!-- Historial de Classes -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-lg font-bold text-slate-900">Historial de Classes</h2>
            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs">
                Total: <?= count($classes) ?> classes
            </span>
        </div>

        <div class="space-y-3">
            <?php if (empty($classes)): ?>
                <div class="p-4 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-xs text-slate-400">
                    Sense classes registrades.
                </div>
            <?php else: ?>
                <?php foreach ($classes as $c): ?>
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs space-y-1">
                        <div class="flex items-center justify-between text-slate-500">
                            <span class="font-bold text-slate-800"><?= e($c->getNomInstructor() ?? 'Instructor') ?></span>
                            <span><?= e($c->getDataClasse()) ?></span>
                        </div>
                        <div class="font-semibold text-slate-800"><?= e($c->getActivitat()) ?> — <?= e($c->getDuradaMinuts()) ?> min</div>
                        <p class="text-slate-600"><?= e($c->getObservacions()) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari afegir classe -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nova classe</h3>
            <form action="afegir_classe.php" method="POST" class="space-y-4">
                <input type="hidden" name="client_id" value="<?= $client->getId() ?>">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="activitat" class="block text-xs font-bold uppercase text-slate-600 mb-1">Activitat</label>
                        <input type="text" id="activitat" name="activitat" required placeholder="Ex: Ioga, CrossFit, Pilates"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="durada_minuts" class="block text-xs font-bold uppercase text-slate-600 mb-1">Durada (min)</label>
                        <input type="number" id="durada_minuts" name="durada_minuts" required min="15" max="180" value="60"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="observacions" class="block text-xs font-bold uppercase text-slate-600 mb-1">Observacions</label>
                        <input type="text" id="observacions" name="observacions" required
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition">
                    Registrar Classe
                </button>
            </form>
        </div>
    </div>

    <!-- =========================================================================
         SECCIÓ D'EXAMEN: Abonaments (Bons) del Client
         ========================================================================= -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Abonaments i Bons de Servei</h2>
                <p class="text-xs text-slate-500">Registre de pagaments i bons actius del client.</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-semibold text-xs border border-indigo-100">
                Total: <?= count($bons) ?> bons
            </span>
        </div>

        <!-- Llistat de bons -->
        <div class="space-y-3">
            <?php if (empty($bons)): ?>
                <div class="p-8 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-sm text-slate-400">
                    Encara no s'ha registrat cap bon per a este client.
                </div>
            <?php else: ?>
                <?php foreach ($bons as $bon): ?>
                    <div class="p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50/50 transition space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800"><?= e($bon->getNomInstructor() ?? 'Instructor') ?></span>
                                <span>&bull;</span>
                                <span>Alta: <?= e($bon->getDataAlta()) ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-indigo-700 bg-indigo-50 border border-indigo-100">
                                    <?= number_format((float) $bon->getPreu(), 2) ?> &euro;
                                </span>
                                <?php if (method_exists($bon, 'estaActiu') && $bon->estaActiu()): ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200">
                                        Actiu
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-rose-700 bg-rose-50 border border-rose-200">
                                        Caducat
                                    </span>
                                <?php endif; ?>

                                <?php if (esAdmin() || idUsuariActual() === $bon->getUsuariId()): ?>
                                    <form action="eliminar_bon.php" method="POST" onsubmit="return confirm('Segur que vols eliminar este bon?');" class="inline">
                                        <input type="hidden" name="id" value="<?= $bon->getId() ?>">
                                        <input type="hidden" name="pacient_id" value="<?= $client->getId() ?>">
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold ml-2">Eliminar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-baseline justify-between text-sm">
                            <span class="font-bold text-slate-900"><?= e($bon->getTipusBon()) ?></span>
                            <span class="text-xs text-slate-500">
                                Vàlid fins: <strong><?= e($bon->getDataFi() ?? 'Sense data de caducitat') ?></strong>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari d'alta de bon -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nou bo</h3>
            <form action="afegir_bon.php" method="POST" class="space-y-4">
                <input type="hidden" name="client_id" value="<?= $client->getId() ?>">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="tipus_bon" class="block text-xs font-bold uppercase text-slate-600 mb-1">Tipus de Bo</label>
                        <input type="text" id="tipus_bon" name="tipus_bon" required placeholder="Ex: Mensual, 10 sessions"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="preu" class="block text-xs font-bold uppercase text-slate-600 mb-1">Preu (&euro;)</label>
                        <input type="number" id="preu" name="preu" required min="0" step="0.01" placeholder="Ex: 49.99"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="data_fi" class="block text-xs font-bold uppercase text-slate-600 mb-1">Data de Caducitat (opcional)</label>
                        <input type="date" id="data_fi" name="data_fi"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm transition">
                    Registrar Bo
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
