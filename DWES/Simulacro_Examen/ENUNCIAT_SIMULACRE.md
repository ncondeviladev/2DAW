# Simulacre d'Examen Pràctic: Mòdul de Tasques de Seguiment Comercial (DWES)

> **Mòdul:** Desenvolupament Web en Entorn Servidor (DWES) · 2n CFGS DAW  
> **Professor:** Eloy Gutiérrez Paredes  
> **Temps estimat:** 1 hora i 30 minuts  
> **Projecte base:** TechLeads (`Simulacro_Examen`)  
> **Material permès:** Apunts de les Unitats 2, 3 i 4 (PDFs), projecte base proporcionat, sense internet ni IA.

---

## 1. Context del problema

L'equip de direcció de TechLeads ha detectat que les notes de text lliure no són suficients per a garantir el seguiment dels clients potencials. Els comercials necessiten poder planificar accions futures amb una data límit (per exemple: *«Enviar pressupost detallat»*, *«Telefonar per resoldre dubtes tècnics»*, *«Agendar reunió presencial»*).

El teu encàrrec en esta prova d'examen és **implementar el mòdul de tasques pendents per a cada lead**, permetent afegir noves tasques, consultar-les al panell de detall, marcar-les com a completades (acció `UPDATE`) i conèixer quantes tasques pendents té cada lead des del llistat general.

---

## 2. Objectius tècnics a avaluar

En esta prova s'avaluarà:
1. **Modelatge i persistència:** Creació de la taula `tasques` a MySQL amb claus foranes i integritat referencial (`ON DELETE CASCADE`).
2. **Arquitectura d'aplicació (POO):** Creació de la classe entitat `Tasca` a `src/Model/` i la classe d'accés a dades `TascaDAO` a `src/DAO/` seguint les convencions del projecte.
3. **Sentències preparades PDO:** Ús estricte de consultes preparades per a operacions `INSERT`, `SELECT` (amb `JOIN`) i `UPDATE`.
4. **Control de negoci i permisos:** 
   - Validació de dades d'entrada (descripció obligatòria, data límit vàlida).
   - Canvi d'estat: un botó ràpid per a marcar una tasca com a completada (`completada = 1`).
   - Restricció de permisos: només l'autor de la tasca o un usuari amb rol `administrador` pot canviar l'estat d'una tasca.
5. **Prevenció de consultes N+1:** Recompte eficient de tasques pendents al llistat de leads (`leads.php`) mitjançant `GROUP BY` i `PDO::FETCH_KEY_PAIR`.
6. **Seguretat XSS:** Escapament de tota dada provinent de l'usuari a les vistes mitjançant la funció `e()`.

---

## 3. Requisits detallats per capes

### 3.1. Base de dades (`databases/base-de-dades.sql`)

Afegeix la definició de la taula `tasques` al final del script SQL:

| Camp | Tipus / Restricció | Descripció |
| :--- | :--- | :--- |
| `id` | `INT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | Identificador únic de la tasca |
| `lead_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `leads(id)` amb `ON DELETE CASCADE` |
| `usuari_id` | `INT UNSIGNED NOT NULL` | Clau forana cap a `usuaris(id)` |
| `descripcio` | `VARCHAR(255) NOT NULL` | Text de la tasca a realitzar |
| `data_limit` | `DATE NOT NULL` | Data límit per a completar la tasca |
| `completada` | `TINYINT(1) NOT NULL DEFAULT 0` | Estat: `0` = pendent, `1` = completada |
| `data_creacio`| `TIMESTAMP DEFAULT CURRENT_TIMESTAMP` | Data i hora de registre al sistema |

*Afegeix també al script 3 tasques d'exemple relacionades amb els leads 1 i 2.*

---

### 3.2. Model de domini (`src/Model/Tasca.php`)

Crea la classe `Tasca` dins de l'espai de noms `App\Model`:
- Defineix les propietats utilitzant la **promoció de propietats al constructor** de PHP 8.
- Inclou els camps: `lead_id`, `usuari_id`, `descripcio`, `data_limit`, `completada` (bool/int, per defecte 0), `id` (opcional, per defecte null), `data_creacio` (opcional) i `nom_usuari` (opcional, per guardar el nom de l'autor després del `JOIN`).
- Implementa els *getters* necessaris per a tots els atributs.
- Implementa el mètode helper:
  - `estaVençuda(): bool` $\rightarrow$ Retorna `true` si la tasca NO està completada i la seua `data_limit` és anterior a la data actual (`date('Y-m-d')`).

---

### 3.3. Accés a dades (`src/DAO/TascaDAO.php`)

Crea la classe `TascaDAO` a `src/DAO/` implementant `IDbAccess`. Ha de disposar dels mètodes:

1. **`insert(object $entitat): int`**
   - Rep un objecte `Tasca`, executa un `INSERT` preparat i retorna l'ID generat (`$pdo->lastInsertId()`).
2. **`findByLead(int $leadId): array`**
   - Executa una consulta amb `JOIN` cap a la taula `usuaris` per obtindre `u.usuari AS nom_usuari`.
   - Ordena les tasques: primer les no completades (`completada ASC`), i després per data límit més propera (`data_limit ASC`).
   - Mapeja els resultats a instàncies de la classe `Tasca` utilitzant `PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE`.
3. **`findById(int $id): ?Tasca`**
   - Retorna la tasca amb l'identificador indicat, o `null` si no existix.
4. **`marcarCompletada(int $id): bool`**
   - Executa un `UPDATE tasques SET completada = 1 WHERE id = :id`.
5. **`comptarPendentsPerLead(): array`**
   - Executa una única consulta amb `GROUP BY lead_id` que compta quantes tasques **pendents** (`completada = 0`) té cada lead.
   - Retorna un array associatiu `[lead_id => total_pendents]` fent ús de `PDO::FETCH_KEY_PAIR`.

---

### 3.4. Configuració (`config/bootstrap.php`)

- Importa la classe `App\DAO\TascaDAO`.
- Instancia el DAO i assigna'l a la variable global `$tascaDAO`:
  ```php
  $tascaDAO = new TascaDAO($connexio);
  ```

---

### 3.5. Controladors (`public/dashboard/`)

1. **`afegir_tasca.php` (Nou controlador d'acció):**
   - Comprova autenticació (`requereixLogin()`) i que la petició siga `POST`.
   - Valida que `descripcio` no estiga buida (màx. 255 caràcters).
   - Valida que `data_limit` no estiga buida i tinga un format de data vàlid.
   - Si hi ha errors, desa el missatge a `$_SESSION['flash_error']` i redirigix a `lead.php?id=$leadId`.
   - Si és vàlid, crea la instància de `Tasca` associada a l'usuari en sessió (`$_SESSION['usuari_id']`) i desa-la amb `$tascaDAO->insert($tasca)`.
   - Redirigix a `lead.php?id=$leadId` amb missatge a `$_SESSION['flash_exit']`.

2. **`completar_tasca.php` (Nou controlador d'acció):**
   - Comprova autenticació (`requereixLogin()`) i mètode `POST`.
   - Rep `tasca_id` i `lead_id`.
   - Recupera la tasca amb `$tascaDAO->findById($tascaId)`.
   - **Control de permisos:** Comprova que l'usuari actual siga l'autor de la tasca (`$tasca->getUsuariId() === $_SESSION['usuari_id']`) O que tinga rol d'administrador (`$_SESSION['rol'] === 'administrador'`). Si no té permís, respon amb codi 403 i error.
   - Si té permisos, crida a `$tascaDAO->marcarCompletada($tascaId)` i redirigix.

---

### 3.6. Vistes (`public/dashboard/`)

1. **`lead.php` (Detall del Lead):**
   - Carrega les tasques del lead amb `$tascaDAO->findByLead($leadId)`.
   - Mostra una nova secció **«Tasques de seguiment»** amb:
     - El llistat de tasques: descripció, autor, data límit i estat (Pendent o Completada).
     - Si la tasca està vençuda (`$tasca->estaVençuda()`), ressalta la data en color roig o etiqueta d'avís.
     - Un botó/formulari per a marcar com a completada aquelles tasques que encara estiguen pendents (només visible si l'usuari té permisos).
     - Formulari per afegir una nova tasca (un camp de text per a la descripció i un `<input type="date">` per a la data límit).

2. **`leads.php` (Llistat general):**
   - Mostra una columna o xicoteta etiqueta informativa amb les **Tasques pendents** de cada lead (utilitzant el resultat de `$tascaDAO->comptarPendentsPerLead()`).

---

## 4. Bareme de puntuació de l'examen (Total: 10 punts)

| Secció | Criteri d'avaluació | Punts |
| :--- | :--- | :---: |
| **SQL** | Taula correcta, tipus, claus foranes i `ON DELETE CASCADE` | 1,5 pts |
| **Model** | Classe `Tasca`, constructor PHP 8, getters i helper `estaVençuda()` | 1,5 pts |
| **DAO** | Consultes PDO preparades, `JOIN` amb usuaris, `UPDATE` i `FETCH_KEY_PAIR` | 3,0 pts |
| **Controladors** | Validació d'entrada, gestió de sessions, missatges flash i comprovació de rols | 2,5 pts |
| **Vistes** | Renderització neta, visualització condicional i prevenció XSS amb `e()` | 1,5 pts |

