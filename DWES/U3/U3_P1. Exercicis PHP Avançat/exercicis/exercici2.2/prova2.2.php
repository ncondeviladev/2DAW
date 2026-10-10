<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova de l'exercici 2.2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <h1 class="text-xl font-bold text-gray-800 mb-4">Consulta un lead (JSON)</h1>
        <ul class="space-y-2">
            <li><a href="exercici2.2.php?id=1" class="text-blue-600 hover:underline">Lead amb id 1</a></li>
            <li><a href="exercici2.2.php?id=2" class="text-blue-600 hover:underline">Lead amb id 2</a></li>
            <li><a href="exercici2.2.php?id=99" class="text-red-600 hover:underline">Lead amb id 99 (no existeix)</a></li>
        </ul>
    </div>

</body>
</html>