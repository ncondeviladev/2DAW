class Alumno {
  #expediente;
  #notas;
  #nombre;

  constructor(expediente, nombre) {
    this.#expediente = expediente;
    this.#nombre = nombre;
    this.#notas = [];
  }
  getNombre() {
    return this.#nombre;
  }
  getExpediente() {
    return this.#expediente;
  }
  agregarNota(nota) {
    if (nota >= 0 && nota <= 10) {
      this.#notas.push(nota);
    } else {
      throw Error("Nota no valida");
    }
  }
  getNotaMedia() {
    if (!this.#notas || this.#notas.length === 0) {
      throw Error("El array está vacio");
    } else
      return this.#notas.reduce((acc, n) => acc + n, 0) / this.#notas.length;
  }
  resumen() {
    return `Alumno: ${this.getNombre()} (Exp: ${this.getExpediente()} - Media: ${this.getNotaMedia().toFixed(2)} [Notas: ${this.#notas.join(", ")}])`;
  }
}

const alumno = new Alumno(1234, "Noe Conde");
alumno.agregarNota(8);
alumno.agregarNota(7.4);


console.log(alumno.resumen());

