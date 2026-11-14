# ⚡ Guía Completa de Preparación DWEC (Examen 1ª Evaluación)
> **Módulo:** Desarrollo Web en Entorno Cliente (DWEC) — 2º DAW  
> **Profesor:** José Ramón Migueles  
> **Alumno:** Noé Conde Vila  
> **Formato del examen:** 10 preguntas tipo test + 3 ejercicios prácticos de desarrollo (`ejRA2.js`, `ejRA3.js`, `ejRA4.js`).

---

## 🗺️ Índice de Contenidos

1. [Bloque 1: El Test de 10 Preguntas (Conceptos Clave y Trampas)](#bloque-1)
   - 1.1. Tipos primitivos vs referencia y la mutabilidad con `const`
   - 1.2. Las trampas históricas de `typeof`
   - 1.3. Comparaciones: `==` vs `===` y valores *Falsy*
   - 1.4. Declaración de variables: `var` vs `let` vs `const`, Hoisting y TDZ
   - 1.5. Funciones flecha y el contexto `this` léxico
   - 1.6. Closures (Clausuras) explicadas sin rodeos
   - 1.7. **Simulacro: 15 Preguntas Tipo Test con Solución Razonada**
2. [Bloque 2: Ejercicio 1 de Examen — RA2 (`ejRA2.js`): Cadenas, Math y Fechas](#bloque-2)
   - 2.1. Métodos esenciales de `String`
   - 2.2. Métodos esenciales del objeto `Math`
   - 2.3. Manejo del objeto `Date` (creación y cálculo de días)
   - 2.4. **Ejercicio Guiado RA2: Limpieza de texto y cálculo temporal**
   - 2.5. **Ejercicio de Examen Real RA2 con Solución Comentada**
3. [Bloque 3: Ejercicio 2 de Examen — RA3 (`ejRA3.js`): Arrays y Programación Funcional](#bloque-3)
   - 3.1. La tríada funcional: `filter`, `map` y `reduce`
   - 3.2. Búsqueda y validación: `find`, `some`, `every`, `includes`
   - 3.3. Ordenación numérica y alfabética con `sort()`
   - 3.4. **Ejercicio Guiado RA3: Filtrado y agregación tipo `analizaNumeros`**
   - 3.5. **Ejercicio de Examen Real RA3 con Solución Comentada**
4. [Bloque 4: Ejercicio 3 de Examen — RA4 (`ejRA4.js`): POO Moderna en ES6 con `#privado`](#bloque-4)
   - 4.1. Estructura de clase ES6: `class`, `constructor` y `this`
   - 4.2. Atributos privados con almohadilla (`#propiedad`)
   - 4.3. Getters y Setters con validación de datos
   - 4.4. Métodos de negocio y método `resumen()`
   - 4.5. **Ejercicio Guiado RA4: Clase completa tipo `Libro` / `Articulo`**
   - 4.6. **Ejercicio de Examen Real RA4 con Solución Comentada**
5. [Bloque 5: Plantillas Maestras para el Examen](#bloque-5)

---

<a name="bloque-1"></a>
# 🧠 BLOQUE 1: El Test de 10 Preguntas (Conceptos Clave y Trampas)

En el test del ordenador, José Ramón no busca que sepas sintaxis compleja, sino que caigas en las inconsistencias históricas de JavaScript.

---

### 1.1. Tipos primitivos vs referencia y la mutabilidad con `const`

JavaScript divide los datos en dos categorías:

| Característica | Tipos Primitivos | Tipos Compuestos (Referencia) |
| :--- | :--- | :--- |
| **Cuáles son** | `number`, `string`, `boolean`, `undefined`, `null`, `bigint`, `symbol`. | `Object`, `Array`, `Function`. |
| **Cómo se pasan** | **Por valor** (se crea una copia independiente en memoria). | **Por referencia** (se comparte la misma dirección de memoria). |
| **Mutabilidad** | Inmutables (no puedes modificar el primitivo original). | Mutables (puedes cambiar sus propiedades internas). |

```javascript
// Paso por valor (Primitivo):
let a = 10;
let b = a;
b = 20;
console.log(a); // 10 (a no cambia)

// Paso por referencia (Compuesto):
const arr1 = [1, 2];
const arr2 = arr1;
arr2.push(3);
console.log(arr1); // [1, 2, 3] (¡arr1 cambia porque comparten memoria!)
```

#### ⚠️ Trampa típica: ¿`const` hace inmutable a un Array u Objeto?
**NO.** `const` solo congela la asignación de la variable (no puedes hacer `arr1 = [4, 5]`), pero **SÍ permite mutar su contenido interno** (`arr1.push(99)` o `obj.nombre = "Pepe"` son totalmente válidos).

---

### 1.2. Las trampas históricas de `typeof`

Aprende estas 4 líneas de memoria porque entran siempre:

```javascript
typeof 42;          // "number"
typeof "hola";      // "string"
typeof true;        // "boolean"
typeof undefined;   // "undefined"

// ⚠️ LAS 3 TRAMPAS TÍPICAS DE EXAMEN:
typeof null;        // "object"  -> Bug histórico de JS de 1995 que nunca se corrigió.
typeof NaN;         // "number"  -> NaN significa "Not a Number", ¡pero su tipo es number!
typeof [1, 2, 3];   // "object"  -> Los arrays no tienen tipo propio en typeof.
typeof function(){};// "function"-> Las funciones sí devuelven "function".
```

> **¿Cómo comprobar si algo es realmente un Array?** Con `Array.isArray(variable)`.

---

### 1.3. Comparaciones: `==` vs `===` y valores *Falsy*

- **`==` (Igualdad laxa):** Intenta convertir los tipos antes de comparar (coerción implícita). Es peligroso e impredecible.
- **`===` (Igualdad estricta):** Comprueba que **el tipo Y el valor** sean exactamente idénticos.

```javascript
0 == "";            // true (convierte "" a 0)
0 == false;         // true (convierte false a 0)
"" == false;        // true
null == undefined;  // true (regla especial de JS)

// Con igualdad estricta (===) TODOS son false:
0 === "";           // false (number vs string)
0 === false;        // false (number vs boolean)
null === undefined; // false (object vs undefined)
```

#### Los 6 únicos valores Falsy en JavaScript:
Todo en JavaScript se evalúa a `true` (truthy), **EXCEPTO estos 6**:
1. `false`
2. `0` (y `-0`)
3. `""` (string vacío)
4. `null`
5. `undefined`
6. `NaN`

*(Ojo: `[]` y `{}` están vacíos, pero **son `true`** porque son objetos en memoria).*

---

### 1.4. Declaración de variables: `var` vs `let` vs `const`, Hoisting y TDZ

| Criterio | `var` (Obsoleto ❌) | `let` (Reasignable ✅) | `const` (Fija ✅) |
| :--- | :--- | :--- | :--- |
| **Ámbito (Scope)** | Función o global | **Bloque `{ ... }`** | **Bloque `{ ... }`** |
| **Reasignación** | Sí (`x = 5; x = 6;`) | Sí | **No (`TypeError`)** |
| **Redeclaración** | Sí (`var x=1; var x=2;`) | **No (`SyntaxError`)** | **No (`SyntaxError`)** |
| **Hoisting** | Se eleva inicializada en `undefined` | Se eleva pero entra en **TDZ** | Se eleva pero entra en **TDZ** |

- **Hoisting:** Mecanismo donde el motor de JS lee las declaraciones antes de ejecutar el código.
- **TDZ (Temporal Dead Zone):** El período entre el inicio del bloque y la línea donde declaras `let` o `const`. Acceder a la variable antes de su declaración lanza `ReferenceError`.

```javascript
console.log(x); // undefined (var se eleva con valor undefined)
var x = 10;

console.log(y); // ReferenceError: Cannot access 'y' before initialization
let y = 20;     // (estaba en la TDZ)
```

---

### 1.5. Funciones flecha (`=>`) y el contexto `this` léxico

Las funciones normales (`function`) y las funciones flecha (`=>`) tienen una diferencia crucial en el examen:

1. **Función tradicional (`function`):** Crea su propio `this` dependiendo de **quién la invoque**.
2. **Función flecha (`=>`):** **NO tiene `this` propio**. Hereda el `this` del contexto donde fue escrita (*this léxico*). Tampoco tiene objeto `arguments`.

```javascript
const usuario = {
  nombre: "Noé",
  saludarTradicional: function() {
    console.log(this.nombre); // "Noé" (this apunta a usuario)
  },
  saludarFlecha: () => {
    console.log(this.nombre); // undefined (this apunta al objeto global Window)
  }
};
```
> **Regla:** En métodos de objetos usa funciones tradicionales si necesitas `this`. En callbacks de arrays (`map`, `filter`) usa funciones flecha.

---

### 1.6. Closures (Clausuras) explicadas sin rodeos

Una **closure** se produce cuando una función interna **recuerda y mantiene acceso** a las variables de su función padre, incluso después de que la función padre haya terminado de ejecutarse.

```javascript
function crearContador() {
  let contador = 0; // Variable privada protegida en la clausura
  return function() {
    contador++;
    return contador;
  };
}

const incrementar = crearContador();
console.log(incrementar()); // 1
console.log(incrementar()); // 2
console.log(incrementar()); // 3
```
> **¿Para qué sirve en examen?** Para crear variables y funciones privadas antes de que existieran las clases con `#`.

---

### 1.7. Simulacro: 15 Preguntas Tipo Test con Solución Razonada

#### Pregunta 1: ¿Cuál es el resultado de `typeof null`?
- a) `"null"`
- b) `"undefined"`
- c) `"object"` *(Correcta: bug histórico nunca corregido de JS).*
- d) `"number"`

#### Pregunta 2: ¿Qué valor imprime `console.log(typeof NaN)`?
- a) `"NaN"`
- b) `"number"` *(Correcta: NaN representa un fallo numérico, pero su tipo es number).*
- c) `"undefined"`
- d) `"error"`

#### Pregunta 3: ¿Qué ocurre al ejecutar `const nums = [1, 2]; nums.push(3);`?
- a) Lanza `TypeError: Assignment to constant variable`.
- b) El array se modifica a `[1, 2, 3]`. *(Correcta: const protege la variable, no el contenido del array).*
- c) Devuelve `undefined`.
- d) Requiere declarar el array con `let`.

#### Pregunta 4: ¿Cuál de las siguientes comparaciones devuelve `false`?
- a) `0 == false` (devuelve true)
- b) `"" == 0` (devuelve true)
- c) `null == undefined` (devuelve true)
- d) `null === undefined` *(Correcta: tienen tipos distintos: object vs undefined).*

#### Pregunta 5: ¿Qué ámbito tienen las variables declaradas con `let`?
- a) Ámbito de función únicamente.
- b) Ámbito global siempre.
- c) Ámbito de bloque `{ ... }`. *(Correcta: viven solo dentro de las llaves donde se declaran).*
- d) Ámbito de archivo.

#### Pregunta 6: ¿Qué es la "Zona Muerta Temporal" (TDZ)?
- a) El tiempo que tarda el Garbage Collector en borrar variables.
- b) El período entre el inicio del ámbito y la declaración de `let`/`const` donde acceder a ellas da error. *(Correcta).*
- c) El tiempo de espera de un `setTimeout`.
- d) Un error al intentar dividir por 0.

#### Pregunta 7: ¿Cuál de los siguientes valores es considerado *Truthy* en un condicional?
- a) `""` (falsy)
- b) `0` (falsy)
- c) `[]` *(Correcta: todo objeto o array, aunque esté vacío, evalúa a true).*
- d) `null` (falsy)

#### Pregunta 8: ¿Cómo se comprueba fiablemente si la variable `x` es un Array?
- a) `typeof x === "array"` (falso, devuelve "object")
- b) `Array.isArray(x)` *(Correcta: método oficial y fiable).*
- c) `x.type == "array"`
- d) `x instanceof String`

#### Pregunta 9: ¿Qué diferencia principal tiene una función flecha `() => {}` con una tradicional?
- a) La función flecha no puede recibir parámetros.
- b) La función flecha siempre debe devolver un número.
- c) La función flecha no tiene su propio `this`, sino que hereda el del contexto donde se define. *(Correcta).*
- d) La función flecha no admite recursividad.

#### Pregunta 10: ¿Qué devuelve `Boolean("false")`?
- a) `false`
- b) `true` *(Correcta: cualquier string no vacío, incluso con la palabra "false", evalúa a true).*
- c) `null`
- d) `NaN`

#### Pregunta 11: ¿Qué resultado produce `"5" + 3` y `"5" - 3`?
- a) `8` y `2`
- b) `"53"` y `2` *(Correcta: el operador `+` concatena strings; el operador `-` fuerza conversión numérica).*
- c) `"53"` y `"5-3"`
- d) `NaN` y `2`

#### Pregunta 12: ¿Qué hace `Object.freeze(obj)`?
- a) Elimina el objeto de memoria.
- b) Congela el objeto para que no se puedan añadir, borrar ni modificar sus propiedades existentes. *(Correcta).*
- c) Convierte el objeto a JSON.
- d) Oculta las claves privadas.

#### Pregunta 13: En una closure, ¿qué mantiene accesible la función interna?
- a) Solo los parámetros globales de Window.
- b) Las variables locales del ámbito léxico de su función contenedora. *(Correcta).*
- c) Solo los atributos estáticos de la clase.
- d) Únicamente variables numéricas.

#### Pregunta 14: ¿Qué devuelve `Array(3).fill(0)`?
- a) `[0, 0, 0]` *(Correcta: crea un array de 3 huecos y los rellena con 0).*
- b) `[3, 0]`
- c) `[0]`
- d) `null`

#### Pregunta 15: ¿Qué diferencia hay entre `null` y `undefined`?
- a) Son exactamente idénticos en valor y tipo.
- b) `undefined` indica una variable declarada sin inicializar; `null` representa una ausencia intencionada de valor asignada por el programador. *(Correcta).*
- c) `null` solo se usa con números y `undefined` con texto.
- d) `undefined` ocupa más memoria que `null`.

---

<a name="bloque-2"></a>
# 🔤 BLOQUE 2: Ejercicio 1 de Examen — RA2 (`ejRA2.js`)
### Cadenas (`String`), Números (`Math`) y Fechas (`Date`)

El ejercicio `ejRA2.js` consiste en recibir datos en bruto (un string largo, un código o una fecha) y devolverlos limpios, formateados o con algún cálculo matemático.

---

### 2.1. Métodos esenciales de `String`

```javascript
const texto = "  Desarrollo Web en Entorno Client 2DAW  ";

// 1. Limpieza de espacios en extremos:
const limpio = texto.trim(); // "Desarrollo Web en Entorno Client 2DAW"

// 2. Mayúsculas y Minúsculas:
limpio.toLowerCase(); // todo a minúsculas
limpio.toUpperCase(); // todo a mayúsculas

// 3. Extraer trozos de texto (slice es el mejor método):
// slice(inicio, finSinIncluir)
limpio.slice(0, 10);     // "Desarrollo"
limpio.slice(-4);        // "2DAW" (cuenta desde el final con valores negativos)

// 4. Dividir texto en un Array (split):
const palabras = limpio.split(" "); // ["Desarrollo", "Web", "en", "Entorno", "Client", "2DAW"]

// 5. Reemplazar texto:
limpio.replace("Client", "Cliente"); // reemplaza la primera coincidencia
limpio.replaceAll(" ", "-");         // reemplaza todas las coincidencias

// 6. Comprobaciones de contenido (devuelven boolean):
limpio.includes("Web");      // true
limpio.startsWith("Desa");   // true
limpio.endsWith("2DAW");     // true

// 7. Rellenar cadenas (muy útil para números de factura o fechas):
"5".padStart(2, "0"); // "05" (rellena a la izquierda hasta tener 2 dígitos)
```

---

### 2.2. Métodos esenciales del objeto `Math`

```javascript
// 1. Redondeos:
Math.floor(4.9); // 4 (siempre hacia abajo al entero más cercano)
Math.ceil(4.1);  // 5 (siempre hacia arriba al entero más cercano)
Math.round(4.5); // 5 (redondeo estándar: 0.5 hacia arriba)

// 2. Mínimos y Máximos:
Math.min(10, 5, 20, 2); // 2
Math.max(10, 5, 20, 2); // 20
// Con arrays usando el operador spread (...):
const valores = [10, 50, 3];
Math.max(...valores);   // 50

// 3. Generar número aleatorio entre MIN y MAX (¡Pregunta fija!):
function aleatorio(min, max) {
  // Fórmula oficial: Math.floor(Math.random() * (max - min + 1)) + min;
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
console.log(aleatorio(1, 10)); // Entero aleatorio entre 1 y 10 inclusive

// 4. Formatear decimales numéricos:
const precio = 19.4589;
precio.toFixed(2); // "19.46" (¡Ojo! toFixed devuelve un string, no un number)
parseFloat(precio.toFixed(2)); // 19.46 (vuelve a ser número)
```

---

### 2.3. Manejo del objeto `Date`

> ⚠️ **La gran trampa de Date en JavaScript**:  
> Los meses van de **0 a 11** (0 = Enero, 1 = Febrero, ..., 10 = Noviembre, 11 = Diciembre).  
> Los días de la semana van de **0 a 6** (0 = Domingo, 1 = Lunes, ..., 6 = Sábado).

```javascript
// 1. Crear fechas:
const ahora = new Date(); // Fecha y hora actuales
const examen = new Date(2026, 10, 18); // 18 de Noviembre de 2026 (mes 10 es Noviembre)
const fechaISO = new Date("2026-11-18"); // Formato estándar ISO (YYYY-MM-DD)

// 2. Extraer partes de la fecha:
const anyo = examen.getFullYear();   // 2026 (¡NUNCA uses getYear() que está obsoleto!)
const mes  = examen.getMonth() + 1;  // 11 (Sumamos 1 para mostrar formato humano 1-12)
const dia  = examen.getDate();       // 18 (getDate es el día del mes; getDay es el día de la semana)

// 3. Calcular la diferencia en días entre dos fechas (Patrón de examen):
function diasEntre(fecha1, fecha2) {
  const unDiaEnMs = 1000 * 60 * 60 * 24; // ms * seg * min * horas = 86.400.000 ms
  const diferenciaMs = Math.abs(fecha2 - fecha1); // Restar fechas devuelve milisegundos
  return Math.floor(diferenciaMs / unDiaEnMs);
}

const hoy = new Date("2026-11-14");
const fExamen = new Date("2026-11-18");
console.log(diasEntre(hoy, fExamen)); // 4 días
```

---

### 2.4. Ejercicio Guiado RA2: Limpieza de texto y cálculo temporal

**Enunciado:**  
Crea una función llamada `procesaRegistro(cadena)` que reciba una cadena con el formato:  
`"  usuario:noe conde;fecha_nacimiento:1998-05-12;gasto_total:145.894  "`  
La función debe devolver un objeto limpio con:
1. `nombre`: En mayúsculas y sin espacios sobrantes (`"NOE CONDE"`).
2. `edad`: Los años cumplidos calculados a partir de la fecha actual.
3. `gastoFormateado`: El gasto redondeado a 2 decimales con el símbolo del euro (`"145.89 €"`).

```javascript
function procesaRegistro(cadena) {
  // 1. Limpiar espacios exteriores y separar por punto y coma:
  const partes = cadena.trim().split(";");
  
  // 2. Extraer cada dato separando por los dos puntos:
  const nombreRaw = partes[0].split(":")[1];
  const fechaRaw  = partes[1].split(":")[1];
  const gastoRaw  = parseFloat(partes[2].split(":")[1]);

  // 3. Procesar el nombre:
  const nombre = nombreRaw.trim().toUpperCase();

  // 4. Procesar la fecha y calcular edad:
  const fechaNac = new Date(fechaRaw);
  const hoy = new Date();
  let edad = hoy.getFullYear() - fechaNac.getFullYear();
  // Ajuste por si aún no ha llegado el mes o día de su cumpleaños este año:
  const mesActual = hoy.getMonth();
  const mesNac = fechaNac.getMonth();
  if (mesActual < mesNac || (mesActual === mesNac && hoy.getDate() < fechaNac.getDate())) {
    edad--;
  }

  // 5. Formatear el gasto:
  const gastoFormateado = `${gastoRaw.toFixed(2)} €`;

  return { nombre, edad, gastoFormateado };
}

// Comprobación:
console.log(procesaRegistro("  usuario:noe conde;fecha_nacimiento:1998-05-12;gasto_total:145.894  "));
// Salida esperada: { nombre: 'NOE CONDE', edad: 28, gastoFormateado: '145.89 €' }
```

---

### 2.5. Ejercicio de Examen Real RA2 con Solución Comentada

**Enunciado Tipo Examen:**  
Crea un script llamado `ejRA2.js` con una función `analizarMatricula(texto)` que reciba una cadena de texto que contiene matrículas de alumnos desordenadas separadas por barras inclinadas `/`:  
`"  2daw-2026/014-noe conde vila/2026-11-20  "`  
La función debe validar y devolver un objeto con los siguientes campos:
1. `curso`: La primera parte en mayúsculas (`"2DAW"`).
2. `expediente`: El número de expediente con exactamente 5 dígitos rellenado con ceros a la izquierda (ej: `"00014"`).
3. `nombreAlumno`: Capitalizado (primera letra de cada palabra en mayúscula: `"Noe Conde Vila"`).
4. `diasParaFecha`: Número de días enteros que faltan desde la fecha de hoy hasta la fecha indicada en la matrícula (`2026-11-20`). Si la fecha ya ha pasado, debe devolver `0`.

#### Solución Oficial Comentada:
```javascript
function analizarMatricula(texto) {
  // 1. Limpieza inicial de la cadena y división en partes:
  const campos = texto.trim().split("/");
  if (campos.length < 3) {
    throw new Error("El formato de la matrícula es incorrecto.");
  }

  // 2. Extraer curso y número de expediente del primer y segundo campo:
  const curso = campos[0].split("-")[0].toUpperCase(); // "2DAW"
  const numeroExpediente = campos[1].split("-")[0].trim(); // "014"
  const expediente = numeroExpediente.padStart(5, "0"); // "00014"

  // 3. Extraer y capitalizar el nombre del alumno:
  const nombreRaw = campos[1].split("-")[1].trim(); // "noe conde vila"
  const nombreAlumno = nombreRaw
    .split(" ")
    .map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1).toLowerCase())
    .join(" "); // "Noe Conde Vila"

  // 4. Calcular días restantes hasta la fecha indicada:
  const fechaObjetivo = new Date(campos[2].trim());
  const hoy = new Date();
  
  // Normalizar ambas fechas a medianoche para comparar solo días:
  hoy.setHours(0, 0, 0, 0);
  fechaObjetivo.setHours(0, 0, 0, 0);

  let diasParaFecha = 0;
  if (fechaObjetivo > hoy) {
    const unDiaMs = 1000 * 60 * 60 * 24;
    diasParaFecha = Math.round((fechaObjetivo - hoy) / unDiaMs);
  }

  return {
    curso,
    expediente,
    nombreAlumno,
    diasParaFecha
  };
}

// PRUEBA DE EJECUCIÓN:
const resultado = analizarMatricula("  2daw-2026/014-noe conde vila/2026-11-20  ");
console.log(resultado);
/*
Salida en consola:
{
  curso: '2DAW',
  expediente: '00014',
  nombreAlumno: 'Noe Conde Vila',
  diasParaFecha: 6
}
*/
```

---

<a name="bloque-3"></a>
# 📊 BLOQUE 3: Ejercicio 2 de Examen — RA3 (`ejRA3.js`)
### Arrays y Programación Funcional (`filter`, `map`, `reduce`, `sort`)

Este es el ejercicio donde José Ramón evalúa si sabes procesar colecciones de datos usando métodos funcionales modernos sin escribir bucles `for` tradicionales.

---

### 3.1. La tríada funcional: `filter`, `map` y `reduce`

Aprende qué hace cada método y qué devuelve:

| Método | ¿Qué hace? | ¿Qué devuelve? | Regla de oro |
| :--- | :--- | :--- | :--- |
| **`.filter()`** | **Selecciona** elementos que cumplen una condición booleana. | Un **nuevo Array** con menos o igual número de elementos. | La función debe devolver `true` para quedarse el elemento o `false` para descartarlo. |
| **`.map()`** | **Transforma** cada elemento del array. | Un **nuevo Array** con **exactamente la misma longitud**, pero con los elementos modificados. | La función debe devolver el elemento transformado. |
| **`.reduce()`** | **Acumula / Resume** todo el array en un único valor final. | Un **único valor** (un número, un string, o un objeto resumido). | Recibe un acumulador `acc`, el elemento actual `elem` y un **valor inicial obligatorio**. |

```javascript
const productos = [
  { id: 1, nombre: "Ratón", precio: 15, stock: true },
  { id: 2, nombre: "Teclado", precio: 45, stock: false },
  { id: 3, nombre: "Monitor", precio: 180, stock: true },
  { id: 4, nombre: "Cable HDMI", precio: 8, stock: true }
];

// 1. FILTER: Solo productos en stock:
const enStock = productos.filter(p => p.stock === true);

// 2. MAP: Obtener solo la lista de nombres en mayúsculas:
const nombresMayus = productos.map(p => p.nombre.toUpperCase());
// ["RATÓN", "TECLADO", "MONITOR", "CABLE HDMI"]

// 3. REDUCE: Calcular el precio total de todos los productos:
// Sintaxis: array.reduce((acumulador, elemento) => acumulador + valor, valorInicial)
const totalDinero = productos.reduce((total, p) => total + p.precio, 0);
// 15 + 45 + 180 + 8 = 248

// 4. ENCADENAMIENTO (El patrón favorito del profesor):
// "Calcula el precio total de los productos que SÍ están en stock aplicando un 10% de IVA":
const totalConIva = productos
  .filter(p => p.stock)               // 1º Filtramos solo stock
  .map(p => p.precio * 1.21)          // 2º Añadimos IVA
  .reduce((acc, precio) => acc + precio, 0); // 3º Sumamos todo
```

---

### 3.2. Búsqueda y validación: `find`, `some`, `every`, `includes`

```javascript
const numeros = [5, 12, 8, 130, 44];

// find: Devuelve el PRIMER elemento que cumple la condición (o undefined):
const primeroMayorA10 = numeros.find(n => n > 10); // 12

// findIndex: Devuelve la POSICIÓN del primer elemento (o -1 si no existe):
const indice = numeros.findIndex(n => n === 130); // 3

// some: ¿Al menos UNO cumple la condición? (devuelve boolean):
const hayNegativos = numeros.some(n => n < 0); // false

// every: ¿TODOS cumplen la condición? (devuelve boolean):
const todosPositivos = numeros.every(n => n > 0); // true

// includes: ¿Existe este elemento exacto en el array? (devuelve boolean):
numeros.includes(8); // true
```

---

### 3.3. Ordenación numérica y alfabética con `sort()`

> ⚠️ **Peligro mortal en el examen:**  
> Por defecto, `array.sort()` convierte todo a string y ordena alfabéticamente.  
> `[10, 5, 25, 100].sort()` devuelve `[10, 100, 25, 5]` porque "1" va antes que "2" y "2" antes que "5".

#### Cómo ordenar SIEMPRE correctamente:

```javascript
const numeros = [10, 5, 25, 100];

// Orden numérico ascendente (de menor a mayor):
numeros.sort((a, b) => a - b); // [5, 10, 25, 100]

// Orden numérico descendente (de mayor a menor):
numeros.sort((a, b) => b - a); // [100, 25, 10, 5]

// Orden alfabético con acentos y caracteres españoles (localeCompare):
const nombres = ["Óscar", "Ana", "Carlos", "Álvaro"];
nombres.sort((a, b) => a.localeCompare(b, "es"));
// ["Álvaro", "Ana", "Carlos", "Óscar"]
```

---

### 3.4. Ejercicio Guiado RA3: Tipo `analizaNumeros`

**Enunciado:**  
Escribe una función `procesarNotas(listaNotas)` que reciba un array de notas numéricas (pueden venir con decimales) y devuelva un objeto con:
1. `aprobados`: Array únicamente con las notas mayores o iguales a 5 ordenadas de menor a mayor.
2. `media`: La nota media redondeada a dos decimales.
3. `algunExcelente`: Booleano que indique si hay al menos una nota $\ge 9$.
4. `todasValidas`: Booleano que compruebe si todas las notas están en el rango legal de 0 a 10.

```javascript
function procesarNotas(listaNotas) {
  // Si el array viene vacío, controlamos el caso límite:
  if (!listaNotas || listaNotas.length === 0) {
    return { aprobados: [], media: 0, algunExcelente: false, todasValidas: true };
  }

  // 1. Validar si todas están entre 0 y 10:
  const todasValidas = listaNotas.every(n => n >= 0 && n <= 10);

  // 2. Filtrar aprobados y ordenar de menor a mayor:
  const aprobados = listaNotas
    .filter(n => n >= 5)
    .sort((a, b) => a - b);

  // 3. Comprobar si hay algún excelente (>= 9):
  const algunExcelente = listaNotas.some(n => n >= 9);

  // 4. Calcular la media con reduce:
  const sumaTotal = listaNotas.reduce((acc, nota) => acc + nota, 0);
  const media = parseFloat((sumaTotal / listaNotas.length).toFixed(2));

  return {
    aprobados,
    media,
    algunExcelente,
    todasValidas
  };
}

// Comprobación:
console.log(procesarNotas([4.5, 7.2, 9.5, 3.0, 8.0]));
/*
Salida esperada:
{
  aprobados: [ 7.2, 8, 9.5 ],
  media: 6.44,
  algunExcelente: true,
  todasValidas: true
}
*/
```

---

### 3.5. Ejercicio de Examen Real RA3 con Solución Comentada

**Enunciado Oficial Tipo Examen:**  
Desarrolla en un archivo `ejRA3.js` una función llamada `analizarInventario(articulos)` que reciba un array de objetos con la siguiente estructura:
```javascript
const inventario = [
  { ref: "A1", categoria: "hardware", precio: 120, unidades: 5 },
  { ref: "B2", categoria: "software", precio: 60, unidades: 0 },
  { ref: "C3", categoria: "hardware", precio: 15, unidades: 20 },
  { ref: "D4", categoria: "periferico", precio: 35, unidades: 8 }
];
```
La función debe devolver un objeto resumen con:
1. `disponibles`: Array de referencias (`ref`) que tienen al menos 1 unidad en stock, ordenadas alfabéticamente.
2. `valorTotalStock`: Suma económica total de todos los artículos (`precio * unidades`) con 2 decimales.
3. `articulosHardwareCaros`: Lista de artículos de la categoría `"hardware"` cuyo precio supere los 50 €.
4. `todoConStock`: Booleano que verifique si absolutamente todos los artículos tienen unidades $> 0$.

#### Solución Oficial Comentada:
```javascript
function analizarInventario(articulos) {
  // Control de entrada nula o vacía:
  if (!Array.isArray(articulos) || articulos.length === 0) {
    return {
      disponibles: [],
      valorTotalStock: 0,
      articulosHardwareCaros: [],
      todoConStock: false
    };
  }

  // 1. Referencias con stock (> 0) ordenadas alfabéticamente:
  const disponibles = articulos
    .filter(art => art.unidades > 0)
    .map(art => art.ref)
    .sort((a, b) => a.localeCompare(b));

  // 2. Valor total del stock (precio * unidades acumulado):
  const valorTotalStock = parseFloat(
    articulos
      .reduce((acumulado, art) => acumulado + (art.precio * art.unidades), 0)
      .toFixed(2)
  );

  // 3. Hardware caro (categoría 'hardware' y precio > 50):
  const articulosHardwareCaros = articulos.filter(
    art => art.categoria.toLowerCase() === "hardware" && art.precio > 50
  );

  // 4. Comprobar si todos los artículos tienen stock:
  const todoConStock = articulos.every(art => art.unidades > 0);

  return {
    disponibles,
    valorTotalStock,
    articulosHardwareCaros,
    todoConStock
  };
}

// PRUEBA DE EJECUCIÓN:
const inventarioPrueba = [
  { ref: "A1", categoria: "hardware", precio: 120, unidades: 5 },
  { ref: "B2", categoria: "software", precio: 60, unidades: 0 },
  { ref: "C3", categoria: "hardware", precio: 15, unidades: 20 },
  { ref: "D4", categoria: "periferico", precio: 35, unidades: 8 }
];

console.log(analizarInventario(inventarioPrueba));
/*
Salida en consola:
{
  disponibles: [ 'A1', 'C3', 'D4' ],
  valorTotalStock: 1180,
  articulosHardwareCaros: [ { ref: 'A1', categoria: 'hardware', precio: 120, unidades: 5 } ],
  todoConStock: false
}
*/
```

---

<a name="bloque-4"></a>
# 🏛️ BLOQUE 4: Ejercicio 3 de Examen — RA4 (`ejRA4.js`)
### POO Moderna en ES6: Clases, Campos Privados (`#`), Getters/Setters

José Ramón exige que la clase no use la sintaxis antigua de funciones constructoras (`function Persona()`), sino la sintaxis moderna de ES6 con **campos privados con `#`** para proteger los datos.

---

### 4.1. Anatomía de una Clase ES6 limpia

```javascript
class Producto {
  // 1. Declaración obligatoria de campos privados arriba de todo:
  #id;
  #precio;

  // 2. Constructor: inicializa los datos al hacer new Producto(...)
  constructor(id, nombre, precio) {
    this.#id = id;
    this.nombre = nombre; // público
    this.precio = precio; // usa el setter para validar
  }

  // 3. Getter y Setter para controlar el precio:
  get precio() {
    return this.#precio;
  }

  set precio(nuevoPrecio) {
    if (nuevoPrecio <= 0) {
      throw new Error("El precio debe ser un número estrictamente positivo.");
    }
    this.#precio = nuevoPrecio;
  }

  // 4. Getter de solo lectura para el ID (no tiene setter):
  get id() {
    return this.#id;
  }

  // 5. Método de instancia normal:
  calcularIva(porcentaje = 21) {
    return this.#precio * (porcentaje / 100);
  }

  // 6. Método resumen tipo ficha:
  resumen() {
    return `Producto [ID: ${this.#id}] ${this.nombre} - Precio: ${this.#precio} €`;
  }
}
```

---

### 4.2. ¿Por qué usamos atributos con `#`?

- En JavaScript tradicional, si escribes `this._precio`, cualquiera puede acceder desde fuera con `prod._precio = -500;`. La barra baja `_` era solo una convención entre programadores, no privacidad real.
- **Con `#precio` es privacidad real a nivel de motor**: si alguien intenta hacer `prod.#precio` desde fuera de la clase, el motor lanza inmediatamente un error de sintaxis (`SyntaxError: Private field '#precio' must be declared in an enclosing class`).

---

### 4.3. Ejercicio Guiado RA4: Clase `Alumno` con cálculo de notas

**Enunciado:**  
Crea una clase llamada `Alumno` que gestione los datos de un estudiante:
- Campos privados: `#expediente` y `#notas` (array de números).
- Campo público: `nombre`.
- Constructor que reciba `(expediente, nombre)`. Las notas deben arrancar vacías `[]`.
- Un método `agregarNota(nota)` que verifique que la nota sea un número entre 0 y 10 antes de meterla al array (si no es válida, no la añade o lanza error).
- Un getter `notaMedia` que calcule y devuelva el promedio de las notas añadidas (si no tiene notas, devuelve 0).
- Un método `resumen()` que devuelva el string:  
  `"Alumno: Noé Conde (Exp: 00123) - Media: 7.50 [Notas: 7, 8]"`

```javascript
class Alumno {
  #expediente;
  #notas;

  constructor(expediente, nombre) {
    this.#expediente = expediente;
    this.nombre = nombre;
    this.#notas = [];
  }

  get expediente() {
    return this.#expediente;
  }

  agregarNota(nota) {
    if (typeof nota !== "number" || nota < 0 || nota > 10) {
      console.warn(`Nota inválida rechazada: ${nota}`);
      return false;
    }
    this.#notas.push(nota);
    return true;
  }

  get notaMedia() {
    if (this.#notas.length === 0) return 0;
    const suma = this.#notas.reduce((acc, n) => acc + n, 0);
    return parseFloat((suma / this.#notas.length).toFixed(2));
  }

  resumen() {
    return `Alumno: ${this.nombre} (Exp: ${this.#expediente}) - Media: ${this.notaMedia.toFixed(2)} [Notas: ${this.#notas.join(", ")}]`;
  }
}

// Comprobación:
const alum = new Alumno("00123", "Noé Conde");
alum.agregarNota(7.5);
alum.agregarNota(8.5);
alum.agregarNota(12); // Inválida, se rechaza
console.log(alum.resumen());
// Salida: Alumno: Noé Conde (Exp: 00123) - Media: 8.00 [Notas: 7.5, 8.5]
```

---

### 4.4. Ejercicio de Examen Real RA4 con Solución Comentada

**Enunciado Oficial Tipo Examen:**  
Crea el archivo `ejRA4.js` que defina la clase `Tarea`.  
La clase debe representar una tarea dentro de una aplicación de gestión con las siguientes especificaciones:
1. **Atributos privados:**
   - `#id`: Identificador numérico único de solo lectura.
   - `#tiempoEstimadoMinutos`: Número entero que representa los minutos estimados.
2. **Atributos públicos:**
   - `titulo`: Texto descriptivo de la tarea.
   - `completada`: Booleano que por defecto arranca en `false`.
3. **Constructor:** Recibe `(id, titulo, tiempoEstimadoMinutos)`.
4. **Getters y Setters:**
   - Getter de solo lectura para `id`.
   - Getter y Setter para `tiempoEstimadoMinutos`. El setter debe verificar que los minutos sean un número entero mayor a 0; en caso contrario debe asignar por defecto `30` minutos.
5. **Métodos:**
   - `completar()`: Cambia el estado de `completada` a `true`.
   - `tiempoEnHoras()`: Devuelve el tiempo estimado convertido a horas con 2 decimales (ej: 90 minutos $\rightarrow$ `1.50`).
   - `resumen()`: Devuelve una cadena con el formato:  
     `"[ID: 1] Tarea: 'Estudiar DWEC' | Estado: PENDIENTE | Tiempo: 1.50 h"`  
     *(Si está completada debe mostrar `COMPLETADA` en lugar de `PENDIENTE`)*.

#### Solución Oficial Comentada:
```javascript
class Tarea {
  // 1. Declaración obligatoria de atributos privados:
  #id;
  #tiempoEstimadoMinutos;

  constructor(id, titulo, tiempoEstimadoMinutos) {
    this.#id = id;
    this.titulo = titulo.trim();
    this.completada = false; // Por defecto siempre arranca en false
    this.tiempoEstimadoMinutos = tiempoEstimadoMinutos; // Pasa por el setter
  }

  // Getter de solo lectura para el ID (sin setter):
  get id() {
    return this.#id;
  }

  // Getter para el tiempo estimado:
  get tiempoEstimadoMinutos() {
    return this.#tiempoEstimadoMinutos;
  }

  // Setter con regla de validación de negocio:
  set tiempoEstimadoMinutos(minutos) {
    if (typeof minutos === "number" && Number.isInteger(minutos) && minutos > 0) {
      this.#tiempoEstimadoMinutos = minutos;
    } else {
      console.warn("Tiempo inválido. Asignando 30 minutos por defecto.");
      this.#tiempoEstimadoMinutos = 30;
    }
  }

  // Método para marcar la tarea como completada:
  completar() {
    this.completada = true;
  }

  // Método de cálculo:
  tiempoEnHoras() {
    return (this.#tiempoEstimadoMinutos / 60).toFixed(2);
  }

  // Método resumen visual de la tarea:
  resumen() {
    const estado = this.completada ? "COMPLETADA" : "PENDIENTE";
    return `[ID: ${this.#id}] Tarea: '${this.titulo}' | Estado: ${estado} | Tiempo: ${this.tiempoEnHoras()} h`;
  }
}

// PRUEBA DE EJECUCIÓN DEL EXAMEN:
const t1 = new Tarea(1, "Estudiar DWEC para el examen", 90);
console.log(t1.resumen());
// [ID: 1] Tarea: 'Estudiar DWEC para el examen' | Estado: PENDIENTE | Tiempo: 1.50 h

t1.completar();
console.log(t1.resumen());
// [ID: 1] Tarea: 'Estudiar DWEC para el examen' | Estado: COMPLETADA | Tiempo: 1.50 h

const t2 = new Tarea(2, "Hacer la compra", -10); // Minutos inválidos
console.log(t2.resumen());
// [ID: 2] Tarea: 'Hacer la compra' | Estado: PENDIENTE | Tiempo: 0.50 h (asignó 30 min por defecto)
```

---

<a name="bloque-5"></a>
# 📋 BLOQUE 5: Plantillas Maestras para el Examen

Copia estos tres esqueletos durante el examen para empezar a programar sobre seguro sin dudar en la estructura:

### Plantilla `ejRA2.js` (Cadenas, Math y Fechas)
```javascript
/**
 * ejRA2.js — Tratamiento de cadenas, números y fechas
 * @param {string} entrada
 * @returns {Object}
 */
function procesarRA2(entrada) {
  // 1. Limpieza inicial:
  const datoLimpio = entrada.trim();

  // 2. Operaciones con String:
  // datoLimpio.split(";") | datoLimpio.slice(0, 5) | datoLimpio.toUpperCase()

  // 3. Operaciones con Math:
  // Math.floor(...) | Math.round(...) | parseFloat(num.toFixed(2))

  // 4. Operaciones con Date:
  // const f = new Date(datoFecha);
  // const dias = Math.floor(Math.abs(f2 - f1) / (1000 * 60 * 60 * 24));

  return {
    // devolver propiedades requeridas
  };
}

// Prueba:
// console.log(procesarRA2("..."));
```

---

### Plantilla `ejRA3.js` (Arrays y Programación Funcional)
```javascript
/**
 * ejRA3.js — Métodos funcionales de arrays
 * @param {Array} coleccion
 * @returns {Object}
 */
function procesarRA3(coleccion) {
  if (!Array.isArray(coleccion) || coleccion.length === 0) {
    return { filtrados: [], total: 0, verificacion: false };
  }

  // 1. Filtrar (quedarse con los que cumplen condición):
  const filtrados = coleccion.filter(elem => elem.activo === true);

  // 2. Transformar (extraer o cambiar campos):
  const transformados = filtrados.map(elem => elem.nombre.toUpperCase());

  // 3. Acumular / Sumar:
  const sumaTotal = coleccion.reduce((acc, elem) => acc + elem.precio, 0);

  // 4. Validar (some o every):
  const verificacion = coleccion.every(elem => elem.precio > 0);

  return {
    filtrados,
    transformados,
    sumaTotal,
    verificacion
  };
}

// Prueba:
// console.log(procesarRA3([...]));
```

---

### Plantilla `ejRA4.js` (Clase ES6 con Campos Privados)
```javascript
/**
 * ejRA4.js — POO moderna con campos privados
 */
class Entidad {
  #id;
  #valorNumerico;

  constructor(id, nombre, valorNumerico) {
    this.#id = id;
    this.nombre = nombre;
    this.valorNumerico = valorNumerico; // llama al setter
  }

  // Getter solo lectura:
  get id() {
    return this.#id;
  }

  // Getter y Setter con validación:
  get valorNumerico() {
    return this.#valorNumerico;
  }

  set valorNumerico(nuevoValor) {
    if (typeof nuevoValor === "number" && nuevoValor >= 0) {
      this.#valorNumerico = nuevoValor;
    } else {
      this.#valorNumerico = 0; // valor seguro por defecto
    }
  }

  // Método de instancia:
  resumen() {
    return `[ID: ${this.#id}] ${this.nombre} - Valor: ${this.#valorNumerico}`;
  }
}

// Prueba:
// const obj = new Entidad(1, "Ejemplo", 100);
// console.log(obj.resumen());
```

