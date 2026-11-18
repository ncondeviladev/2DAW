<?php

use App\Model\Bon;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? '';
    $bon = $bonDAO->findById($id);

    if ($id !== idUsuariActual() || !esAdmin()) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }
    $bonDAO->delete($id);
    setFlash('exit', 'Bon eliminat');
    header('Location: client.php?id=' . $client_id);
    exit;


}
header('Location: clients.php');
exit;