# Unitat 2. PHP Bàsic — DWES
> Font: https://eloyfpinformatica.github.io/DWES/contenidos/2-php-basic.html
> Temporalització: 14 hores

---

## Índex
1. [Bloc 1: Introducció i Entorn](#bloc-1)
2. [Bloc 2: Fonaments del Llenguatge PHP](#bloc-2)
3. [Bloc 3: Estructures de Control i Depuració](#bloc-3)
4. [Bloc 4: Gestió de Dades amb Arrays](#bloc-4)
5. [Bloc 5: Modularització i Disseny](#bloc-5)
6. [Bloc 6: Formularis](#bloc-6)
7. [Exercicis](#exercicis)

---

## Bloc 1: Introducció i Entorn {#bloc-1}

### 1.1. Què és PHP?
PHP (PHP: Hypertext Preprocessor) és un llenguatge de codi obert executat al servidor.
El client mai veu el codi PHP, només el HTML resultant.

```
[ Navegador (Client) ]
       | 1. Petició HTTP (ex: index.php)
       v
[ Servidor Web (Apache/NGINX) ]
       | 2. Passa el fitxer a l'intèrpret de PHP
       v
[ Engine PHP ] > Executa la lògica / consulta BD
       | 3. Genera el codi HTML de resposta
       v
[ Navegador (Client) ] < Rep només HTML + CSS
```

### 1.2. Configuració amb Docker

**Dockerfile:**
```dockerfile
FROM php:8.5-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
```

**docker-compose.yml:**
```yaml
services:
  web:
    build: .
    container_name: techleads_web
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    extra_hosts:
      - "host.docker.internal:host-gateway"
```

**Estructura:**
```
meu-projecte/
├── docker-compose.yml
├── Dockerfile
└── src/
    └── index.php
```

**Comandaments Docker:**
```bash
docker compose up -d      # Arrancar en segon pla
docker compose ps         # Veure contenidors actius
docker compose logs -f    # Veure logs en temps real
docker compose stop       # Parar
docker compose down       # Parar i eliminar contenidors
```

### 1.3. Integració de codi PHP en HTML

```php
<?php
// Bloc de lògica
echo "Hola, món!";
?>

<!-- Etiqueta curta d'impressió (equivalent a echo) -->
<h1><?= "Benvingut" ?></h1>
```

> **Bona pràctica:** Si el fitxer conté NOMÉS PHP, ometre l'etiqueta de tancament `?>`.

### 1.4. Tailwind CSS via CDN

```html
<script src="https://cdn.tailwindcss.com"></script>
```

---

## Bloc 2: Fonaments del Llenguatge PHP {#bloc-2}

### 2.1. Variables, tipat dinàmic i case sensitivity

```php
<?php
$element = "Hola DWES"; // string
$element = 42;           // integer (canvia el tipus!)
$element = true;         // boolean

$nom = "Laura";
$Nom = "Carles";  // Variable DIFERENT ($nom != $Nom)

echo $nom;   // Laura
ECHO $Nom;   // Carles (ECHO == echo, no és sensible)
?>
```

- **Variables:** SÍ sensibles a majúscules (`$nom` ≠ `$Nom`)
- **Funcions/paraules clau:** NO sensibles (`echo` = `ECHO`)

### 2.2. Tipus de dades primitius

| Tipus | Exemple |
|-------|---------|
| Integer | `$edat = 25;` |
| Float | `$preu = 19.99;` |
| String | `$nom = "TechLeads";` |
| Boolean | `$esAdmin = true;` |
| NULL | `$resultat = null;` |

**Cometes dobles vs simples:**
```php
$empresa = "TechLeads";

echo "Benvingut a $empresa";        // Benvingut a TechLeads (interpolació)
echo 'Benvingut a $empresa';        // Benvingut a $empresa (literal)
echo 'Benvingut a ' . $empresa;     // Benvingut a TechLeads (concatenació amb .)
```

**Interpolació avançada amb {}:**
```php
$id = 42;
$seccio = "productes";

$url = "https://web.com/{$seccio}/detall.php?id={$id}";
// https://web.com/productes/detall.php?id=42

$quantitat = 5;
$unitat = "metro";
echo "Tinc {$quantitat} {$unitat}s d'amplària."; // Tinc 5 metros d'amplària.

$lead = ['id' => 10, 'nom' => 'Carles'];
echo "Lead {$lead['id']}: {$lead['nom']}";
```

### 2.3. Àmbits de les variables (Scope)

```php
$missatgeGlobal = "Hola des de fora";

function saludar() {
    $missatgeLocal = "Hola des de dins";
    // $missatgeGlobal NO accessible aquí sense global
    echo $missatgeLocal;
}

// $missatgeLocal NO accessible aquí
```

**Accedir a globals des de funcions:**
```php
$canal = "DWES";

function mostrarCanal() {
    global $canal;                        // Opció 1
    echo $GLOBALS['canal'];               // Opció 2
}
```
> ⚠️ L'ús de `global` és un code smell. Millor passar per paràmetre.

### 2.4. Operadors i constants

```php
// Aritmètics
$suma = $a + $b;
$modul = $a % $b;       // Residu
$potencia = $a ** $b;   // Potència

// Concatenació
$text = "Hola" . " " . "Món";

// Assignació
$x += 10;
$text1 .= " Món";

// Comparació
$num = "5";
var_dump($num == 5);    // true  (valor, no tipus)
var_dump($num === 5);   // false (valor I tipus)

// Null Coalescing
$usuari = $_GET['usuari'] ?? 'Anonim';
```

**Constants:**
```php
define("APP_NAME", "TechLeads");    // Forma tradicional
const VERSION = "1.0.0";            // Forma moderna

echo APP_NAME;  // Sense $ !
// APP_NAME = "altre";  // ERROR FATAL
```

| Criteri | `define()` | `const` |
|---------|-----------|---------|
| Àmbit | Qualsevol lloc | Nivell superior / classes |
| Execució | Temps d'execució | Temps de compilació |

### 2.5. Comentaris i bones pràctiques

```php
// Una línia (estil C++)
## Una línia (estil Shell)
/* Múltiples línies */

/**
 * PHPDoc - per a funcions
 * @param string $nom
 * @return string
 */
```

**PSR-12:**
- Variables: `camelCase` → `$nomUsuari`
- Constants: `UPPER_SNAKE_CASE` → `DB_PORT`
- Indentació: 4 espais
- Preferir `===` sobre `==`
- Ometre `?>` al final de fitxers PHP purs

---

## Bloc 3: Estructures de Control i Depuració {#bloc-3}

### 3.1. Decisió (if, switch, match)

```php
// if / elseif / else
if ($pressupost >= 5000) {
    echo "Client Enterprise";
} elseif ($pressupost >= 1500) {
    echo "Client Estàndard";
} else {
    echo "Projecte Menor";
}

// Ternari
$etiqueta = ($estat === 'nou') ? 'Pendent' : 'Atés';

// Null Coalescing
$nom = $_GET['nom'] ?? 'Anònim';

// switch
switch ($estatLead) {
    case 'nou':
        $msg = "Nou lead";
        break;
    case 'convertit':
    case 'guanyat':
        $msg = "Projecte acceptat!";
        break;
    default:
        $msg = "Estat desconegut";
}

// match (PHP 8+) — comparació estricta (===), retorna valor, sense break
$missatge = match ($estatLead) {
    'nou' => "Nou lead pendent.",
    'contactat' => "Correu enviat.",
    'convertit', 'guanyat' => "Projecte acceptat!",
    default => "Estat no reconegut."
};
```

### 3.2. Bucles

```php
// for
for ($i = 1; $i <= 5; $i++) {
    echo "Pàgina {$i}";
}

// while
$intents = 0;
while ($intents < 3) {
    echo "Intent: {$intents}";
    $intents++;
}

// do-while (s'executa almenys 1 vegada)
do {
    echo "Almenys 1 vegada";
} while ($executat === true);

// foreach (el més usat en PHP)
foreach ($serveis as $servei) {
    echo $servei;
}

foreach ($configuracio as $clau => $valor) {
    echo "{$clau}: {$valor}";
}
```

- `break` → eix del bucle
- `continue` → salta a la següent iteració

### 3.3. Depuració (Debug)

```php
// Activar errors (NOMÉS en desenvolupament!)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Inspecció de variables
echo "<pre>";
var_dump($lead);    // Tipus + valor (detallat)
print_r($lead);     // Llegible per humans
var_export($lead);  // Sintaxi PHP executable
echo "</pre>";

// Aturar execució (Dump and Die)
var_dump($dadesRebudes);
exit;  // Tot el que ve després NO s'executa
```

---

## Bloc 4: Gestió de Dades amb Arrays {#bloc-4}

### 4.1. Arrays indexats

```php
$estatsLead = ['nou', 'contactat', 'convertit'];  // Sintaxi moderna
$categories = array('Web', 'eCommerce');           // Sintaxi tradicional

echo $estatsLead[0];  // nou (índex comença en 0)

$serveis[] = 'SEO';   // Afegir al final
$serveis[0] = 'Disseny UI/UX';  // Modificar

// Iterar
for ($i = 0; $i < count($tecnologies); $i++) {
    echo $tecnologies[$i];
}
foreach ($tecnologies as $index => $tecnologia) {
    echo "{$index}: {$tecnologia}";
}
```

### 4.2. Arrays associatius

```php
$lead = [
    'id'        => 101,
    'nom'       => 'Aina Martínez',
    'email'     => 'aina@empresa.com',
    'pressupost'=> 3500.00,
    'actiu'     => true
];

echo $lead['nom'];   // Aina Martínez

// Afegir / modificar
$lead['telefon'] = '600123456';
$lead['email'] = 'nou@email.com';

// Comprovar existència
if (isset($lead['nom'])) { ... }
if (array_key_exists('versio', $config)) { ... }

// Iterar
foreach ($lead as $clau => $valor) {
    echo "<li>{$clau}: " . htmlspecialchars($valor) . "</li>";
}
```

### 4.3. Arrays multidimensionals

```php
$llistatLeads = [
    ['id' => 1, 'nom' => 'Joan', 'pressupost' => 4500.00, 'estat' => 'nou'],
    ['id' => 2, 'nom' => 'Laura', 'pressupost' => 12000.00, 'estat' => 'convertit'],
];

echo $llistatLeads[1]['nom'];  // Laura

// Renderitzar taula
foreach ($llistatLeads as $lead) {
    echo "<tr><td>{$lead['id']}</td><td>{$lead['nom']}</td></tr>";
}
```

### 4.4. Funcions predefinides per a arrays

```php
count($array)                       // Nombre d'elements
in_array($cerca, $array, $estricte) // Existeix el valor?
array_key_exists($clau, $array)     // Existeix la clau?

array_keys($array)    // Retorna les claus
array_values($array)  // Retorna els valors (reindexat)

array_push($array, $elem)   // Afegir al final
array_pop($array)            // Treure del final
array_unshift($array, $elem) // Afegir al principi
array_shift($array)          // Treure del principi
array_search($cerca, $array) // Retorna la clau o false

// Ordenació (modifiquen l'original!)
sort($array)    // Menor a major (perd claus assoc.)
rsort($array)   // Major a menor
asort($array)   // Per valors, manté claus
ksort($array)   // Per claus

// Funcionals
array_merge($a, $b)
array_filter($array, fn($x) => $x['pressupost'] >= 1500)
array_map(fn($x) => $x * 2, $array)
```

---

## Bloc 5: Modularització {#bloc-5}

### 5.1. Funcions

```php
// Paràmetres per defecte + tipus de retorn
function calcularIVA(float $import, float $tipus = 21.0): float {
    return $import + $import * ($tipus / 100);
}

calcularIVA(1000);      // 1210 (usa 21% per defecte)
calcularIVA(1000, 10.0); // 1100

// Pas per VALOR (no canvia l'original)
function afegirSufix(string $text) {
    $text .= " - Processat";
}
$estat = "Pendent";
afegirSufix($estat);
echo $estat; // "Pendent" (no ha canviat)

// Pas per REFERÈNCIA & (sí canvia l'original)
function aplicarDescompte(float &$preu, float $pct) {
    $preu -= $preu * ($pct / 100);
}
$pressupost = 2000.0;
aplicarDescompte($pressupost, 15);
echo $pressupost; // 1700
```

### 5.2. Mode estricte i tipus

```php
<?php
declare(strict_types=1); // PRIMERA línia del fitxer!

function formatarPressupost(float $quantitat, string $moneda = '€'): string {
    return number_format($quantitat, 2, ',', '.') . ' ' . $moneda;
}

// Union Types i Nullable (PHP 8+)
function buscarLead(array $llistat, int|string $id): ?array {
    foreach ($llistat as $lead) {
        if ($lead['id'] == $id) return $lead;
    }
    return null;
}
```

### 5.3. Inclusió de fitxers

| Funció | Si no existeix | Carrega 1 vegada |
|--------|---------------|-----------------|
| `include` | Warning, continua | No |
| `require` | Fatal Error, para | No |
| `include_once` | Warning, continua | Sí |
| `require_once` | Fatal Error, para | Sí |

```php
require_once __DIR__ . '/config.php';      // Crítics
require_once __DIR__ . '/helpers.php';
include __DIR__ . '/templates/header.php'; // Opcionals
```

### 5.4. Separació lògica / vista

```php
<?php
// --- LÒGICA (dalt del tot) ---
declare(strict_types=1);
$usuariNom = "Carles";
$notificacions = ["Nou lead assignat", "Pressupost aprovat"];
$hasNotificacions = count($notificacions) > 0;
?>

<!-- --- VISTA (HTML) --- -->
<h1>Hola, <?= htmlspecialchars($usuariNom) ?></h1>

<?php if ($hasNotificacions): ?>
    <ul>
    <?php foreach ($notificacions as $msg): ?>
        <li><?= htmlspecialchars($msg) ?></li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No tens notificacions.</p>
<?php endif; ?>
```

---

## Bloc 6: Formularis {#bloc-6}

### 6.1. GET vs POST

| | GET | POST |
|--|-----|------|
| Dades en URL | ✅ Sí | ❌ No |
| Límit | ~2000 caràcters | Pràcticament il·limitat |
| Historial | Queda enregistrat | No |
| Ús | Cerques, filtres, paginació | Login, registre, creació de dades |

### 6.2. Superglobals

```php
// URL: cercar.php?paraula=php&pagina=2
$cerca = $_GET['paraula'] ?? '';
$pagina = (int)($_GET['pagina'] ?? 1);

// Formulari POST
$nom = $_POST['nom_client'] ?? '';

// Detectar mètode
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // S'ha enviat el formulari!
}
```

### 6.3. Validació al servidor

> ⚠️ **Regla fonamental:** Mai confiar en les dades de l'usuari. La validació HTML5/JS es pot saltar fàcilment. SEMPRE validar a PHP.

```php
<?php
declare(strict_types=1);
$errors = [];
$nom = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom   = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($nom)) {
        $errors['nom'] = 'El camp nom és obligatori.';
    } elseif (mb_strlen($nom) < 2) {
        $errors['nom'] = 'El nom ha de tindre almenys 2 caràcters.';
    }

    if (empty($email)) {
        $errors['email'] = 'El correu és obligatori.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El format del correu no és vàlid.';
    }

    if (empty($errors)) {
        // Dades vàlides! Processar...
    }
}
?>
```

---

## Exercicis {#exercicis}

### Part 1 — Introducció i entorn

**Exercici 1.1** — Primera pàgina PHP (`exercici1.1.php`)
- Declarar `$nomEmpresa`, `$eslogan`, `$anyFundacio`
- Imprimir amb `<?= ?>`

**Exercici 2.1** — Fitxa d'un lead (`exercici2.1.php`)
- Variables: `$nom`, `$pressupost` (float), `$contactat` (bool), `$notes` (null)
- `var_dump()` de totes
- Cometes simples vs dobles amb `{$var}`

**Exercici 2.2** — Àmbit de variables (`exercici2.php`)
- Variable global `$percentatgeComissio = 10`
- Funció `calcularComissio()` amb `global`
- Fórmula: `$pressupostVenda * $percentatgeComissio / 100`

**Exercici 2.3** — Pressupost amb IVA (`exercici2.3.php`)
- `define("NOM_EMPRESA", "TechLeads")`
- `const IVA_PERCENT = 21`
- Calcular `$preuIva` i `$preuFinal`
