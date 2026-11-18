<?php

function show(mixed $var): void
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function e(?string $var): string
{
    return htmlspecialchars($var ?? '', ENT_QUOTES, 'UTF-8');
}

function requereixLogin(): void
{
    if (empty($_SESSION['usuari'])) {
        header('Location: /dashboard/login.php');
        exit;
    }
}

function esAdmin(): bool
{
    return !empty($_SESSION['usuari']['rol']) && $_SESSION['usuari']['rol'] === 'administrador';
}

function usuariActual(): ?string
{
    return $_SESSION['usuari']['nom'] ?? null;
}

function idUsuariActual(): ?int
{
    return isset($_SESSION['usuari']['id']) ? (int) $_SESSION['usuari']['id'] : null;
}

function setFlash(string $tipus, string $missatge): void
{
    $_SESSION['flash'][$tipus] = $missatge;
}

function getFlash(string $tipus): ?string
{
    if (isset($_SESSION['flash'][$tipus])) {
        $msg = $_SESSION['flash'][$tipus];
        unset($_SESSION['flash'][$tipus]);
        return $msg;
    }
    return null;
}
