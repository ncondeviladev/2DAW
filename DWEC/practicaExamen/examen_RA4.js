/**
 * EXAMEN REAL — RA4: POO en ES6 con Atributos Privados (#) y Getters/Setters
 * ===========================================================================
 * Enunciado:
 * Define la clase Tarea que gestione tareas en una aplicación:
 *
 * 1. Atributos privados obligatorios (#):
 *    - #id: Identificador numérico único de solo lectura.
 *    - #tiempoEstimadoMinutos: Número entero de minutos estimados.
 *
 * 2. Atributos públicos:
 *    - titulo: Cadena de texto descriptiva.
 *    - completada: Booleano que siempre arranca en false por defecto.
 *
 * 3. Constructor: Recibe (id, titulo, tiempoEstimadoMinutos).
 *
 * 4. Getters y Setters:
 *    - Getter de solo lectura para id (sin setter).
 *    - Getter y Setter para tiempoEstimadoMinutos: El setter debe validar que sea
 *      un número entero mayor a 0; si no es válido, asigna por defecto 30 minutos.
 *
 * 5. Métodos:
 *    - completar(): Cambia completada a true.
 *    - tiempoEnHoras(): Devuelve los minutos convertidos a horas con 2 decimales (ej: 90 -> "1.50").
 *    - resumen(): Devuelve:
 *      "[ID: 1] Tarea: 'Estudiar DWEC' | Estado: PENDIENTE | Tiempo: 1.50 h"
 *      (Si está completada muestra "COMPLETADA").
 */

class Tarea {
  #id;
  #tiempoEstimadoMinutos;

  constructor(id, titulo, tiempoEstimadoMinutos) {
    this.#id = id;
    this.titulo = titulo;
    this.tiempoEstimadoMinutos = tiempoEstimadoMinutos;
    this.completada = false;
  }

  get id() {
    return this.#id;
  }

  get tiempoEstimadoMinutos() {
    return this.#tiempoEstimadoMinutos;
  }

  set tiempoEstimadoMinutos(minutos) {
    if (Number.isInteger(minutos) && minutos > 0) {
      this.#tiempoEstimadoMinutos = minutos;
    } else this.#tiempoEstimadoMinutos = 30;
  }

  completar() {
    this.completada = true;
  }
  tiempoEnHoras() {
    return (this.#tiempoEstimadoMinutos / 60).toFixed(2);
  }
  resumen() {
    return `[ID: ${this.#id}] Tarea: "${this.titulo}" | Estado: ${this.completada ? `"COMPLETADA"` : "PENDIENTE"} | Tiempo: ${this.tiempoEnHoras()} h`;
  }
}

// CASOS DE PRUEBA OFICIALES:
const t1 = new Tarea(1, "Estudiar DWEC", 90); //?
console.log(t1.resumen());
t1.completar();
console.log(t1.resumen());

const t2 = new Tarea(2, "Hacer compra", -5); // Negativo -> debe poner 30 min por defecto
console.log(t2.resumen());
