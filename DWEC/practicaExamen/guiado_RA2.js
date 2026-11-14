const cadena =
  " usuario:noe conde;fecha_nacimiento:1991-12-21;gasto_total:145.894 ";

function procesarRegistro(cadena) {}

const partes = cadena.trim().split(";");
console.log(partes);

const nombre = partes[0].split(":");
console.log(nombre);
const fecha = partes[1].split(":");
console.log(fecha);;
const gasto = partes[2].split(":");
console.log(gasto);

const nombreFinal= nombre[1].toUpperCase();
console.log(nombreFinal);

const fechaNac = new Date(fecha[1]);
const fechaHoy = new Date();

const anyos = fechaHoy.getFullYear() - fechaNac.getFullYear();
console.log(anyos);

const gastoFinal = Number(gasto[1]).toFixed(2).toString() + " €";
console.log(gastoFinal);

const objeto = {nombre: nombreFinal, edad: anyos, gastoFormateado: gastoFinal};


console.log(objeto);

