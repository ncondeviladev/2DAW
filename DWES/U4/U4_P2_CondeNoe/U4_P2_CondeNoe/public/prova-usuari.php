<?php

use App\Model\Usuari;

require_once __DIR__ . '/../config/bootstrap.php';

try {
    $usuari = new Usuari('miquel', password_hash('secret123', PASSWORD_DEFAULT));
    $id = $usuariDAO->insert($usuari);

    echo "Usuari creat amb id $id";
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}