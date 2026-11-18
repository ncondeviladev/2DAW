<?php

use App\DAO\TiquetDAO;
use App\DAO\UsuariDAO;
use App\DAO\IntervencioDAO;
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

$tiquetDAO = new TiquetDAO($connexio);
$usuariDAO = new UsuariDAO($connexio);
$intervencioDAO = new IntervencioDAO($connexio);

// En l'examen, una vegada creat IntervencioDAO, s'instanciarà ací:
// use App\DAO\IntervencioDAO;
// $intervencioDAO = new IntervencioDAO($connexio);
