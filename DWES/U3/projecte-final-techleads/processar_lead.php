<?php

declare(strict_types=1);

require_once __DIR__ . '/app/lib/GestorLeads.php';
iniciarSesioLead();

//Si es post redirecciona a index php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

//Recollida de dades del formulari
$contacte = $_POST['contacte'] ?? [];
$nom = trim($contacte['nom'] ?? '');
$email = trim($contacte['email'] ?? '');
$telefon = trim($contacte['telefon'] ?? '');
$empresa = trim($contacte['empresa'] ?? '');

$serveis = $_POST['serveis'] ?? [];
$pressupost = trim($_POST['pressupost'] ?? '');
$missatge = trim($_POST['missatge'] ?? '');
$termes = isset($_POST['termes']);

$errors = [];

//Validacions
if ($nom == '') {
    $errors[] = 'El nom és obligatori';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email no valid';
}

if ($pressupost === '' || !is_numeric($pressupost) || (float) $pressupost <= 0) {
    $errors[] = 'Pressupost invàlid';
}
if (!$termes) {
    $errors[] = 'Has d\'acceptar els termes';
}


//Gestió de fitxer

$nomFitxerGuardat = null;
//Captura de fitxer
if (isset($_FILES['document']) && $_FILES['document']['error'] !== UPLOAD_ERR_NO_FILE) {
    $fitxer = $_FILES['document'];

    //Comprovacio de fitxer
    if ($fitxer['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "S'ha produit un error en la pujada";
    } else {
        if ($fitxer['size'] > 2 * 1024 * 1024) {
            $errors[] = "L'arxiu supera el pes màxim de 2MB";
        }
        //Comprovacio del tipus amb finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal = $finfo->file($fitxer['tmp_name']);

        $mimesPermesos = [
            'application/pdf' => 'pdf',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];
        //Comprova el format i descarta amb error o el guarda en directori
        if (!array_key_exists($mimeReal, $mimesPermesos)) {
            $errors[] = "Format d'arxiu no permés. Sols s'acepta PDF, JPG o PNG";
        } else {
            $extensio = $mimesPermesos[$mimeReal];
            $nomFitxerGuardat = 'doc_' . uniqid('', true) . '.' . $extensio;
            $desti = __DIR__ . '/pujades/' . $nomFitxerGuardat;

            if (!move_uploaded_file($fitxer['tmp_name'], $desti)) {
                $errors[] = "No s'ha pogut guardar l'arxiu...";
                $nomFitxerGuardat = null;
            }
        }

    }
}

//Decició final patró prg

//Si hi han errors els guardem i les dades d'usuari en $_SESSION
if(!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['valors_previs'] = [
        'nom' => $nom,
        'email' => $email,
        'telefon' => $telefon,
        'empresa' => $empresa,
        'serveis' => $serveis,
        'pressupost' => $pressupost,
        'missatge' => $missatge,
        'termes' => $termes,
    ];
    header('Location: index.php');
    exit;
}

//Si tot es correcte es crea el nou Lead
$nouId = proximIdLead();
$nouLead = new Lead(
    id: $nouId,
    nom: $nom,
    email: $email,
    serveis: $serveis,
    pressupost: (float) $pressupost,
    missatge: $missatge,
    telefon: $telefon !== '' ? $telefon : null,
    empresa: $empresa !== '' ? $empresa : null,
    document: $nomFitxerGuardat,
    estatInicial: Lead::ESTAT_NOU
);

afegirLead($nouLead);
header('Location: index.php?enviat=1');
exit;