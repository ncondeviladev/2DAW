<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>DWES - Pràctica 1 (Docker)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-xl shadow-md max-w-md w-full text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Entorn de Desenvolupament Docker</h1>
        <p class="text-gray-600 mb-4">Pràctica 1 — Noé Conde Vila (2n DAW)</p>
        
        <div class="bg-blue-50 text-blue-700 p-3 rounded-lg text-sm mb-6 font-medium">
            PHP <?= phpversion() ?> · Apache · MySQL · phpMyAdmin
        </div>

        <div class="flex gap-3 justify-center text-sm font-medium">
            <a href="/test/" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                Pàgina de Test 🚀
            </a>
            <a href="http://localhost:8081" target="_blank" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                phpMyAdmin
            </a>
        </div>
    </div>

</body>
</html>
