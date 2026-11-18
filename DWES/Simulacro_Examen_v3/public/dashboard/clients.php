<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$clients = $clientDAO->findAll();
$totalsClasses = $classeDAO->comptarPerClient();

// =========================================================================
// TASCA D'EXAMEN (Punt 5):
// Descomenta esta línia una vegada creat BonDAO:
$totalsBons = $bonDAO->comptarBonsPerClient();
// =========================================================================

$titolPagina = 'Llistat de Clients - FitLife Studio';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Registre de Clients</h1>
            <p class="text-sm text-slate-500">Seguiment d'entrenaments i abonaments.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 font-semibold text-xs border border-emerald-100">
                Total: <?= count($clients) ?> clients actius
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
                        <th class="py-3.5 px-4">Client</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Nivell</th>
                        <th class="py-3.5 px-4 text-center">Classes</th>
                        <th class="py-3.5 px-4 text-center">Bons</th>
                        <th class="py-3.5 px-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($clients as $client): ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-3 px-4">
                                <div class="font-semibold text-slate-900"><?= e($client->getNomComplet()) ?></div>
                                <div class="text-xs text-slate-500"><?= e($client->getTelefon()) ?> &bull; <?= e($client->getEdatAprox()) ?></div>
                            </td>
                            <td class="py-3 px-4 text-slate-600"><?= e($client->getEmail()) ?></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-xs font-bold border <?= $client->getBadgeNivell() ?>">
                                    <?= e($client->getNivell()) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-slate-700">
                                <?= $totalsClasses[$client->getId()] ?? 0 ?>
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-indigo-700">
                                <?= ($totalsBons ?? [])[$client->getId()] ?? 0 ?>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="client.php?id=<?= $client->getId() ?>"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition">
                                    Veure fitxa
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
