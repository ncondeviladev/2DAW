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
