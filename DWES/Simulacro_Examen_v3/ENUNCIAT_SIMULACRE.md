# Simulacre d'Examen Pràctic: Sistema FitLife Studio - Mòdul d'Abonaments (DWES)

> **Mòdul:** Desenvolupament Web en Entorn Servidor (DWES) · 2n CFGS DAW  
> **Professor:** Eloy Gutiérrez Paredes  
> **Temps estimat:** 1 hora i 30 minuts  
> **Projecte base:** FitLife Studio (`DWES/Simulacro_Examen_v3/`)  
> **Material permès:** Apunts oficials de les Unitats 2, 3 i 4 (PDFs), projecte base proporcionat, sense internet ni IA.

---

## 1. Context del problema

L'estudi de fitness **FitLife Studio** utilitza una aplicació web interna per a gestionar els seus clients i els seus entrenaments.

Al projecte base ja disposes d'un exemple complet i funcional d'entitat filla 1:N:
- Les classes d'entrenament (`classes`): disposes del model `Classe.php`, del DAO `ClasseDAO.php` (amb el seu `JOIN` a instructors i el seu recompte agregat) i del seu controlador `afegir_classe.php`. **Pots usar estos fitxers com a plantilla de referència en tot moment.**

El teu encàrrec en esta prova d'examen és **implementar el mòdul de bons i abonaments (`bons`)**, connectant totes les capes de l'aplicació per a permetre als instructors registrar els abonaments dels clients, controlar si estan actius o caducats i mostrar el nombre de bons en el llistat general.

---

## 2. Objectius tècnics a avaluar

1. **Persistència i Integritat Referencial (SQL):**  
   Creació de la taula `bons` a MySQL amb claus foranes cap a `clients` (`ON DELETE CASCADE`) i cap a `usuaris`.
2. **Modelatge Orientat a Objectes (POO - PHP 8):**  
   Creació de la classe entitat `Bon` a `src/Model/` amb promoció de propietats al constructor i mètode helper de negoci (`estaActiu(): bool`).
3. **Accés a dades amb PDO (DAO):**  
   Implementació de la interfície `IDbAccess` a `src/DAO/BonDAO.php` amb consultes preparades, `JOIN` cap a `usuaris` i mapejat d'objectes mitjançant `PDO::FETCH_CLASS`.
4. **Prevenció de consultes N+1:**  
   Recompte eficient de bons al llistat de clients (`clients.php`) mitjançant `GROUP BY` i `PDO::FETCH_KEY_PAIR`.
5. **Controladors i Seguretat:**  
   - Validació de dades en servidor (`preu` numèric positiu, `tipus_bon` obligatori).
   - Patró PRG (Post-Redirect-Get) amb missatges flash de sessió.
   - Restricció d'autorització: només l'instructor autor o un usuari `administrador` pot eliminar un bon.

---

## 3. Requisits detallats per capes

### 3.1. Base de dades (`databases/base-de-dades.sql`)

Afegeix al final del fitxer la definició de la taula `bons`:

| Camp | Tipus / Restricció | Descripció |
| :--- | :--- | :--- |
| `id` | `INT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | Identificador únic del bo |
| `client_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `clients(id)` amb `ON DELETE CASCADE` |
| `usuari_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `usuaris(id)` (instructor que registra) |
| `tipus_bon` | `VARCHAR(80) NOT NULL` | Tipus d'abonament (p. ex: *Mensual*, *10 sessions*, *Trimestral*) |
| `preu` | `DECIMAL(6,2) NOT NULL` | Import cobrat pel bo (p. ex: 49.99) |
| `data_inici` | `DATE NOT NULL` | Data d'inici de validesa del bo |
| `data_fi` | `DATE NULL` | Data de caducitat (opcional, null = sense caducitat) |
| `data_alta` | `TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP` | Data i hora de registre |

*Afegeix també 3 registres de prova vinculats als clients 1 i 2.*

---

### 3.2. Model de domini (`src/Model/Bon.php`)

Crea la classe `Bon` dins de l'espai de noms `App\Model`:
- Utilitza la **promoció de propietats al constructor** de PHP 8.
- Camps: `client_id`, `usuari_id`, `tipus_bon`, `preu`, `data_inici`, `data_fi` (null per defecte), `id` (null per defecte), `data_alta` (null per defecte) i `nom_instructor` (null per defecte, per al JOIN).
- Implementa els *getters* necessaris.
- Implementa el mètode de negoci:
  - `estaActiu(): bool` → Retorna `true` si `data_fi` és nul·la O si `data_fi >= date('Y-m-d')`.

---

### 3.3. Accés a dades (`src/DAO/BonDAO.php`)

Crea la classe `BonDAO` implementant `IDbAccess` *(mira com a referència [ClasseDAO.php](src/DAO/ClasseDAO.php))*:

1. **`insert(object $entitat): int`**  
   Executa un `INSERT` preparat i retorna l'ID generat (`$pdo->lastInsertId()`).
2. **`findByClient(int $clientId): array`**  
   Executa un `SELECT` amb `JOIN` cap a la taula `usuaris` per a obtindre `u.usuari AS nom_instructor`.  
   Ordena els bons per `data_alta DESC`.  
   Mapeja els resultats a instàncies de `Bon` amb `PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE`.
3. **`findById(int $id): ?Bon`**  
   Retorna el bon indicat o `null`.
4. **`delete(int $id): void`**  
   Elimina el bon per identificador.
5. **`comptarBonsPerClient(): array`**  
   Executa una única consulta amb `GROUP BY client_id` que compta quants bons té cada client (`COUNT(*) AS total`).  
   Retorna l'array associatiu clau-valor amb `PDO::FETCH_KEY_PAIR`.
6. Mètodes buits `findAll(): array` i `update(object $entitat): void` per a complir la interfície.

*Recorda instanciar `$bonDAO` a `config/bootstrap.php`.*

---

### 3.4. Controladors de Negoci (Rutes POST)

1. **`public/dashboard/afegir_bon.php`:**  
   *(Pots basar-te en [afegir_classe.php](public/dashboard/afegir_classe.php))*:
   - Comprova autenticació (`requereixLogin()`).
   - Valida que `client_id` és enter vàlid, `tipus_bon` no és buit i `preu` és numèric >= 0.
   - Valida que `data_inici` no és buida.
   - Crea l'objecte `Bon` associant `idUsuariActual()`.
   - Insereix a la BD, guarda missatge flash `setFlash('exit', '...')` i redirigeix a `client.php?id=X`.

2. **`public/dashboard/eliminar_bon.php`:**
   - Comprova autenticació.
   - Recupera el bon amb `findById($id)`.
   - **Autorització:** Només l'autor del bon (`usuari_id === idUsuariActual()`) O un usuari amb rol `administrador` (`esAdmin()`) pot eliminar-lo. En cas contrari, retorna HTTP 403.
   - Si té permís, executa `delete($id)`, desa missatge flash i redirigeix a `client.php?id=X`.

---

### 3.5. Integració en Vistes

1. **Detall del client (`public/dashboard/client.php`):**  
   - A la línia 23, descomenta:  
     `$bons = $bonDAO->findByClient($id);`

2. **Llistat general (`public/dashboard/clients.php`):**  
   - A la línia 11, descomenta:  
     `$totalsBons = $bonDAO->comptarBonsPerClient();`

---

## 4. Comprovació i Execució

```bash
cd DWES/Simulacro_Examen_v3
docker compose up -d
```

- **Panell FitLife:** http://localhost:8084/
- **phpMyAdmin:** http://localhost:8085/ (usuari `fitlife`, contrasenya `password123`)
- **Usuaris:**
  - `admin` / `admin123` (administrador)
  - `marina` / `vet123` (instructor)
  - `jordi` / `vet123` (instructor)
