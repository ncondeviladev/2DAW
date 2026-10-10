<?php
    // TODO 1: Defineix la constant NOM_EMPRESA = "TechLeads" amb define()
    define("NOM_EMPRESA", "TechLeads");

    // TODO 2: Defineix la constant IVA_PERCENT = 21 amb const
    const IVA_PERCENT = 21;

    // TODO 3: Declara $preuBase = 1500
    $preuBase = 1500;

    // TODO 6: Afig ací un comentari d'una línia explicant el càlcul següent
    //L'IVA es trau fent un calcul entre el preu base i el percentatge d'IVA sobre 100, per a calcular el preu final sumem al preu base el calcul de l'IVA
    // TODO 4: Calcula $preuIva ($preuBase * IVA_PERCENT / 100)
    $preuIva = $preuBase * IVA_PERCENT / 100;
    // TODO 5: Calcula $preuFinal ($preuBase + $preuIva)
    $preuFinal = $preuBase + $preuIva;

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 2.3 - Pressupost amb IVA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 mb-4"><?= NOM_EMPRESA?></h2>
        <p class="text-gray-600">Preu base: <?= $preuBase?> €</p>
        <p class="text-gray-600">IVA: <?= IVA_PERCENT ?> %</p>
        <p class="text-2xl font-bold text-blue-700 mt-4">
            Total: <?= $preuFinal ?> €
        </p>
    </div>

</body>
</html>