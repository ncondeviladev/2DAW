<?php
// TODO 1: Activa el mode estricte (ha de ser la primera línia absoluta)
declare(strict_types=1);

function formatarPressupost(float $quantitat, string $moneda = '€'): string
{
    // TODO 2: Retorna number_format($quantitat, 2, ',', '.') seguit d'un espai i la moneda
    return number_format($quantitat, 2, ',', '.') . ' ' . $moneda;
}

function buscarLeadPerId(array $llistat, int $id): ?array
{
    // TODO 3: Recorre $llistat amb foreach i retorna l'array del lead
    // el 'id' del qual coincidisca amb $id. Si no el troba, retorna null.
    foreach ($llistat as $lead) {
        if ($lead['id'] == $id) {
            return $lead;
        }
    }
    return null;
}

// Array ja proporcionat, no cal que el toques
$llistatLeads = [
    ['id' => 1, 'nom' => 'Joan Garcia', 'pressupost' => 4500.00],
    ['id' => 2, 'nom' => 'Laura Sanchis', 'pressupost' => 12000.00],
    ['id' => 3, 'nom' => 'Marc Climent', 'pressupost' => 800.00],
];

// TODO 4: Declara $preuBase = 1500.0 i crida formatarPressupost($preuBase)
// guardant el resultat en $preuFormatat
$preuBase = 1500.0;
$preuFormatat = formatarPressupost($preuBase);


// TODO 5: Crida buscarLeadPerId($llistatLeads, 2)
// guardant el resultat en $leadTrobat
$leadTrobat = buscarLeadPerId($llistatLeads, 2);

?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 5.2 - Mode estricte i tipus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full space-y-3">
        <p class="text-gray-700">Pressupost formatat: <span class="font-semibold"><?= $preuFormatat ?></span></p>
        <p class="text-gray-700">Lead trobat (ID 2): <span class="font-semibold"><?= $leadTrobat['nom'] ?></span></p>
    </div>

</body>

</html>