<?php

use App\DAO\LeadDAO;
use App\DAO\UsuariDAO;
use App\Database\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';
const CARPETA_PUJADES = __DIR__ . '/../public/pujades';

session_start();

$config = require __DIR__ . '/database.php';

$connexio = new DBConnection(
    host: $config['host'],
    baseDades: $config['base_dades'],
    usuari: $config['usuari'],
    contrasenya: $config['contrasenya'],
    charset: $config['charset']
);

$leadDAO = new LeadDAO($connexio);
$usuariDAO = new UsuariDAO($connexio);