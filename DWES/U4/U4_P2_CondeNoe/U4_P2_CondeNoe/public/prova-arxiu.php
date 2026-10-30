<?php

require_once __DIR__ . '/../config/bootstrap.php';

$missatge = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nom = pujarArxiu($_FILES['document'] ?? [], CARPETA_PUJADES);

        if ($nom === null) {
            $missatge = 'No has triat cap arxiu.';
        } else {
            $ruta = CARPETA_PUJADES . '/' . $nom;
            $existia = is_file($ruta);
            eliminarArxiu(CARPETA_PUJADES, $nom);

            $missatge = 'Pujat com ' . $nom
                . ' | Existia: ' . var_export($existia, true)
                . ' | Existix després d\'eliminar: ' . var_export(is_file($ruta), true);
        }
    } catch (RuntimeException $e) {
        $missatge = 'Error: ' . $e->getMessage();
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="document">
    <button type="submit">Pujar</button>
</form>
<p><?= htmlspecialchars($missatge) ?></p>