<?php
// TODO 1: Declara la variable global $percentatgeComissio amb el valor 10
$percentatgeComisio = 10;

function calcularComissio($pressupostVenda)
{
    // TODO 2: Fes accessible ací dins la variable global $percentatgeComissio
    global $percentatgeComisio;

    // TODO 3: Calcula la comissió ($pressupostVenda * $percentatgeComissio / 100)
    // i retorna-la amb return
    return $pressupostVenda * $percentatgeComisio / 100;
}

// TODO 4: Declara $vendaMarc = 4000 i crida calcularComissio($vendaMarc)
// guardant el resultat en $comissioMarc

$vendaMarc = 4000;
$comissioMarc = calcularComissio($vendaMarc);
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 2.2 - Comissió del comercial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full text-center">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Comissió de Marc</h2>
        <p class="text-gray-600">Venda: 4000 €</p>
        <p class="text-3xl font-bold text-green-600 mt-4">
            <?= $comissioMarc ?> €
        </p>
    </div>

</body>

</html>