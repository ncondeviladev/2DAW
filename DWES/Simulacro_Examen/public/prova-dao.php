<?php

use App\Model\Lead;

require_once __DIR__ . '/../config/bootstrap.php';

try {
    // 1. Llistar
    echo '<h3>Llistat</h3>';
    foreach ($leadDAO->findAll() as $lead) {
        echo '#' . $lead->getId() . ' ' . $lead->getNom()
            . ' [' . $lead->getEstat() . '] '
            . implode(', ', $lead->getServeis()) . '<br>';
    }

    // 2. Inserir
    $nou = new Lead('Prova', 'prova@exemple.com', null, null, ['SEO', 'Cloud'], 250.5, null, null);
    $id = $leadDAO->insert($nou);
    echo "<p>Inserit amb id $id</p>";

    // 3. Avançar l'estat i guardar-lo
    $lead = $leadDAO->findById($id);
    $lead->avancarEstat();
    $leadDAO->update($lead);
    echo '<p>Nou estat: ' . $leadDAO->findById($id)->getEstat() . '</p>';

    // 4. Eliminar
    $leadDAO->delete($id);
    echo '<p>Després d\'eliminar: ';
    var_dump($leadDAO->findById($id));
    echo '</p>';

    // 5. Usuari
    $ana = $usuariDAO->findByUsuari('ana');
    echo '<p>Contrasenya d\'ana correcta? ';
    var_dump($ana->verificarContrasenya('contrasenya123'));
    echo '</p>';

    // 6. El instanceof protegix els DAO
    $leadDAO->insert($ana);
} catch (Exception $e) {
    echo '<p>' . get_class($e) . ': ' . $e->getMessage() . '</p>';
}