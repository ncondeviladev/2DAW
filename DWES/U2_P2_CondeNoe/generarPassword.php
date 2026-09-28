<?php


function generarPassword($longitud, $inclouNumeros = true, $inclouSimbols = false)
{
    $pass = "";

    $caracters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($inclouNumeros) {
        $caracters .= "0123456789";
    }
    if ($inclouSimbols) {
        $caracters .= "!@#$%&*?";
    }
    $totalCaracters = strlen($caracters);

    for ($i = 0; $i < $longitud; $i++) {
        $caracterAleatori = rand(0, $totalCaracters - 1);
        $pass .= $caracters[$caracterAleatori];
    }
    return $pass;
}

// Proves de la funció:
echo "<h2>Proves de generarPassword</h2>";

echo "1. Password (8 caràcters per defecte): " . generarPassword(8) . "<br>\n";

echo "2. Password (8 caràcters, només lletres): " . generarPassword(8, false) . "<br>\n";

echo "3. Password (12 caràcters, lletres, números i símbols): " . generarPassword(12, true, true) . "<br>\n";

echo "4. Password (10 caràcters amb símbols, ordre alterat amb arguments amb nom): " . generarPassword(inclouSimbols: true, longitud: 10) . "<br>\n";


echo "5. Password (6 caràcters, només lletres amb arguments amb nom): " . generarPassword(longitud: 6, inclouNumeros: false) . "<br>\n";