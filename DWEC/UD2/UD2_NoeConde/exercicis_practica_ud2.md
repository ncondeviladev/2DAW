<style>
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
  }
</style>

# DWEC — Unitat 2: Exercicis de Programació en JavaScript

## Sintaxi Bàsica, Estructures de Control, Bucles i Arrays

| | |
|---|---|
| **Alumne** | Noé Conde Vila |
| **Curs** | 2n DAW (Semipresencial) — IES Maria Enríquez |
| **Assignatura** | DWEC — Desenvolupament Web en Entorn Client |
| **Data** | Setembre 2026 |

---

## Exercici 1: Classificació d'un nombre (`classifyNumber`)

**Enunciat: Donat un nombre $n$, informa si és negatiu, zero o positiu. A més, si és positiu, indica també si és parell o senar. Escriu una funció `classifyNumber(n)` que retorni una cadena amb la classificació.**

```javascript
function classifyNumber(n) {
  if (n < 0) {
    return "Negatiu";
  } else if (n === 0) {
    return "Zero";
  } else {
    if (n % 2 === 0) {
      return "Positiu parell";
    } else {
      return "Positiu senar";
    }
  }
}

// Proves
console.log(classifyNumber(-5));
console.log(classifyNumber(0));
console.log(classifyNumber(4));
console.log(classifyNumber(7));
```

---

## Exercici 2: Assignar temporada segons el mes (`monthToSeason`)

**Enunciat: Donat un número de mes (1-12), mostra la temporada corresponent en l'hemisferi nord: hivern (desembre-febrer), primavera (març-maig), estiu (juny-agost), tardor (setembre-novembre). Implementa una funció `monthToSeason(month)` que retorni la cadena de la temporada. Si el mes no és vàlid, retorna "Mes invàlid".**

```javascript
function monthToSeason(month) {
  if (month > 12 || month < 1) {
    return "Mes invàlid";
  } else if (month == 12 || month <= 2) {
    return "Hivern";
  } else if (month >= 3 && month <= 5) {
    return "Primavera";
  } else if (month >= 6 && month <= 8) {
    return "Estiu";
  } else {
    return "Tardor";
  }
}

// Proves
console.log(monthToSeason(1));
console.log(monthToSeason(4));
console.log(monthToSeason(7));
console.log(monthToSeason(10));
console.log(monthToSeason(15));
```

---

## Exercici 3: Suma dels dígits d'un nombre (`sumaDigits`)

**Enunciat: Escriu una funció `sumaDigits(n)` que, donat un enter $n \ge 0$, retorni la suma dels seus dígits. Cal utilitzar un bucle `while` per processar els dígits.**

```javascript
function sumaDigits(n) {
  let suma = 0;
  while (n > 0) {
    suma += n % 10; // Coge el último dígito
    n = Math.floor(n / 10); // Elimina el último dígito
  }
  return suma;
}

// Proves
console.log(sumaDigits(123));
console.log(sumaDigits(4056));
console.log(sumaDigits(0));
```

---

## Exercici 4: Primers $n$ termes de Fibonacci (`fibonacciN`)

**Enunciat: Escriu una funció `fibonacciN(n)` que retorni un array amb els primers $n$ termes de la successió de Fibonacci, començant per `[0, 1]`. Cal fer servir un bucle `for`. Si $n$ és 0, retorna un array buit `[]`; si $n$ és 1, retorna `[0]`.**

```javascript
function fibonacciN(n) {
  if (n <= 0) return [];
  if (n === 1) return [0];
  let fib = [0, 1];
  for (let i = 2; i < n; i++) {
    fib.push(fib[i - 1] + fib[i - 2]);
  }
  return fib;
}

// Proves
console.log(fibonacciN(0));
console.log(fibonacciN(1));
console.log(fibonacciN(2));
console.log(fibonacciN(5));
console.log(fibonacciN(8));
```
