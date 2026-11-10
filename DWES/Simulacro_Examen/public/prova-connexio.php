<?php

require_once __DIR__ . '/../config/bootstrap.php';

try {
    $pdo = $connexio->getPDO();

    echo 'Leads a la base de dades: ';
    echo $pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn();

    echo '<br>Mateixa connexió reutilitzada? ';
    var_dump($connexio->getPDO() === $pdo);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}