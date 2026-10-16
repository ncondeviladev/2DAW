<?php
// Llistat de diversos Leads (Array indexat que conté arrays associatius)
$llistatLeads = [
    [
        'id'         => 1,
        'nom'        => 'Joan Garcia222',
        'empresa'    => 'Tèxtils S.L.',
        'pressupost' => 4500.00,
        'estat'      => 'nou'
    ],
    [
        'id'         => 2,
        'nom'        => 'Laura Sanchis',
        'empresa'    => 'Innovació Tech',
        'pressupost' => 12000.00,
        'estat'      => 'convertit'
    ],
    [
        'id'         => 3,
        'nom'        => 'Marc Climent',
        'empresa'    => 'Econova',
        'pressupost' => 800.00,
        'estat'      => 'descartat'
    ]
];

// Recórrer cada registre i totes les seues claus dinàmicament
foreach ($llistatLeads as $index => $lead) {
    echo "<h3>Lead #" . ($index + 1) . "</h3>";
    echo "<ul>";
    foreach ($lead as $clau => $valor) {
        echo "<li><strong>{$clau}:</strong> {$valor}</li>";
    }
    echo "</ul>";
}
