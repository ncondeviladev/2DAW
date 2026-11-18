<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$pacients = $pacientDAO->findAll();
$totalsVisites = $visitaDAO->comptarPerPacient();

// =========================================================================
// TASCA D'EXAMEN (Punt 5):
// Descomenta esta línia una vegada creat VacunaDAO:
$totalsVacunes = $vacunaDAO->comptarVacunesPerPacient();
// =========================================================================

$titolPagina = 'Llistat de Pacients - VetClinic';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Registre de Pacients</h1>
            <p class="text-sm text-slate-500">Historial mèdic i gestió veterinària.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 font-semibold text-xs border border-emerald-100">
                Total: <?= count($pacients) ?> pacients actius
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
                        <th class="py-3.5 px-4">Pacient / Espècie</th>
                        <th class="py-3.5 px-4">Raça & Edat</th>
                        <th class="py-3.5 px-4">Propietari</th>
                        <th class="py-3.5 px-4 text-center">Visites Reals</th>
                        <!-- TASCA D'EXAMEN: Columna Vacunes -->
                        <th class="py-3.5 px-4 text-center">Vacunes</th>
                        <th class="py-3.5 px-4 text-right">Accions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($pacients as $pacient): ?>
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 text-base"><?= e($pacient->getNom()) ?></div>
                                <span class="inline-block mt-0.5 px-2 py-0.5 rounded text-xs font-semibold uppercase border <?= $pacient->getBadgeEspecie() ?>">
                                    <?= e($pacient->getEspecie()) ?>
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-800"><?= e($pacient->getRaca()) ?></div>
                                <div class="text-xs text-slate-400">Edat: <?= e($pacient->getEdatAprox()) ?></div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-slate-700"><?= e($pacient->getNomPropietari()) ?></div>
                                <div class="text-xs text-slate-400 font-mono"><?= e($pacient->getTelefon()) ?></div>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono text-xs">
                                <span class="px-2 py-1 rounded-md bg-slate-100 font-bold text-slate-700">
                                    <?= $totalsVisites[$pacient->getId()] ?? 0 ?> visites
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono text-xs">
                                <?php
                                // TASCA D'EXAMEN: Mostrar el nombre de vacunes
                                if (isset($totalsVacunes[$pacient->getId()])) {
                                    $num = (int) $totalsVacunes[$pacient->getId()];
                                    echo "<span class='px-2 py-1 rounded-md bg-indigo-50 border border-indigo-100 font-bold text-indigo-700'>{$num} dosis</span>";
                                } else {
                                    echo "<span class='text-slate-400'>0 vacunes</span>";
                                }
                                ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="pacient.php?id=<?= $pacient->getId() ?>"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-xs transition">
                                    Fitxa Clínica &rarr;
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
