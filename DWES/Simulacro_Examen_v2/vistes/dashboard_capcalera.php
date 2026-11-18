<!DOCTYPE html>
<html lang="ca" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titolPagina ?? 'VetClinic Huellas') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3.5">
            <div class="flex items-center gap-3">
                <a href="pacients.php" class="flex items-center gap-2.5">
                    <div class="h-9 w-9 rounded-xl bg-emerald-600 flex items-center justify-center text-white font-black text-sm shadow-md shadow-emerald-500/20">
                        VC
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">Vet<span class="text-emerald-600">Clinic</span></span>
                </a>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                    Clínica Veterinària Huellas
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span><?= e(usuariActual()) ?> (<strong><?= e($_SESSION['usuari']['rol'] ?? 'veterinari') ?></strong>)</span>
                </div>
                <a href="logout.php" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-rose-600 hover:text-rose-700 bg-rose-50 border border-rose-200 transition">
                    Tancar sessió
                </a>
            </div>
        </div>
    </header>
    <main class="flex-1 max-w-6xl w-full mx-auto px-6 py-8">
