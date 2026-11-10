<?php

require_once __DIR__ .  '/../../config/bootstrap.php';
use App\Model\Tasca;

requereixLogin();

//Comprova si existeix el lead
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: leads.php');
    exit;
}

$leadId = (int)($_POST['lead_id'] ?? 0);
$descripcio = trim($_POST['descripcio'] ?? '');
$dataLimit = trim($_POST['data_limit'] ?? '');
$usuariId = (int)($_SESSION['usuari_id'] ?? 0);
$completada = (int)($_POST['completada'] ?? 0);

if(empty($descripcio)) {
    $_SESSION['flash_error'] = 'La descripcio no pot estar buida';
    header("Location: lead.php?id=$leadId");
    exit;
}
if($dataLimit === '' || strtotime($dataLimit) === false) {
    $_SESSION['flash_error'] = 'Error en data limit';
    header("Location: lead.php?id=$leadId");
    exit;
}


try {
    $tasca = new Tasca(
        lead_id: $leadId,
        usuari_id: $usuariId,
        descripcio: $descripcio,
        data_limit: $dataLimit,
    );

    $tascaDAO->insert($tasca);
    $_SESSION['flash_exit'] = 'Tasca afegida correctament';
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Error al guardar la tasca en la db';
}
header("Location: lead.php?id=$leadId");
exit;