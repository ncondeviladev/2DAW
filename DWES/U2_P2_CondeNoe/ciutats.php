<?php

$ciutats = ["barcelona" => 160000, "valencia" => 80000, "madrid" => 3000000, "roma" => 2800000, "paris" => 2200000, "gandia" => 75000, "alicante" => 120000];


function buscarPoblacio($ciutatBuscada, $ciutats) //Sé que açí no demanes funció pero preferisc fero aixina ho vec mes net
{
    $ciutatBuscada = strtolower(trim($ciutatBuscada));

    if (array_key_exists($ciutatBuscada, $ciutats)) {
        $poblacio = number_format($ciutats[$ciutatBuscada], 0, ",", ".");
        return "<p style='color:green;'>La població de <strong>" . ucfirst($ciutatBuscada) . "</strong> es de <strong>$poblacio habitants</strong>.</p>";
    } else {
        return "<p style='color:red;'><strong>Error:</strong> La ciutat introduïda no es troba en la base de dades.</p>";
    }
}


$missatge = "";
if (isset($_POST["ciutat"])) {
    $missatge = buscarPoblacio(
        $_POST["ciutat"],
        $ciutats
    );
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Exercici 2 - Buscador de Població de Ciutats</title>
    <meta name="author" content="Noé Conde Vila">
    <meta name="description" content="Cercador de població de ciutats en PHP utilitzant arrays associatius">
    <meta name="keywords" content="DWES, PHP, array associatiu, ciutats, poblacio">
    <meta name="robots" content="index, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>

<body>
    <header class="container" style="max-width: 650px; margin-top: 30px;">
        <h1>Buscador de població</h1>
        <p>Unitat 2 - DWES PHP</p>
    </header>
    <main class="container" style="max-width: 650px;">
        <section>
            <form method="POST">
                <label for="ciutat">Introdueix el nom d'una ciutat:</label>
                <fieldset role="group">
                    <input type="text" id="ciutat" name="ciutat" placeholder="Ex: Valencia, Gandia, Madrid..." required>
                    <input type="submit" value="consultar">
                </fieldset>
            </form>
        </section>
        <section>
            <?= $missatge ?>
        </section>

    </main>
</body>

</html>