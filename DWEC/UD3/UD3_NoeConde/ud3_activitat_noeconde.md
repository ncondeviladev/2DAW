<style>
  @page {
    size: A4;
    margin: 2.2cm 2.4cm;
  }
  body {
    font-family: Calibri, Aptos, "Segoe UI", Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.35;
    color: #000000;
    margin: 0;
    padding: 0;
  }
  /* Título principal y cabecera mínima */
  h1 {
    font-family: Calibri, Aptos, "Segoe UI", Arial, sans-serif;
    color: #2e5b88;
    font-size: 14pt;
    font-weight: bold;
    margin: 0 0 2pt 0;
  }
  .header-meta {
    font-size: 9.5pt;
    color: #595959;
    margin: 0 0 12pt 0;
    padding-bottom: 4pt;
    border-bottom: 0.75pt solid #d9d9d9;
  }
  /* Títulos de sección idénticos al PDF original */
  h2 {
    font-family: Calibri, Aptos, "Segoe UI", Arial, sans-serif;
    color: #2e5b88;
    font-size: 11pt;
    font-weight: bold;
    margin: 10pt 0 3pt 0;
    page-break-after: avoid !important;
    break-after: avoid !important;
  }
  p {
    margin: 0 0 4pt 0;
    orphans: 3;
    widows: 3;
  }
  ul {
    margin: 2pt 0 4pt 0;
    padding-left: 16pt;
  }
  li {
    margin-bottom: 2pt;
  }
  /* Bloque de código: sin cortes entre páginas y sin amarillos */
  pre {
    background-color: #f7f9fa !important;
    border: 1px solid #d0d7de !important;
    border-radius: 3px;
    padding: 8pt 10pt;
    margin: 6pt 0 10pt 0;
    page-break-inside: avoid !important;
    break-inside: avoid !important;
  }
  pre code, code {
    font-family: Consolas, "Courier New", monospace !important;
    font-size: 9pt !important;
    line-height: 1.35;
    color: #24292e !important;
    background: transparent !important;
  }
  /* Anular cualquier resaltado amarillo de extensiones de Markdown a PDF */
  .hljs-string, .token.string, span.hljs-string {
    color: #032f62 !important;
  }
  .hljs-keyword, .token.keyword {
    color: #005cc5 !important;
  }
  .hljs-number, .token.number {
    color: #005cc5 !important;
  }
  .hljs-comment, .token.comment {
    color: #6a737d !important;
    font-style: italic;
  }
  /* Preguntas y respuestas */
  .pregunta {
    margin-top: 8pt;
    margin-bottom: 2pt;
    font-weight: normal;
  }
  .resposta {
    color: #1f4e78;
    font-size: 10.5pt;
    margin: 2pt 0 6pt 12pt;
    line-height: 1.35;
  }
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    body {
      margin: 0;
      padding: 0;
    }
    pre, pre code {
      page-break-inside: avoid !important;
      break-inside: avoid !important;
    }
    h1, h2 {
      page-break-after: avoid !important;
      break-after: avoid !important;
    }
  }
</style>

# UD3 Actividad puntuable

<div class="header-meta">
  <strong>Alumno:</strong> Noé Conde Vila &nbsp;|&nbsp; <strong>Curso:</strong> 2º DAW Semipresencial &nbsp;|&nbsp; <strong>Módulo:</strong> DWEC &nbsp;|&nbsp; <strong>Fecha:</strong> Octubre 2026
</div>

## Enunciado
Desarrolla una función en JavaScript llamada 'analizaNumeros' que reciba un array de números enteros y devuelva un objeto con la siguiente información:
- Un array con los números pares (usando filter).
- Un array con el doble de cada número (usando map).
- La suma total de todos los números (usando reduce).
- Un valor booleano que indique si todos los números son positivos (usando every).

## Objetivos
- Practicar el uso de métodos de arrays en JavaScript.
- Comprender cómo manipular colecciones de datos.
- Aplicar funciones de orden superior para transformar, filtrar y reducir arrays.

## Requisitos técnicos
- La función debe llamarse 'analizaNumeros'.
- Debe recibir un array de números enteros como parámetro.
- Debe devolver un objeto con las propiedades: pares, dobles, sumaTotal, todosPositivos.
- No se permite el uso de bucles tradicionales (for, while).

## Ejemplo de entrada/salida
Entrada:  
[1, 2, 3, 4, 5]  
Salida:  
{ pares: [2, 4], dobles: [2, 4, 6, 8, 10], sumaTotal: 15, todosPositivos: true }

## Implementación en JavaScript (analizaNumeros.js)

```javascript
function analizaNumeros(numeros) {
    return {
        // Filter: obtiene solo los números pares (resto de la división entre 2 igual a 0)
        pares: numeros.filter(n => n % 2 === 0),
        // Map: transforma cada elemento devolviendo el doble de su valor
        dobles: numeros.map(n => n * 2),
        // Reduce: acumula todos los valores sumándolos (0 como valor inicial seguro)
        sumaTotal: numeros.reduce((acc, n) => acc + n, 0),
        // Every: comprueba si todos los números son estrictamente positivos (> 0)
        todosPositivos: numeros.every(n => n > 0)
    };
}

// Pruebas de ejecución
console.log(analizaNumeros([1, 2, 3, 4, 5]));
// Salida: { pares: [2, 4], dobles: [2, 4, 6, 8, 10], sumaTotal: 15, todosPositivos: true }

console.log(analizaNumeros([]));
// Salida: { pares: [], dobles: [], sumaTotal: 0, todosPositivos: true }

console.log(analizaNumeros([-4, -2, 0, 3]));
// Salida: { pares: [-4, -2, 0], dobles: [-8, -4, 0, 6], sumaTotal: -3, todosPositivos: false }

console.log(analizaNumeros([1, "hola", 3]));
// Salida: { pares: [], dobles: [2, NaN, 6], sumaTotal: '1hola3', todosPositivos: false }
```

## Preguntas de verificación de autoría

<p class="pregunta">1. ¿Qué métodos de array has utilizado en tu solución y por qué?</p>
<div class="resposta">
He utilizado funciones nativas como filter, map, reduce y every que manejan arrays sin necesidad de bucles.
</div>

<p class="pregunta">2. ¿Qué diferencia hay entre map y forEach? ¿Por qué elegiste uno sobre el otro?</p>
<div class="resposta">
Porque con map devolvemos un array ya montado con el resultado deseado, en lugar de crear un array manual, hacer un bucle y un push, con map es mas limpio y resumido.
</div>

<p class="pregunta">3. ¿Cómo gestionaría tu función un array vacío? ¿Qué resultado devolvería?</p>
<div class="resposta">
Devuelve todos los resultados vacios, suma total 0 y positivos true, como se muestra en el segundo ejemplo.
</div>

<p class="pregunta">4. ¿Has probado tu función con valores negativos o no numéricos? ¿Qué aprendiste de esas pruebas?</p>
<div class="resposta">
El tercer ejemplo muestra que actua como se espera, los negativos no importan cuando se buscan pares o dobles, y los no numéricos devuelven un error o aviso NaN.
</div>

<p class="pregunta">5. ¿Qué parte del ejercicio te ha resultado más difícil y cómo la resolviste?</p>
<div class="resposta">
Poner el valor inicial de reduce en 0 para evitar el error de array vacio es un detalle que se me pasó al principio.
</div>
