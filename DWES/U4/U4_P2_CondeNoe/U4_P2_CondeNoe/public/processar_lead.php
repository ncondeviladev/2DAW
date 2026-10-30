<?php

use App\Model\Lead;

require_once __DIR__ . '/../config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Recollida de dades
$nom = trim($_POST['contacte']['nom'] ?? '');
$email = trim($_POST['contacte']['email'] ?? '');
$telefon = trim($_POST['contacte']['telefon'] ?? '');
$empresa = trim($_POST['contacte']['empresa'] ?? '');
$serveis = filtrarServeis($_POST['serveis'] ?? []);
$pressupost = $_POST['pressupost'] ?? '';
$missatge = trim($_POST['missatge'] ?? '');
$termes = $_POST['termes'] ?? '';
$document = null;

// Validacions
$errors = validarDadesLead($nom, $email, $pressupost);

if ($termes === '') {
    $errors['termes'] = 'Cal acceptar els termes i condicions.';
}

// Pugem el document si no hi ha errors, per evitar documents orfes
if (empty($errors)) {
    try {
        $document = pujarArxiu($_FILES['document'] ?? [], CARPETA_PUJADES);
    } catch (RuntimeException $e) {
        $errors['document'] = $e->getMessage();
    }
}

if (empty($errors)) {
    $lead = new Lead(
        nom: $nom,
        email: $email,
        telefon: nullSiBuit($telefon),
        empresa: nullSiBuit($empresa),
        serveis: $serveis,
        pressupost: (float) $pressupost,
        missatge: nullSiBuit($missatge),
        document: $document
    );

    try {
        $leadDAO->insert($lead);

        header('Location: index.php?enviat=1');
        exit;
    } catch (PDOException $e) {
        // El lead no s'ha guardat: l'arxiu pujat quedaria orfe
        eliminarArxiu(CARPETA_PUJADES, $document);
        error_log($e->getMessage());
        $errors['bd'] = 'No s\'ha pogut guardar la sol·licitud. Torna-ho a provar més tard.';
    }
}

$_SESSION['errors'] = $errors;
$_SESSION['old'] = [
    'nom' => $nom,
    'email' => $email,
    'empresa' => $empresa,
    'telefon' => $telefon,
    'pressupost' => $pressupost,
    'serveis' => $serveis,
    'missatge' => $missatge,
    'termes' => $termes,
];

header('Location: index.php');
exit;