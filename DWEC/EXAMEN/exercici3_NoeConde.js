/**
 * Clase Billetera con métodos de ingreso, retiro y transferencia. 
 * 
 * @param {string|number} id 
 * @param {number} saldoInicialdefecto 
 * @param {number} limiteDiario 
 */

class Billetera {
    #id;
    #saldoInicial = 0;
    #limiteDiario = 500;

    constructor(id, saldoInicial, limiteDiario) {
        this.#id = id;
        this.#saldoInicial = saldoInicial;
        this.#limiteDiario = limiteDiario;
        this.acumuladoRetirado = 0;
    }
/**
 * Método para depositar dinero en la cuenta.
 * @param {*} m Monto a depositar 
 */
    depositar(m) {
        if (typeof m !== "number" || m <= 0) {
            throw new Error("El ingreso debe ser positivo.");
        }
        this.saldo += m;
    };

    /**
     * Método para retirar dinero de la cuenta
     * @param {} m Monto a retirar 
     */
    retirar(m) {
        if (typeof m !== "number" || m <= 0) {
            throw new Error("EL valor debe ser positivo.");
        }
        if (m > this.saldo) {
            throw new Error("No hay fondos que retirar.");
        }
        if (this.acumuladoRetirado + m > this.limiteDiario) {
            throw new Error("Has superado el limite diario de retiro.");
        }
        this.saldo -= m;
        this.acumuladoRetirado += m;
    };
/**
 * Método para transferir dinero de la cuenta a otra de destino
 * @param {*} m  Monto a transferir
 * @param {*} destino Destino de la transferencia 
 */
    transferir(m, destino) {
        if (!(destino instanceof Billetera)) {
            throw new Error("Error en instancia Billetera");
        }

        this.retirar(m);

        destino.depositar(m);
    };


    getId() {
        return this.#id;
    }
    getSaldo() {
        return this.#saldoInicial;
    }
    getLimiteDiario() {
        return this.#limiteDiario;
    }

}

const ana = new Billetera("Ana", 300, 300);
const luis = new Billetera("Luis", 50, 300);

ana.transferir(120, luis); //?
console.log(`Saldos: Ana = ${ana.getSaldo()} / Luis = ${luis.getSaldo()}`); //?
try {
    luis.transferir(400, ana);
} catch (e) {
    console.log("Error:", e.message); //?
}
console.log(`Saldos finales: Ana = ${ana.getSaldo()} / Luis = ${luis.getSaldo()}`); //?















