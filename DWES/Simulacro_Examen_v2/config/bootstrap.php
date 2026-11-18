<?php

use App\DAO\PacientDAO;
use App\DAO\UsuariDAO;
use App\DAO\VisitaDAO;
use App\DAO\VacunaDAO;
use App\Database\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$config = require __DIR__ . '/database.php';

$connexio = new DBConnection(
    host: $config['host'],
    baseDades: $config['base_dades'],
    usuari: $config['usuari'],
    contrasenya: $config['contrasenya'],
    charset: $config['charset']
);

$pacientDAO = new PacientDAO($connexio);
$usuariDAO = new UsuariDAO($connexio);
$visitaDAO = new VisitaDAO($connexio);
$vacunaDAO = new VacunaDAO($connexio);

// =========================================================================
// TASCA D'EXAMEN:
// Quan hages creat VacunaDAO a src/DAO/VacunaDAO.php, registra'l ací:
// use App\DAO\VacunaDAO;
// $vacunaDAO = new VacunaDAO($connexio);
// =========================================================================
