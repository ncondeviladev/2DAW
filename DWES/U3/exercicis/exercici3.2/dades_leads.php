<?php
// LÒGICA: dades i càlculs. Ací no hi ha HTML.

function obtenirLeads(): array
{
    // En un cas real, ací hi hauria una consulta a la base de dades
    return [
        ['nom' => 'Aina Soler', 'empresa' => 'Tèxtils S.L.', 'pressupost' => 4500.0],
        ['nom' => 'Marc Climent', 'empresa' => 'Econova', 'pressupost' => 800.0],
        ['nom' => 'Laura Sanchis', 'empresa' => 'Innovació Tech', 'pressupost' => 12000.0],
    ];
}

function calcularPressupostTotal(array $leads): float
{
    // TODO 1: Recorre $leads amb un foreach, suma el 'pressupost' de cada lead
    // i retorna el total
    $total = 0;
    foreach ($leads as $l) {
        $total += (float) $l['pressupost'];
    }
    return $total;
}