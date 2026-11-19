<?php

use App\Model\Recanvi;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int) ($_POST['id'] ?? 0);
    $recanvi = $recanviDAO->findById($id);

    if ($recanvi) {
        if ($recanvi->getUsuariId() !== idUsuariActual() && !esAdmin()) {
            http_response_code(403);
            exit;
        }
        $recanviDAO->delete($id);
        setFlash('exit', 'Peça eliminada correctament.');
        header('Location: vehicle.php?id=' . $recanvi->getVehicleId());
        exit;
    }


}

header('Location: vehicles.php');
exit;


