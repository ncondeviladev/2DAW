<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($titolPagina ?? 'FitLife Studio') ?></title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50">
<nav class="bg-white border-b border-slate-200 px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="text-lg font-bold text-emerald-700">FitLife Studio</span>
        <span class="text-xs text-slate-400">|</span>
        <a href="/dashboard/clients.php" class="text-sm text-slate-600 hover:text-emerald-600 transition">Clients</a>
    </div>
    <div class="flex items-center gap-3 text-xs text-slate-500">
        <span><?= e($_SESSION['usuari'] ?? '') ?></span>
        <?php if (esAdmin()): ?>
            <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-700 font-semibold">Admin</span>
        <?php endif; ?>
        <a href="/logout.php" class="text-rose-500 hover:text-rose-700 font-semibold transition">Eixir</a>
    </div>
</nav>
<main class="p-6">
