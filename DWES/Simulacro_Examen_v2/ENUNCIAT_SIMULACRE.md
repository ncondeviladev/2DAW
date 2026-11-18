# Simulacre d'Examen Pràctic: Sistema VetClinic Huellas - Mòdul de Vacunació (DWES)

> **Mòdul:** Desenvolupament Web en Entorn Servidor (DWES) · 2n CFGS DAW  
> **Professor:** Eloy Gutiérrez Paredes  
> **Temps estimat:** 1 hora i 30 minuts  
> **Projecte base:** VetClinic (`DWES/Simulacro_Examen_v2/`)  
> **Material permès:** Apunts oficials de les Unitats 2, 3 i 4 (PDFs), projecte base proporcionat, sense internet ni IA.

---

## 1. Context del problema

La clínica veterinària **VetClinic Huellas** utilitza una aplicació web interna per a gestionar els seus pacients (gossos, gats, aus, etc.).

Al projecte base ja disposes d'un exemple complet i funcional d'entitat filla 1:N:
- Les consultes mèdiques (`visites`): disposes del model `Visita.php`, del DAO `VisitaDAO.php` (amb el seu `JOIN` a veterinaris i el seu recompte agregat) i del seu controlador `afegir_visita.php`. **Pots usar estos fitxers com a plantilla de referència en tot moment.**

El teu encàrrec en esta prova d'examen és **implementar el mòdul de vacunació dels pacients (`vacunes`)**, connectant totes les capes de l'aplicació per a permetre als veterinaris registrar les vacunes administrades, controlar les dates de recordatori i mostrar el nombre de dosis a la cartilla clínica.

---

## 2. Objectius tècnics a avaluar

1. **Persistència i Integritat Referencial (SQL):**  
   Creació de la taula `vacunes` a MySQL amb claus foranes cap a `pacients` (`ON DELETE CASCADE`) i cap a `usuaris`.
2. **Modelatge Orientat a Objectes (POO - PHP 8):**  
   Creació de la classe entitat `Vacuna` a `src/Model/` amb promoció de propietats al constructor i mètode helper de negoci (`requereixRecordatori(): bool`).
3. **Accés a dades amb PDO (DAO):**  
   Implementació de la interfície `IDbAccess` a `src/DAO/VacunaDAO.php` amb consultes preparades, `JOIN` cap a `usuaris` i mapejat d'objectes mitjançant `PDO::FETCH_CLASS`.
4. **Prevenció de consultes N+1:**  
   Recompte eficient de vacunes al llistat de pacients (`pacients.php`) mitjançant `GROUP BY` i `PDO::FETCH_KEY_PAIR`.
5. **Controladors i Seguretat:**  
   - Validació de dades en servidor (`preu` numèric positiu, `nom_vacuna` obligatori).
   - Patró PRG (Post-Redirect-Get) amb missatges flash de sessió.
   - Restricció d'autorització: només el veterinari autor o un usuari `administrador` pot eliminar una vacuna.

---

## 3. Requisits detallats per capes

### 3.1. Base de dades (`databases/base-de-dades.sql`)

Afegeix al final del fitxer la definició de la taula `vacunes`:

| Camp | Tipus / Restricció | Descripció |
| :--- | :--- | :--- |
| `id` | `INT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | Identificador únic de la dosi |
| `pacient_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `pacients(id)` amb `ON DELETE CASCADE` |
| `usuari_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `usuaris(id)` (veterinari que administra) |
| `nom_vacuna` | `VARCHAR(100) NOT NULL` | Nom comercial o tipus (p. ex: *Ràbia*, *Tetravalent*) |
| `preu` | `DECIMAL(6,2) NOT NULL` | Import cobrat per la vacuna (p. ex: 35.50) |
| `proxima_dosi` | `DATE NULL` | Data recomanada de revacunació (opcional) |
| `data_administracio` | `TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP` | Data i hora d'administració |

*Afegeix també 3 registres de prova vinculats als pacients 1 i 2.*

---

### 3.2. Model de domini (`src/Model/Vacuna.php`)

Crea la classe `Vacuna` dins de l'espai de noms `App\Model`:
- Utilitza la **promoció de propietats al constructor** de PHP 8.
- Camps: `pacient_id`, `usuari_id`, `nom_vacuna`, `preu`, `proxima_dosi` (string o null), `id` (opcional, null per defecte), `data_administracio` (opcional, null per defecte) i `nom_veterinari` (opcional, per a guardar el nom després del `JOIN`).
- Implementa els *getters* necessaris.
- Implementa el mètode de negoci:
  - `requereixRecordatori(): bool` $\rightarrow$ Retorna `true` si `proxima_dosi` no és nul·la i la data és igual o anterior a 15 dies vista (`date('Y-m-d', strtotime('+15 days'))`).

---

### 3.3. Accés a dades (`src/DAO/VacunaDAO.php`)

Crea la classe `VacunaDAO` implementant `IDbAccess` *(mira com a referència [VisitaDAO.php](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/Simulacro_Examen_v2/src/DAO/VisitaDAO.php))*:

1. **`insert(object $entitat): int`**  
   Executa un `INSERT` preparat i retorna l'ID generat (`$pdo->lastInsertId()`).
2. **`findByPacient(int $pacientId): array`**  
   Executa un `SELECT` amb `JOIN` cap a la taula `usuaris` per a obtindre `u.usuari AS nom_veterinari`.  
   Ordena les vacunes per `data_administracio DESC`.  
   Mapeja els resultats a instàncies de `Vacuna` amb `PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE`.
3. **`findById(int $id): ?Vacuna`**  
   Retorna la vacuna indicada o `null`.
4. **`delete(int $id): void`**  
   Elimina la vacuna per identificador.
5. **`comptarVacunesPerPacient(): array`**  
   Executa una única consulta amb `GROUP BY pacient_id` que compta quantes vacunes té cada pacient (`COUNT(*) AS total`).  
   Retorna l'array associatiu clau-valor amb `PDO::FETCH_KEY_PAIR`.
6. Mètodes buits `findAll(): array` i `update(object $entitat): void` per a complir la interfície.

*Recorda instanciar `$vacunaDAO` a `config/bootstrap.php`.*

---

### 3.4. Controladors de Negoci (Rutes POST)

1. **`public/dashboard/afegir_vacuna.php`:**
   *(Pots basar-te en [afegir_visita.php](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/Simulacro_Examen_v2/public/dashboard/afegir_visita.php))*:
   - Comprova autenticació (`requereixLogin()`).
   - Valida que `pacient_id` és enter vàlid, `nom_vacuna` no és buit i `preu` és numèric $\ge 0$.
   - Crea l'objecte `Vacuna` associant `idUsuariActual()`.
   - Insereix a la BD, guarda missatge flash `setFlash('exit', '...')` i redirigeix a `pacient.php?id=X`.

2. **`public/dashboard/eliminar_vacuna.php`:**
   - Comprova autenticació.
   - Recupera la vacuna amb `findById($id)`.
   - **Autorització:** Només l'autor de la vacuna (`usuari_id === idUsuariActual()`) O un usuari amb rol `administrador` (`esAdmin()`) pot eliminar-la. En cas contrari, retorna HTTP 403 Forbidden.
   - Si té permís, executa `delete($id)`, desa missatge flash i redirigeix a `pacient.php?id=X`.

---

### 3.5. Integració en Vistes

1. **Detall del pacient (`public/dashboard/pacient.php`):**
   - A la línia 23, recupera les vacunes amb:  
     `$vacunes = $vacunaDAO->findByPacient($id);`
   - La plantilla HTML ja té tot el disseny preparat per a pintar la cartilla i el formulari.
2. **Llistat general (`public/dashboard/pacients.php`):**
   - A la línia 11, recupera el total de vacunes amb:  
     `$totalsVacunes = $vacunaDAO->comptarVacunesPerPacient();`

---

## 4. Comprovació i Execució

El stack de VetClinic s'executa a la carpeta `DWES/Simulacro_Examen_v2/`:

```bash
docker compose up -d
```

- **Panell Clínic:** [http://localhost:8082/](http://localhost:8082/)
- **phpMyAdmin:** [http://localhost:8083/](http://localhost:8083/) (usuari `vetclinic`, contrasenya `password123`)
- **Usuaris:**
  - `admin` / `admin123` (administrador)
  - `laura` / `vet123` (veterinari)
  - `sergi` / `vet123` (veterinari)
