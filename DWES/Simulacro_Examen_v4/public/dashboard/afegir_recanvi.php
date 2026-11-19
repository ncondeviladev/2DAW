<?php

use App\Model\Recanvi;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
    $nom_peca = trim($_POST['nom_peca'] ?? '');
    $preu_unitari = $_POST['preu_unitari'] ?? 0;
    $quantitat = $_POST['quantitat'] ?? 0;

    $errors = [];

    if ($nom_peca === '') {
        $errors['nom_peca'] = 'El nom de la peça es obligatori.';
    }
    if ($preu_unitari <= 0) {
        $errors['preu_unitari'] = 'El preu no pot ser 0';
    }
    if ($quantitat <= 0) {
        $errors['quantitat'] = 'La quantitat no pot ser 0';
    }

    if (empty($errors)) {
        $recanvi = new Recanvi(
            vehicle_id: $vehicle_id,
            usuari_id: idUsuariActual(),
            nom_peca: $nom_peca,
            preu_unitari: $preu_unitari,
            quantitat: $quantitat
        );
        $recanviDAO->insert($recanvi);

        setFlash('exit', 'Peca de recanvi registrada correctament.');
        header('Location: vehicle.php?id=' . $vehicle_id);
        exit;

    }
}

header('Location: vehicles.php');
exit;








