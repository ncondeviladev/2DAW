<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: vehicles.php');
    exit;
}

$vehicle = $vehicleDAO->findById($id);
if (!$vehicle) {
    http_response_code(404);
    echo "<h1>404 Vehicle no trobat</h1><p><a href='vehicles.php'>Tornar</a></p>";
    exit;
}

$reparacions = $reparacioDAO->findByVehicle($id);

// =========================================================================
// TASCA D'EXAMEN (Punt 2):
// Recuperar els recanvis instal·lats en este vehicle:
$recanvis = $recanviDAO->findByVehicle($id);
$recanvis = [];
// =========================================================================

$titolPagina = 'Vehicle ' . $vehicle->getMatricula() . ' - AutoTaller';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <a href="vehicles.php" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-amber-700 transition">
            &larr; Tornar al llistat de vehicles
        </a>
        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-slate-100 text-slate-800 border border-slate-300">
            Matrícula: <?= e($vehicle->getMatricula()) ?>
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

    <!-- Targeta de dades del vehicle -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-3">
        <div class="flex items-baseline justify-between border-b border-slate-100 pb-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900"><?= e($vehicle->getMarca()) ?> <?= e($vehicle->getModel()) ?></h1>
                <p class="text-xs text-slate-500">Propietari: <strong><?= e($vehicle->getNomPropietari()) ?></strong> &bull; Telèfon: <?= e($vehicle->getTelefon()) ?> &bull; Antiguitat: <?= e($vehicle->getAntiguitat()) ?></p>
            </div>
        </div>
    </div>

    <!-- Historial de Reparacions d'Exemple -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-lg font-bold text-slate-900">Mà d'Obra i Reparacions Registrades</h2>
            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs">
                Total: <?= count($reparacions) ?> feines
            </span>
        </div>

        <div class="space-y-3">
            <?php if (empty($reparacions)): ?>
                <div class="p-4 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-xs text-slate-400">
                    Sense feines de mà d'obra registrades.
                </div>
            <?php else: ?>
                <?php foreach ($reparacions as $r): ?>
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs space-y-1">
                        <div class="flex items-center justify-between text-slate-500">
                            <span class="font-bold text-slate-800"><?= e($r->getNomMecanic() ?? 'Mecànic') ?></span>
                            <span><?= e($r->getDataReparacio()) ?></span>
                        </div>
                        <div class="font-semibold text-slate-800"><?= e($r->getDescripcio()) ?></div>
                        <div class="flex items-center justify-between text-slate-600 pt-1">
                            <span><?= e($r->getHoresFeina()) ?> hores &times; <?= number_format($r->getCostHora(), 2) ?> &euro;/h</span>
                            <span class="font-bold text-slate-900">Total: <?= number_format($r->getCostTotal(), 2) ?> &euro;</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari afegir reparació -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nova mà d'obra</h3>
            <form action="afegir_reparacio.php" method="POST" class="space-y-4">
                <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId() ?>">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="descripcio" class="block text-xs font-bold uppercase text-slate-600 mb-1">Descripció</label>
                        <input type="text" id="descripcio" name="descripcio" required placeholder="Ex: Substitució corretja distribució"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="hores_feina" class="block text-xs font-bold uppercase text-slate-600 mb-1">Hores de Feina</label>
                        <input type="number" id="hores_feina" name="hores_feina" required min="0.25" step="0.25" value="1.00"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="cost_hora" class="block text-xs font-bold uppercase text-slate-600 mb-1">Cost / Hora (&euro;)</label>
                        <input type="number" id="cost_hora" name="cost_hora" required min="10" step="1" value="45.00"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm transition">
                    Guardar Reparació
                </button>
            </form>
        </div>
    </div>

    <!-- =========================================================================
         SECCIÓ D'EXAMEN: Recanvis Instal·lats en el Vehicle
         ========================================================================= -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Peces i Recanvis Utilitzats</h2>
                <p class="text-xs text-slate-500">Material facturat, unitats i estat de garantia de la peça.</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-semibold text-xs border border-indigo-100">
                Total: <?= count($recanvis) ?> peces
            </span>
        </div>

        <!-- Llistat de recanvis -->
        <div class="space-y-3">
            <?php if (empty($recanvis)): ?>
                <div class="p-8 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-sm text-slate-400">
                    Encara no s'ha assignat cap peça de recanvi a este vehicle.
                </div>
            <?php else: ?>
                <?php foreach ($recanvis as $recanvi): ?>
                    <div class="p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50/50 transition space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800"><?= e($recanvi->getNomMecanic() ?? 'Mecànic') ?></span>
                                <span>&bull;</span>
                                <span>Data: <?= e($recanvi->getDataAlta()) ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-indigo-700 bg-indigo-50 border border-indigo-100">
                                    <?= number_format((float) $recanvi->getImportTotal(), 2) ?> &euro;
                                </span>
                                <?php if (method_exists($recanvi, 'enGarantia') && $recanvi->enGarantia()): ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200">
                                        En Garantia
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-slate-500 bg-slate-100 border border-slate-200">
                                        Fora de Garantia
                                    </span>
                                <?php endif; ?>

                                <?php if (esAdmin() || idUsuariActual() === $recanvi->getUsuariId()): ?>
                                    <form action="eliminar_recanvi.php" method="POST" onsubmit="return confirm('Segur que vols donar de baixa este recanvi?');" class="inline">
                                        <input type="hidden" name="id" value="<?= $recanvi->getId() ?>">
                                        <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId() ?>">
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold ml-2">Eliminar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-baseline justify-between text-sm">
                            <span class="font-bold text-slate-900"><?= e($recanvi->getNomPeca()) ?></span>
                            <span class="text-xs text-slate-500">
                                Quantitat: <strong><?= e($recanvi->getQuantitat()) ?> unitats</strong> &bull; Preu unitari: <?= number_format((float) $recanvi->getPreuUnitari(), 2) ?> &euro;
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari d'afegir recanvi -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nova peça / recanvi</h3>
            <form action="afegir_recanvi.php" method="POST" class="space-y-4">
                <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId() ?>">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="nom_peca" class="block text-xs font-bold uppercase text-slate-600 mb-1">Nom de la Peça</label>
                        <input type="text" id="nom_peca" name="nom_peca" required placeholder="Ex: Filtre de pol·len, Bomba d'aigua"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="preu_unitari" class="block text-xs font-bold uppercase text-slate-600 mb-1">Preu Unitari (&euro;)</label>
                        <input type="number" id="preu_unitari" name="preu_unitari" required min="0.01" step="0.01" placeholder="Ex: 24.50"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="quantitat" class="block text-xs font-bold uppercase text-slate-600 mb-1">Quantitat (unitats)</label>
                        <input type="number" id="quantitat" name="quantitat" required min="1" step="1" value="1"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-amber-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm transition">
                    Assignar Recanvi
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
