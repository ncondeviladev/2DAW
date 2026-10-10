<?php
// A partir de la següent llista de dades, crea un array associatiu:
// sabates, 20
// camiseta, 15
// ulleres de sol, 40

// -- Arrays --
$productes = ["sabates" => 20, "camiseta" => 15, "ulleres de sol" => 40, "gorra" => 5];
$descomptes = ["10DESC" => 10, "20DESC" => 20, "BLACK" => 40];

//-- FUNCIONS --
function comprobarDesc($desc, $descomptes)
{
  return array_key_exists($desc, $descomptes);
}

function totalCompra($llistaCompra)
{
  $sumaTotal = 0;
  foreach ($llistaCompra as $preu) {
    $sumaTotal += $preu;
  }
  return $sumaTotal;
}

function preuDescompte($desc, $sumaTotal)
{
  $descompte = ($sumaTotal * $desc) / 100;
  return $sumaTotal - $descompte;
}
// -- Variables Control --
$total = totalCompra($productes);
$descompteValid = false;
$error = false;
$descompreImport = 0;
$totalFinal = $total;

// -- Funció php --
if (isset($_POST['codi'])) {
  $codiEnviat = strtoupper(trim($_POST['codi'])); //Neteja espais i cambia a mayuscula
  if (comprobarDesc($codiEnviat, $descomptes)) { // comproba codi
    $descompteValid = true;
    $percentatge = $descomptes[$codiEnviat]; //Obte descompte de la llista
    $totalFinal = preuDescompte($percentatge, $total);//Guarda total
    $descompteImport = $total - $totalFinal; //Guarda descompte

  } else
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light dark">
  <title>Problema 2 - Descompte</title>


  <!-- Pico.css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>

<body>
  <!-- Header -->
  <header class="container">
    <hgroup>
      <h1>Llista de la compra</h1>
      <p>Aplica el teu descompte</p>
    </hgroup>
  </header>
  <!-- ./ Header -->

  <!-- Main -->
  <main class="container">

    <!-- Tables -->
    <?php if (!$descompteValid): ?>
      <section id="tables">
        <h2>Resum de la compra</h2>
        <div class="overflow-auto">
          <table class="striped">
            <thead>
              <tr>
                <th scope="col">Producte</th>
                <th scope="col">Preu</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($productes as $nomProducte => $preuProducte): ?>
                <!--Se que igual m'adelante Eloy, pero cambie esta part per un bucle per a que plene la tabla de productes amb les ulleres que no estaben i per si s'afegix mes a la llista-->
                <tr>
                  <th scope="row">
                    <?= ucfirst($nomProducte) ?> <!--Capitalitzem el nom del productoe-->
                  </th>
                  <td>
                    <?= $preuProducte ?>
                  </td>
                </tr>
              <?php endforeach; ?>

              <th scope="row"><strong>Total</strong></th>
              <td><strong><?= $total ?> €</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <!-- ./ Tables -->
      <!-- Preview -->
      <section id="preview">
        <h3>Aplicar descompte?</h3>
        <p><strong>Important: </strong>Afegeix el teu descompte</p>
        <br>
        <form method="POST">
          <fieldset role="group">
            <input type="text" name="codi" placeholder="Escriu el teu codi de descompte ací" required>
            <input type="submit" value="Aplicar descompte!">
          </fieldset>
        </form>
      </section>
      <!-- ./ Preview -->

    <?php else: ?>
      <section id="tables">
        <h2>Resum de la compra amb descompte</h2>
        <div class="overflow-auto">
          <table class="striped">
            <thead>
              <tr>
                <th scope="col">Producte</th>
                <th scope="col">Preu</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($productes as $nomProducte => $preuProducte): ?>
                <tr>
                  <th scope="row">
                    <?= ucfirst($nomProducte) ?>
                  </th>
                  <td>
                    <?= $preuProducte ?>
                  </td>
                <?php endforeach; ?>
              </tr>
              <tr>
                <th scope="row"><strong>Total</strong></th>
                <td><strong><?= $total ?> €</strong></td>
              </tr>
              <tr>
                <th scope="row"><strong>Descompte aplicat</strong></th>
                <td style="color:green;"><strong>-<?= $descompteImport ?> €</strong></td>
              </tr>
              <tr>
                <th scope="row"><strong>Total amb descompte <?= $percentatge . " %" ?></strong></th>
                <td><strong><?= $totalFinal ?> €</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
        <p style="text-align: center;">
          <a href="index.php" role="button" class="secondary">Restablir - Provar atre
            codi</a><!--Fique un boto de neteja per no tindre que refrescar la pagina per a probar, ademes que sempre va be ;)-->
        </p>
      </section>
    <?php endif; ?>

    <?php if ($error): ?>
      <p style="color:red"><strong>Upps!</strong> El codi de descompte introduït no és vàlid</p>
    <?php endif; ?>



  </main>
  <!-- ./ Main -->

  <!-- Footer -->
  <footer class="container" style="text-align:center;">
    <small>U2. PHP Bàsic - DWES - 2n DAW - IES Maria Enríquez
    </small>
  </footer>
  <!-- ./ Footer -->

</body>

</html>