<?php

use App\Model\Intervencio;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    $intervencio = $intervencioDAO->findById((int) $id);

    if (idUsuariActual() !== $intervencio->getUsuariId() && !esAdmin()) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }
    $intervencioDAO->delete($id);
    header('Location: tiquet.php?id=' . $intervencio->getTiquetId());
    exit;



}