<?php

require_once __DIR__ . '/../../config/bootstrap.php';
use App\Model\Nota;

requereixLogin();

//Comprova si existeix el lead
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: leads.php');
    exit;
}


//Captura de dades
$notaId = isset($_POST['nota_id']) && ctype_digit($_POST['nota_id']) ? (int)$_POST['nota_id'] : 0;
$leadId = isset($_POST['lead_id']) && ctype_digit($_POST['lead_id']) ? (int)$_POST['lead_id'] : 0;

if($notaId <= 0 || $leadId <=0) {
    header('Location: leads.php');
    exit;

}

//Busca la nota
$nota = $notaDAO->findById($notaId);
if($nota === null) {
    $_SESSION['flash_error'] = 'La nota que intenteu eliminar no existeix.';
    header("Location: lead.php?id=$leadId");
    exit;
}

//Comrpova permisos
$usuariId = (int) ($_SESSION['usuari_id'] ?? 0);
$esAdmin = (($_SESSION['rol'] ?? '') === 'administrador');
$esAutor = $nota->getUsuariId() === $usuariId;

if(!$esAutor && !$esAdmin) {
    http_response_code(403);
    $_SESSION['flash_error'] = 'No teniu permisos per a eliminar aquesta nota.';
    header("Location: lead.php?id=$leadId");
    exit;
}
//Elimina la nota
try {
    $notaDAO->delete($notaId);
    $_SESSION['flash_exit'] = 'Nota eliminada';

}catch(PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash_error'] = 'Error al eliminar';
}

header("Location: lead.php?id=$leadId");
exit;