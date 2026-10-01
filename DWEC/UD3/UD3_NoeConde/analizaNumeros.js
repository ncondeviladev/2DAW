/*
* @param {number[]} numeros
* @returns {Object}
**/

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


// Cas 1: Exemple oficial de l'enunciat
const entradaExemple = [1, 2, 3, 4, 5];
console.log("Cas 1 (Exemple enunciat):");
console.log(analizaNumeros(entradaExemple));
// Eixida esperada:
// { pares: [2, 4], dobles: [2, 4, 6, 8, 10], sumaTotal: 15, todosPositivos: true }

// Cas 2: Prova amb números negatius i zero
const entradaAmbNegatius = [-4, -1, 0, 3, 6];
console.log("\nCas 2 (Amb negatius i zero):");
console.log(analizaNumeros(entradaAmbNegatius));
// Eixida esperada:
// { pares: [-4, 0, 6], dobles: [-8, -2, 0, 6, 12], sumaTotal: 4, todosPositivos: false }

// Cas 3: Prova amb un array buit (límit)
const entradaBuida = [];
console.log("\nCas 3 (Array buit):");
console.log(analizaNumeros(entradaBuida));
// Eixida esperada:
// { pares: [], dobles: [], sumaTotal: 0, todosPositivos: true }
