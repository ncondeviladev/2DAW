<?php
// TODO 1: Declara l'array associatiu $lead amb 'id', 'nom', 'email', 'pressupost' i 'actiu'
$lead = ['id' => 1, 'nom' => "Noé Conde", 'email' => "noeconvil@alu.edu.gva.es", 'pressupost' => 100, 'actiu' => true];

// TODO 2: Afig la clau 'telefon' => "600112233"
$lead['telefon'] = "600112233";

// TODO 3: Modifica la clau 'actiu' i posa-la a false
$lead['actiu'] = false;

// TODO 4: Comprova amb isset($lead['nom']) si la clau existeix.
// Si existeix, $nomMostrat = $lead['nom']; si no, $nomMostrat = "Sense nom"
if (isset($lead['nom'])) {
    $nomMostrat = $lead['nom'];
} else {
    $nomMostrat = "Sense nom";
}

// TODO 5: Amb foreach ($lead as $clau => $valor), construeix $llistaLead
// concatenant "<li><strong>{clau}:</strong> {valor}</li>" per cada parella
$llistaLead = '';
foreach ($lead as $clau => $valor) {
    $llistaLead .= "<li><strong>$clau:</strong> $valor</li>";
}



?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 4.2 - Fitxa d'un lead</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Lead: <?= $nomMostrat ?></h2>
        <ul class="text-gray-700 space-y-1">
            <?= $llistaLead ?>
        </ul>
    </div>

</body>

</html>