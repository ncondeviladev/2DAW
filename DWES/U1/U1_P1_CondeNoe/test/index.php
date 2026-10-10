<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Test PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-xl shadow-md max-w-md w-full text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Hola des de test PHP 🚀</h1>
        <p class="text-gray-600 mb-4">Servidor web i intèrpret PHP funcionant correctament.</p>
        
        <p class="text-sm text-gray-500 bg-gray-50 py-2 px-4 rounded-lg inline-block border border-gray-200">
            Versió: <span class="font-semibold text-gray-700">PHP <?= phpversion() ?></span>
        </p>

        <div class="mt-6">
            <a href="/" class="text-sm text-blue-600 hover:underline">← Tornar a l'inici</a>
        </div>
    </div>

</body>
</html>
