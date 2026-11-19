
/**
 * Clasifica els numeros de un array por rango.
 *
 * @param {number[]} numeros - Array de numeros
 * @param {number} min - Límite inferior
 * @param {number} max - Límite superior
 * @returns {Object} Objeto clave valor que devuelve
 */
function clasificarPorRango(numeros, min, max) {

    if (!Array.isArray(numeros) || numeros.length === 0) {
        return { enRango: 0 };
    }
    const valoresEnRango = numeros.filter((n) => n > min && n <= max);
    return { enRango: valoresEnRango.length };



}
console.log(clasificarPorRango([1, 5, 7, 9, 2], 2, 7)); //? 