<?php

use App\Model\Vacuna;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pacient_id = filter_input(INPUT_POST, 'pacient_id', FILTER_VALIDATE_INT);
    $nom_vacuna = trim($_POST['nom_vacuna'] ?? '');
    $preu = (float) trim($_POST['preu'] ?? '');
    $usuari_id = trim($_POST['usuari_id'] ?? '');
    $proxima_dosi = trim($_POST['proxima_dosi'] ?? null);
    $data_administracio = ($_POST['data_administracio'] ?? null);


    $errors = [];

    if (!$pacient_id) {
        $errors['pacient_id'] = "El pacient no és vàlid.";
    }

    if ($nom_vacuna === '') {
        $errors['nom_vacuna'] = "El nom de la vacuna de la consulta és obligatori.";
    }
    if ($preu <= 0 || is_numeric($preu)) {
        $errors['preu'] = "El preu ha de ser vàlid.";
    }

    $vacuna = new Vacuna(
        $pacient_id,
        idUsuariActual(),
        $nom_vacuna,
        $preu,
        $proxima_dosi,
        $data_administracio,
    );

    $vacunaDAO->insert($vacuna);

    setFlash('exit', 'Vacuna registrada');
    header('Location: pacient.php?id=' . $pacient_id);
    exit;
}
header('Location: pacients.php');
exit;