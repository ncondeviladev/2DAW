<?php
use App\Model\Lead;


function show(array|int|string|float $var) :void{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function e(string $var) :string {
    return htmlspecialchars($var);
}

function colorEstat(string $estat): string
{
    return match ($estat) {
        Lead::ESTAT_NOU => 'emerald',
        Lead::ESTAT_CONTACTAT => 'amber',
        Lead::ESTAT_TANCAT => 'sky',
        default => 'sky',
    };
}

/**
 * Puja un arxiu rebut d'un formulari a la carpeta indicada.
 *
 * @param array  $arxiu            Element de $_FILES (p. ex. $_FILES['document'])
 * @param string $carpetaDesti     Carpeta on es guardarà l'arxiu
 * @param array  $tipusPermesos    Tipus MIME permesos i l'extensió que els correspon
 * @param int    $grandariaMaxima  Grandària màxima en bytes
 *
 * @return string|null Nom de l'arxiu guardat, o null si no s'ha triat cap arxiu
 *
 * @throws RuntimeException Si l'arxiu no és vàlid o no es pot guardar
 */
function pujarArxiu(
    array $arxiu,
    string $carpetaDesti,
    array $tipusPermesos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'application/pdf' => 'pdf'],
    int $grandariaMaxima = 2 * 1024 * 1024
): ?string {
    $codiError = $arxiu['error'] ?? UPLOAD_ERR_NO_FILE;
    $missatgeGrandaria = 'L\'arxiu no pot superar els ' . ($grandariaMaxima / 1024 / 1024) . ' MB.';

    // L'arxiu és opcional: si no s'ha triat cap, no és un error
    if ($codiError === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    // PHP ja ha rebutjat l'arxiu perquè supera els límits de php.ini o del formulari
    if ($codiError === UPLOAD_ERR_INI_SIZE || $codiError === UPLOAD_ERR_FORM_SIZE) {
        throw new RuntimeException($missatgeGrandaria);
    }

    if ($codiError !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Hi ha un error al pujar el document.');
    }

    if ($arxiu['size'] > $grandariaMaxima) {
        throw new RuntimeException($missatgeGrandaria);
    }

    // Tipus REAL de l'arxiu, llegint-ne el contingut
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipusReal = $finfo->file($arxiu['tmp_name']);

    if (!isset($tipusPermesos[$tipusReal])) {
        throw new RuntimeException('Tipus d\'arxiu no permés.');
    }

    // L'extensió es deriva del tipus real detectat, no del nom original
    $nomArxiu = uniqid('doc_', true) . '.' . $tipusPermesos[$tipusReal];

    if (!move_uploaded_file($arxiu['tmp_name'], rtrim($carpetaDesti, '/') . '/' . $nomArxiu)) {
        throw new RuntimeException('Error en moure l\'arxiu.');
    }

    return $nomArxiu;
}

/**
 * Elimina un arxiu de la carpeta indicada, si existeix.
 */
function eliminarArxiu(string $carpeta, ?string $nomArxiu): void
{
    if ($nomArxiu === null || $nomArxiu === '') {
        return;
    }

    // basename() evita que un nom manipulat isca de la carpeta (p. ex. "../config/database.php")
    $ruta = rtrim($carpeta, '/') . '/' . basename($nomArxiu);

    if (is_file($ruta)) {
        unlink($ruta);
    }
}

/**
 * Valida les dades comunes d'un lead.
 * Retorna un array d'errors (buit si tot és correcte).
 */
function validarDadesLead(string $nom, string $email, mixed $pressupost): array
{
    $errors = [];

    if ($nom === '') {
        $errors['nom'] = 'El camp nom és obligatori.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El correu electrònic no és vàlid.';
    }

    if (!is_numeric($pressupost) || $pressupost <= 0) {
        $errors['pressupost'] = 'El pressupost ha de ser un valor numèric.';
    }

    return $errors;
}

/**
 * Deixa només els serveis que oferim. Ignora qualsevol altre valor.
 */
function filtrarServeis(mixed $serveis): array
{
    if (!is_array($serveis)) {
        return [];
    }

    return array_values(array_filter(
        $serveis,
        fn($servei) => is_string($servei) && in_array($servei, Lead::SERVEIS, true)
    ));
}

/**
 * Converteix una cadena buida en null (per a guardar NULL a la base de dades).
 */
function nullSiBuit(string $text): ?string
{
    return $text === '' ? null : $text;
}

/**
 * Comprova que hi ha un usuari autenticat. Si no, redirigix al login.
 */
function requereixLogin(): void
{
    if (empty($_SESSION['usuari'])) {
        header('Location: login.php');
        exit;
    }
}