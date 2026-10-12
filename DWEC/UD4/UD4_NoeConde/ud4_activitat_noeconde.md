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
  /* Título principal y cabecera */
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
  /* Títulos de sección idénticos al PDF oficial */
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
  /* Bloque de código: sin cortes entre páginas */
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
  /* Anular cualquier resaltado amarillo indeseado */
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
  /* Preguntas (negro y negrita) y respuestas (azul diferenciado) */
  .pregunta {
    margin-top: 10pt;
    margin-bottom: 3pt;
    font-weight: bold !important;
    color: #000000 !important;
    page-break-after: avoid !important;
    break-after: avoid !important;
  }
  .resposta, .resposta * {
    color: #0b5394 !important;
    font-size: 10.5pt;
    line-height: 1.4;
  }
  .resposta {
    margin: 2pt 0 8pt 12pt;
    page-break-before: avoid !important;
    break-before: avoid !important;
  }
  .item-pregunta {
    page-break-inside: avoid !important;
    break-inside: avoid !important;
    margin-bottom: 8pt;
  }
  .salto-pagina {
    page-break-before: always !important;
    break-before: page !important;
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
    .item-pregunta {
      page-break-inside: avoid !important;
      break-inside: avoid !important;
    }
    .salto-pagina {
      page-break-before: always !important;
      break-before: page !important;
    }
  }
</style>

# UD4 Actividad puntuable

<div class="header-meta">
  <strong>Alumno:</strong> Noé Conde Vila &nbsp;|&nbsp; <strong>Curso:</strong> 2º DAW Semipresencial &nbsp;|&nbsp; <strong>Módulo:</strong> DWEC &nbsp;|&nbsp; <strong>Fecha:</strong> Octubre 2026
</div>

## Enunciado del ejercicio
Desarrolla una clase en JavaScript llamada `Libro` que represente un libro con las siguientes características:
- **Atributos:**
  - `titulo` (string)
  - `autor` (string)
  - `paginas` (número)
  - `leido` (booleano)
- **Métodos:**
  - `marcarComoLeido()` → cambia el estado de `leido` a `true`.
  - `resumen()` → devuelve un string con el resumen del libro en el siguiente formato:  
    `"El libro 'titulo' de autor tiene paginas páginas. ¿Leído?: Sí/No"`

## Objetivos
- Practicar la creación de clases y objetos en JavaScript.
- Aplicar conceptos de atributos, métodos y encapsulación.
- Comprender cómo representar entidades del mundo real mediante programación orientada a objetos.

## Requisitos técnicos
- La clase debe llamarse `Libro`.
- Debe tener un constructor que inicialice todos los atributos.
- Debe implementar los métodos `marcarComoLeido()` y `resumen()`.
- Se debe demostrar el uso creando un objeto y mostrando el resumen antes y después de marcarlo como leído.
- Se debe documentar el código realizado.

## Ejemplo de entrada/salida
```javascript
const miLibro = new Libro("1984", "George Orwell", 328, false);
document.write(miLibro.resumen()); // El libro '1984' de George Orwell tiene 328 páginas. ¿Leído?: No
miLibro.marcarComoLeido();
document.write(miLibro.resumen()); // El libro '1984' de George Orwell tiene 328 páginas. ¿Leído?: Sí
```

<div class="salto-pagina"></div>

## Implementación en JavaScript (Libro.js)

```javascript
class Libro {
  /**
   *
   * @param {string} titulo
   * @param {string} autor
   * @param {number} paginas
   * @param {boolean} leido
   */
  constructor(titulo, autor, paginas, leido) {
    this.titulo = titulo;
    this.autor = autor;
    this.paginas = paginas;
    this.leido = leido;
  }

  marcarComoLeido() {
    this.leido = true;
  }
  resumen() {
    const estadoLeido = this.leido ? "Sí" : "No";
    return `El libro '${this.titulo}' de ${this.autor} tiene ${this.paginas} páginas. ¿Leído?: ${estadoLeido}`;
  }
}

// 1. Caso de prueba oficial del enunciado
const miLibro = new Libro("1984", "George Orwell", 328, false);
console.log(miLibro.resumen());
// Salida: El libro '1984' de George Orwell tiene 328 páginas. ¿Leído?: No
miLibro.marcarComoLeido();
console.log(miLibro.resumen());
// Salida: El libro '1984' de George Orwell tiene 328 páginas. ¿Leído?: Sí
// 2. Libros adicionales de prueba
const libro1 = new Libro("Cien años de soledad", "Gabriel García Márquez", 417, false);
const libro2 = new Libro("El principito", "Antoine de Saint-Exupéry", 96, true);
console.log(libro1.resumen());
libro1.marcarComoLeido();
console.log(libro1.resumen());
console.log(libro2.resumen());

```

<div class="salto-pagina"></div>

## Preguntas de verificación de autoría

<div class="item-pregunta">
  <p class="pregunta">1. ¿Qué ventajas ofrece el uso de clases frente a funciones sueltas en este ejercicio?</p>
  <div class="resposta">
  - Es la base de POO, programación orientada a objetos, que permite crear entidades con atributos y funciones propias con herencia y polimorfismo.
  </div>
</div>

<div class="item-pregunta">
  <p class="pregunta">2. ¿Cómo se relaciona este ejercicio con el concepto de encapsulación?</p>
  <div class="resposta">
  - Como objeto o clase, nos permite agrupar los atributos y los métodos o funciones que los gestionan, como cambiar el estado de leído con la funcion 'marcarComoLeido' de sí mismo, sin necesidad de acceder a los atributos de manera directa.
  </div>
</div>

<div class="item-pregunta">
  <p class="pregunta">3. ¿Qué ocurriría si no se inicializa el atributo <code>leido</code> en el constructor?</p>
  <div class="resposta">
  - Que el atributo quedaria como 'undefined', y al ejecutar cualquier método propio que lo utilice lo evaluaría con el ternario como false, seria booleano pero podría provocar fallos con comprobaciones estrictas.
  </div>
</div>

<div class="item-pregunta">
  <p class="pregunta">4. ¿Cómo podrías extender esta clase para incluir una calificación del libro?</p>
  <div class="resposta">
  - De la misma forma que con 'leído', podríamos añadir un atributo como 'calificacion = null' y un método que compruebe la nota dentro de un rango como de 0 a 10 y actualizariamos 'resumen()' para que lo muestre.
  </div>
</div>

<div class="item-pregunta">
  <p class="pregunta">5. ¿Qué parte del ejercicio te ha resultado más desafiante y cómo la resolviste?</p>
  <div class="resposta">
  - No ha sido particularmente difícil, solo la sintaxis de js cuesta un poco de entender más aún cuando se mezcla con tantos otros lenguajes de otras asignaturas.
  </div>
</div>
