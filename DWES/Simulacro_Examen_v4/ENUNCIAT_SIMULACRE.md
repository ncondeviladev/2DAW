# Simulacre d'Examen Pràctic: AutoTaller MotorPlus - Mòdul de Recanvis (DWES)

> **Mòdul:** Desenvolupament Web en Entorn Servidor (DWES) · 2n CFGS DAW  
> **Professor:** Eloy Gutiérrez Paredes  
> **Temps recomanat:** 45 - 60 minuts (Sprint final abans de l'examen de les 18:00)  
> **Projecte base:** AutoTaller MotorPlus (`DWES/Simulacro_Examen_v4/`)  

---

## 1. Context del problema

El taller mecànic **AutoTaller MotorPlus** gestiona els vehicles que entren a reparació i la mà d'obra dels mecànics.

Al projecte base ja disposes de l'exemple de referència complet d'entitat 1:N:
- Les reparacions de mà d'obra (`reparacions`): disposes del model `Reparacio.php`, del DAO `ReparacioDAO.php` (amb el seu `JOIN` a mecànics i recompte agregat) i del seu controlador `afegir_reparacio.php`. **Usa'ls de plantilla en tot moment.**

El teu repte és **implementar el mòdul de peces i recanvis facturats (`recanvis`)**, connectant totes les capes de l'aplicació.

---

## 2. Requisits tècnics per capes

### 2.1. Base de dades (`databases/base-de-dades.sql`)

Afegeix al final del fitxer la definició de la taula `recanvis`:

| Camp | Tipus / Restricció | Descripció |
| :--- | :--- | :--- |
| `id` | `INT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | Identificador únic de la peça |
| `vehicle_id` | `INT UNSIGNED NOT NULL` | FK cap a `vehicles(id)` amb `ON DELETE CASCADE` |
| `usuari_id` | `INT UNSIGNED NOT NULL` | FK cap a `usuaris(id)` (mecànic que l'instal·la) |
| `nom_peca` | `VARCHAR(100) NOT NULL` | Nom o referència de la peça |
| `preu_unitari` | `DECIMAL(6,2) NOT NULL` | Import unitari en euros |
| `quantitat` | `INT UNSIGNED NOT NULL DEFAULT 1` | Unitats utilitzades |
| `data_alta` | `TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP` | Data d'instal·lació |

*Afegeix també 3 registres de prova vinculats als vehicles 1 i 2.*

---

### 2.2. Model de domini (`src/Model/Recanvi.php`)

Crea la classe `Recanvi` dins de `App\Model`:
- Constructor promotion de PHP 8:
  - `vehicle_id`, `usuari_id`, `nom_peca`, `preu_unitari`, `quantitat`, `id` (null per defecte), `data_alta` (null per defecte) i `nom_mecanic` (null per defecte, per al JOIN).
- Getters corresponents.
- Mètodes de negoci auxiliars:
  - `getImportTotal(): float` $\rightarrow$ Retorna el preu unitari multiplicat per la quantitat (`round($this->preu_unitari * $this->quantitat, 2)`).
  - `enGarantia(): bool` $\rightarrow$ Retorna `true` si la data d'alta té menys de 2 anys d'antiguitat respecte a la data actual (o simplement `true` si no s'especifica data).

---

### 2.3. Accés a dades (`src/DAO/RecanviDAO.php`)

Crea la classe `RecanviDAO` implementant `IDbAccess` *(prenent com a mirall [ReparacioDAO.php](src/DAO/ReparacioDAO.php))*:
1. **`insert(object $entitat): int`** $\rightarrow$ Insereix a `recanvis` i retorna `$pdo->lastInsertId()`.
2. **`findByVehicle(int $vehicleId): array`** $\rightarrow$ `SELECT r.*, u.usuari AS nom_mecanic FROM recanvis r JOIN usuaris u ON r.usuari_id = u.id WHERE r.vehicle_id = :vehicle_id ORDER BY r.data_alta DESC`. Utilitzant `self::MODE, Recanvi::class`.
3. **`findById(int $id): ?Recanvi`** $\rightarrow$ Retorna el recanvi o null.
4. **`delete(int $id): void`** $\rightarrow$ Elimina el recanvi per ID.
5. **`comptarRecanvisPerVehicle(): array`** $\rightarrow$ `GROUP BY vehicle_id` amb `PDO::FETCH_KEY_PAIR`.
6. Mètodes buits `findAll()` i `update()`.

*Registra `$recanviDAO` a `config/bootstrap.php`.*

---

### 2.4. Controladors de Negoci

1. **`public/dashboard/afegir_recanvi.php`:**
   - Comprova `requereixLogin()`.
   - Valida dades (`vehicle_id` enter, `nom_peca` no buit, `preu_unitari` > 0, `quantitat` > 0).
   - Crea instància `Recanvi` amb **named arguments** associant `usuari_id: idUsuariActual()`.
   - Insereix a la BD amb guard `if (empty($errors))`, desa flash 'exit' i redirigeix a `vehicle.php?id=X`.

2. **`public/dashboard/eliminar_recanvi.php`:**
   - Comprova autenticació.
   - Recupera el recanvi amb `findById($id)`.
   - Autorització: `if ($recanvi->getUsuariId() !== idUsuariActual() && !esAdmin()) { http_response_code(403); exit; }`.
   - Executa `delete($id)`, desa flash i redirigeix a `vehicle.php?id=` amb l'ID del vehicle.

---

### 2.5. Integració en Vistes

1. **`public/dashboard/vehicle.php` (Línia 24):** Descomenta la línia per a obtindre `$recanvis` i elimina la línia següent que la buida.
2. **`public/dashboard/vehicles.php` (Línia 12):** Descomenta la línia de `$totalsRecanvis`.

---

## 3. Accés i Credencials

- **Web:** [http://localhost:8086](http://localhost:8086)
- **phpMyAdmin:** [http://localhost:8087](http://localhost:8087) (usuari `autotaller`, contrasenya `password123`)
- **Usuaris:**
  - `admin` / `admin123` (administrador)
  - `pep` / `mecanic123` (mecànic)
  - `voro` / `mecanic123` (mecanic)
