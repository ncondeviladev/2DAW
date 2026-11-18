<?php

use App\Model\Classe;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $client_id     = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
    $activitat     = trim($_POST['activitat'] ?? '');
    $durada_minuts = filter_input(INPUT_POST, 'durada_minuts', FILTER_VALIDATE_INT);
    $observacions  = trim($_POST['observacions'] ?? '');

    $errors = [];

    if (!$client_id) {
        $errors['client_id'] = 'El client no és vàlid.';
    }
    if ($activitat === '') {
        $errors['activitat'] = "El nom de l'activitat és obligatori.";
    }
    if (!$durada_minuts || $durada_minuts <= 0) {
        $errors['durada_minuts'] = 'La durada ha de ser un enter positiu.';
    }

    if (empty($errors)) {
        $classe = new Classe(
            client_id:     $client_id,
            usuari_id:     idUsuariActual(),
            activitat:     $activitat,
            durada_minuts: $durada_minuts,
            observacions:  $observacions,
        );

        $classeDAO->insert($classe);

        setFlash('exit', 'Classe registrada correctament.');
        header('Location: client.php?id=' . $client_id);
        exit;
    }
}

header('Location: clients.php');
exit;
