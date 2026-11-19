
const datos = [1, 2, 3, 4, 5];


const resultado = datos.reduce((acc, n) => {
    if (n % 2 == 0) {
        acc.sumaPares += n;
    } else {
        acc.sumaImpares += n;
    }
    acc.total += n;
    return acc;
}, { sumaPares: 0, sumaImpares: 0, total: 0 },
);

console.log(resultado); //?



