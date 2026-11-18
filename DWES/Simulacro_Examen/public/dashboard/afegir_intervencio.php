<?php

use App\Model\Intervencio;

require_once __DIR__ . '/../../config/bootstrap.php';
requereixLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tiquet_id = trim($_POST['tiquet_id'] ?? '');
    $usuari_id = trim($_POST['usuari_id'] ?? '');
    $minuts = trim($_POST['minuts'] ?? '');
    $comentari = trim($_POST['comentari'] ?? '');

    if (!filter_var($tiquet_id, FILTER_VALIDATE_INT))
        $errors['tiquet_id'] = "El tiquet deu ser enter";

    if (!is_numeric($minuts) || (int) $minuts <= 0)
        $errors['minuts'] = "Els minuts deuen ser numerics";

    if ($comentari === "")
        $errors['comenta'] = "El comentari es obligatori";
}

if (!empty($errors)) {
    setFlash('error', implode(' ', $errors));
    header('Location: tiquet.php?id=' . $tiquet_id);
    exit;
}

$intervencio = new Intervencio($tiquet_id, idUsuariActual(), $minuts, $comentari);
$intervencioDAO->insert($intervencio);

setFlash('exit', 'Intervenció registrada correctament.');
header('Location: tiquet.php?id=' . $tiquet_id);
exit;


