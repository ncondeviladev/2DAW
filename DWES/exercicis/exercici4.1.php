<?php
    // TODO 1: Declara $tecnologies com a array indexat amb "PHP", "MySQL", "TailwindCSS", "JavaScript"
    $tecnologies = ["PHP", "MySQL", "TailwindCSS", "JavaScript"];

    // TODO 2: Declara $primera accedint a la primera posició (índex 0)
    $primera = $tecnologies[0];

    // TODO 3: Declara $ultima accedint a l'última posició, usant count($tecnologies) - 1
    $ultima = $tecnologies[count($tecnologies) - 1];


    // TODO 4: Afig "Docker" al final de l'array amb $tecnologies[] = ...
    $tecnologies[] = "Docker";

    // TODO 5: Amb foreach ($tecnologies as $index => $tecnologia), construeix $llistaTec
    // concatenant "<li>Llenguatge {index}: {tecnologia}</li>" per cada element
    $llistaTec = '';
    foreach ($tecnologies as $index => $tecnologia) {
        $llistaTec .= "<li>Llenguatge $index: $tecnologia</li>";
    }

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 4.1 - Tecnologies del stack</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-2xl mx-auto">

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <p class="text-gray-700">Primera tecnologia: <span class="font-semibold"><?= $primera ?></span></p>
            <p class="text-gray-700">Última tecnologia (abans d'afegir Docker): <span class="font-semibold"><?= $ultima ?></span></p>
            <p class="text-gray-700">Total de tecnologies (després d'afegir Docker): <span class="font-semibold"><?= count($tecnologies) ?></span></p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Stack complet</h3>
            <ul class="list-disc list-inside text-gray-700">
                <?= $llistaTec ?>
            </ul>
        </div>

    </div>

</body>
</html>