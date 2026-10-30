<?php

require_once __DIR__ . '/../../config/bootstrap.php';

// Els leads ja no estan a la sessió: podem destruir-la sencera
$_SESSION = [];
session_destroy();

setcookie('usuari', '', time() - 1, '/');

header('Location: login.php');
exit;