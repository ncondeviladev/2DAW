<?php

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: tiquets.php');
    exit;
}

$tiquet = $tiquetDAO->findById($id);
if (!$tiquet) {
    http_response_code(404);
    echo "<h1>404 Tiquet no trobat</h1><p><a href='tiquets.php'>Tornar</a></p>";
    exit;
}

// TASCA D'EXAMEN (Punt 2):
// Recuperar les intervencions associades a este tiquet:
// $intervencions = $intervencioDAO->findByTiquet($id);
$intervencions = $intervencioDAO->findByTiquet($id);

$titolPagina = 'Detall del Tiquet: ' . $tiquet->getCodi();
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>

<div class="space-y-6 max-w-5xl">
    <div class="flex items-center justify-between">
        <a href="tiquets.php" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
            &larr; Tornar al llistat de tiquets
        </a>
        <div class="flex items-center gap-2">
            <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase <?= $tiquet->getBadgePrioritat() ?>">
                Prioritat: <?= e($tiquet->getPrioritat()) ?>
            </span>
            <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase <?= $tiquet->getBadgeEstat() ?>">
                Estat: <?= e($tiquet->getEstat()) ?>
            </span>
        </div>
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

    <!-- Targeta de detall del tiquet -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-4">
        <div class="border-b border-slate-100 pb-4">
            <div class="flex items-baseline gap-3">
                <span class="font-mono font-bold text-lg text-indigo-600"><?= e($tiquet->getCodi()) ?></span>
                <h1 class="text-xl font-bold text-slate-900"><?= e($tiquet->getTitol()) ?></h1>
            </div>
            <p class="text-xs text-slate-400 mt-1">Registrat el <?= e($tiquet->getDataCreacio()) ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm bg-slate-50 rounded-xl p-4 border border-slate-200/60">
            <div>
                <span class="block text-xs font-bold uppercase text-slate-400">Client / Sol·licitant</span>
                <span class="font-semibold text-slate-800"><?= e($tiquet->getClientNom()) ?></span>
                <span class="text-xs text-slate-500 block"><?= e($tiquet->getClientEmail()) ?></span>
            </div>
            <div>
                <span class="block text-xs font-bold uppercase text-slate-400">Estat d'Atenció</span>
                <span class="font-semibold text-slate-800 uppercase"><?= e($tiquet->getEstat()) ?></span>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Descripció del Problema</h3>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-700 leading-relaxed whitespace-pre-wrap"><?= e($tiquet->getDescripcio()) ?></div>
        </div>
    </div>

    <!-- SECCIÓ D'EXAMEN: Intervencions Tècniques (1:N) -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Historial d'Intervencions Tècniques</h2>
                <p class="text-xs text-slate-500">Registre d'actuacions, hores dedicades i resolució per part de l'equip de suport.</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs">
                Total: <?= count($intervencions) ?> actuacions
            </span>
        </div>

        <!-- Llista d'intervencions -->
        <div class="space-y-3">
            <?php if (empty($intervencions)): ?>
                <div class="p-8 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200 text-sm text-slate-400">
                    Encara no s'ha registrat cap intervenció tècnica per a este tiquet.
                </div>
            <?php else: ?>
                <?php foreach ($intervencions as $intervencio): ?>
                    <div class="p-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50/50 transition space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800"><?= e($intervencio->getNomUsuari() ?? 'Tècnic') ?></span>
                                <span>&bull;</span>
                                <span><?= e($intervencio->getDataIntervencio()) ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-indigo-700 bg-indigo-50 border border-indigo-100">
                                    <?= (int) $intervencio->getMinuts() ?> min
                                </span>
                                <?php if (method_exists($intervencio, 'esSignificativa') && $intervencio->esSignificativa()): ?>
                                    <span class="px-2 py-0.5 rounded font-semibold text-amber-700 bg-amber-50 border border-amber-200">
                                        &ge; 1h Treball
                                    </span>
                                <?php endif; ?>

                                <?php if (esAdmin() || idUsuariActual() === $intervencio->getUsuariId()): ?>
                                    <form action="eliminar_intervencio.php" method="POST" onsubmit="return confirm('Segur que vols eliminar esta intervenció?');" class="inline">
                                        <input type="hidden" name="id" value="<?= $intervencio->getId() ?>">
                                        <input type="hidden" name="tiquet_id" value="<?= $tiquet->getId() ?>">
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold ml-2">Eliminar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap"><?= e($intervencio->getComentari()) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Formulari per a registrar una nova intervenció -->
        <div class="pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Registrar nova actuació tècnica</h3>
            <form action="afegir_intervencio.php" method="POST" class="space-y-4">
                <input type="hidden" name="tiquet_id" value="<?= $tiquet->getId() ?>">

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="sm:col-span-1">
                        <label for="minuts" class="block text-xs font-bold uppercase text-slate-600 mb-1">Temps (en minuts)</label>
                        <input type="number" id="minuts" name="minuts" min="1" step="1" required placeholder="Ex: 45"
                            class="w-full bg-slate-50 border border-slate-300 focus:border-indigo-600 rounded-xl px-3 py-2 text-sm outline-none">
                    </div>
                    <div class="sm:col-span-3">
                        <label for="comentari" class="block text-xs font-bold uppercase text-slate-600 mb-1">Informe tècnic de l'actuació</label>
                        <textarea id="comentari" name="comentari" rows="3" required placeholder="Descriu les proves realitzades, configuracions aplicades o solucions..."
                            class="w-full bg-slate-50 border border-slate-300 focus:border-indigo-600 rounded-xl p-3 text-sm outline-none"></textarea>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-sm text-xs transition">
                        Guardar Intervenció
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php'; ?>
