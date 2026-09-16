<?php
    // TODO 7 (repte opcional): activa ací la visualització d'errors
    // amb ini_set('display_errors', '1') i error_reporting(E_ALL)
    ini_set('display_errors', '1');
    error_reporting(E_ALL);


    // TODO 1: Declara $totalPagines = 5 i, amb un bucle for,
    // construeix $llistaPagines concatenant "<li>Pàgina X</li>" per cada pàgina
    $totalPagines = 5;
    $llistaPagines = '';
    for ($i = 1; $i <= $totalPagines; $i++) {
        $llistaPagines .= "<li>Pàgina $i</li>";
    }


    // TODO 2: Declara $intents = 0 i $maxIntents = 3. Amb un bucle while,
    // construeix $llistaIntents concatenant "<li>Intent número: X</li>"
    // (no oblides incrementar $intents dins del bucle)
    $intents = 0;
    $maxIntents = 3;
    $llistaIntents = '';
    while ($intents < $maxIntents) {
        $intents++;
        $llistaIntents .= "<li>Intent número: $intents</li>";
    }


    // Array ja proporcionat, no cal que el toques
    $serveis = ["Web Corporativa", "Botiga Online", "App Mòbil"];

    // TODO 3: Amb un foreach, construeix $llistaServeis concatenant
    // "<li>Servei</li>" per cada servei de l'array $serveis
    $llistaServeis = '';
    foreach ($serveis as $value) {
        $llistaServeis .= "<li>$value</li>";
    }

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 3.3 - Bucles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pàgines (for)</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?= $llistaPagines ?>
            </ul>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Intents (while)</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?= $llistaIntents ?>
            </ul>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Serveis (foreach)</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?= $llistaServeis ?>
            </ul>
        </div>

    </div>

</body>
</html>