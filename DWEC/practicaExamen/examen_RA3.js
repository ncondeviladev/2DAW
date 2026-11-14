/**
 * EXAMEN REAL — RA3: Arrays y Programación Funcional (filter, map, reduce, sort)
 * ==============================================================================
 * Enunciado:
 * Desarrolla una función llamada analizarInventario(articulos) que reciba un array
 * de objetos como el siguiente:
 * 
 * [
 *   { ref: "A1", categoria: "hardware", precio: 120, unidades: 5 },
 *   { ref: "B2", categoria: "software", precio: 60, unidades: 0 },
 *   { ref: "C3", categoria: "hardware", precio: 15, unidades: 20 },
 *   { ref: "D4", categoria: "periferico", precio: 35, unidades: 8 }
 * ]
 * 
 * La función debe devolver un objeto con:
 * 1. disponibles: Array de referencias (ref) que tienen al menos 1 unidad (unidades > 0),
 *    ordenadas alfabéticamente. -> ["A1", "C3", "D4"]
 * 2. valorTotalStock: Suma económica de todos los artículos (precio * unidades) con 2 decimales. -> 1180
 * 3. articulosHardwareCaros: Array de artículos de categoría "hardware" con precio > 50.
 * 4. todoConStock: Booleano que verifique si absolutamente TODOS los artículos tienen unidades > 0. -> false
 * 
 * Controla también que si la entrada es nula o vacía no rompa el programa.
 */

const inventarioPrueba = [
  { ref: "A1", categoria: "hardware", precio: 120, unidades: 5 },
  { ref: "B2", categoria: "software", precio: 60, unidades: 0 },
  { ref: "C3", categoria: "hardware", precio: 15, unidades: 20 },
  { ref: "D4", categoria: "periferico", precio: 35, unidades: 8 }
];

function analizarInventario(articulos) {
    // Escribe aquí tu código:
    
}

console.log(analizarInventario(inventarioPrueba));
