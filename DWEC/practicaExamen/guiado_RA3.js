function procesarNotas(listaNotas) {}

const listaNotas = [4.5, 7.2, 9.5, 3.0, 8.0];

if (!listaNotas || listaNotas.length === 0) {
  return {
    aprobados: [],
    media: 0,
    algunExcelente: false,
    todasValidadas: true,
  };
}
const aprobados = listaNotas.filter(nota => nota >= 5).sort((a, b) => a - b);
console.log(aprobados);

const media = listaNotas.reduce((acc, n) => acc + n, 0) / listaNotas.length;
console.log(media);

const algunExcelente = listaNotas.some(n => n > 9);
console.log(algunExcelente);


const todasValidadas = listaNotas.every(n => n < 10 && n > 0);
console.log(todasValidadas);


const objeto = {
    aprobados: aprobados,
    media: media,
    algunExcelente: algunExcelente,
    todasValidadas: todasValidadas
};
console.log(objeto);



