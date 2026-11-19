<?php

function requereixLogin(): void
{
    if (empty($_SESSION['usuari_id'])) {
        header('Location: /index.php');
        exit;
    }
}

function idUsuariActual(): int
{
    return (int) ($_SESSION['usuari_id'] ?? 0);
}

function esAdmin(): bool
{
    return ($_SESSION['rol'] ?? '') === 'administrador';
}

function setFlash(string $clau, string $missatge): void
{
    $_SESSION['flash'][$clau] = $missatge;
}

function getFlash(string $clau): ?string
{
    if (isset($_SESSION['flash'][$clau])) {
        $valor = $_SESSION['flash'][$clau];
        unset($_SESSION['flash'][$clau]);
        return $valor;
    }
    return null;
}

function e(mixed $valor): string
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
