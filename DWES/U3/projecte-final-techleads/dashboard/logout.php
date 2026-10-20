<?php

declare(strict_types=1);

session_start();

// Buida i destruix la sessio
$_SESSION = [];
session_destroy();

// Borrem la cookie recordam
setcookie('recorda_usuari', '', time() - 3600, '/');

// Redirigim al formulari de login
header('Location: login.php');
exit;
