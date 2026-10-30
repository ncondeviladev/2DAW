<?php

require_once __DIR__ .  '/../../config/bootstrap.php';
use App\Model\Nota;

requereixLogin();

//Comprova si existeix el lead
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: leads.php');
    exit;
}

//Captura de dades
$leadId = isset($_POST['lead_id']) && ctype_digit($_POST['lead_id']) ? (int)$_POST['lead_id'] : 0;
$text = trim($_POST['text'] ?? '');

//Valida el text de la nota
if ($text === '') {
    $_SESSION['flash_error'] = 'El text no pot estar buit.';
    header("Location: lead.php?id=$leadId");
    exit;
}

if (mb_strlen($text) > 500) {
    $_SESSION['flash_error'] = 'La nota no pot superar els 500 caràcters.';
    header("Location: lead.php?id=$leadId");
    exit;
}

//Configura el usuari logejat com autor

$usuariId = (int) ($_SESSION['usuari_id'] ?? 0);

try {
    $nota = new Nota(
        lead_id: $leadId,
        usuari_id: $usuariId,
        text: $text,
    );

    $notaDAO->insert($nota);
    $_SESSION['flash_exit'] = "Nota afegida correctament.";
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash_error'] = 'Error al desar la nota a la base de dades.';
}
header("Location: lead.php?id=$leadId");
exit;
