<?php

use App\Model\Lead;
use App\Model\Usuari;
use App\DAO\IDbAccess;

require_once __DIR__ . '/../vendor/autoload.php';

$lead = new Lead('Aina Soler', 'aina@textils.exemple', null, 'Tèxtils S.L.', ['Web', 'SEO'], 4500.00, null, null);
var_dump($lead->getId());      // NULL
var_dump($lead->getEstat());   // "nou"

$lead->avancarEstat();

var_dump($lead->toArray()['serveis']);   // string(...) "["Web","SEO"]"

var_dump($lead->getEstat());   // "contactat"

$usuari = new Usuari('ana', password_hash('contrasenya123', PASSWORD_DEFAULT));
var_dump($usuari->verificarContrasenya('contrasenya123'));  // bool(true)
var_dump($usuari->verificarContrasenya('altra'));           // bool(false)



var_dump(interface_exists(IDbAccess::class));   // bool(true)