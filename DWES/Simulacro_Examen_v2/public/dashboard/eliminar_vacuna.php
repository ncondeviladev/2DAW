<?php

use App\Model\Vacuna;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $vacuna = $vacunaDAO->findById((int)($_POST['id'] ?? ''));

if(!$vacuna) {
    header('Location: pacientes.php');
    exit;
}

    if ($vacuna->getUsuariId() !== idUsuariActual() && !esAdmin()) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }
    $vacunaDAO->delete($vacuna->getId());

    setFlash('exit', 'Vacuna eliminada');
    header('Location: pacient.php?id=' . $vacuna->getPacientId());
    exit;

}
header('Location: pacients.php');
exit;