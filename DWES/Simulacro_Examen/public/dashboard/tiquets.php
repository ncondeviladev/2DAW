<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$tiquets = $tiquetDAO->findAll();

// TASCA D'EXAMEN (Punt 5):
// Quan s'haja creat IntervencioDAO, es recuperarà el total de minuts per tiquet:
// $totalsMinuts = $intervencioDAO->calcularTotalMinutsPerTiquet();
$totalsMinuts = $intervencioDAO->calcularTotalMinutsPerTiquet();
    
$titolPagina = 'Llistat de Tiquets d\'Incidència';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Tiquets de Suport Tècnic</h1>
            <p class="text-sm text-slate-500">Gestió i seguiment d'incidències actives del sistema.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 font-semibold text-xs border border-indigo-100">
                Total: <?= count($tiquets) ?> tiquets
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
                        <th class="py-3.5 px-4">Codi</th>
                        <th class="py-3.5 px-4">Títol & Client</th>
                        <th class="py-3.5 px-4 text-center">Prioritat</th>
                        <th class="py-3.5 px-4 text-center">Estat</th>
                        <!-- TASCA EXAMEN: Columna Minuts Acumulats -->
                        <th class="py-3.5 px-4 text-center">Temps Dedicat</th>
                        <th class="py-3.5 px-4 text-right">Accions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($tiquets)): ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">No hi ha cap tiquet registrat.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tiquets as $tiquet): ?>
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-bold text-indigo-600">
                                    <?= e($tiquet->getCodi()) ?>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-900"><?= e($tiquet->getTitol()) ?></div>
                                    <div class="text-xs text-slate-500"><?= e($tiquet->getClientNom()) ?> &bull; <?= e($tiquet->getClientEmail()) ?></div>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold uppercase <?= $tiquet->getBadgePrioritat() ?>">
                                        <?= e($tiquet->getPrioritat()) ?>
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold uppercase <?= $tiquet->getBadgeEstat() ?>">
                                        <?= e($tiquet->getEstat()) ?>
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-mono text-xs text-slate-600">
                                    <?php
                                    // TASCA D'EXAMEN: Mostrar el total de minuts si està disponible a $totalsMinuts
                                    if (isset($totalsMinuts[$tiquet->getId()])) {
                                        $minuts = (int) $totalsMinuts[$tiquet->getId()];
                                        echo "<span class='font-bold text-indigo-700'>{$minuts} min</span>";
                                    } else {
                                        echo "<span class='text-slate-400'>0 min</span>";
                                    }
                                    ?>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="tiquet.php?id=<?= $tiquet->getId() ?>"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-indigo-50 text-slate-700 hover:text-indigo-600 font-semibold text-xs transition">
                                        Veure Detall &rarr;
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
