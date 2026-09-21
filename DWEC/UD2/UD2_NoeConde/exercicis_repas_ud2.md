<style>
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
  }
</style>

# DWEC — Unitat 2: Exercicis de Repàs i Algorísmia en JavaScript

| | |
|---|---|
| **Alumne** | Noé Conde Vila |
| **Curs** | 2n DAW (Semipresencial) — IES Maria Enríquez |
| **Assignatura** | DWEC — Desenvolupament Web en Entorn Client |
| **Data** | Setembre 2026 |

---

## Exercici 1: Calcular si un nombre és primer

**Enunciat: Escriu una funció `esPrimer(n)` que diga si $n$ és primer (retorna `true` o `false`).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function esPrimer(n) {
    // TODO: Implementar la funció
}

// Exemples
console.log(esPrimer(17)); // true
console.log(esPrimer(15)); // false
```

---

## Exercici 2: Factorial (iteratiu)

**Enunciat: Calcula el factorial de $n$ utilitzant un mètode iteratiu (no recursiu).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function factorial(n) {
    // TODO: Implementar la funció
}

// Exemples
console.log(factorial(5)); // 120
```

---

## Exercici 3: Màxim entre tres nombres

**Enunciat: Donats tres enters $a, b, c$, retorna el màxim.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function maxTres(a, b, c) {
    // TODO: Implementar la funció
}

// Exemples
console.log(maxTres(3, 9, 5)); // 9
```

---

## Exercici 4: Divisors d'un nombre

**Enunciat: Imprimeix/retorna tots els divisors de $n$ en ordre ascendent.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function divisors(n) {
    // TODO: Implementar la funció
}

// Exemple
console.log(divisors(28)); // [1, 2, 4, 7, 14, 28]
```

---

## Exercici 5: Comptar vocals en una cadena

**Enunciat: Donada una cadena $s$, compta les vocals ($a, e, i, o, u$).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function comptaVocals(s) {
    // TODO: Implementar la funció
}

// Exemple
console.log(comptaVocals("Hola món")); // 3 (o, a, o)
```

---

## Exercici 6: Comptar zeros al final de $n!$

**Enunciat: Donat $n$, determina quants zeros té $n!$ a la dreta (nombre de zeros de factorització).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function zerosFactorial(n) {
    // TODO: Implementar la funció
}

// Exemple
console.log(zerosFactorial(10)); // 2
```

---

## Exercici 7: Comprovació de coprimers

**Enunciat: Donats $a$ i $b$, determina si són coprimers (el seu màxim comú divisor és 1).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function coprimers(a, b) {
    // TODO: Implementar la funció
}

// Exemples
console.log(coprimers(14, 15)); // true
console.log(coprimers(14, 21)); // false
```

---

## Exercici 8: Suma dels dígits fins a un sol dígit (arrel digital)

**Enunciat: Suma els dígits de $n$ repetidament fins que quede un sol dígit.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function digitalRoot(n) {
    // TODO: Implementar la funció
}

// Exemple
console.log(digitalRoot(9875)); // 2  (9+8+7+5 = 29 -> 2+9 = 11 -> 1+1 = 2)
```

---

## Exercici 9: Comprovar si una cadena és palíndrom (ignorant espais i puntuació)

**Enunciat: Donada una cadena $s$, comprova si és palíndrom (es llegeix igual d'esquerra a dreta que de dreta a esquerra), ignorant espais i caràcters no alfanumèrics.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function esPalindrom(s) {
    // TODO: Implementar la funció
}

// Exemples
console.log(esPalindrom("A man, a plan, a canal: Panama")); // true
console.log(esPalindrom("race a car")); // false
```

---

## Exercici 10: Invertir una cadena recursivament

**Enunciat: Donada una cadena $s$, retorna la mateixa cadena però al revés, implementat de forma recursiva.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function invertirRec(s) {
    // TODO: Implementar la funció
}

// Exemple
console.log(invertirRec("abcdef")); // "fedcba"
```

---

## Exercici 11: Comptar particions palíndromes d'una cadena

**Enunciat: Donada una cadena $s$, calcula el nombre de formes diferents de dividir $s$ en substrings que siguen palíndroms.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function countPalindromicPartitions(s) {
    // TODO: Implementar la funció
}

// Exemple
console.log(countPalindromicPartitions("aab")); // 2
```

---

## Exercici 12: Comptar camins en una graella amb obstacles

**Enunciat: Donada una graella $m \times n$ amb obstacles (cel·les bloquejades), calcula el nombre de camins des de la cantonada superior esquerra $(0,0)$ fins a la cantonada inferior dreta $(m-1, n-1)$, movent-te només cap a la dreta o cap avall.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function countPathsWithObstacles(obstacles) {
    // TODO: Implementar la funció
}

// Exemple
const grid1 = [
    [false, false, false],
    [false, true,  false],
    [false, false, false]
];
console.log(countPathsWithObstacles(grid1)); // 2
```

---

## Exercici 13: Longitud de la millor subcadena sense caràcters repetits

**Enunciat: Donada una cadena $s$, troba la longitud de la subcadena més llarga sense caràcters repetits.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function lengthOfLongestUniqueSubstring(s) {
    // TODO: Implementar la funció
}

// Exemples
console.log(lengthOfLongestUniqueSubstring("abcabcbb")); // 3 ("abc")
console.log(lengthOfLongestUniqueSubstring("bbbbb"));    // 1
```

---

## Exercici 14: Generació de totes les seqüències vàlides de parèntesis

**Enunciat: Donat un nombre $n$ de parells, genera totes les seqüències vàlides de parèntesis amb $n$ parells `(` i `)` de manera que sempre estiguen balancejades.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function generateParenthesis(n) {
    // TODO: Implementar la funció
}

// Exemple
console.log(generateParenthesis(3));
// [ "((()))", "(()())", "(())()", "()(())", "()()()" ]
```

---

## Exercici 15: Màxima suma de subseqüència amb elements no adjacents

**Enunciat: Donada una successió de valors enters, troba el màxim sumatori d'una subseqüència no adjacent (no es poden escollir elements contigus).**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function maxNonAdjacentSum(nums) {
    // TODO: Implementar la funció
}

// Exemples
console.log(maxNonAdjacentSum([3, 2, 7, 10]));    // 13 (3 + 10)
console.log(maxNonAdjacentSum([3, 2, 5, 10, 7])); // 15 (3 + 5 + 7)
```

---

## Exercici 16: Cerca binària recursiva

**Enunciat: Implementar una cerca binària recursiva en un vector ordenat de manera ascendent. La funció ha de retornar l'índex de l'element buscat si existeix, o -1 si no és present.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta / explicació de l'alumne]
</p>

```javascript
function binarySearch(arr, target, left = 0, right = arr.length - 1) {
    // TODO: Implementar la funció
}

// Exemples
const v = [1, 3, 4, 6, 8, 10, 12];
console.log(binarySearch(v, 6));  // 3
console.log(binarySearch(v, 7));  // -1
console.log(binarySearch(v, 1));  // 0
console.log(binarySearch(v, 12)); // 6
```
