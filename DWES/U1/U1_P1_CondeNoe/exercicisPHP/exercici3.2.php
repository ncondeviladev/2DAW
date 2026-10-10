<?php
    // TODO 1: Declara $estatLead = "contactat"
    $estatLead = "contactat";


    // TODO 2: Completa l'estructura switch perquè assigne $missatgeSwitch
    switch ($estatLead) {
        // Escriu ací els case necessaris, amb el seu break;
        case "nou":
            $missatgeSwitch = "Tens un nou lead pendent d'assignar.";
            break;
        case "contactat":
            $missatgeSwitch = "S'ha enviat un correu al client.";
            break;
        case "convertit":
            $missatgeSwitch = "El projecte s'ha acceptat!.";
            break;
        default:
            $missatgeSwitch = "Estat no reconegut";
    }


    // TODO 3: Escriu una expressió match($estatLead) equivalent
    // i assigna el resultat a $missatgeMatch

    $missatgeMatch = match($estatLead) {
        "nou" => "Tens un nou lead pendent d'assignar.",
        "contactat" => "S'ha enviat un correu al client.",
        "convertit" => "El projecte s'ha acceptat!.",
        default => "Estat no reconegut"
    };

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 3.2 - Switch vs Match</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center gap-4 p-8">

    <div class="bg-white p-6 rounded-lg shadow-md max-w-md w-full">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Resultat amb <code>switch</code></h3>
        <p class="text-gray-700"><?= $missatgeSwitch ?></p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md max-w-md w-full">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Resultat amb <code>match</code></h3>
        <p class="text-gray-700"><?= $missatgeMatch ?></p>
    </div>

</body>
</html>