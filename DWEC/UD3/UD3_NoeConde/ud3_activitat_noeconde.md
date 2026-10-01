<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.5;
    color: #24292f;
  }
  /* Evitar líneas huérfanas o viudas en párrafos */
  p {
    orphans: 3;
    widows: 3;
  }
  /* Bloques de código completos sin partirse entre páginas */
  pre, pre code {
    page-break-inside: avoid;
    break-inside: avoid;
  }
  /* Tablas íntegras */
  table {
    page-break-inside: avoid;
    break-inside: avoid;
  }
  /* Títulos: nunca al final de una página sin contenido debajo */
  h1, h2, h3, h4 {
    page-break-after: avoid;
    break-after: avoid;
  }
  /* Reglas de impresión / exportación a PDF */
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    pre, pre code, table, blockquote {
      page-break-inside: avoid;
      break-inside: avoid;
    }
    h1, h2, h3, h4 {
      page-break-after: avoid;
      break-after: avoid;
    }
  }
</style>

# DWEC — Unitat 3: Activitat Puntuable

## Manipulació d'Arrays amb Funcions d'Ordre Superior (`analizaNumeros`)

|                 |                                              |
| --------------- | -------------------------------------------- |
| **Alumne**      | Noé Conde Vila                               |
| **Curs**        | 2n DAW (Semipresencial) — IES Maria Enríquez |
| **Assignatura** | DWEC — Desenvolupament Web en Entorn Client  |
| **Data**        | Octubre 2026                                 |

---

## 1. Enunciat de l'Activitat

**Desarrolla una función en JavaScript llamada `analizaNumeros` que reciba un array de números enteros y devuelva un objeto con la siguiente información:**

- **Un array con los números pares (usando `filter`).**
- **Un array con el doble de cada número (usando `map`).**
- **La suma total de todos los números (usando `reduce`).**
- **Un valor booleano que indique si todos los números son positivos (usando `every`).**

### **Objetivos:**
- Practicar el uso de métodos de arrays en JavaScript.
- Comprender cómo manipular colecciones de datos.
- Aplicar funciones de orden superior para transformar, filtrar y reducir arrays.

### **Requisitos técnicos:**
- La función debe llamarse `analizaNumeros`.
- Debe recibir un array de números enteros como parámetro.
- Debe devolver un objeto con las propiedades: `pares`, `dobles`, `sumaTotal`, `todosPositivos`.
- **No se permite el uso de bucles tradicionales (`for`, `while`).**

### **Ejemplo de entrada/salida:**
- **Entrada:** `[1, 2, 3, 4, 5]`
- **Salida:** `{ pares: [2, 4], dobles: [2, 4, 6, 8, 10], sumaTotal: 15, todosPositivos: true }`

---

## 2. Implementació en JavaScript (`analizaNumeros.js`)

```javascript
function analizaNumeros(numeros) {
    return {
        // Filter: obté només els números parells (residu de la divisió per 2 igual a 0)
        pares: numeros.filter(n => n % 2 === 0),
        // Map: transforma cada element retornant el doble del seu valor
        dobles: numeros.map(n => n * 2),
        // Reduce: acumula tots els valors sumant-los (0 com a valor inicial segur)
        sumaTotal: numeros.reduce((acc, n) => acc + n, 0),
        // Every: comprova si tots els números són estrictament positius (> 0)
        todosPositivos: numeros.every(n => n > 0)
    };
}



```

---

## 3. Preguntes de Verificació d'Autoria

**1. ¿Qué métodos de array has utilizado en tu solución y por qué?**

<p>
He gastat diversos mètodes, filter, map, reduce, every, sobre el array de numeros per a retornar les dades del array mitjançant les condicions.

</p>

---

**2. ¿Qué diferencia hay entre `map` y `forEach`? ¿Por qué elegiste uno sobre el otro?**

<p>
<!-- Escriu ací la teua resposta a la pregunta 2 -->

</p>

---

**3. ¿Cómo gestionaría tu función un array vacío? ¿Qué resultado devolvería?**

<p>
<!-- Escriu ací la teua resposta a la pregunta 3 -->

</p>

---

**4. ¿Has probado tu función con valores negativos o no numéricos? ¿Qué aprendiste de esas pruebas?**

<p>
<!-- Escriu ací la teua resposta a la pregunta 4 -->

</p>

---

**5. ¿Qué parte del ejercicio te ha resultado más difícil y cómo la resolviste?**

<p>
<!-- Escriu ací la teua resposta a la pregunta 5 -->

</p>
