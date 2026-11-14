/**
 * EXAMEN REAL — RA2: Cadenas (String), Math y Fechas (Date)
 * =========================================================
 * Enunciado:
 * Crea una función llamada analizarMatricula(texto) que reciba una cadena
 * con matrículas de alumnos desordenadas separadas por barras inclinadas '/':
 *
 * "  2daw-2026/014-noe conde vila/2026-11-20  "
 *
 * La función debe devolver un objeto con los siguientes campos:
 * 1. curso: La primera parte en mayúsculas ("2DAW").
 * 2. expediente: Número de expediente con exactamente 5 dígitos rellenado con ceros a la izquierda ("00014").
 * 3. nombreAlumno: Capitalizado (primera letra de cada palabra en mayúscula: "Noe Conde Vila").
 * 4. diasParaFecha: Número de días enteros que faltan desde la fecha de hoy hasta la fecha indicada ("2026-11-20").
 *    Si la fecha ya ha pasado, debe devolver 0.
 *
 * Salida esperada:
 * {
 *   curso: '2DAW',
 *   expediente: '00014',
 *   nombreAlumno: 'Noe Conde Vila',
 *   diasParaFecha: 6
 * }
 */

const entradaPrueba = "  2daw-2026/014-noe conde vila/2026-11-20  ";

function analizarMatricula(texto) {
  const cadena = texto.trim().split("/"); //?
  const curso = cadena[0].split("-")[0].toUpperCase(); //?
  const expediente = cadena[1].split("-")[0].padStart(5, 0);
  const nombreAlumno = cadena[1]
    .split("-")[1]
    .split(" ")
    .map((p) => p.charAt(0).toUpperCase() + p.slice(1).toLowerCase())
    .join(" "); //?
  const fecha = new Date(cadena[2]); //?
  const fechaHoy = new Date(); //?
  const diasParaFecha = Math.floor((Math.abs(fecha - fechaHoy) / (1000 * 60 * 60 * 24))); //?
  return {
    curso: curso,
    expediente: expediente,
    nombreAlumno: nombreAlumno,
    nombreAlumno: nombreAlumno,
    diasParaFecha: diasParaFecha,
  }
}

console.log(analizarMatricula(entradaPrueba));
