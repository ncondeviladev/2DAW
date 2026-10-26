# 📘 Temario Resumido y Cuaderno de Repaso — DWEC (2n DAW)

> **Mòdul:** Desenvolupament Web en Entorn Client (DWEC)  
> **Professor:** José Ramón Migueles Hernández  
> **Alumne:** Noé Conde Vila  
> **Objectiu:** Síntesi conceptual progressiva i resolució d'exercicis pràctics clau abans dels exàmens presencials (19–20 de novembre).

---

## 🗺️ Mapa de Blocs de Repàs

- [x] **[Bloc 1: Motor JS, Càrrega, Àmbits, Variables i Comparacions](#-bloc-1-motor-js-càrrega-àmbits-variables-i-comparacions) (✅ COMPLETAT)**
- [x] **[Bloc 2: Control de Flux, Truthy/Falsy i Bucles (`for...of` vs `for...in`)](#-bloc-2-control-de-flux-truthyfalsy-i-bucles-avançats) (✅ COMPLETAT)**
- [x] **[Bloc 3: Funcions, Àmbits, Closures, Paràmetres Rest i Desestructuració](#-bloc-3-funcions-àmbits-closures-paràmetres-rest-i-desestructuració) (✅ COMPLETAT)**
- [x] **[Bloc 4: Mètodes Natius Avançats d'Array (`map`, `filter`, `reduce`), String i Math](#-bloc-4-mètodes-natius-avançats-darray-map-filter-reduce-string-i-math) (✅ COMPLETAT)**
- [x] **[Bloc 5: BOM, DOM, Objectes del Navegador i Persistència (`localStorage`, `JSON`)](#-bloc-5-bom-dom-objectes-del-navegador-i-persistència-localstorage-json) (✅ COMPLETAT)**
- [x] **[Bloc 6: Programació Orientada a Objectes moderna en ES6 (Clases, `#privat`, Herència)](#-bloc-6-programació-orientada-a-objectes-moderna-en-es6-ud4) (✅ COMPLETAT)**
- [x] **[Bloc 7: Asincronia (Promeses, `async/await` i `fetch`)](#-bloc-7-asincronia-promeses-asyncawait-i-fetch-últim-bloc) (✅ COMPLETAT)**

> 🏆 **Estat de la preparació:** **7 de 7 blocs completats al 100%**. Temari complet de la 1a avaluació consolidat i resolt!

---

# 🚀 BLOC 1: Motor JS, Càrrega, Àmbits, Variables i Comparacions

## 1.1. Com s'executa JavaScript en el Navegador?

1. **Fil Únic (_Single-Threaded_):**  
   JavaScript té una única pila de crides (_Call Stack_). Executa una instrucció alhora. Les operacions asíncrones (temporitzadors, peticions de xarxa) no bloquegen el fil perquè es deriven a l'_Event Loop_ i a la cua de tasques.
2. **Càrrega de Scripts en l'HTML:**
   - `<script src="app.js">`: Bloqueja la lectura de l'HTML mentre es descarrega i s'executa.
   - `<script src="app.js" defer>`: **Recomanat per defecte.** Es descarrega en segon pla mentre l'HTML es parseja i s'executa **en ordre** just quan el DOM està llest.
   - `<script src="app.js" async>`: Es descarrega en segon pla i s'executa **immediatament quan arriba**, sense respectar ordre ni esperar el DOM (ideal per a scripts aïllats com Google Analytics).
3. **Mode Estricte (`"use strict";`):**  
   Activat a l'inici d'un arxiu o funció, impedeix crear variables globals accidentals (per exemple, `x = 10;` sense `let`/`const` llançarà `ReferenceError` en comptes de crear una variable global silenciosa).

---

## 1.2. Declaració de Variables: `const` vs `let` vs `var`

| Característica      | `var` (Obsolet ❌)            | `let` (Variable reassignable ✅) | `const` (Per defecte ✅)    |
| :------------------ | :---------------------------- | :------------------------------- | :-------------------------- |
| **Àmbit (_Scope_)** | Funció o global               | **Bloc `{ ... }`**               | **Bloc `{ ... }`**          |
| **Reassignació**    | Permesa                       | **Permesa**                      | **Prohibida (`TypeError`)** |
| **Redeclaració**    | Permesa (perillós)            | Prohibida (`SyntaxError`)        | Prohibida (`SyntaxError`)   |
| **Hoisting**        | S'eleva amb valor `undefined` | Zona Morta Temporal (TDZ)        | Zona Morta Temporal (TDZ)   |

> 💡 **Regla d'or:** Usa sempre `const`. Utilitza `let` només quan el valor de la variable haja de canviar (com el comptador d'un bucle). **Mai utilitzes `var`**.

### La Mutabilitat en `const` (Pregunta clàssica d'examen):

`const` immobilitza la **referència en memòria** (el contenidor), NO les propietats internes d'un objecte o els elements d'un array:

```javascript
// ✅ Correcte: modifiquem el contingut intern
const alumne = { nom: "Noé", curs: "2DAW" };
alumne.curs = "2n DAW Semipresencial"; // Permès!
alumne.edat = 25; // Permès!

// ❌ Error: no es pot reassignar la referència sencera
// alumne = { nom: "Nou Alumne" }; // TypeError: Assignment to constant variable

const numeros = [10, 20];
numeros.push(30); // ✅ Permès! L'array ara val [10, 20, 30]
// numeros = [1, 2]; // ❌ TypeError
```

---

## 1.3. Tipus de Dades i l'operador `typeof`

- **Tipus Primitius (es passen per VALOR):**
  1. `number` (inclosos `NaN` i `Infinity`).
  2. `string` (cometes simples, dobles o _template literals_ `` `Hola ${nom}` ``).
  3. `boolean` (`true` o `false`).
  4. `undefined` (variable declarada sense assignar).
  5. `null` (absència intencionada de valor).
  6. `symbol` i `bigint`.
- **Tipus Compostos (es passen per REFERÈNCIA):** `Object`, `Array`, `Function`.

### Trampes típiques d'examen amb `typeof`:

```javascript
typeof 42; // "number"
typeof "hola"; // "string"
typeof true; // "boolean"
typeof undefined; // "undefined"
typeof null; // "object" ⚠️ (Bug històric de JS mai corregit)
typeof NaN; // "number" ⚠️ (NaN significa Not-a-Number, però el seu tipus és number)
```

---

## 1.4. Operadors de Comparació: `==` vs `===`

- **`==` (Igualtat laxa o dèbil):** Realitza coerció implícita de tipus (intenta convertir abans de comparar). Condueix a comportaments incoherents:
  - `0 == ""` ➔ `true`
  - `0 == false` ➔ `true`
  - `null == undefined` ➔ `true`
- **`===` (Igualtat estricta):** Comprova **tipus i valor** sense fer cap conversió.
  - `0 === false` ➔ `false`
  - `null === undefined` ➔ `false`
  - `"5" === 5` ➔ `false`

> 💡 **Conclusió:** Usa sempre `===` i `!==`.

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 1

_(Escriu les teues respostes directament baix de cada apartat i guarda l'arxiu)._

### Exercici 1.1: Predicció de sortida

Observa el següent codi:

```javascript
const colors = ["blau", "verd"];
colors.push("roig");
colors[0] = "groc";
console.log(colors);
console.log(colors.length);
```

**Pregunta:** Funcionarà o llançarà un error per ser `const`? Què imprimirà exactament per consola?

> **La teua resposta:**  
> El primer push afegix roig a la llista, el afegir groc aixi sobre la pos 0 que es blau cambia el blau a groc per lo que imprimiria groc, berd roig y length 3

---

### Exercici 1.2: Avaluació de comparacions estrictes

Indica què retorna cadascuna de les següents expressions (`true` o `false`):

1. `"" == 0`
   > **Resposta:true**
2. `"" === 0`
   > **Resposta:false**
3. `typeof NaN === "number"`
   > **Resposta:true**
4. `null === undefined`
   > **Resposta:false**
5. `null == undefined`
   > **Resposta:true**

---

### Exercici 1.3: Concepte `defer` vs `async`

Explica amb les teues pròpies paraules (en 1 o 2 frases) per què solem posar `defer` en els nostres scripts de l'aplicació en lloc de deixar-los sense atribut o amb `async`.

> **La teua resposta:**  
> _Amb defer el codi js espera a que carregue toto el dom de html per executarse y async carrega en segon pla y carrega en parralele cuan arriba pero lo que amb defer fer una cosa i despres latra es lo mes eficient i lliure derrors_

# 🚀 BLOC 2: Control de Flux, Truthy/Falsy i Bucles Avançats

## 2.1. Els Valors Falsy i Truthy en JavaScript

En JavaScript, en avaluar una expressió dins d'un `if`, `while` o operador lògic, el valor es converteix automàticament a booleà (_type coercion_).

> ⚠️ **Pregunta clau d'examen:** Només existeixen **6 valors Falsy** en tot JavaScript:
>
> 1. `false`
> 2. `0` (i `-0`, `0n`)
> 3. `""` (cadena de text buida)
> 4. `null`
> 5. `undefined`
> 6. `NaN`

**Tot el que NO estiga en aquesta llista és Truthy.**
Exemples que solen enganyar:

- `[]` (un array buit és **Truthy**!)
- `{}` (un objecte buit és **Truthy**!)
- `"0"` (el text `"0"` té contingut, per tant és **Truthy**!)
- `"false"` (és **Truthy** per ser text no buit!)

```javascript
if ([]) {
  console.log("S'executa perquè un array buit és Truthy!");
}
if ("") {
  // ❌ No s'executa mai (cadena buida = Falsy)
}
```

---

## 2.2. Operadors Lògics Moderns: `||` vs `??` i l'Encallament Opcional `?.`

### El problema de l'operador OR (`||`) per a valors per defecte:

L'operador `||` retorna el segon operand si el primer és **qualsevol valor Falsy**.

```javascript
let puntuacio = 0;
// Volem donar un valor per defecte només si no n'hi ha:
let resultat = puntuacio || 10;
console.log(resultat); // ⚠️ Dóna 10! Ha esborrat el 0 perquè 0 és Falsy!
```

### La solució moderna: Nullish Coalescing (`??`)

L'operador `??` només salta al valor per defecte si el primer és estrictament **`null` o `undefined`**. Si val `0`, `""` o `false`, respecta el valor original:

```javascript
let puntuacio = 0;
let resultat = puntuacio ?? 10;
console.log(resultat); // ✅ Dóna 0! Respecta el valor legítim.

let nom = null;
let nomFinal = nom ?? "Anònim";
console.log(nomFinal); // "Anònim"
```

### L'Operador d'Encallament Opcional (`?.` - Optional Chaining)

Evita llançar l'error típic `TypeError: Cannot read properties of undefined`:

```javascript
const usuari = { nom: "Noé", perfil: null };

// ❌ Sense optional chaining:
// console.log(usuari.perfil.ciutat); // TypeError: Cannot read properties of null

// ✅ Amb optional chaining:
console.log(usuari?.perfil?.ciutat); // Retorna undefined de forma segura, sense trencar l'app!
```

---

## 2.3. Bucles en JavaScript: `for` clàssic, `for...of` vs `for...in`

| Tipus de Bucle                        | Ús Principal                    | Sobre què itera?           | Exemple típic                                    |
| :------------------------------------ | :------------------------------ | :------------------------- | :----------------------------------------------- |
| **`for (let i = 0; ...)`**            | Control manual d'índex          | Índex numèric              | Quan necessites conèixer l'índex o saltar passos |
| **`for (const element of iterable)`** | **Arrays, Strings, Maps, Sets** | **ELS VALORS**             | `for (const num of [10, 20])`                    |
| **`for (const clau in objecte)`**     | **Objectes literals**           | **LES CLAUS (propietats)** | `for (const clau in persona)`                    |

> 💡 **Regla d'or d'examen:**
>
> - Usa **`for...of`** per a recórrer **ARRAYS** (voler els valors).
> - Usa **`for...in`** per a recórrer **OBJECTES** (voler les claus/propietats).

```javascript
// Exemple for...of (per a arrays):
const llista = ["alfa", "beta", "gamma"];
for (const element of llista) {
  console.log(element); // Imprimeix "alfa", "beta", "gamma"
}

// Exemple for...in (per a objectes):
const cotxe = { marca: "Toyota", model: "Yaris", cv: 116 };
for (const propietat in cotxe) {
  console.log(`${propietat} => ${cotxe[propietat]}`);
  // "marca => Toyota", "model => Yaris", "cv => 116"
}
```

### `break` vs `continue`:

- `break`: Trenca el bucle completament i n'ix immediatament.
- `continue`: Interromp la iteració actual i salta directament a la següent.

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 2

_(Escriu les teues respostes directament baix de cada apartat i guarda l'arxiu)._

### Exercici 2.1: Predicció de valors (`||` vs `??`)

Indica quin valor final tindrà la variable en cada cas:

```javascript
const intents = 0;
const text = "";
const configuracio = null;

const r1 = intents || 5;
const r2 = intents ?? 5;
const r3 = text || "Sense text";
const r4 = text ?? "Sense text";
const r5 = configuracio ?? "Per defecte";
```

> **Les teues respostes (Anotades amb correcció):**
>
> - `r1` val: 5 ✅ (0 és Falsy, `||` salta al 5)
> - `r2` val: 0 ✅ (`??` no salta perquè 0 no és null ni undefined)
> - `r3` val: "Sense text" ✅ (`""` és Falsy, `||` salta al valor per defecte)
> - `r4` val: **`""` (cadena buida)** ⚠️ _(Vas posar "sense text", però `??` només substitueix si és estrictament `null` o `undefined`. Com `""` és un text vàlid de longitud 0, es conserva sense canvis)._
> - `r5` val: "Per defecte" ✅ (`configuracio` és null, `??` salta al valor per defecte)

---

### Exercici 2.2: Predicció de bucles `for...of` vs `for...in`

Observa el següent codi:

```javascript
const preus = [100, 200, 300];

console.log("Bucle 1:");
for (const x of preus) {
  console.log(x);
}

console.log("Bucle 2:");
for (const y in preus) {
  console.log(y);
}
```

**Pregunta:** Què imprimirà exactament el Bucle 1 i què imprimirà el Bucle 2?

> **La teua resposta (Anotada amb correcció):**
>
> - Bucle 1 imprimeix: **100 200 300** ✅ (`for...of` recorre els VALORS de l'array)
> - Bucle 2 imprimeix: **`"0"` `"1"` `"2"`** ⚠️ _(Vas posar 1 2 3, però recorda que els índexs d'array en programació comencen en 0! A més, `for...in` els lliura com a cadenes perquè els tracta com a claus)._

---

### Exercici 2.3: Xicotet algorisme amb `continue`

Escriu a continuació un xicotet bucle `for...of` que sume en una variable `total` **només els números positius** del següent array, ignorant els negatius mitjançant la instrucció `continue`:

```javascript
const valors = [10, -5, 20, -15, 30, -2];
let total = 0;

// Escriu el teu codi ací:
for (const v of valors) {
  // ✅ Lògica impecable! (Afegit 'const' per bona pràctica)
  if (v < 0) continue;
  total += v;
}

console.log("Total positius:", total); // Hauria de donar 60 (10 + 20 + 30)
```

> **El teu codi complet:**  
> _(Escriu ací el bloc del bucle)_

---

# 🚀 BLOC 3: Funcions, Àmbits, Closures, Paràmetres Rest i Desestructuració

## 3.1. Tipus de Funcions en JavaScript

En JavaScript modern usem tres formes principals per a definir funcions:

```javascript
// 1. Declaració tradicional (Function Declaration)
// Té HOISTING: es pot cridar abans en el codi de la seua línia de definició.
function duplicar(n) {
  return n * 2;
}

// 2. Expressió de Funció (Function Expression)
// NO té hoisting: no es pot usar abans d'aquesta línia.
const duplicarExp = function (n) {
  return n * 2;
};

// 3. Funció Fletxa (Arrow Function) — ES6
// Sintaxi compacta molt usada en callbacks i mètodes d'Array:
const duplicarArrow = (n) => n * 2; // Retorn implícit (sense 'return' ni claus {})
```

### Particularitats clau de les Arrow Functions per a examen:

1. **Retorn implícit:** Si no poses claus `{}`, el resultat de l'expressió es retorna automàticament.
2. **Retornar un objecte literal:** Cal embolicar-lo entre parèntesis `({ ... })` perquè JS no confonga les claus de l'objecte amb el cos de la funció:
   ```javascript
   const crearUsuari = (nom, id) => ({ nom: nom, id: id });
   ```
3. **El valor de `this` (Molt important):** Les funcions fletxa **NO tenen el seu propi `this`**. Hereten el `this` del context pare on han sigut definides (_lexical this_).

---

## 3.2. Paràmetres per Defecte i Paràmetres Rest (`...`)

### Paràmetres per defecte:

S'apliquen si l'argument és omès o és estrictament `undefined`:

```javascript
function calcularPreu(preu, iva = 0.21) {
  return preu + preu * iva;
}
```

### Paràmetres Rest (`...`):

Permeten recollir un nombre indefinit d'arguments en un **Array real** (substituint l'antic i problemàtic objecte `arguments`). Ha de ser sempre l'**últim paràmetre**:

```javascript
function sumarTots(multiplicador, ...numeros) {
  // 'numeros' és un Array de debò
  let total = 0;
  for (const num of numeros) {
    total += num;
  }
  return total * multiplicador;
}
console.log(sumarTots(2, 5, 10, 15)); // (5 + 10 + 15) * 2 = 60
```

---

## 3.3. L'Operador Spread (`...` - Dispersió)

Mentre que Rest _agrupa_ valors en un array, **Spread _desempaqueta_** elements d'un array o propietats d'un objecte:

```javascript
// Clonar o fusionar arrays fàcilment:
const a1 = [1, 2];
const a2 = [3, 4];
const combinat = [...a1, ...a2, 5]; // [1, 2, 3, 4, 5]

// Clonar i afegir propietats a objectes (Shallow Copy):
const base = { model: "Focus", motor: "Gasolina" };
const cotxeComplet = { ...base, color: "Roig", any: 2024 };
```

---

## 3.4. Desestructuració (_Destructuring_)

Extreu valors d'arrays o propietats d'objectes directament en variables independents:

### Desestructuració d'Arrays (per posició):

```javascript
const coordenades = [39.4699, -0.3763];
const [latitud, longitud] = coordenades;
console.log(latitud); // 39.4699

// Saltar posicions:
const colors = ["roig", "verd", "blau", "groc"];
const [primer, , tercer] = colors; // primer = "roig", tercer = "blau"
```

### Desestructuració d'Objectes (per nom de propietat):

```javascript
const alumne = { nom: "Noé", curs: "2DAW", nota: 9.5 };

// Extracció bàsica:
const { nom, nota } = alumne;

// Extracció amb canvi de nom de variable i valor per defecte:
const { curs: cicleFormatiu, ciutat = "Gandia" } = alumne;
console.log(cicleFormatiu); // "2DAW"
console.log(ciutat); // "Gandia" (valor per defecte perquè no existia a 'alumne')
```

---

## 3.5. Àmbit (_Scope_) i Closures (_Clausures_)

> 🧠 **Definició clau d'examen:**  
> Un **Closure** es produeix quan una funció interna «recorda» i manté accés a les variables de la funció exterior (pare) que la va crear, fins i tot **després que la funció exterior haja acabat d'executar-se**.

Permet crear **estat privat** en JavaScript (abans de l'arribada dels camps privats de classes `#`):

```javascript
function crearComptador(valorInicial = 0) {
  let comptador = valorInicial; // Variable PRIVADA protegida dins del closure

  return {
    incrementar: function () {
      comptador++;
      return comptador;
    },
    obtenirValor: function () {
      return comptador;
    },
  };
}

const c1 = crearComptador(10);
console.log(c1.incrementar()); // 11
console.log(c1.incrementar()); // 12
console.log(c1.obtenirValor()); // 12
// No hi ha cap manera d'accedir a 'comptador' directament des de fora!
```

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 3

_(Pots escriure el codi directament baix de cada apartat)._

### Exercici 3.1: Conversió a Arrow Function en 1 sola línia

Transforma la següent funció tradicional en una **funció fletxa de 1 sola línia** amb retorn implícit d'un objecte literal:

```javascript
function crearPunt(x, y) {
  return {
    coordX: x,
    coordY: y,
  };
}
```

> **La teua solució (en 1 línia):**  
> `const crearPunt = (x, y) => ({coordX: x, coordY: y})`  
> ✅ **PERFECTE (10 / 10):** Has utilitzat exactament els parèntesis `({ ... })` per a retornar l'objecte literal de forma implícita sense fallar la sintaxi.

---

### Exercici 3.2: Desestructuració avançada

Donat el següent objecte:

```javascript
const producte = {
  id: 101,
  nom: "Teclat Mecànic",
  preu: 79.99,
};
```

Escriu **una sola línia de codi** utilitzant desestructuració per a:

1. Guardar la propietat `nom` en una variable anomenada `nomProducte`.
2. Guardar la propietat `stock` amb un valor per defecte de `0` (ja que no existeix en l'objecte).

> **La teua resposta inicial:**  
> `let nomProducte = producte.nom;`  
> `let stock = producte.stock ?? 0;`
>
> 💡 **Correcció pedagògica:** El teu codi aconsegueix el valor correcte per accés de punt tradicional, però **l'enunciat demanava fer-ho amb sintaxi de Desestructuració (`{ ... } = producte`) en 1 sola línia**:
>
> ```javascript
> const { nom: nomProducte, stock = 0 } = producte;
> ```
>
> - **`nom: nomProducte`**: extreu la propietat `nom` de l'objecte i la desa en una variable nova anomenada `nomProducte`.
> - **`stock = 0`**: com `stock` no existeix en `producte`, li assigna automàticament el valor per defecte `0`.

---

### Exercici 3.3: Predicció de sortida d'un Closure

Observa aquest codi:

```javascript
function crearAcumulador(base) {
  return function (afegit) {
    base += afegit;
    return base;
  };
}

const suma5 = crearAcumulador(5);
const r1 = suma5(10);
const r2 = suma5(2);

const suma100 = crearAcumulador(100);
const r3 = suma100(50);
```

**Pregunta:** Quin valor tindran `r1`, `r2` i `r3` al final de l'execució?

> **Les teues respostes (Anotades amb correcció):**
>
> - `r1` val: **15** ✅ (`base` comença en 5 + 10 = 15)
> - `r2` val: **17** ⚠️ _(Vas posar 7, però compte amb la màgia del Closure! La variable `base` no es reinicia a 5 en la segona crida; es va quedar guardada en memòria valent 15. Per tant: 15 + 2 = 17!)._
> - `r3` val: **150** ✅ (`suma100` és una nova instància independent del closure: 100 + 50 = 150)

---

# 🚀 BLOC 4: Mètodes Natius Avançats d'Array (`map`, `filter`, `reduce`), String i Math

## 4.1. Mètodes d'Array Funcionals (Immutables)

En JavaScript modern evitem els bucles `for` manuals sempre que siga possible, substituint-los per mètodes funcionals declaratius que **no muten l'array original**:

| Mètode                     | Què fa?                                                  | Què retorna?                                    |
| :------------------------- | :------------------------------------------------------- | :---------------------------------------------- |
| **`.forEach(fn)`**         | Executa una funció per a cada element (efecte secundari) | `undefined` (mai retorna un array)              |
| **`.map(fn)`**             | Transforma cada element aplicant la funció               | **Nou Array** amb la **mateixa grandària**      |
| **`.filter(fn)`**          | Filtra elements que compleixen una condició booleana     | **Nou Array** amb els elements que donen `true` |
| **`.find(fn)`**            | Busca el primer element que compleix la condició         | El **primer element trobat** (o `undefined`)    |
| **`.some(fn)`**            | Comprova si **almenys un** element compleix la condició  | Booleà (`true` / `false`)                       |
| **`.every(fn)`**           | Comprova si **tots** els elements compleixen la condició | Booleà (`true` / `false`)                       |
| **`.reduce(fn, inicial)`** | Acumula tots els elements en un únic resultat final      | Un únic valor (número, objecte, etc.)           |

### Exemples comentats:

```javascript
const preus = [10, 25, 60, 80, 5];

// 1. .map(): Multiplica tots els preus per 2
const doblats = preus.map((p) => p * 2); // [20, 50, 120, 160, 10]

// 2. .filter(): Només els preus majors de 20
const cars = preus.filter((p) => p > 20); // [25, 60, 80]

// 3. Encadenament (.filter().map()): Filtra i després transforma
const carsDobles = preus.filter((p) => p > 20).map((p) => p * 2); // [50, 120, 160]

// 4. .reduce(): Suma tots els preus
// L'acumulador comença en 0 (segon argument de reduce)
const totalCompra = preus.reduce(
  (acumulador, preuActual) => acumulador + preuActual,
  0,
);
console.log(totalCompra); // 180
```

---

## 4.2. Mètodes Clau de l'Objecte `String`

```javascript
const frase = "  Desenvolupament Web en Entorn Client  ";

// 1. .trim(): Elimina espais en blanc dels extrems
const neta = frase.trim(); // "Desenvolupament Web en Entorn Client"

// 2. Comprovacions booleanes (molt útils en validacions):
console.log(neta.includes("Web")); // true
console.log(neta.startsWith("Desen")); // true
console.log(neta.endsWith("Servidor")); // false

// 3. .split(separador): Converteix String a Array
const paraules = neta.split(" ");
// ["Desenvolupament", "Web", "en", "Entorn", "Client"]

// 4. .slice(inici, fi): Retalla una subcadena (sense mutar)
console.log(neta.slice(0, 16)); // "Desenvolupament"
```

---

## 4.3. L'Objecte `Math`

- `Math.floor(x)`: Arrodoneix **cap avall** (`Math.floor(4.9)` ➔ `4`).
- `Math.ceil(x)`: Arrodoneix **cap amunt** (`Math.ceil(4.1)` ➔ `5`).
- `Math.round(x)`: Arrodoneix al número enter **més proper** (`Math.round(4.5)` ➔ `5`).
- `Math.max(...nums)` i `Math.min(...nums)`: Màxim i mínim.

### La fórmula clàssica d'examen: Número enter aleatori entre `min` i `max`

`Math.random()` retorna un decimal pseudoaleatori entre `0` (inclòs) i `1` (exclòs).  
Per a obtindre un enter aleatori entre `min` i `max` (ambdós inclosos):

```javascript
function generarAleatori(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
```

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 4

_(Pots escriure el codi directament baix de cada apartat)._

### Exercici 4.1: Encadenament `.filter()` i `.map()`

Donat el següent llistat de productes:

```javascript
const cataleg = [
  { nom: "Ratolí", preu: 25 },
  { nom: "Monitor", preu: 200 },
  { nom: "Auriculars", preu: 45 },
  { nom: "Cadira Gamer", preu: 150 },
];
```

Escriu una sola instrucció encadenada (`cataleg.filter(...).map(...)`) que:

1. Filtre només els productes amb un `preu >= 50`.
2. Retorne un array únicament amb els **noms en majúscules** (`.toUpperCase()`).

> **La teua solució (Anotada amb correcció):**  
> `catalegFiltrat = cataleg.filter((p) => {p.preu >= 50}).map((p) => {p.nom.toUpperCase()})`
>
> 💡 **Correcció pedagògica (El parany de les claus `{}`):**  
> Vas posar les claus `{ ... }` dins de la funció fletxa sense la paraula `return`. Recorda la regla d'or del Bloque 3: **si poses claus `{}`, has d'escriure `return` explícit**. Si no poses `return`, la funció retorna `undefined` i el filtre queda buit.
>
> - **Solució neta en 1 línia (sense claus per a retorn implícit):**
>   ```javascript
>   const catalegFiltrat = cataleg
>     .filter((p) => p.preu >= 50)
>     .map((p) => p.nom.toUpperCase());
>   ```

---

### Exercici 4.2: Càlcul total amb `.reduce()`

Donat el següent carret de la compra, on cada element té `preu` i `quantitat`:

```javascript
const carret = [
  { producte: "Llibre", preu: 15, quantitat: 2 },
  { producte: "Quadern", preu: 3, quantitat: 5 },
  { producte: "Bolígraf", preu: 1.5, quantitat: 10 },
];
```

Utilitza `.reduce()` per a calcular l'import total de la compra (tingues en compte que cada línia val `preu * quantitat`).

> **La teua solució:**
>
> ```javascript
> const total = carret.reduce((acumulador, filaActual) => {
>   return acumulador + filaActual.preu * filaActual.quantitat;
> }, 0);
> ```
>
> ✅ **PERFECTE (10 / 10):** Has utilitzat exactament el callback amb el seu retorn i el valor inicial `0`.  
> _(Nota: Com ja saps, en cada iteració `filaActual` és un dels objectes de l'array `carret`, per això té les propietats `.preu` i `.quantitat`)._

---

### Exercici 4.3: Tirada d'un dau de 6 cares amb `Math`

Completa la següent funció fletxa d'1 línia perquè retorne un número enter aleatori entre 1 i 6 (com un dau tradicional de joc):

> **La teua solució (Anotada amb correcció):**  
> `const tirarDau = (min, max) => Math.floor(Math.random * (max - min + 1)) + min;`
>
> 💡 **Correcció pedagògica:**
>
> 1. `Math.random` és una funció nativa, per tant cal invocar-la amb parèntesis: **`Math.random()`**.
> 2. Com és un dau concret de 6 cares (entre 1 i 6), no cal demanar paràmetres:
>    ```javascript
>    const tirarDau = () => Math.floor(Math.random() * 6) + 1;
>    ```

---

# 🚀 BLOC 5: BOM, DOM, Objectes del Navegador i Persistència (`localStorage`, `JSON`)

## 5.1. El BOM (Browser Object Model) i l'Objecte `window`

L'objecte `window` representa la finestra del navegador i és l'objecte global suprem en client:

1. **`window.location` (URL i navegació):**
   - `location.href`: Obtenir o canviar la URL actual (`location.href = "login.html"` redirigeix a una altra pàgina).
   - `location.reload()`: Recarrega la pàgina actual.
2. **Temporitzadors (_Timers_):**
   - `setTimeout(fn, ms)`: Executa la funció `fn` **una sola vegada** passats `ms` mil·lisegons.
     ```javascript
     const idTimer = setTimeout(() => console.log("Han passat 3 segons"), 3000);
     clearTimeout(idTimer); // Cancel·la el temporitzador abans que s'execute
     ```
   - `setInterval(fn, ms)`: Executa la funció **de forma periòdica** cada `ms` mil·lisegons.
     ```javascript
     const idRellotge = setInterval(() => console.log("Tic"), 1000);
     clearInterval(idRellotge); // Atura el cicle repetitiu
     ```

---

## 5.2. El DOM (Document Object Model) i Manipulació d'Elements

El DOM és la representació en arbre d'objectes del document HTML:

### 1. Selecció moderna d'elements:

```javascript
// Retorna el PRIMER element coincident (o null):
const boto = document.querySelector("#btn-enviar");
const titol = document.querySelector(".encapcalat");

// Retorna un NodeList estàtic amb TOTS els elements coincidents:
const paràgrafs = document.querySelectorAll("p.destacat");
paràgrafs.forEach((p) => (p.style.color = "blue"));
```

### 2. Modificació de contingut i atributs:

- `.textContent`: Modifica o llegeix el text pla (segur contra atacs XSS).
- `.innerHTML`: Interpreta codi HTML (`"<strong>Text</strong>"`).
- `.value`: Llegeix o assigna el valor d'elements de formulari (`<input>`, `<select>`, `<textarea>`).
- `.classList` (Gestió de classes CSS):
  - `.classList.add("actiu")`
  - `.classList.remove("ocult")`
  - `.classList.toggle("mode-fosc")` (si té la classe la lleva, si no la té la posa).
  - `.classList.contains("actiu")` (retorna `true` o `false`).

### 3. Creació i eliminació de nodes:

```javascript
const nouElement = document.createElement("li"); // Crea la tag <li></li>
nouElement.textContent = "Comprar llet"; // Li afegeix contingut
document.querySelector("#llista-tasques").append(nouElement); // L'insereix al final

// nouElement.remove(); // Elimina el node del document
```

---

## 5.3. Gestió d'Esdeveniments (_Events_)

```javascript
const formulari = document.querySelector("#meu-formulari");

formulari.addEventListener("submit", (e) => {
  // ⚠️ MÈTODE ESTRELLA D'EXAMEN:
  e.preventDefault(); // Evita que el formulari s'envie i recarregue la pàgina!

  const campNom = document.querySelector("#nom");
  console.log("Nom introduït:", campNom.value);
});
```

- **`e.target`**: L'element exacte del DOM que ha disparat l'esdeveniment.
- **`e.preventDefault()`**: Atura l'acció per defecte del navegador (submit de formularis, enllaços `<a>`).
- **`e.stopPropagation()`**: Evita la propagació de l'esdeveniment cap als elements pares (_Event Bubbling_).

---

## 5.4. Persistència de Dades: `localStorage`, `sessionStorage` i `JSON`

| Característica   | `localStorage`                               | `sessionStorage`                           |
| :--------------- | :------------------------------------------- | :----------------------------------------- |
| **Persistència** | Permanent (fins que s'esborre explícitament) | Temporal (s'esborra en tancar la pestanya) |
| **Capacitat**    | ~5 MB per domini                             | ~5 MB per pestanya                         |
| **Format admès** | **NOMÉS Strings de text!**                   | **NOMÉS Strings de text!**                 |

> ⚠️ **El gran error típic en exàmens:**
> Si fas `localStorage.setItem("usuari", { nom: "Noé" })`, es guardarà la cadena `"[object Object]"` i les dades es perden.
> **Cal usar sempre `JSON.stringify()` per a desar i `JSON.parse()` per a recuperar:**

```javascript
const usuaris = [
  { id: 1, nom: "Noé" },
  { id: 2, nom: "Eloy" },
];

// 1. Guardar objecte o array (Serialitzar a String):
localStorage.setItem("llista_usuaris", JSON.stringify(usuaris));

// 2. Recuperar i tornar a convertir en Objecte/Array de debò (Deserialitzar):
const dadesGuardades = localStorage.getItem("llista_usuaris");
const usuarisRecuperats = JSON.parse(dadesGuardades) ?? [];
console.log(usuarisRecuperats[0].nom); // "Noé"

// 3. Eliminar dades:
localStorage.removeItem("llista_usuaris");
// localStorage.clear(); // Esborra tot el localStorage del domini
```

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 5

_(Pots escriure el teu codi directament baix de cada apartat)._

### Exercici 5.1: Formulari amb `preventDefault()`

Donat el següent formulari HTML:

```html
<form id="form-login">
  <input type="text" id="usuari" placeholder="Nom d'usuari" />
  <button type="submit">Entrar</button>
</form>
```

Escriu el codi JavaScript amb `addEventListener` que:

1. Capture l'esdeveniment `submit` del formulari.
2. Evite la recàrrega de la pàgina amb `e.preventDefault()`.
3. Mostre per consola el text que l'usuari ha escrit a l'input `#usuari`.

> **La teua solució:**  
> const formulari = document.querySelector("#form-login");
> formulari.addEventListener("submit", e => {
> e.preventDefault();
>
> const inputUsuari = document.querySelector("#usuari");
> console.log("Nom d'usuari: ", inputUsuari.value);
>
> })

---

### Exercici 5.2: Botó de Mode Fosc (`classList.toggle`)

Escriu el codi per a que quan es faça clic sobre un botó amb id `#btn-mode`:

- S'alterne la classe CSS `dark-theme` sobre l'element `document.body` (si no la té, que la pose; si ja la té, que la lleu).

> **La teua solució:**  
> const botoMode = document.querySelector("#btn-mode");
> botoMode.addEventListener("click", () => {
> document.body.classList.toggle("dark-theme");
> })

---

### Exercici 5.3: Persistència d'un Array amb `localStorage`

Tens el següent array d'objectes:

```javascript
const tasques = [
  { id: 1, text: "Repassar DWEC", feta: true },
  { id: 2, text: "Entregar U4 DWES", feta: false },
];
```

Escriu les **2 línies de codi** necessàries per a:

1. Guardar l'array `tasques` en `localStorage` sota la clau `"tasques_app"`.
2. Recuperar eixes dades de `localStorage` en una nova variable `tasquesCarregades` com a Array d'objectes JS real.

> **La teua solució (Anotada amb correcció):**
>
> ```javascript
> localStorage.setItem("tasques_app", JSON.stringify(tasques)); // ⚠️ compte amb l'errata: stringify (amb 'i')
> const tasquesCarregades = JSON.parse(localStorage.getItem("tasques_app")); // afegit 'const' per bona pràctica
> ```
>
> ✅ **PERFECTE (10 / 10):** La lògica és impecable: `JSON.stringify` per a convertir a text en desar, i `JSON.parse` per a recuperar l'array real d'objectes.

---

# 🚀 BLOC 6: Programació Orientada a Objectes moderna en ES6 (UD4)

En la UD4 treballes amb la sintaxi moderna de classes introduïda en ECMAScript 2015 (ES6). Encara que per sota JavaScript continua funcionant amb prototips (_prototypal inheritance_), la sintaxi `class` és molt similar a Java o PHP, fent-la molt neta i intuïtiva.

---

## 6.1. Estructura Bàsica d'una Classe en JavaScript

```javascript
class Usuari {
  // 1. Constructor: s'executa automàticament en fer 'new'
  constructor(nom, email) {
    this.nom = nom; // Propietat pública
    this.email = email;
  }

  // 2. Mètode d'instància (pertany a cada objecte creat)
  saludar() {
    return `Hola, soc ${this.nom} (${this.email})`;
  }
}

// Instanciació d'objectes:
const u1 = new Usuari("Noé", "noe@correu.com");
console.log(u1.saludar()); // "Hola, soc Noé (noe@correu.com)"
```

---

## 6.2. Encapsulament: Camps Privats amb `#` i Getters/Setters

Fins fa poc, a JavaScript no existien propietats privades (s'usava la convenció de posar una barra baixa `_saldo`, però era accessible igualment).  
En JavaScript modern (ES2022) s'utilitza el símbol almohadeta **`#`** per a declarar **camps estrictament privats**:

```javascript
class CompteEstalvis {
  // Declaració obligatòria del camp privat amb '#'
  #saldo;

  constructor(titular, saldoInicial = 0) {
    this.titular = titular;
    this.#saldo = saldoInicial; // Només visible DINS d'aquesta classe
  }

  // GETTER: Permet llegir el camp com si fora una propietat normal
  get saldo() {
    return this.#saldo;
  }

  // SETTER: Permet validar abans de modificar
  set saldo(nouSaldo) {
    if (nouSaldo < 0) {
      throw new Error("El saldo no pot ser negatiu!");
    }
    this.#saldo = nouSaldo;
  }

  ingressar(quantitat) {
    if (quantitat > 0) this.#saldo += quantitat;
  }
}

const compte = new CompteEstalvis("Noé", 100);
console.log(compte.saldo); // 100 (Crida al getter 'get saldo')
compte.ingressar(50);
console.log(compte.saldo); // 150

// ❌ Intent d'accedir des de fora a la propietat privada:
// console.log(compte.#saldo); // SyntaxError: Private field '#saldo' must be declared in an enclosing class
```

---

## 6.3. Membres Estàtics (`static`)

Un mètode o propietat amb **`static`** pertany a la **pròpia Classe**, no a les instàncies individuals creades amb `new`.

> 💡 **Exemple típic:** `Math.floor()` és un mètode estàtic de la classe `Math` (no fas `new Math()`).

```javascript
class Validador {
  // Propietat estàtica compartida
  static MIN_LONGITUD_PASS = 8;

  // Mètode estàtic d'utilitat
  static esPasswordSegur(pass) {
    return pass.length >= Validador.MIN_LONGITUD_PASS;
  }
}

// S'invoca directament sobre el nom de la Classe, SENSE fer 'new':
console.log(Validador.esPasswordSegur("12345678")); // true
console.log(Validador.esPasswordSegur("curta")); // false
```

---

## 6.4. Herència: `extends` i `super()`

Permet que una classe filla herete propietats i mètodes d'una classe pare:

> ⚠️ **Regla d'or d'examen:**  
> Dins del `constructor` d'una classe filla, és **obligatori cridar a `super(...)` abans d'utilitzar la paraula clau `this`**.

```javascript
class Dispositiu {
  constructor(marca, model) {
    this.marca = marca;
    this.model = model;
  }

  descripcio() {
    return `${this.marca} ${this.model}`;
  }
}

// Herència amb 'extends':
class Portatil extends Dispositiu {
  constructor(marca, model, ram) {
    // Crida al constructor de la classe pare (Dispositiu):
    super(marca, model);
    this.ram = ram; // Propietat específica del Portàtil
  }

  // Sobreescriptura de mètode (Method Overriding):
  descripcio() {
    // Podem aprofitar el mètode del pare amb super.descripcio()
    return `${super.descripcio()} amb ${this.ram}GB RAM`;
  }
}

const miPc = new Portatil("Lenovo", "ThinkPad", 32);
console.log(miPc.descripcio()); // "Lenovo ThinkPad amb 32GB RAM"
```

---

## 6.5. Documentació amb JSDoc

El professor Migueles dóna molta importància a documentar classes i funcions amb format JSDoc:

```javascript
/**
 * Representa un producte de la botiga.
 * @class
 */
class Producte {
  /**
   * @param {string} nom - El nom del producte.
   * @param {number} preu - El preu en euros.
   */
  constructor(nom, preu) {
    this.nom = nom;
    this.preu = preu;
  }

  /**
   * Calcula el preu amb IVA inclòs.
   * @param {number} [iva=0.21] - El tipus d'IVA aplicable.
   * @returns {number} El preu final amb impostos.
   */
  calcularPVP(iva = 0.21) {
    return this.preu * (1 + iva);
  }
}
```

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 6

_(Escriu el teu codi directament baix de cada apartat)._

### Exercici 6.1: Classe amb camp privat `#` i Getter

Crea una classe anomenada `Termostat`:

1. Ha de tindre un camp privat `#temperatura` (en graus Celsius).
2. El constructor rep `temperaturaInicial` i l'assigna al camp privat `#temperatura`.
3. Crea un getter `get temperatura()` que retorne el valor del camp privat.
4. Crea un mètode `pujar()` que incremente la temperatura en 1 grau.

> **La teua solució:**  
>  class Termostat {
> #temperatura;
> constructor(temperaturaInicial) {
> this.#temperatura = temperaturaInicial;
> }
> get temperatura() {
> return this.#temperatura;
> }
> pujar() {
> this.#temperatura++;
> }
> }

---

### Exercici 6.2: Herència amb `extends` i `super`

Donada la classe `Llibre` que vas crear en la pràctica:

```javascript
class Llibre {
  constructor(titol, autor) {
    this.titol = titol;
    this.autor = autor;
  }

  detall() {
    return `'${this.titol}' de ${this.autor}`;
  }
}
```

Crea una classe filla anomenada `LlibreDigital` que:

1. Herete de `Llibre` mitjançant `extends`.
2. El seu constructor reba `(titol, autor, format)` (per exemple "PDF" o "EPUB").
3. Cride correctament a `super(...)` per a inicialitzar el títol i l'autor.
4. Guarde `format` en `this.format`.
5. Sobreescriga el mètode `detall()` per a retornar: `'${titol}' de ${autor} [Format: ${format}]`.

> **La teua solució:**  
>  class LlibreDigital extends Llibre {

      constructor(titol, autor, format) {
         super(titol, autor);
         this.format = format;
      }
      detall() {
         return `${super.detall()} [Format: ${this.format}]`;
      }

}

---

### Exercici 6.3: Mètode Estàtic (`static`)

Afegeix a la següent classe `Conversor` un mètode estàtic anomenat `celsiusAFahrenheit(celsius)` que aplique la fórmula `(celsius * 9/5) + 32` i retorne el resultat:

```javascript
class Conversor {
  static celsiusAFahrenheit(celsius) {
    return (celsius * 9) / 5 + 32;
  }
}

// Prova d'ús (sense fer 'new'):
// console.log(Conversor.celsiusAFahrenheit(0));   // Hauria d'imprimir 32
// console.log(Conversor.celsiusAFahrenheit(100)); // Hauria d'imprimir 212
```

> **La teua solució (Anotada amb correcció):**
>
> ```javascript
> class Conversor {
>   static celsiusAFahrenheit(celsius) {
>     return (celsius * 9) / 5 + 32;
>   }
> }
> ```
>
> ✅ **PERFECTE (10 / 10):** Mètode estàtic implementat exactament amb la paraula clau `static`, permetent cridar `Conversor.celsiusAFahrenheit(...)` sense necessitat de fer `new`.

---

# 🚀 BLOC 7: Asincronia (Promeses, `async/await` i `fetch`) — ÚLTIM BLOC!

## 7.1. Per què necessitem Asincronia en el Client?

Com hem vist des del Bloc 1, JavaScript funciona en un **únic fil (_Single-Threaded_)**.  
Si una operació tarda temps (per exemple, demanar dades a un servidor a través d'Internet que tarda 1 segon en respondre):

- **Si fora síncron:** El navegador es **congelaria completament** durant eixe segon (l'usuari no podria fer clic, ni scroll, ni moure el ratolí).
- **Com és asíncron:** JavaScript encarrega la petició a la xarxa, continua atenent la pantalla i l'usuari amb fluïdesa, i **quan la resposta arriba**, l'Event Loop s'encarrega d'avisar-nos per a processar les dades.

---

## 7.2. Les Promeses (`Promise`)

Una **Promesa** és un objecte de JavaScript que representa el resultat futur d'una operació asíncrona.

> ⚠️ **Pregunta clàssica de test:** Una promesa pot estar en un d'aquests **3 estats**:
>
> 1. **`pending` (Pendent):** L'operació s'està executant (esperant la resposta de la xarxa).
> 2. **`fulfilled` / `resolved` (Resolta amb èxit):** L'operació ha finalitzat correctament i tenim les dades.
> 3. **`rejected` (Rebutjada):** S'ha produït un error (sense connexió, error 404/500, etc.).

### Consum clàssic amb `.then()` i `.catch()`:

```javascript
// La funció descarregarDades() retorna una Promesa:
descarregarDades()
  .then((resultat) => {
    console.log("Dades rebudes amb èxit:", resultat);
  })
  .catch((error) => {
    console.error("S'ha produït un error:", error);
  })
  .finally(() => {
    console.log("Operació acabada (tant si ha anat bé com malament)");
  });
```

---

## 7.3. La Sintaxi Moderna: `async` i `await` (ES2017)

La sintaxi `.then().catch()` funcionava bé, però quan s'encadenaven moltes operacions acabava sent difícil de llegir (_Promise Hell_).  
Per això es van introduir les paraules clau **`async`** i **`await`**, que permeten escriure codi asíncron amb l'aspecte net d'un codi síncron tradicional:

- **`async`:** Es col·loca davant de la funció. Indica que eixa funció **retorna automàticament una Promesa**.
- **`await`:** Només es pot utilitzar **dins de funcions `async`**. Pausa l'execució de la funció fins que la Promesa es resol, i en trau el resultat net directament.
- **Gestió d'errors:** S'utilitza el clàssic bloc **`try { ... } catch (error) { ... }`**:

```javascript
async function processar() {
  try {
    console.log("Demanant dades...");
    const dades = await descarregarDades(); // Espera sense congelar el navegador
    console.log("Dades rebudes:", dades);
  } catch (error) {
    console.error("Error capturat:", error);
  }
}
```

---

## 7.4. Peticions HTTP amb la Fetch API (`fetch`)

`fetch()` és la funció nativa moderna dels navegadors per a comunicar-se amb servidors i APIs REST (substituint l'antic i feixuc `XMLHttpRequest`).

> ⚠️ **El gran parany d'examen amb `fetch()`:**  
> `fetch()` requereix **DOS passos amb `await`**:
>
> 1. El primer `await fetch(url)` espera a rebre les capçaleres de la resposta HTTP.
> 2. El segon `await resposta.json()` espera a llegir i deserialitzar el cos de la resposta com a Array/Objecte de JavaScript.

### Petició GET (Demanar dades):

```javascript
async function obtindreProductes() {
  try {
    const resposta = await fetch("https://api.botiga.com/productes");

    // Comprovació obligatòria del codi d'estat HTTP (200-299):
    if (!resposta.ok) {
      throw new Error(`Error HTTP: ${resposta.status} ${resposta.statusText}`);
    }

    const productes = await resposta.json(); // Converteix de text JSON a Objecte JS
    console.log("Llistat de productes:", productes);
    return productes;
  } catch (error) {
    console.error("Error en la petició:", error.message);
  }
}
```

### Petició POST (Enviar dades noves a un servidor):

```javascript
async function guardarLead(nouLead) {
  const resposta = await fetch("https://api.techleads.com/leads", {
    method: "POST",
    headers: {
      "Content-Type": "application/json", // Avisem que enviem dades JSON
    },
    body: JSON.stringify(nouLead), // Serialitzem a String abans d'enviar
  });
  return await resposta.json();
}
```

---

## ✏️ EXERCICIS PRÀCTICS DEL BLOC 7

_(Escriu el teu codi directament baix de cada apartat)._

### Exercici 7.1: De `.then()` a `async / await`

Tens la següent funció escrita amb l'estil antic de promeses:

```javascript
function carregarConfiguracio() {
  obtindreDadesServidor()
    .then((config) => {
      console.log("Configuració:", config);
    })
    .catch((err) => {
      console.error("Error:", err);
    });
}
```

**Reescriu la funció `carregarConfiguracio` utilitzant la sintaxi moderna de `async / await` i un bloc `try / catch`:**

> **La teua solució (Anotada amb correcció):**  
> ```javascript
> async function carregarConfiguracio() {
>   try {
>     const config = await obtindreDadesServidor();
>     console.log("Configuració: ", config);
>   } catch (error) {
>     console.error(error);
>   }
> }
> ```  
> ✅ **PERFECTE (10 / 10):** Has reescrit el codi a la perfecció. L'ús de `async`, `try`, `await` i `catch` és la forma estàndard i neta de consumir promeses en JavaScript modern.

---

### Exercici 7.2: Funció `fetch` per a obtindre un usuari

Completa la següent funció asíncrona perquè:

1. Faça una petició `fetch` a la URL: `` `https://jsonplaceholder.typicode.com/users/${id}` ``
2. Comprove si la resposta és correcta amb `if (!resposta.ok)`. Si falla, llança un error amb `throw new Error("Usuari no trobat")`.
3. Converteix la resposta a JSON amb `await resposta.json()` i retorne l'usuari.

> **La teua solució:**  
> ```javascript
> async function buscarUsuariPerId(id) {
>   try {
>     const resposta = await fetch(`https://jsonplaceholder.typicode.com/users/${id}`);
> 
>     if (!resposta.ok) {
>       throw new Error("Usuari no trobat");
>     }
>     const usuari = await resposta.json();
>     return usuari;
>   } catch (error) {
>     console.error("Error capturat:", error.message);
>   }
> }
> ```  
> ✅ **PERFECTE (10 / 10):** Has seguit la seqüència exacta de 3 passos: `await fetch()`, validació amb `!resposta.ok` i `throw`, i extracció del cos amb `await resposta.json()`.

---

### Exercici 7.3: Pregunta clau d'examen sobre l'Event Loop

Observa aquest codi:

```javascript
console.log("1");

setTimeout(() => {
  console.log("2");
}, 0);

console.log("3");
```

**Pregunta:** Quin ordre exacte d'impressió tindrà per consola (`1, 2, 3` o `1, 3, 2`)? Explica breument per què el número amb `setTimeout(..., 0)` no s'executa immediatament.

> **La teua resposta inicial:**
> - Ordre d'impressió: 1, 2, 3
> - Explicació: el timeout esta a 0 per lo que no te espera e imprimix enseguida
>
> 💡 **Correcció pedagògica (La gran trampa de l'Event Loop):**  
> L'ordre real és **`1, 3, 2`**!  
> **Per què el `2` s'imprimeix l'últim encara que el temporitzador siga de `0 ms`?**  
> Pel simple fet de ser una funció asíncrona delegada al navegador (`setTimeout`), JavaScript no la deixa en la Pila principal de crides (*Call Stack*). **La desplaça a la Cua de Tasques (*Task Queue*)**.  
> I la regla sagrada de l'Event Loop és: **cap tasca de la cua s'executa fins que la pila de codi síncron directe estiga TOTALMENT buida**.  
> Per tant, primer s'executa `console.log("1")` (síncron), després `console.log("3")` (síncron), i només quan el fitxer acaba, l'Event Loop deixa passar el `setTimeout` executant `console.log("2")`.

---

## 🏁 FI DEL TEMARI DE DWEC (1a AVALUACIÓ)

🏆 **Enhorabona! Tens el 100% del temari oficial del primer quadrimestre (UD1 a UD4) sintetitzat, explicat i resolt en aquest quadern.** Estàs absolutament preparat per a l'examen presencial del 19–20 de novembre!
