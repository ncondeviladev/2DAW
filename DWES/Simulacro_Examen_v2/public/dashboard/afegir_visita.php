<?php

use App\Model\Visita;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

/**
 * Controlador de referència per a inserció (PRG).
 * Utilitza este fitxer com a plantilla per a construir `afegir_vacuna.php`.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pacient_id = filter_input(INPUT_POST, 'pacient_id', FILTER_VALIDATE_INT);
    $motiu      = trim($_POST['motiu'] ?? '');
    $diagnostic = trim($_POST['diagnostic'] ?? '');

    $errors = [];

    if (!$pacient_id) {
        $errors['pacient_id'] = "El pacient no és vàlid.";
    }

    if ($motiu === '') {
        $errors['motiu'] = "El motiu de la consulta és obligatori.";
    }

    if ($diagnostic === '') {
        $errors['diagnostic'] = "El diagnòstic és obligatori.";
    }

    // Si hi ha errors, guardem missatge d'error i redirigim
    if (!empty($errors)) {
        setFlash('error', implode(' ', $errors));
        header('Location: pacient.php?id=' . ($pacient_id ?: ''));
        exit;
    }

    // Si tot és vàlid, creem l'entitat associant l'usuari actual autenticat
    $visita = new Visita(
        pacient_id: $pacient_id,
        usuari_id:  idUsuariActual(),
        motiu:       $motiu,
        diagnostic:  $diagnostic
    );

    $visitaDAO->insert($visita);

    setFlash('exit', 'Visita clínica registrada correctament.');
    header('Location: pacient.php?id=' . $pacient_id);
    exit;
}

header('Location: pacients.php');
exit;
