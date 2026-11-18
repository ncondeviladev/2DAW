<?php

use App\Model\Bon;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $client_id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
    $tipus_bon = trim($_POST['tipus_bon'] ?? '');
    $preu = (float) $_POST['preu'] ?? '';
    $data_inici = $_POST['data_inici'] ?? '';
    $data_fi = $_POST['data_fi'] ?? '';

    $errors = [];

    if (!$client_id || $client_id <= 0) {
        $errors['client_id'] = 'El client no és vàlid.';
    }
    if ($tipus_bon === '') {
        $errors['tipus_bon'] = 'El bon no pot estar buit';
    }
    if (!is_numeric($preu) || $preu <= 0) {
        $errors['preu'] = 'El preu ha de ser valid';
    }

    if ($data_inici === '') {
        $errors['data_inici'] = 'La data inici no pot estar buida';
    }

    $bon = new Bon(
        client_id: $client_id,
        usuari_id: idUsuariActual(),
        tipus_bon: $tipus_bon,
        preu: $preu,
        data_inici: $data_inici,
        data_fi: $data_fi
    );

    $bonDAO->insert($bon);

    setFlash('exit', 'Bon registrat');
    header('Location: client.php?id=' . $client_id);
    exit;
}
header('Location: clients.php');
exit;