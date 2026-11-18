<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: pacients.php');
    exit;
}

$pacient = $pacientDAO->findById($id);
if (!$pacient) {
    http_response_code(404);
    echo "<h1>404 Pacient no trobat</h1><p><a href='pacients.php'>Tornar</a></p>";
    exit;
}

// Visites clíniques associades (exemple funcional ja implementat)
$visites = $visitaDAO->findByPacient($id);

// =========================================================================
// TASCA D'EXAMEN (Punt 2):
// Recuperar les vacunes administrades a este pacient:
$vacunes = $vacunaDAO->findByPacient($id);
//$vacunes = [];
// =========================================================================

$titolPagina = 'Fitxa de ' . $pacient->getNom() . ' - VetClinic';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <a href="pacients.php" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-600 transition">
            &larr; Tornar al llistat de pacients
        </a>
        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase border <?= $pacient->getBadgeEspecie() ?>">
            Espècie: <?= e($pacient->getEspecie()) ?>
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

    <!-- Targeta de dades del pacient -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="flex items-baseline justify-between border-b border-slate-100 pb-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900"><?= e($pacient->getNom()) ?></h1>
                <p class="text-xs text-slate-500"><?= e($pacient->getRaca()) ?> &bull; Edat: <?= e($pacient->getEdatAprox()) ?></p>
            </div>
            <div class="text-right">
                <span class="text-xs font-bold uppercase text-slate-400 block">Microxip</span>
                <span class="font-mono text-xs font-bold text-slate-700"><?= e($pacient->getMicroxip() ?? 'Sense microxip') ?></span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs bg-slate-50 rounded-xl p-3 border border-slate-200/60">
            <div>
                <span class="font-bold text-slate-500 uppercase">Propietari/ària:</span>
                <span class="font-semibold text-slate-800 ml-1"><?= e($pacient->getNomPropietari()) ?></span>
            </div>
            <div>
                <span class="font-bold text-slate-500 uppercase">Telèfon de contacte:</span>
                <span class="font-semibold text-slate-800 font-mono ml-1"><?= e($pacient->getTelefon()) ?></span>
            </div>
        </div>
    </div>

    <!-- SECCIÓ 1: Visites clíniques (EXEMPLE DE REFERÈNCIA JA FUNCIONANT) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-lg font-bold text-slate-900">Historial de Consultes i Diagnòstics</h2>
            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs">
                Total: <?= count($visites) ?> consultes
            </span>
        </div>

        <div class="space-y-3">
            <?php if (empty($visites)): ?>
                <div class="p-4 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-xs text-slate-400">
                    Sense visites registrades.
                </div>
            <?php else: ?>
                <?php foreach ($visites as $v): ?>
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs space-y-1">
                        <div class="flex items-center justify-between text-slate-500">
                            <span class="font-bold text-slate-800"><?= e($v->getNomVeterinari() ?? 'Veterinari') ?></span>
                            <span><?= e($v->getDataVisita()) ?></span>
                        </div>
                        <div class="font-semibold text-slate-800"><?= e($v->getMotiu()) ?></div>
                        <p class="text-slate-600"><?= e($v->getDiagnostic()) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- =========================================================================
         SECCIÓ D'EXAMEN: Cartilla de Vacunació (Relació 1:N que has de connectar)
         ========================================================================= -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Cartilla Oficial de Vacunació</h2>
                <p class="text-xs text-slate-500">Registre d'immunitzacions, preu del tractament i data de renovació.</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-semibold text-xs border border-indigo-100">
                Total: <?= count($vacunes) ?> vacunes
            </span>
        </div>

        <!-- Llistat de vacunes -->
        <div class="space-y-3">
            <?php if (empty($vacunes)): ?>
                <div class="p-8 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-sm text-slate-400">
                    Encara no s'ha registrat cap vacuna en la cartilla d'este pacient.
                </div>
            <?php else: ?>
                <?php foreach ($vacunes as $vacuna): ?>
                    <div class="p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50/50 transition space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800"><?= e($vacuna->getNomVeterinari() ?? 'Veterinari') ?></span>
                                <span>&bull;</span>
                                <span>Administrada: <?= e($vacuna->getDataAdministracio()) ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-indigo-700 bg-indigo-50 border border-indigo-100">
                                    <?= number_format((float) $vacuna->getPreu(), 2) ?> &euro;
                                </span>
                                <?php if (method_exists($vacuna, 'requereixRecordatori') && $vacuna->requereixRecordatori()): ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-amber-700 bg-amber-50 border border-amber-200">
                                        Renovació Urgent
                                    </span>
                                <?php endif; ?>

                                <?php if (esAdmin() || idUsuariActual() === $vacuna->getUsuariId()): ?>
                                    <form action="eliminar_vacuna.php" method="POST" onsubmit="return confirm('Segur que vols eliminar esta vacuna?');" class="inline">
                                        <input type="hidden" name="id" value="<?= $vacuna->getId() ?>">
                                        <input type="hidden" name="pacient_id" value="<?= $pacient->getId() ?>">
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold ml-2">Eliminar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-baseline justify-between text-sm">
                            <span class="font-bold text-slate-900"><?= e($vacuna->getNomVacuna()) ?></span>
                            <span class="text-xs text-slate-500">
                                Pròxima dosi: <strong><?= e($vacuna->getProximaDosi() ?? 'No requerida') ?></strong>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari d'administració de vacuna -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nova dosi de vacuna</h3>
            <form action="afegir_vacuna.php" method="POST" class="space-y-4">
                <input type="hidden" name="pacient_id" value="<?= $pacient->getId() ?>">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="nom_vacuna" class="block text-xs font-bold uppercase text-slate-600 mb-1">Nom de la Vacuna</label>
                        <input type="text" id="nom_vacuna" name="nom_vacuna" required placeholder="Ex: Ràbia anual, Tetravalent"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="preu" class="block text-xs font-bold uppercase text-slate-600 mb-1">Preu (&euro;)</label>
                        <input type="number" id="preu" name="preu" step="0.01" min="0" required placeholder="Ex: 35.50"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div>
                        <label for="proxima_dosi" class="block text-xs font-bold uppercase text-slate-600 mb-1">Pròxima Dosi (Data opcional)</label>
                        <input type="date" id="proxima_dosi" name="proxima_dosi"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-sm text-xs transition">
                        Guardar Vacuna en Cartilla
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
