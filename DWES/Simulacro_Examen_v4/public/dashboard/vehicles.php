<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$vehicles = $vehicleDAO->findAll();
$totalsReparacions = $reparacioDAO->comptarPerVehicle();

// =========================================================================
// TASCA D'EXAMEN (Punt 5):
// Descomenta esta línia una vegada creat RecanviDAO:
$totalsRecanvis = $recanviDAO->comptarRecanvisPerVehicle();
// =========================================================================

$titolPagina = 'Registre de Vehicles - AutoTaller MotorPlus';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Parc de Vehicles</h1>
            <p class="text-sm text-slate-500">Historial d'intervencions mecàniques i recanvis instal·lats.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 font-semibold text-xs border border-amber-200">
                Total: <?= count($vehicles) ?> vehicles registrats
            </span>
        </div>
    </div>

    <?php if ($msg = getFlash('exit')): ?>
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
            <?= e($msg) ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600">
                        <th class="py-3.5 px-4">Vehicle / Matrícula</th>
                        <th class="py-3.5 px-4">Propietari</th>
                        <th class="py-3.5 px-4">Antiguitat</th>
                        <th class="py-3.5 px-4 text-center">Reparacions</th>
                        <th class="py-3.5 px-4 text-center">Recanvis</th>
                        <th class="py-3.5 px-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($vehicles as $v): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900"><?= e($v->getMarca()) ?> <?= e($v->getModel()) ?></div>
                                <span class="inline-block mt-0.5 px-2 py-0.5 bg-slate-100 text-slate-700 font-mono font-bold text-xs rounded border border-slate-200">
                                    <?= e($v->getMatricula()) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-medium text-slate-800"><?= e($v->getNomPropietari()) ?></div>
                                <div class="text-xs text-slate-500"><?= e($v->getTelefon()) ?></div>
                            </td>
                            <td class="py-3 px-4 text-slate-600">
                                <?= e($v->getAntiguitat()) ?> (<?= e($v->getAnyFabricacio()) ?>)
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-slate-700">
                                <?= $totalsReparacions[$v->getId()] ?? 0 ?>
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-amber-700">
                                <?= ($totalsRecanvis ?? [])[$v->getId()] ?? 0 ?>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="vehicle.php?id=<?= $v->getId() ?>"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold transition">
                                    Fitxa Tècnica &rarr;
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
