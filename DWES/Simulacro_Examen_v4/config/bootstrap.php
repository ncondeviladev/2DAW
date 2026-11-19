<?php

use App\DAO\VehicleDAO;
use App\DAO\UsuariDAO;
use App\DAO\ReparacioDAO;
use App\Database\DBConnection;
use App\DAO\RecanviDAO;

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

$vehicleDAO = new VehicleDAO($connexio);
$usuariDAO = new UsuariDAO($connexio);
$reparacioDAO = new ReparacioDAO($connexio);
$recanviDAO = new RecanviDAO($connexio);

// =========================================================================
// TASCA D'EXAMEN:
// Quan hages creat RecanviDAO a src/DAO/RecanviDAO.php, registra'l ací:
// use App\DAO\RecanviDAO;
// $recanviDAO = new RecanviDAO($connexio);
// =========================================================================
