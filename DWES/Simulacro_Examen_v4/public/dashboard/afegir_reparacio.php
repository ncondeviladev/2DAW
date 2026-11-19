<?php

use App\Model\Reparacio;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vehicle_id   = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
    $descripcio   = trim($_POST['descripcio'] ?? '');
    $hores_feina  = (float) ($_POST['hores_feina'] ?? 0);
    $cost_hora    = (float) ($_POST['cost_hora'] ?? 0);

    $errors = [];

    if (!$vehicle_id || $vehicle_id <= 0) {
        $errors['vehicle_id'] = 'El vehicle no és vàlid.';
    }
    if ($descripcio === '') {
        $errors['descripcio'] = 'La descripció del treball és obligatòria.';
    }
    if ($hores_feina <= 0) {
        $errors['hores_feina'] = 'Les hores han de ser un valor superior a 0.';
    }
    if ($cost_hora <= 0) {
        $errors['cost_hora'] = 'El cost per hora ha de ser un valor positiu.';
    }

    if (empty($errors)) {
        $reparacio = new Reparacio(
            vehicle_id:  $vehicle_id,
            usuari_id:   idUsuariActual(),
            descripcio:  $descripcio,
            hores_feina: $hores_feina,
            cost_hora:   $cost_hora,
        );

        $reparacioDAO->insert($reparacio);

        setFlash('exit', 'Feina de reparació registrada correctament.');
        header('Location: vehicle.php?id=' . $vehicle_id);
        exit;
    }
}

header('Location: vehicles.php');
exit;
