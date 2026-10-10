<?php
    function calcularIVA(float $import, float $tipus = 21.0): float {
        // TODO 1: Calcula i retorna el preu final amb IVA
        // Fórmula: $import + ($import * $tipus / 100)
        return $import + ($import * $tipus / 100);
    }

    function aplicarDescompte(float &$preu, float $percentatge) {
        // TODO 2: Modifica directament $preu restant-li el percentatge indicat
        // Fórmula: $preu -= $preu * $percentatge / 100
        // Fixa't que $preu es passa per referència (&): no cal fer return
        $preu -= $preu * $percentatge / 100;
    }

    // TODO 3: Declara $preuBase = 1000 i crida calcularIVA($preuBase)
    // guardant el resultat en $preuAmbIvaDefecte
    $preuBase = 1000;
    $preuAmbIvaDefecte = calcularIVA($preuBase);


    // TODO 4: Crida calcularIVA($preuBase, 10.0)
    // guardant el resultat en $preuAmbIvaReduit
$preuAmbIvareduit = calcularIVA($preuBase, 10.0);

    // TODO 5: Declara $pressupostFinal = 2000.0 i crida
    // aplicarDescompte($pressupostFinal, 15)
    $pressupostFinal = 2000.0;
    aplicarDescompte($pressupostFinal, 15);

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 5.1 - Funcions i pas de paràmetres</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full space-y-3">
        <p class="text-gray-700">Preu amb IVA (21% per defecte): <span class="font-semibold"><?= $preuAmbIvaDefecte ?> €</span></p>
        <p class="text-gray-700">Preu amb IVA reduït (10%): <span class="font-semibold"><?= $preuAmbIvareduit ?> €</span></p>
        <p class="text-gray-700">Pressupost amb 15% de descompte: <span class="font-semibold"><?= $pressupostFinal ?> €</span></p>
    </div>

</body>
</html>