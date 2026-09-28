<?php

$cistella = [
    ["nom" => "Teclat", "preu" => 45, "quantitat" => 2],
    ["nom" => "Ratolí", "preu" => 20, "quantitat" => 3],
    ["nom" => "Monitor", "preu" => 200, "quantitat" => 1],
];


function calcularCompra($cistella)
{
    $total = 0;
    foreach ($cistella as $nomProd) {
        $total += $nomProd["preu"] * $nomProd["quantitat"];
    }
    return $total;
}


$totalFinal = calcularCompra($cistella);
echo "El preu total de la compra és: " . $totalFinal . " €\n";