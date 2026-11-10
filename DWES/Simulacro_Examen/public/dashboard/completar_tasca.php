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
$id = (int)($_POST['id'] ?? 0);
$usuariId = (int)($_SESSION['usuari_id'] ?? 0);



$tasca = $tascaDAO->findById($id);

if ($tasca === null) {
    $_SESSION['flash_error'] = 'La tasca no existeix.';
    header("Location: lead.php?id=$leadId");
    exit;
}

$esAdmin = (($_SESSION['rol'] ?? '') === 'administrador');
$esAutor = ($tasca->getUsuariId() === $usuariId);

if(!$esAutor && !$esAdmin) {
    http_response_code(403);
    $_SESSION['flash_error'] = 'Error usuari incorrecte';
    header("Location: lead.php?id=$leadId");
    exit;
} 

$tasca->marcarCompletada($Id);