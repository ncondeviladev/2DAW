<style>
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
  }
</style>

# DWEC — Unitat 2: Exercicis de Repàs i Algorísmia en JavaScript

|                 |                                              |
| --------------- | -------------------------------------------- |
| **Alumne**      | Noé Conde Vila                               |
| **Curs**        | 2n DAW (Semipresencial) — IES Maria Enríquez |
| **Assignatura** | DWEC — Desenvolupament Web en Entorn Client  |
| **Data**        | Setembre 2026                                |

---

## Exercici 1: Calcular si un nombre és primer

**Enunciat: Escriu una funció que diga si n és primer.**

```javascript
function esPrimer(n) {
  if (n < 2) return false; // Numeros menores que 2 no son primos
  if (n === 2) return true; // El 2 es el unico numero primo par
  if (n % 2 === 0) return false; // Descartamos todos los demas numeros pares
  for (let i = 3; i * i <= n; i += 2) {
    // Probamos impares hasta la raiz cuadrada para ahorrar vueltas
    if (n % i === 0) return false; // Si encontramos una division exacta, no es primo
  }
  return true; // Si ningun numero lo divide exactamente, es primo
}

// Exemples
console.log(esPrimer(17)); // true
console.log(esPrimer(15)); // false
```

---

## Exercici 2: Factorial (iteratiu)

**Enunciat: Calcula el factorial de n utilitzant un mètode iteratiu (no recursiu).**

```javascript
function factorial(n) {
  if (n < 0) throw new Error("n ha de ser no negatiu"); // El factorial no existe para negativos, lanzamos un error
  let resultat = 1; // Empezamos en 1 (elemento neutro de la multiplicacion)
  for (let i = 2; i <= n; i++) {
    // Multiplicamos desde 2 hasta n
    resultat *= i; // Acumulamos el producto: resultat = resultat * i
  }
  return resultat; // Devolvemos el factorial final acumulado
}

// Exemples
console.log(factorial(5)); // 120
```

---

## Exercici 3: Màxim entre tres nombres

**Enunciat: Donats tres enters a, b, c, retorna el màxim.**

```javascript
function maxTres(a, b, c) {
  if (a >= b && a >= c) {
    // Comprobamos si 'a' es mayor o igual que los otros dos
    return a;
  } else if (b >= a && b >= c) {
    // Comprobamos si 'b' es mayor o igual que 'a' y 'c'
    return b;
  }
  return c; // Si ni 'a' ni 'b' son los mayores, por descarte lo es 'c'
}

// Exemples
console.log(maxTres(3, 9, 5)); // 9
```

---

## Exercici 4: Divisors d'un nombre

**Enunciat: Imprimeix tots els divisors de n en ordre ascendent.**

```javascript
function divisors(n) {
  n = Math.abs(n); // Si es negativo lo convertimos a positivo
  let resultat = []; // Array donde guardaremos la lista de divisores
  for (let i = 1; i * i <= n; i++) {
    // Recorremos hasta la raiz cuadrada (el punto espejo)
    if (n % i === 0) {
      // Si el resto es 0, 'i' divide exacto
      resultat.push(i); // Guardamos el divisor pequeño
      if (i !== n / i) resultat.push(n / i); // Guardamos su pareja grande sin duplicar
    }
  }
  resultat.sort((x, y) => x - y); // Ordenamos los numeros de menor a mayor
  return resultat; // Retornamos el array con todos los divisores
}

// Exemple
console.log(divisors(28)); // [1, 2, 4, 7, 14, 28]
```

---

## Exercici 5: Comptar vocals en una cadena

**Enunciat: Donada una cadena s, compta les vocals (a, e, i, o, u).**

```javascript
function comptaVocals(s) {
  let vocals = 0; // Contador de vocales encontradas
  s = s.toLowerCase(); // Convertimos el texto a minusculas para comparar facil
  for (let i = 0; i < s.length; i++) {
    // Recorremos caracter a caracter
    if ("aeiou".includes(s[i])) vocals++; // Si la cadena de vocales contiene la letra actual, sumamos 1
  }
  return vocals; // Devolvemos el total de vocales encontradas
}

// Exemple
console.log(comptaVocals("Hola món")); // 3 (o, a, o)
```

---

## Exercici 6: Comptar zeros al final de n! (núm de zeros de factorització)

**Enunciat: Donat n, determina quants zeros té n! a la dreta (màxim nombre de zeros).**

```javascript
function zerosFactorial(n) {
  let ceros = 0; // Contador de ceros acumulados
  let p = 5; // Empezamos comprobando los múltiplos de 5
  while (p <= n) {
    // Mientras el múltiplo no supere al número n
    ceros += Math.floor(n / p); // Sumamos cuántos múltiplos de p caben en n
    p *= 5; // Pasamos a la siguiente potencia de 5 (5, 25, 125...)
  }
  return ceros; // Devolvemos el total de ceros al final
}

// Exemple
console.log(zerosFactorial(10)); // 2
```

---

## Exercici 7: Comprovació de coprimes amb l'algorisme d'Euclides

**Enunciat: Donats a i b, escriu si són coprims (GCD(a, b) == 1) utilitzant l'algorisme d'Euclides (divisions successives).**

```javascript
function areCoprime(a, b) {
  a = Math.abs(a); // Convertimos 'a' a positivo por si es negativo
  b = Math.abs(b); // Convertimos 'b' a positivo por si es negativo
  while (b !== 0) { // Repetimos el bucle mientras el divisor 'b' no sea 0
    let resto = a % b; // Calculamos el resto de la division entera entre 'a' y 'b'
    a = b; // El divisor pasa a ser el nuevo dividendo
    b = resto; // El resto pasa a ser el nuevo divisor
  }
  return a === 1; // Si el maximo comun divisor final es 1, son coprimos (true)
}

// Exemples
console.log(areCoprime(35, 16)); // true
console.log(areCoprime(21, 14)); // false
```

---

## Exercici 8: Comprovar si un nombre és perfet (divisors exclosos igual a n)

**Enunciat: Donat n, verifica si és un nombre perfecte (la suma dels seus divisors exclosant n és igual a n).**

```javascript
function esPerfet(n) {
  if (n <= 1) return false; // Los números menores o iguales a 1 no son perfectos
  let suma = 1; // El 1 siempre es divisor propio de cualquier n > 1
  for (let d = 2; d * d <= n; d++) { // Recorremos hasta la raíz cuadrada
    if (n % d === 0) { // Si d divide exacto a n
      suma += d; // Sumamos el divisor pequeño
      if (d !== n / d) suma += n / d; // Sumamos su pareja grande sin duplicar
    }
  }
  return suma === n; // Comprobamos si la suma de divisores coincide con n
}

// Exemples
console.log(esPerfet(6)); // true (1+2+3)
console.log(esPerfet(28)); // true (1+2+4+7+14)
```

---

## Exercici 9: Suma recursiva de 1 a n

**Enunciat: Calcula la suma dels naturals de 1 a n de forma recursiva.**

```javascript
function sumaRec(n) {
  if (n <= 0) return 0; // Caso base: si n es 0 o menor, la suma es 0
  return n + sumaRec(n - 1); // Caso recursivo: n más la suma recursiva de n - 1
}

// Exemples
console.log(sumaRec(5)); // 15
```

---

## Exercici 10: Invertir una cadena recursivament

**Enunciat: Donada una cadena s, retorna la mateixa cadena però al revés, implementat de forma recursiva.**

```javascript
function invertirRec(s) {
  if (s.length <= 1) return s; // Caso base: una cadena de 0 o 1 caracter ya está invertida
  return s[s.length - 1] + invertirRec(s.slice(0, -1)); // Último caracter + inversión recursiva del resto
}

// Exemple
console.log(invertirRec("abcdef")); // "fedcba"
```

---

## Exercici 11: Comptar particions palíndromes d'una cadena

**Enunciat: Donada una cadena s, calcula el nombre de formes diferents de dividir s en substrings que siguin palindròmes. Cada partició és una manera de dividir trossos contigus en substrings palindròmics. Ex: "aab" té 2 particions: ["a","a","b"] i ["aa","b"].**

```javascript
function countPalindromicPartitions(s) {
  const n = s.length;
  // Matriz booleana para precalcular si s[i..j] es un palíndromo
  const pal = Array.from({ length: n }, () => Array(n).fill(false));
  for (let i = n - 1; i >= 0; i--) { // Recorremos desde el final hacia el principio
    for (let j = i; j < n; j++) { // Comprobamos subcadenas desde i hasta j
      if (s[i] === s[j] && (j - i <= 2 || pal[i + 1][j - 1])) {
        pal[i][j] = true; // Es palíndromo si los extremos coinciden y el interior también
      }
    }
  }
  // dp[i] almacena el número de particiones posibles de la subcadena s[i..n-1]
  const dp = new Array(n + 1).fill(0);
  dp[n] = 1; // Caso base: una cadena vacía tiene 1 partición válida
  for (let i = n - 1; i >= 0; i--) { // Calculamos de derecha a izquierda
    let sum = 0;
    for (let j = i; j < n; j++) {
      if (pal[i][j]) sum += dp[j + 1]; // Si s[i..j] es palíndromo, sumamos las formas del resto
    }
    dp[i] = sum; // Guardamos el resultado parcial
  }
  return dp[0]; // Resultado para la cadena completa empezando en el índice 0
}

// Exemple
console.log(countPalindromicPartitions("aab")); // 2
console.log(countPalindromicPartitions("aaa")); // 4: ["a","a","a"], ["a","aa"], ["aa","a"], ["aaa"]
```

---

## Exercici 12: Comptar camins en una graella amb obstacles

**Enunciat: Donada una graella m x n amb obstacles (cel·les bloquejades), calcula el nombre de camins des de la cantonada superior esquerra (0,0) fins a la cantonada inferior dreta (m-1, n-1), movent-te només cap a la dreta o cap avall. Representa obstacles com un conjunt de cadenes "i,j" o una matriu booleana obstacles[i][j] = true.**

```javascript
function countPathsWithObstacles(obstacles) {
  const m = obstacles.length; // Filas de la cuadrícula
  if (m === 0) return 0; // Si la cuadrícula está vacía, no hay caminos
  const n = obstacles[0].length; // Columnas de la cuadrícula
  if (obstacles[0][0]) return 0; // Si la casilla de salida está bloqueada, no hay camino

  // Matriz DP de m x n inicializada a 0
  const dp = Array.from({ length: m }, () => Array(n).fill(0));
  dp[0][0] = 1; // 1 forma de empezar en la casilla inicial

  for (let i = 0; i < m; i++) { // Recorremos filas
    for (let j = 0; j < n; j++) { // Recorremos columnas
      if (obstacles[i][j]) {
        dp[i][j] = 0; // Si hay obstáculo, hay 0 caminos que pasen por aquí
        continue;
      }
      if (i > 0) dp[i][j] += dp[i - 1][j]; // Sumamos caminos que vienen desde arriba
      if (j > 0) dp[i][j] += dp[i][j - 1]; // Sumamos caminos que vienen desde la izquierda
    }
  }
  return dp[m - 1][n - 1]; // Devolvemos caminos para llegar a la esquina inferior derecha
}

// Exemple
const grid1 = [
  [false, false, false],
  [false, true, false],
  [false, false, false],
];
console.log(countPathsWithObstacles(grid1)); // 2
```

---

## Exercici 13: Longitud de la millor subcadena sense caràcters repetits

**Enunciat: Donada una cadena s, troba la longitud de la subcadena més llarga sense caràcters repetits.**

```javascript
function lengthOfLongestUniqueSubstring(s) {
  const pos = new Map(); // Guarda la última posición vista de cada caracter
  let left = 0, best = 0; // Puntero izquierdo de la ventana y longitud máxima encontrada

  for (let right = 0; right < s.length; right++) { // Puntero derecho que recorre la cadena
    if (pos.has(s[right]) && pos.get(s[right]) >= left) {
      left = pos.get(s[right]) + 1; // Si el caracter ya se vio, movemos el inicio de la ventana
    }
    pos.set(s[right], right); // Actualizamos la última posición vista del caracter
    best = Math.max(best, right - left + 1); // Guardamos la longitud máxima de la ventana actual
  }
  return best; // Devolvemos la longitud de la subcadena única más larga
}

// Exemples
console.log(lengthOfLongestUniqueSubstring("abcabcbb")); // 3 ("abc")
console.log(lengthOfLongestUniqueSubstring("bbbbb")); // 1
```

---

## Exercici 14: Generació de totes les seqüències vàlides de parèntesis

**Enunciat: Donat un nombre n de parells, genera totes les seqüències vàlides de parèntesis amb n parells '(' i ')' de manera que sempre estiguin balancejades.**

```javascript
function generateParenthesis(n) {
  const res = []; // Array donde almacenaremos las combinaciones válidas

  // Función recursiva de backtracking: cadena acumulada, abiertos usados, cerrados usados
  function backtrack(curr, open, close) {
    if (curr.length === 2 * n) { // Si la cadena alcanza la longitud 2 * n, es una solución completa
      res.push(curr); // Guardamos la combinación
      return;
    }
    if (open < n) backtrack(curr + '(', open + 1, close); // Podemos abrir si quedan '(' por usar
    if (close < open) backtrack(curr + ')', open, close + 1); // Podemos cerrar si hay '(' abiertos
  }

  backtrack('', 0, 0); // Iniciamos el backtracking con cadena vacía
  return res; // Devolvemos todas las secuencias válidas generadas
}

// Exemple
console.log(generateParenthesis(3));
// [ "((()))", "(()())", "(())()", "()(())", "()()()" ]
```

---

## Exercici 15: Màxim sum subseqüència amb espai no adyacents

**Enunciat: Dada una successió d'entitats amb valors enter, troba el màxim sumatori d'una subseqüència no adjacent (no es poden escollir elements contigus). No es tracta de sol·licitar ordre de números en la seqüència, només la suma òptima.**

```javascript
function maxNonAdjacentSum(nums) {
  if (nums.length === 0) return 0; // Si el array está vacío, la suma máxima es 0
  let incl = Math.max(0, nums[0]); // Mejor suma incluyendo el primer elemento
  let excl = 0; // Mejor suma excluyendo el elemento actual

  for (let i = 1; i < nums.length; i++) { // Recorremos desde el segundo elemento
    const newExcl = Math.max(excl, incl); // La mejor suma sin el actual es el máximo anterior
    incl = excl + nums[i]; // La suma incluyendo el actual suma el valor a la anterior exclusión
    excl = newExcl; // Actualizamos la exclusión
  }
  return Math.max(incl, excl); // Devolvemos la mejor suma posible entre incluir o excluir
}

// Exemples
console.log(maxNonAdjacentSum([3, 2, 7, 10])); // 13 (3 + 10)
console.log(maxNonAdjacentSum([3, 2, 5, 10, 7])); // 15 (3 + 5 + 7)
```

---

## Exercici 16: Cerca binària recursiva

**Enunciat: Implementar una cerca binària recursiva en un vector ordenat de manera ascendent. La funció ha de retornar l'índex de l'element buscant si existeix, o -1 si no és present. La cerca es divideix en dos subproblems reduint a la meitat el rang de recerca en cada pas.**

**Descripció de la solució:**
- Si el rang és invàlid (left > right), l'element no està present i retornem -1.
- Es calcula l'índex del mig: mid = floor((left + right) / 2).
- Si l'element buscant és igual a arr[mid], retornem mid.
- Si és menor que arr[mid], busquem a la meitat esquerra: left ... mid-1.
- Si és més gran, busquem a la meitat dreta: mid+1 ... right.
- La recursivitat continua fins a trobar l'element o fins que el range sigui invàlid.

**Explicació detallada:**
- Avantatge principal: cada pas descarta la meitat de l'espai possible, per tant la complexitat és O(log n).
- Cas base: rang invàlid (left > right) o element trobat en arr[mid].
- Cas recursiu: segons la comparació amb arr[mid], cridem recursivament la cerca en la meitat pertinent.
- Es pot exposar amb paràmetres opcionals left i right per inicialitzar com left = 0 i right = arr.length - 1.

```javascript
function binarySearch(arr, target, left = 0, right = arr.length - 1) {
  if (left > right) return -1; // Caso base: rango no válido, el elemento no existe

  const mid = Math.floor((left + right) / 2); // Calculamos el índice medio del rango

  if (arr[mid] === target) {
    return mid; // Elemento encontrado en el medio, devolvemos su posición
  } else if (target < arr[mid]) {
    return binarySearch(arr, target, left, mid - 1); // Buscamos en la mitad izquierda
  } else {
    return binarySearch(arr, target, mid + 1, right); // Buscamos en la mitad derecha
  }
}

// Exemples
const v = [1, 3, 4, 6, 8, 10, 12];
console.log(binarySearch(v, 6)); // 3
console.log(binarySearch(v, 7)); // -1
console.log(binarySearch(v, 1)); // 0
console.log(binarySearch(v, 12)); // 6
```
