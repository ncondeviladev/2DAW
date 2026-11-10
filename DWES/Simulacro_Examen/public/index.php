<?php
require_once __DIR__ . '/../config/bootstrap.php';

//Comprovem si el formulari ha sigut correcte
$formularioEnviado = $_GET['enviat'] ?? 0;

//Arrepleguem errors i dades enviades (old)
$errorsFormulario = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [
        'nom' => '', 'email' => '', 'telefon' => '', 'empresa' => '',
        'serveis' => [], 'pressupost' => '', 'missatge' => '', 'termes' => ''
    ];

//Netegem les dades de la sessió
unset($_SESSION['errors']);
unset($_SESSION['old']);


require_once __DIR__ . '/../vistes/capcalera.php';
?>

<!-- Contingut Principal -->
<main class="max-w-3xl mx-auto px-6 py-10 flex-1 w-full space-y-8">

    <!-- Secció de Títol i Hero -->
    <div class="space-y-3 text-center sm:text-left">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200/60 text-xs font-semibold text-indigo-700">
            <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
            Resposta en menys de 24 hores
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Sol·licita <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">informació</span>
        </h1>
        <p class="text-slate-600 text-base max-w-xl">
            Explica'ns el teu projecte tecnològic i el nostre equip comercial prepararà una proposta a la teua mida sense compromís.
        </p>
    </div>

    <?php if ($formularioEnviado): ?>
    <div class="flex items-start gap-3.5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm">
        <div class="p-1 rounded-lg bg-emerald-100 text-emerald-600 shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-emerald-900">Sol·licitud enviada correctament!</p>
            <p class="text-sm text-emerald-700 mt-0.5">Hem registrat les teues dades i ens posarem en contacte amb tu molt prompte.</p>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($errorsFormulario)): ?>
    <div class="flex items-start gap-3.5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 shadow-sm">
        <div class="p-1 rounded-lg bg-rose-100 text-rose-600 shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div class="space-y-1">
            <p class="font-semibold text-rose-900">Cal que revises les dades del formulari:</p>
            <ul class="list-disc list-inside text-sm text-rose-700 space-y-0.5">
                <?php foreach($errorsFormulario as $error) {
                    echo "<li>{$error}</li>";
                } ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <!-- Formulari Públic -->
    <form method="POST" action="processar_lead.php" enctype="multipart/form-data"
        class="bg-white rounded-2xl p-6 sm:p-8 shadow-xl shadow-slate-200/50 border border-slate-200/80 space-y-6">

        <div class="border-b border-slate-100 pb-4">
            <h2 class="text-lg font-bold text-slate-800">Dades de contacte</h2>
            <p class="text-xs text-slate-500">Introdueix la teua informació perquè puguem respondre't.</p>
        </div>

        <!-- Dades personals i d'empresa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="nom" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Nom i cognoms <span class="text-indigo-600">*</span>
                </label>
                <input type="text" id="nom" name="contacte[nom]" value="<?= e($old['nom']) ?>" placeholder="Ex: Joan Garcia"
                    class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Email de contacte <span class="text-indigo-600">*</span>
                </label>
                <input type="email" id="email" name="contacte[email]" value="<?= e($old['email']) ?>" placeholder="nom@empresa.com"
                    class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
            </div>

            <div>
                <label for="telefon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Telèfon <span class="text-xs font-normal text-slate-400 capitalize">(opcional)</span>
                </label>
                <input type="text" id="telefon" name="contacte[telefon]" value="<?= e($old['telefon']) ?>" placeholder="600 123 456"
                    class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
            </div>

            <div>
                <label for="empresa" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Empresa <span class="text-xs font-normal text-slate-400 capitalize">(opcional)</span>
                </label>
                <input type="text" id="empresa" name="contacte[empresa]" value="<?= e($old['empresa']) ?>" placeholder="Nom de la companyia"
                    class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
            </div>
        </div>

        <!-- Serveis d'interés -->
        <fieldset class="pt-2">
            <legend class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">
                Serveis d'interés <span class="text-xs font-normal text-slate-400 capitalize">(tria un o més)</span>
            </legend>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <label class="relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-indigo-50/40 hover:border-indigo-200 cursor-pointer transition-all">
                    <input type="checkbox" name="serveis[]" value="Web" <?= in_array('Web', $old['serveis'])?'checked':''; ?>
                        class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">Web</span>
                </label>

                <label class="relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-indigo-50/40 hover:border-indigo-200 cursor-pointer transition-all">
                    <input type="checkbox" name="serveis[]" value="App mòbil"  <?= in_array('App mòbil', $old['serveis'])?'checked':''; ?>
                        class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">App mòbil</span>
                </label>

                <label class="relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-indigo-50/40 hover:border-indigo-200 cursor-pointer transition-all">
                    <input type="checkbox" name="serveis[]" value="SEO" <?= in_array('SEO', $old['serveis'])?'checked':''; ?>
                        class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">SEO</span>
                </label>

                <label class="relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-indigo-50/40 hover:border-indigo-200 cursor-pointer transition-all">
                    <input type="checkbox" name="serveis[]" value="Cloud" <?= in_array('Cloud', $old['serveis'])?'checked':''; ?>
                        class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                    <span class="text-sm font-medium text-slate-700">Cloud</span>
                </label>
            </div>
        </fieldset>

        <!-- Pressupost estimat -->
        <div>
            <label for="pressupost" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Pressupost estimat (€) <span class="text-indigo-600">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 font-medium">€</span>
                <input type="text" id="pressupost" name="pressupost" value="<?= e($old['pressupost']) ?>" placeholder="Ex: 5000"
                    class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl pl-9 pr-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
            </div>
        </div>

        <!-- Missatge -->
        <div>
            <label for="missatge" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Descripció del projecte
            </label>
            <textarea id="missatge" name="missatge" rows="4" placeholder="Detalla què necessites, terminis previstos, funcionalitats clau..."
                class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none resize-y"><?= e($old['missatge']) ?></textarea>
        </div>

        <!-- Pujada de document -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Document amb requisits o briefing <span class="text-xs font-normal text-slate-400 capitalize">(opcional)</span>
            </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl bg-slate-50/60 hover:bg-indigo-50/30 hover:border-indigo-300 transition-all group">
                <div class="space-y-1 text-center">
                    <div class="mx-auto h-10 w-10 text-slate-400 group-hover:text-indigo-600 transition-colors flex items-center justify-center">
                        <svg class="w-8 h-8" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="flex text-sm text-slate-600 justify-center">
                        <label for="document" class="relative cursor-pointer rounded-md font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                            <span>Selecciona un arxiu</span>
                            <input id="document" name="document" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">o arrossega'l ací</p>
                    </div>
                    <p class="text-xs text-slate-400">
                        Formats permesos: PDF, JPG o PNG (màxim 2 MB)
                    </p>
                </div>
            </div>
        </div>

        <!-- Termes i condicions -->
        <div class="pt-2">
            <label class="flex items-start gap-3 text-slate-700 cursor-pointer">
                
                <input type="checkbox" name="termes" <?= $old['termes']?'checked':'' ?> class="w-4 h-4 mt-0.5 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                <span class="text-xs text-slate-600 leading-relaxed">
                    Accepte que TechLeads utilitze estes dades exclusivament per a contactar-me i gestionar esta sol·licitud de pressupost.
                </span>
            </label>
        </div>

        <!-- Botó d'enviament -->
        <button type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold px-7 py-3 rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:-translate-y-0.5 transition-all duration-200">
            <span>Enviar sol·licitud</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </button>
    </form>

</main>

<?php

include_once __DIR__ . '/../vistes/peu.php';
