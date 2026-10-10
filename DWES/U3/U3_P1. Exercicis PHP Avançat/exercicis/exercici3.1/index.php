<?php
// TODO 1: Declara $titolPagina amb el valor 'Inici'
// (ha de definir-se ABANS d'incloure la capçalera)
$titolPagina = "Inici";
// TODO 2: Incorpora la capçalera amb require 'capcalera.php'
require 'capcalera.php';
// TODO 3: Incorpora el banner d'ofertes amb include 'banner-ofertes.php'
// (és un element opcional: si falla, la pàgina ha de continuar)
include 'banner-ofertes.php';
?>

<!-- CONTINGUT: no cal tocar res d'ací en avall, excepte el TODO 4 -->
<main class="max-w-3xl mx-auto p-6 flex-1">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Benvinguts a TechLeads</h1>
    <p class="text-gray-600">Gestiona els teus leads comercials de manera senzilla.</p>
</main>

<?php
// TODO 4: Incorpora el peu amb require 'peu.php'
require 'peu.php';
?>