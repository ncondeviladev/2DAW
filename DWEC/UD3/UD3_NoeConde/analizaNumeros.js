/*
* @param {number[]} numeros
* @returns {Object}
**/

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


// Caso 1: Ejemplo oficial del enunciado
const entradaEjemplo = [1, 2, 3, 4, 5];
console.log("Caso 1 (Ejemplo enunciado):");
console.log(analizaNumeros(entradaEjemplo));
// Salida esperada:
// { pares: [2, 4], dobles: [2, 4, 6, 8, 10], sumaTotal: 15, todosPositivos: true }

// Caso 2: Prueba con números negativos y cero
const entradaConNegativos = [-4, -1, 0, 3, 6];
console.log("\nCaso 2 (Con negativos y cero):");
console.log(analizaNumeros(entradaConNegativos));
// Salida esperada:
// { pares: [-4, 0, 6], dobles: [-8, -2, 0, 6, 12], sumaTotal: 4, todosPositivos: false }

// Caso 3: Prueba con un array vacío (límite)
const entradaVacia = [];
console.log("\nCaso 3 (Array vacío):");
console.log(analizaNumeros(entradaVacia));
// Salida esperada:
// { pares: [], dobles: [], sumaTotal: 0, todosPositivos: true }

// Caso 4: Prueba con valores no numéricos
console.log("\nCaso 4 (Con no numéricos):");
console.log(analizaNumeros([1, "hola", 3]));
// Salida esperada:
// { pares: [], dobles: [2, NaN, 6], sumaTotal: '1hola3', todosPositivos: false }
