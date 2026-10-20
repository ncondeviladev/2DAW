<?php

declare(strict_types=1);
/**
 * Clase GestorLeads
 * Gestiona les funciones de la clase Lead
 */

require_once __DIR__ . '/Lead.php';


//Assegura que la sesio esta iniciadai que existeix el array de leads
function iniciarSesioLead(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['leads']) || !is_array($_SESSION['leads'])) {
        $_SESSION['leads'] = [];
    }
}
//Retorna el array de leads en la sessió
function obtindreLeads(): array
{
    iniciarSesioLead();
    return $_SESSION['leads'];
}

//Retorna el que serà el proxim lead i si no hi ha comença per 1.
function proximIdLead(): int
{
    iniciarSesioLead();

    if (empty($_SESSION['leads']))
        return 1;

    $ids = array_map(fn(Lead $lead) => $lead->getId(), $_SESSION['leads']);
    return max($ids) + 1;

}
//Agrega un nou lead al array de leads de la sesió
function afegirLead(Lead $lead): void
{
    iniciarSesioLead();
    $_SESSION['leads'][] = $lead;
}
//Avança d'estat un lead retornant si ho ha cumplit satisfactoriament amb booleà
function avancarEstatLead(int $id): bool
{
    iniciarSesioLead();

    foreach ($_SESSION['leads'] as $l) {
        if ($l instanceof Lead && $l->getId() === $id) {
            $l->avancarEstat();
            return true;
        }
    }
    return false;
}

