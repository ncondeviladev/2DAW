# Simulacre d'Examen Pràctic: Sistema HelpDeskPro - Mòdul d'Intervencions Tècniques (DWES)

> **Mòdul:** Desenvolupament Web en Entorn Servidor (DWES) · 2n CFGS DAW  
> **Professor:** Eloy Gutiérrez Paredes  
> **Temps estimat:** 1 hora i 30 minuts  
> **Projecte base:** HelpDeskPro (`DWES/Simulacro_Examen/`)  
> **Material permès:** Apunts oficials de les Unitats 2, 3 i 4 (PDFs), projecte base proporcionat, sense internet ni assistents IA.

---

## 1. Context del problema

L'empresa tecnològica disposa d'un sistema intern anomenat **HelpDeskPro** per a gestionar els tiquets d'incidències reportats pels clients.

Actualment, el sistema permet als tècnics autenticar-se, veure el llistat general de tiquets i consultar el detall de cadascun. Tanmateix, la direcció tècnica necessita portar un **control estricte del temps i de les actuacions que cada tècnic realitza sobre cada tiquet**.

El teu objectiu en esta prova és **implementar el mòdul complet d'intervencions tècniques (relació 1:N)**, connectant totes les capes de l'aplicació: Base de Dades $\rightarrow$ Model de Domini $\rightarrow$ DAO $\rightarrow$ Controladors (PRG) $\rightarrow$ Vistes.

---

## 2. Objectius tècnics a avaluar

1. **Persistència i Integritat Referencial (SQL):**  
   Creació de la taula `intervencions` amb claus foranes cap a `tiquets` (`ON DELETE CASCADE`) i cap a `usuaris`.
2. **Modelatge Orientat a Objectes (POO - PHP 8):**  
   Creació de l'entitat `Intervencio` a `src/Model/` amb promoció de propietats al constructor, tipat estricte i mètodes de negoci.
3. **Accés a dades amb PDO (DAO):**  
   Implementació de la interfície `IDbAccess` a `src/DAO/IntervencioDAO.php` amb sentències preparades obligatòries, consultes amb `JOIN` i mapatge d'objectes mitjançant `PDO::FETCH_CLASS`.
4. **Prevenció de consultes N+1:**  
   Ús eficient d'agregacions SQL (`GROUP BY` i `SUM`) per a calcular el temps total dedicat a cada tiquet sense fer una consulta per fila.
5. **Seguretat i Control d'Accés:**  
   - Validació de camps en el servidor (temps positiu, text obligatori).
   - Control d'autorització: només l'autor de la intervenció o un usuari amb rol `administrador` pot eliminar una intervenció existent.
   - Protecció contra XSS mitjançant escapament amb `e()`.
   - Patró PRG (Post-Redirect-Get) amb missatges flash de sessió.

---

## 3. Requisits detallats per capes

### 3.1. Base de dades (`databases/base-de-dades.sql`)

Afegeix al final del fitxer la creació de la taula `intervencions`:

| Camp | Tipus / Restricció | Descripció |
| :--- | :--- | :--- |
| `id` | `INT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | Identificador únic de la intervenció |
| `tiquet_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `tiquets(id)` amb `ON DELETE CASCADE` |
| `usuari_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `usuaris(id)` |
| `minuts` | `INT UNSIGNED NOT NULL` | Temps en minuts dedicat pel tècnic a l'actuació |
| `comentari` | `TEXT NOT NULL` | Descripció detallada de les proves o accions dutes a terme |
| `data_intervencio` | `TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP` | Data i hora de registre de la intervenció |

*Afegeix també 3 registres d'exemple associats als tiquets 1 i 2.*

---

### 3.2. Model de domini (`src/Model/Intervencio.php`)

Crea la classe `Intervencio` dins del namespace `App\Model`:
- Utilitza la **promoció de propietats al constructor** de PHP 8.
- Atributs: `tiquet_id`, `usuari_id`, `minuts`, `comentari`, `id` (opcional, null per defecte), `data_intervencio` (opcional, null per defecte) i `nom_usuari` (opcional, per a emmagatzemar el nom del tècnic després del `JOIN`).
- Implementa *getters* per a tots els atributs.
- Implementa el mètode de negoci:
  - `esSignificativa(): bool` $\rightarrow$ Retorna `true` si els minuts dedicats són iguals o superiors a 60 (`$this->minuts >= 60`).

---

### 3.3. Accés a dades (`src/DAO/IntervencioDAO.php`)

Crea la classe `IntervencioDAO` implementant `IDbAccess`:
1. **`insert(object $entitat): int`**  
   Executa un `INSERT` preparat i retorna l'ID generat (`$pdo->lastInsertId()`).
2. **`findByTiquet(int $tiquetId): array`**  
   Executa una consulta amb `JOIN` cap a la taula `usuaris` per a obtindre `u.usuari AS nom_usuari`.  
   Ordena les intervencions per data descendent (`data_intervencio DESC`).  
   Retorna un array d'objectes `Intervencio` utilitzant `PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE`.
3. **`findById(int $id): ?Intervencio`**  
   Retorna la intervenció per ID o `null`.
4. **`delete(int $id): void`**  
   Elimina la intervenció amb l'identificador indicat.
5. **`calcularTotalMinutsPerTiquet(): array`**  
   Executa una única consulta amb `GROUP BY tiquet_id` que calcule `SUM(minuts) AS total_minuts`.  
   Retorna un array associatiu clau-valor amb format `[tiquet_id => total_minuts]` (utilitzant `PDO::FETCH_KEY_PAIR`).

*Recorda instanciar `$intervencioDAO` a `config/bootstrap.php`.*

---

### 3.4. Controladors de Negoci (Rutes POST amb PRG)

1. **`public/dashboard/afegir_intervencio.php`:**
   - Comprova autenticació (`requereixLogin()`).
   - Valida que `tiquet_id` és un enter vàlid, `minuts` és numèric i $> 0$, i `comentari` no està buit.
   - Crea l'objecte `Intervencio` associat a l'usuari actual (`idUsuariActual()`).
   - Insereix a la base de dades amb `$intervencioDAO->insert()`.
   - Desa un missatge flash d'èxit i redirigeix a `tiquet.php?id=X`.

2. **`public/dashboard/eliminar_intervencio.php`:**
   - Comprova autenticació.
   - Recupera la intervenció amb `findById($id)`.
   - **Autorització:** Comprova que l'usuari actual és l'autor de la intervenció (`usuari_id === idUsuariActual()`) O té rol `administrador` (`esAdmin()`). Si no compleix cap de les dues condicions, respon amb HTTP 403 Forbidden.
   - Si té permís, executa `$intervencioDAO->delete($id)` i redirigeix amb missatge flash a `tiquet.php?id=X`.

---

### 3.5. Integració en Vistes

1. **Detall del tiquet (`public/dashboard/tiquet.php`):**
   - Recupera les intervencions del tiquet actiu amb `$intervencioDAO->findByTiquet($id)`.
   - L'historial ja està maquetat al fitxer; assegura't que es mostren les dades reals, el badge de treball significatiu (`esSignificativa()`) i el botó d'eliminar condicionat als permisos.
2. **Llistat general (`public/dashboard/tiquets.php`):**
   - Recupera els minuts acumulats amb `$intervencioDAO->calcularTotalMinutsPerTiquet()`.
   - Mostra el temps total a la columna *Temps Dedicat* per a cada tiquet.

---

## 4. Comprovació i Execució del Stack

El projecte s'executa amb Docker Compose des de la carpeta `DWES/Simulacro_Examen/`:

```bash
docker compose up -d
```

- **Aplicació web:** `http://localhost:8080/`
- **phpMyAdmin:** `http://localhost:8081/` (servidor `db`, usuari `helpdesk`, contrasenya `password123` o `root`/`root`).
- **Usuaris de prova:**
  - `admin` / `admin123` (rol administrador)
  - `pau` / `tecnic123` (rol tècnic)
  - `marta` / `tecnic123` (rol tècnic)
