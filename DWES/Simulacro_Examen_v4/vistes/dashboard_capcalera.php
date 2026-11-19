<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($titolPagina ?? 'AutoTaller MotorPlus') ?></title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50">
<nav class="bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="text-lg font-bold text-amber-700 tracking-tight">AutoTaller MotorPlus</span>
        <span class="text-xs text-slate-300">|</span>
        <a href="/dashboard/vehicles.php" class="text-sm font-semibold text-slate-700 hover:text-amber-600 transition">Vehicles</a>
    </div>
    <div class="flex items-center gap-3 text-xs text-slate-500">
        <span class="font-medium text-slate-700"><?= e($_SESSION['usuari'] ?? '') ?></span>
        <?php if (esAdmin()): ?>
            <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold uppercase text-[10px]">Admin</span>
        <?php else: ?>
            <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold uppercase text-[10px]">Mecànic</span>
        <?php endif; ?>
        <a href="/logout.php" class="text-rose-600 hover:text-rose-800 font-bold transition ml-2">Eixir</a>
    </div>
</nav>
<main class="p-6">
