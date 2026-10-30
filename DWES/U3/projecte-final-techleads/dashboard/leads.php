<?php
declare(strict_types=1);

//Carrega gestorleads + leads
require_once __DIR__ . '/../app/lib/GestorLeads.php';
iniciarSesioLead();

//Si no hi ha sesio iniciada redirigeix al login
if (!isset($_SESSION['usuari'])) {
    header('Location: login.php');
    exit;
}
$usuariActual = $_SESSION['usuari'];

//Proses del boto avança estat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accio'] ?? '') === 'avancar') {
    $id = (int) ($_POST['id'] ?? 0);
    if (($id > 0)) {
        avancarEstatLead($id);
    }
    header('Location: leads.php');
    exit;

}
//Obte la llista de leads
$leads = obtindreLeads();

// Calcul d'estadistiques
$totalLeads = count($leads);
$totalNous = 0;
$totalContactats = 0;
$totalTancats = 0;

foreach ($leads as $l) {
    if ($l instanceof Lead) {
        if ($l->getEstat() === Lead::ESTAT_NOU) {
            $totalNous++;
        } elseif ($l->getEstat() === Lead::ESTAT_CONTACTAT) {
            $totalContactats++;
        } elseif ($l->getEstat() === Lead::ESTAT_TANCAT) {
            $totalTancats++;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechLeads - Panell de leads</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Capçalera del Panell -->
    <header class="sticky top-0 z-30 bg-white/85 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3.5">
            <div class="flex items-center gap-3">
                <a href="../index.php" class="flex items-center gap-2.5 group">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                        TL
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">Tech<span
                            class="text-indigo-600">Leads</span></span>
                </a>
                <span
                    class="hidden sm:inline-block text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                    Panell Comercial
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div
                    class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100/80 border border-slate-200 text-xs font-semibold text-slate-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Benvinguda, <strong
                            class="text-indigo-600"><?= htmlspecialchars($usuariActual) ?></strong></span>
                </div>
                <a href="logout.php"
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-semibold text-rose-600 hover:text-rose-700 bg-rose-50/60 hover:bg-rose-100/70 border border-rose-200/70 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Tancar sessió</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Contingut Principal -->
    <main class="max-w-6xl mx-auto px-6 py-8 flex-1 w-full space-y-6">

        <!-- Capçalera de pàgina -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Leads rebuts</h1>
                <p class="text-sm text-slate-500 mt-1">Gestió, seguiment i actualització d'oportunitats comercials.</p>
            </div>
            <a href="../index.php"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold border border-indigo-200/80 transition-colors w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Nou formulari públic</span>
            </a>
        </div>

        <!-- Targetes d'estadístiques ràpides -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Leads</div>
                <div class="text-2xl font-extrabold text-slate-900 mt-1"><?= $totalLeads ?></div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
                <div class="text-xs font-semibold text-sky-600 uppercase tracking-wider">Nous</div>
                <div class="text-2xl font-extrabold text-sky-700 mt-1"><?= $totalNous ?></div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
                <div class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Contactats</div>
                <div class="text-2xl font-extrabold text-amber-700 mt-1"><?= $totalContactats ?></div>
            </div>
            <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-sm">
                <div class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Tancats</div>
                <div class="text-2xl font-extrabold text-emerald-700 mt-1"><?= $totalTancats ?></div>
            </div>
        </div>

        <?php if (!empty($leads)): ?>
            <!-- Taula de Leads -->
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3.5 px-4">Id</th>
                                <th class="py-3.5 px-4">Nom / Contacte</th>
                                <th class="py-3.5 px-4">Empresa</th>
                                <th class="py-3.5 px-4">Serveis</th>
                                <th class="py-3.5 px-4 text-right">Pressupost</th>
                                <th class="py-3.5 px-4">Document</th>
                                <th class="py-3.5 px-4 text-center">Estat</th>
                                <th class="py-3.5 px-4 text-right">Accions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php foreach ($leads as $lead): ?>
                                <?php if ($lead instanceof Lead): ?>
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3.5 px-4 font-mono font-semibold text-slate-500 text-xs">
                                            #<?= $lead->getId() ?></td>
                                        <td class="py-3.5 px-4">
                                            <div class="font-semibold text-slate-800"><?= htmlspecialchars($lead->getNom()) ?></div>
                                            <a href="mailto:<?= htmlspecialchars($lead->getEmail()) ?>"
                                                class="text-xs text-slate-400 block hover:text-indigo-600"><?= htmlspecialchars($lead->getEmail()) ?></a>
                                            <?php if ($lead->getTelefon()): ?>
                                                <div class="text-xs text-slate-400"><?= htmlspecialchars($lead->getTelefon()) ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-600">
                                            <?= !empty($lead->getEmpresa()) ? htmlspecialchars($lead->getEmpresa()) : '<span class="text-slate-400 text-xs">—</span>' ?>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <div class="flex flex-wrap gap-1">
                                                <?php foreach ($lead->getServeis() as $servei): ?>
                                                    <span
                                                        class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-xs font-medium"><?= htmlspecialchars($servei) ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 text-right font-bold text-slate-800">
                                            <?= number_format($lead->getPressupost(), 2, ',', '.') ?> €
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <?php if ($lead->getDocument()): ?>
                                                <a href="../pujades/<?= htmlspecialchars($lead->getDocument()) ?>" target="_blank"
                                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    <span class="max-w-[120px] truncate"
                                                        title="<?= htmlspecialchars($lead->getDocument()) ?>"><?= htmlspecialchars($lead->getDocument()) ?></span>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-slate-400 text-xs">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-center">
                                            <?php if ($lead->getEstat() === Lead::ESTAT_NOU): ?>
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                                    nou
                                                </span>
                                            <?php elseif ($lead->getEstat() === Lead::ESTAT_CONTACTAT): ?>
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    contactat
                                                </span>
                                            <?php else: ?>
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    tancat
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <?php if ($lead->getEstat() === Lead::ESTAT_TANCAT): ?>
                                                <button type="button" disabled
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-400 border border-slate-200 cursor-not-allowed">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>Completat</span>
                                                </button>
                                            <?php else: ?>
                                                <form method="POST" action="leads.php">
                                                    <input type="hidden" name="id" value="<?= $lead->getId() ?>">
                                                    <button type="submit" name="accio" value="avancar"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 transition-colors">
                                                        <span>Avança estat</span>
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <!-- Vista quan encara no hi ha cap lead -->
            <div
                class="bg-white p-12 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 text-center space-y-4">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Encara no hi ha cap sol·licitud</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Quan els clients envien el formulari de contacte
                        públic, apareixeran ací per al seu seguiment comercial.</p>
                </div>
                <div>
                    <a href="../index.php"
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-md shadow-indigo-500/20 transition-all">
                        <span>Obrir formulari públic</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <!-- Peu de pàgina -->
    <footer class="mt-auto border-t border-slate-200/80 bg-white py-6 text-sm text-slate-500">
        <div
            class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <div class="flex items-center gap-2.5">
                <span
                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-600 text-xs font-bold text-white shadow-sm shadow-indigo-500/20">TL</span>
                <span class="font-bold text-slate-800">Tech<span class="text-indigo-600">Leads</span></span>
                <span class="text-xs text-slate-400">· Panell de Control Comercial</span>
            </div>
            <p class="text-xs text-slate-400">&copy; 2026 TechLeads · CFGS DAW</p>
        </div>
    </footer>

</body>

</html>