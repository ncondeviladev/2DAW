<?php

use App\DAO\ClientDAO;
use App\DAO\UsuariDAO;
use App\DAO\ClasseDAO;
use App\DAO\BonDAO;
use App\Database\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

session_start();

$config = require __DIR__ . '/database.php';

$connexio = new DBConnection(
    host: $config['host'],
    baseDades: $config['base_dades'],
    usuari: $config['usuari'],
    contrasenya: $config['contrasenya'],
    charset: $config['charset']
);

$clientDAO = new ClientDAO($connexio);
$usuariDAO = new UsuariDAO($connexio);
$classeDAO = new ClasseDAO($connexio);
$bonDAO = new BonDAO($connexio);

// =========================================================================
// TASCA D'EXAMEN:
// Quan hages creat BonDAO a src/DAO/BonDAO.php, registra'l ací:
// use App\DAO\BonDAO;
// $bonDAO = new BonDAO($connexio);
// =========================================================================
