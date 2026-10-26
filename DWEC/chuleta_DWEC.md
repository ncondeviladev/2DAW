# ⚡ Chuleta DWEC — Guía Maestra de JavaScript (1r Trimestre)
> **Mòdul:** Desenvolupament Web en Entorn Client (2n DAW)  
> **Professor:** José Ramón Migueles Hernández  
> **Propòsit:** Temari complet estructurat, sintaxi, mètodes, exercicis resolts i apunts nets per a preparar pràctiques i exàmens presencials sense dependre del material desorganitzat d'Aules.

---

## 📑 ÍNDEX GENERAL

1. [UD1 — Arquitectures Web i Execució de JavaScript](#1-ud1--arquitectures-web-i-execució-de-javascript)
2. [UD2 — Sintaxi Bàsica, Tipus de Dades i Control de Flux](#2-ud2--sintaxi-bàsica-tipus-de-dades-i-control-de-flux)
3. [UD3 (Part 1) — Funcions, Àmbit i Recursivitat](#3-ud3-part-1--funcions-àmbit-i-recursivitat)
4. [UD3 (Part 2) — Objectes Predefinits Natius (String, Array, Math, Date)](#4-ud3-part-2--objectes-predefinits-natius)
5. [UD3 (Part 3) — Objectes del Navegador (window, document, localStorage, JSON)](#5-ud3-part-3--objectes-del-navegador-i-almacenament)
6. [UD4 — Objectes en JavaScript i Programació Orientada a Objectes (POO)](#6-ud4--objectes-en-javascript-i-poo)
7. [Documentació amb JSDoc](#7-documentació-amb-jsdoc)
8. [Banc d'Exercicis Clau de Repàs i Examen (Resolts Pas a Pas)](#8-banc-dexercicis-clau-de-repàs-i-examen)

---

## 1. UD1 — Arquitectures Web i Execució de JavaScript

### Com s'executa JavaScript?
* **Entorn Client (Navegador):** El navegador web (Chrome, Firefox, Edge, Safari) disposa d'un motor d'execució JS (com **V8** a Chrome/Node, **SpiderMonkey** a Firefox).
* **Fil Únic (*Single-Threaded*):** JavaScript executa una sola instrucció alhora en la pila de crides (*Call Stack*). Per a operacions lentes (temporitzadors, peticions de xarxa), utilitza un mecanisme asíncron anomenat **Event Loop** amb la cua de tasques (*Task Queue*).

### Maneres d'incloure JavaScript a l'HTML
```html
<!-- 1. Script incrustat al final del <body> (Recomanat per defecte) -->
<body>
    <h1>El meu lloc</h1>
    <script>
        console.log("Executat després de renderitzar el DOM");
    </script>
</body>

<!-- 2. Arxiu extern al <head> amb 'defer' (Molt recomanat) -->
<!-- 'defer' descarrega en paral·lel i executa en ordre quan el DOM està llest -->
<head>
    <script src="js/main.js" defer></script>
</head>

<!-- 3. Arxiu extern amb 'async' (Per a scripts independents com Google Analytics) -->
<!-- 'async' descarrega en paral·lel i s'executa immediatament quan arriba, sense garantir ordre -->
<head>
    <script src="js/analytics.js" async></script>
</head>
```

### El Mode Estricte (`"use strict"`)
S'activa col·locant `"use strict";` en la primera línia de l'arxiu o d'una funció.
* **Beneficis:**
  1. Impedeix crear variables globals accidentals (sense declarar `let`/`const`).
  2. Fa fallar errors silenciosos (assignacions a propietats de només lectura).
  3. Prohibeix paraules clau reservades per a futures versions de JS.
```javascript
"use strict";
x = 10; // ❌ ReferenceError: x is not defined (amb strict mode)
```

---

## 2. UD2 — Sintaxi Bàsica, Tipus de Dades i Control de Flux

### Declaració de Variables: `var` vs `let` vs `const`
| Característica | `var` (Obsolet) | `let` (Estàndard modern) | `const` (Per defecte) |
| :--- | :--- | :--- | :--- |
| **Àmbit (*Scope*)** | Funció o global | **Bloc `{ ... }`** | **Bloc `{ ... }`** |
| **Redeclaració** | Permesa (perillós) | Error (`SyntaxError`) | Error (`SyntaxError`) |
| **Reassignació** | Permesa | Permesa | **Prohibida** |
| **Hoisting** | S'eleva com a `undefined` | Zona morta temporal (TDZ) | Zona morta temporal (TDZ) |

> 💡 **Regla d'or:** Usa sempre `const` per defecte. Si la variable ha de canviar de valor (com un comptador en un bucle), usa `let`. **Mai usis `var`**.

```javascript
const PI = 3.14159;
// PI = 3.14; // ❌ TypeError: Assignment to constant variable.

// En objectes i arrays, const bloqueja la referència, NO el contingut:
const persona = { nom: "Noé" };
persona.nom = "Noé Conde"; // ✅ Totalment permès!
// persona = { nom: "Altre" }; // ❌ Error! No es pot reassignar la variable sencera.
```

### Tipus de Dades Primitius
1. `number`: Números enters i decimals (ex: `42`, `3.14`, `NaN`, `Infinity`).
2. `string`: Cadenes de text (ex: `'hola'`, `"adeu"`, template literals `` `Hola ${nom}` ``).
3. `boolean`: `true` o `false`.
4. `undefined`: Variable declarada sense valor assignat.
5. `null`: Absència intencionada de valor (indicat manualment pel programador).
6. `symbol`: Identificador únic immutable.
7. `bigint`: Enters de precisió arbitrària (`12345678901234567890n`).

### Operador `typeof` (Curiositat d'examen)
```javascript
typeof 42;          // "number"
typeof "hola";      // "string"
typeof true;        // "boolean"
typeof undefined;   // "undefined"
typeof null;        // "object" ⚠️ (Bug històric de JavaScript que mai es va canviar)
typeof NaN;         // "number" ⚠️ (NaN és de tipus number)
typeof [];          // "object" (usar Array.isArray(arr) per comprovar arrays)
typeof function(){};// "function"
```

### Comparacions: `==` (feble) vs `===` (estricta)
* `==` (Doble igual): Realitza conversió automàtica de tipus abans de comparar (*coerció*). Provoca errors greus.
* `===` (Triple igual): Comprova **valor i tipus** sense convertir.
```javascript
0 == false;    // true ❌ (coerció)
0 === false;   // false ✅ (diferent tipus: number vs boolean)

"" == 0;       // true ❌
"" === 0;      // false ✅

"5" == 5;      // true ❌
"5" === 5;     // false ✅
```

### Operadors Moderns d'Examen: `?.` i `??`
1. **Encadenament Opcional (`?.`):** Evita errors si una propietat no existeix.
   ```javascript
   const usuari = { dades: { nom: "Noé" } };
   console.log(usuari.adreca?.carrer); // undefined (sense llançar error!)
   ```
2. **Coalescència Nul·la (`??`):** Retorna el costat dret **només** si el costat esquerre és `null` o `undefined` (a diferència de `||`, que també salta amb `0`, `""` o `false`).
   ```javascript
   let puntuacio = 0;
   let resultat1 = puntuacio || 10; // 10 ❌ (perquè 0 és falsy)
   let resultat2 = puntuacio ?? 10; // 0 ✅ (perquè 0 NO és null ni undefined)
   ```

### Bucles i Estructures de Control
```javascript
// 1. for clàssic (quan necessites l'índex numèric)
for (let i = 0; i < arr.length; i++) { ... }

// 2. for...of (PER A VALORS d'un array o cadena - EL MÉS USAT)
const fruites = ["poma", "pera", "plàtan"];
for (const fruita of fruites) {
    console.log(fruita); // "poma", "pera", "plàtan"
}

// 3. for...in (PER A CLAUS d'un objecte)
const cotxe = { marca: "Seat", model: "Ibiza" };
for (const clau in cotxe) {
    console.log(`${clau}: ${cotxe[clau]}`); // "marca: Seat", "model: Ibiza"
}
```

---

## 3. UD3 (Part 1) — Funcions, Àmbit i Recursivitat

### 1. Tipus de Funcions
```javascript
// A. Declaració clàssica (Té hoisting: es pot cridar abans de definir-la)
function sumar(a, b) {
    return a + b;
}

// B. Expressió de funció (Anònima guardada en variable, sense hoisting)
const restar = function(a, b) {
    return a - b;
};

// C. Funció Flecha (Arrow Function - Sintaxi concisa)
const multiplicar = (a, b) => a * b; // Return implícit d'una sola línia

// Si té un sol paràmetre, els parèntesis són opcionals:
const quadrat = x => x * x;

// Si té més d'una línia, calen claus {} i 'return' explícit:
const dividir = (a, b) => {
    if (b === 0) throw new Error("Divisió per zero");
    return a / b;
};
```

### 2. Paràmetres per Defecte i Operador Rest (`...`)
```javascript
// Paràmetre amb valor per defecte
function saludar(nom = "Amic") {
    return `Hola, ${nom}!`;
}

// Operador Rest (...arguments): agrupa arguments variables en un array
function sumarTots(...numeros) {
    return numeros.reduce((acum, n) => acum + n, 0);
}
console.log(sumarTots(1, 2, 3, 4)); // 10
```

### 3. Recursivitat (Concepte Clau d'Examen de Migueles)
Una funció és **recursiva** quan es crida a si mateixa. **SEMPRE** ha de complir dos requisits obligatoris:
1. **Cas Base (Condició de parada):** Evita un bucle infinit (`Maximum call stack size exceeded`).
2. **Cas Recursiu (Avanç cap al cas base):** Crida recursiva modificant l'argument cap a la condició de sortida.

#### Exemple 1: Factorial d'un número ($n! = n \times (n-1)!$)
```javascript
function factorial(n) {
    // 1. Cas base
    if (n <= 1) return 1;
    // 2. Cas recursiu
    return n * factorial(n - 1);
}
console.log(factorial(5)); // 5 * 4 * 3 * 2 * 1 = 120
```

#### Exemple 2: Suma dels números de 1 fins a N
```javascript
function sumaRecursiva(n) {
    if (n <= 1) return n;
    return n + sumaRecursiva(n - 1);
}
console.log(sumaRecursiva(5)); // 5 + 4 + 3 + 2 + 1 = 15
```

#### Exemple 3: Seqüència de Fibonacci
```javascript
// Fibonacci: 0, 1, 1, 2, 3, 5, 8, 13...
function fibonacci(n) {
    if (n === 0) return 0;
    if (n === 1) return 1;
    return fibonacci(n - 1) + fibonacci(n - 2);
}
console.log(fibonacci(6)); // 8
```

#### Exemple 4: Invertir una cadena de forma recursiva
```javascript
function invertirCadena(str) {
    if (str === "") return "";
    return invertirCadena(str.substring(1)) + str.charAt(0);
}
console.log(invertirCadena("hola")); // "aloh"
```

---

## 4. UD3 (Part 2) — Objectes Predefinits Natius

### 🅰️ Classe `String` (Mètodes de Cadena)
Les cadenes en JavaScript són **immutables** (cap mètode modifica la cadena original; tots en retornen una de nova).

| Mètode | Què fa | Exemple |
| :--- | :--- | :--- |
| `str.length` | Propietat: nombre de caràcters. | `"Hola".length` → `4` |
| `charAt(pos)` o `at(pos)` | Retorna el caràcter a la posició indicada (`at` admet negatius). | `"Hola".at(-1)` → `"a"` |
| `indexOf(sub)` | Primera posició de la subcadena (-1 si no existeix). | `"banana".indexOf("na")` → `2` |
| `lastIndexOf(sub)` | Última posició trobada. | `"banana".lastIndexOf("na")` → `4` |
| `includes(sub)` | Retorna `true`/`false` si conté la subcadena. | `"JavaScript".includes("Script")` → `true` |
| `startsWith(sub)` / `endsWith(sub)` | Comprova l'inici o final de la cadena. | `"arxiu.pdf".endsWith(".pdf")` → `true` |
| `slice(inici, fi)` | Extreu un fragment (admet índexs negatius). | `"012345".slice(1, 4)` → `"123"` |
| `substring(inici, fi)` | Extreu un fragment (no admet negatius, intercanvia si inici > fi). | `"012345".substring(1, 4)` → `"123"` |
| `toLowerCase()` / `toUpperCase()` | Converteix a minúscules o majúscules. | `"Hola".toUpperCase()` → `"HOLA"` |
| `trim()` | Elimina espais en blanc a l'inici i al final. | `"  hola  ".trim()` → `"hola"` |
| `replace(vella, nova)` | Substitueix la **primera** ocurrència. | `"gat i gos".replace("gat", "ocell")` |
| `replaceAll(vella, nova)` | Substitueix **totes** les ocurrències. | `"a-b-c".replaceAll("-", "/")` → `"a/b/c"` |
| `split(separador)` | **Divideix la cadena en un array** (super important). | `"1,2,3".split(",")` → `["1", "2", "3"]` |
| `repeat(vegades)` | Repeteix el text N vegades. | `"ab".repeat(3)` → `"ababab"` |

---

### 🅱️ Classe `Array` (Mètodes de Vectors)

#### 1. Mètodes Mutadors (MODIFIQUEN l'array original)
```javascript
const lletres = ["b", "c"];

lletres.push("d");      // Afegeix al final -> ["b", "c", "d"]
lletres.unshift("a");   // Afegeix a l'inici -> ["a", "b", "c", "d"]
const ultim = lletres.pop();    // Elimina i retorna l'últim ("d") -> ["a", "b", "c"]
const primer = lletres.shift(); // Elimina i retorna el primer ("a") -> ["b", "c"]

// splice(inici, quantsEliminar, ...nousElements) - Navalla suïssa
const arr = [10, 20, 30, 40];
arr.splice(1, 2, 99, 88); // A partir de l'índex 1, esborra 2 elements i fica 99, 88
// arr queda: [10, 99, 88, 40]

arr.reverse(); // Inverteix l'ordre in-situ
arr.sort((a, b) => a - b); // Ordena numèricament ascendent (Sense funció ordena com a text!)
```

#### 2. Mètodes No Mutadors (RETORNEN un nou array o valor)
```javascript
const a = [1, 2];
const b = [3, 4];
const c = a.concat(b); // [1, 2, 3, 4] (o amb spread: [...a, ...b])

const fragment = c.slice(1, 3); // [2, 3] (inici inclòs, fi exclòs)
const text = c.join(" - ");     // "1 - 2 - 3 - 4" (uneix array a cadena)
const pla = [[1, 2], [3, 4]].flat(); // [1, 2, 3, 4]
```

#### 3. Mètodes d'Iteració i Ordre Superior (Els preferits d'examen)
```javascript
const numeros = [5, 12, 8, 130, 44];

// forEach: itera sense retornar res
numeros.forEach((num, index) => {
    console.log(`Posició ${index}: ${num}`);
});

// map: transforma cada element i retorna un NOU array de la mateixa mida
const dobles = numeros.map(num => num * 2); // [10, 24, 16, 260, 88]

// filter: filtra elements que compleixen una condició booleana
const majorsDeDeu = numeros.filter(num => num > 10); // [12, 130, 44]

// find: retorna el PRIMER element que compleix la condició (o undefined)
const primerGran = numeros.find(num => num > 100); // 130

// findIndex: retorna la posició del primer que compleix la condició (-1 si no hi és)
const indexGran = numeros.findIndex(num => num > 100); // 3

// some: retorna true si ALMENYS UN compleix la condició
const hiHaNegatius = numeros.some(num => num < 0); // false

// every: retorna true si TOTS compleixen la condició
const totsPositius = numeros.every(num => num > 0); // true

// reduce: redueix tot l'array a un ÚNIC valor acumulat (suma, càlcul, etc.)
// reduce((acumulador, elementActual) => nouAcumulador, valorInicial)
const sumaTotal = numeros.reduce((acum, num) => acum + num, 0); // 199
```

---

### 🅲 Classe `Math`
Objecte estàtic (no s'instancia amb `new Math()`).

```javascript
Math.PI;                // 3.141592653589793
Math.abs(-15);          // 15 (Valor absolut)

// Arredoniment
Math.round(4.5);        // 5 (Arredoniment estàndard al més proper)
Math.floor(4.9);        // 4 (Sempre cap avall / truncat a enter menor)
Math.ceil(4.1);         // 5 (Sempre cap amunt)
Math.trunc(4.9);        // 4 (Elimina la part decimal)

// Potències i arrels
Math.pow(2, 3);         // 8 (o també 2 ** 3)
Math.sqrt(25);          // 5 (Arrel quadrada)

// Màxims i Mínims
Math.max(10, 50, 2, 80);// 80
Math.min(10, 50, 2, 80);// 2
// Ús amb arrays utilitzant Spread (...):
const notes = [4, 8, 2, 10, 7];
Math.max(...notes);     // 10

// Nombres Aleatoris (Fórmula típica d'examen)
Math.random();          // Decimal pseudoaleatori entre [0, 1)

// 👉 FÓRMULA MÀGICA: Número enter aleatori entre MIN i MAX (inclosos)
function aleatori(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
console.log(aleatori(1, 10)); // Enter entre 1 i 10
```

---

### 🅳 Classe `Date` (Gestió de Dates i Hores)
```javascript
// Instanciació
const ara = new Date(); // Data i hora actuals
const nadal = new Date(2026, 11, 25, 0, 0, 0); // Any, Mes (0-11!), Dia, Hora, Min, Seg
const dataISO = new Date("2026-10-21T20:00:00");

// ⚠️ ALERTA EXAMEN: Els mesos van de 0 a 11!
// Gener = 0, Febrer = 1 ... Desembre = 11.
nadal.getMonth(); // 11 (representa Desembre)

// Getters bàsics
ara.getFullYear();  // Any de 4 dígits (ex: 2026)
ara.getMonth();     // Mes (0 - 11)
ara.getDate();      // Dia del mes (1 - 31)
ara.getDay();       // Dia de la setmana (0 = Diumenge, 1 = Dilluns... 6 = Dissabte)
ara.getHours();     // Hores (0 - 23)
ara.getMinutes();   // Minuts (0 - 59)
ara.getSeconds();   // Segons (0 - 59)
ara.getTime();      // Mil·lisegons transcorreguts des de l'1 de gener de 1970 (Timestamp)

// Càlcul de diferència de dies entre dues dates
function diesEntre(data1, data2) {
    const msPerDia = 1000 * 60 * 60 * 24; // 86.400.000 ms
    const difMs = Math.abs(data2.getTime() - data1.getTime());
    return Math.floor(difMs / msPerDia);
}
```

---

## 5. UD3 (Part 3) — Objectes del Navegador i Almacenament

### 1. `window` i diàlegs bàsics
```javascript
window.alert("Missatge simple");           // Només botó acceptar
const nom = window.prompt("Com et dius?"); // Retorna el text o null si cancel·la
const ok = window.confirm("Segur que vols esborrar?"); // Retorna true / false
```

### 2. Temporitzadors
```javascript
// Executa una vegada després de X mil·lisegons (3 segons)
const timer = setTimeout(() => {
    console.log("Passats 3 segons!");
}, 3000);
clearTimeout(timer); // Cancel·la el timeout

// Executa de forma periòdica cada X mil·lisegons (1 segon)
let segons = 0;
const crono = setInterval(() => {
    segons++;
    console.log(`Temps: ${segons}s`);
    if (segons === 5) clearInterval(crono); // Parar l'interval
}, 1000);
```

### 3. Almacenament Local: `localStorage` i `sessionStorage`
Tots dos guarden informació clau-valor **exclusivament en format String**:
* `localStorage`: Les dades persisteixen encara que es tanque el navegador.
* `sessionStorage`: Les dades s'esborren en tancar la pestanya actual.

```javascript
// Mètodes de la API Storage:
localStorage.setItem("usuari", "Noé");
const usuari = localStorage.getItem("usuari"); // "Noé"
localStorage.removeItem("usuari"); // Esborra una clau
localStorage.clear();              // Esborra tot l'emmagatzematge local

// 🚨 Com guardar Arrays o Objectes? (USANT JSON OBLIGATÒRIAMENT)
const alumne = { nom: "Noé", curs: "2DAW", notes: [9, 10, 8] };

// Guardar: convertir Objecte a String amb JSON.stringify
localStorage.setItem("alumne", JSON.stringify(alumne));

// Recuperar: convertir String a Objecte amb JSON.parse
const guardat = JSON.parse(localStorage.getItem("alumne"));
console.log(guardat.notes[1]); // 10
```

---

## 6. UD4 — Objectes en JavaScript i POO

### 1. Objectes Literals
```javascript
const cotxe = {
    marca: "Toyota",
    model: "Corolla",
    any: 2024,
    // Mètode en objecte literal
    descripcio() {
        return `${this.marca} ${this.model} (${this.any})`;
    }
};

// Accés a propietats
console.log(cotxe.marca);    // Notació per punt
console.log(cotxe["model"]); // Notació per claudàtor (ideal si la clau és dinàmica)
```

### 2. Classes Modernes en ES6 (Sintaxi Estàndard d'Examen)
Aquesta és la sintaxi que el professor demana a la tasca de `Libro.js`:

```javascript
class Llibre {
    // Constructor: s'executa en fer 'new Llibre(...)'
    constructor(titol, autor, pagines, preu) {
        this.titol = titol;
        this.autor = autor;
        this.pagines = Number(pagines);
        this.preu = Number(preu);
        this._llegit = false; // Convenció de propietat interna
    }

    // Mètode regular
    mostrarInfo() {
        return `"${this.titol}" de ${this.autor} - ${this.pagines} pàgines (${this.preu} €)`;
    }

    // Getters i Setters (propietats computades o validades)
    get llegit() {
        return this._llegit;
    }

    set llegit(estat) {
        if (typeof estat !== "boolean") {
            throw new Error("L'estat ha de ser un booleà");
        }
        this._llegit = estat;
    }

    // Mètode estàtic (Pertany a la classe, no a una instància)
    static compararPreu(llibreA, llibreB) {
        return llibreA.preu - llibreB.preu;
    }
}

// Instanciació
const llibre1 = new Llibre("El Quixot", "Cervantes", 800, 25);
console.log(llibre1.mostrarInfo());
llibre1.llegit = true; // Activa el setter
console.log(llibre1.llegit); // Activa el getter (true)
```

### 3. Herència amb `extends` i `super`
```javascript
class LlibreDigital extends Llibre {
    constructor(titol, autor, pagines, preu, format) {
        // Crida al constructor de la classe mare (obligatori)
        super(titol, autor, pagines, preu);
        this.format = format; // "PDF", "EPUB", etc.
    }

    // Sobreescriptura de mètode (Polimorfisme)
    mostrarInfo() {
        return `${super.mostrarInfo()} [Format: ${this.format}]`;
    }
}
```

### 4. Mètodes Útils d'`Object`
```javascript
const usuari = { id: 1, nom: "Noé", rol: "Admin" };

Object.keys(usuari);    // ["id", "nom", "rol"] (Array de claus)
Object.values(usuari);  // [1, "Noé", "Admin"] (Array de valors)
Object.entries(usuari); // [ ["id", 1], ["nom", "Noé"], ["rol", "Admin"] ]

// Còpia profunda vs superficial:
const copiaSuperficial = { ...usuari }; // Spread operator (còpia plana)
const copiaProfunda = structuredClone(usuari); // Còpia profunda nativa de JS
```

---

## 7. Documentació amb JSDoc

El professor Migueles valora la documentació formal de funcions i mètodes mitjançant blocs `/** ... */`:

```javascript
/**
 * Calcula el preu final aplicant un percentatge de descompte.
 *
 * @param {number} preuOriginal - El preu base abans del descompte.
 * @param {number} [descompte=0] - El percentatge de descompte (0 a 100). Opcional.
 * @returns {number} El preu total calculat amb el descompte aplicat.
 * @throws {Error} Si el preu és negatiu o el descompte és invàlid.
 */
function calcularDescompte(preuOriginal, descompte = 0) {
    if (preuOriginal < 0) throw new Error("El preu no pot ser negatiu");
    return preuOriginal - (preuOriginal * (descompte / 100));
}
```

### Tags Principals de JSDoc:
* `@param {tipus} nom - Descripció` (Per a paràmetres d'entrada).
* `@param {tipus} [nom=defecte]` (Indica paràmetre opcional amb valor per defecte).
* `@returns {tipus} Descripció` (Tipus de dada i valor retornat).
* `@throws {TipusError} Descripció` (Excepcions que pot llançar).
* `@class` / `@constructor` (Documenta classes i constructors).

---

## 8. Banc d'Exercicis Clau de Repàs i Examen

A continuació es recullen els exercicis típics d'examen del professor resolts de forma elegant i comentats:

### Exercici 1: Rotar un Array a la Dreta N Posicions
*Enunciat:* Donat un array i un número `k`, rotar els seus elements `k` vegades a la dreta.
```javascript
function rotarDreta(arr, k) {
    if (arr.length === 0) return [];
    const copia = [...arr];
    const rotacions = k % copia.length; // Per si k és més gran que la llargada
    for (let i = 0; i < rotacions; i++) {
        const ultim = copia.pop();
        copia.unshift(ultim);
    }
    return copia;
}
console.log(rotarDreta([1, 2, 3, 4, 5], 2)); // [4, 5, 1, 2, 3]
```

### Exercici 2: Comprovar si un Nombre és Primer
*Enunciat:* Retornar `true` si un nombre enter positiu és primer, `false` en cas contrari.
```javascript
function esPrimer(n) {
    if (n <= 1) return false;
    if (n === 2) return true;
    if (n % 2 === 0) return false; // Descarta parells ràpidament
    
    // Comprova només fins a l'arrel quadrada (optimització clau d'examen)
    const limit = Math.sqrt(n);
    for (let i = 3; i <= limit; i += 2) {
        if (n % i === 0) return false;
    }
    return true;
}
console.log(esPrimer(17)); // true
console.log(esPrimer(25)); // false
```

### Exercici 3: Invertir Paraules d'una Frase
*Enunciat:* Invertir l'ordre de les paraules d'un text (ex: `"hola que tal"` -> `"tal que hola"`).
```javascript
function invertirParaules(frase) {
    return frase.trim().split(/\s+/).reverse().join(" ");
}
console.log(invertirParaules("Desenvolupament Web Client")); // "Client Web Desenvolupament"
```

### Exercici 4: Comprovar si una Paraula és Palíndrom
*Enunciat:* Retorna `true` si es llegeix igual del dret que del revés, ignorant espais i majúscules.
```javascript
function esPalindrom(text) {
    const net = text.toLowerCase().replaceAll(" ", "");
    const invertit = net.split("").reverse().join("");
    return net === invertit;
}
console.log(esPalindrom("reconocer")); // true
console.log(esPalindrom("anita lava la tina")); // true
console.log(esPalindrom("javascript")); // false
```

### Exercici 5: Eliminar Elements Duplicats d'un Array
*Enunciat:* Retornar un nou array sense elements repetits.
```javascript
// Manera 1: Amb l'estructura nativa Set (La més ràpida i moderna)
const unics = arr => [...new Set(arr)];

// Manera 2: Amb filter (Típica demanada en exàmens)
function eliminarDuplicats(arr) {
    return arr.filter((elem, index) => arr.indexOf(elem) === index);
}
console.log(eliminarDuplicats([1, 2, 2, 3, 4, 4, 1, 5])); // [1, 2, 3, 4, 5]
```

### Exercici 6: Trobar Freqüència de Caràcters en un String
```javascript
function comptarLletres(str) {
    const frequencia = {};
    for (const lletra of str.toLowerCase()) {
        if (lletra !== " ") {
            frequencia[lletra] = (frequencia[lletra] || 0) + 1;
        }
    }
    return frequencia;
}
console.log(comptarLletres("banana")); // { b: 1, a: 3, n: 2 }
```
