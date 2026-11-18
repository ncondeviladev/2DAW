# 🐘 DWES — Desenvolupament Web en Entorn Servidor

> **Professor:** Eloy Gutiérrez Paredes (`e.gutierrezparedes@edu.gva.es`)  
> **Tutories:** Dimecres vesprada (setmanes parells doble, imparells simple) / Dijous matí.

---

## 🎯 1. Estat de les Tasques de la Unitat

| Tasca | Contingut Clau | Estat | Data Límit |
| :--- | :--- | :---: | :---: |
| `U1_P1 Docker` | Entorn LAMP + Apache + PHP + MySQL | ✅ **Entregat** | 30/11/2026 12:04 |
| `Autoavaluació U1` | Qüestionari d'introducció | ✅ **Fet** | Superat |
| `U2_P1 Exercicis` | PHP bàsic (exercicis 1.1 a 6.3) | ✅ **Entregat** | 21/11/2026 08:16 |
| `U2_P2 Problemes` | Descompte, Productes, Ciutats i Generador Password | ✅ **Entregat** | 28/11/2026 09:56 |
| `Autoavaluació U2` | Qüestionari PHP bàsic | ✅ **Fet** | Superat |
| `U3_P1 Exercicis` | PHP avançat (exercicis blocs 1 al 8) | ✅ **Entregat** | 21/11/2026 08:16 |
| `U3_P2 Miniprojecte` | TechLeads sense BBDD (sessions, arxius, PRG) | ✅ **Entregat (100%)** | 28/11/2026 09:56 |
| `Autoavaluació U3` | Qüestionari PHP avançat | ✅ **Fet** | Superat |
| `U4_P1 Exercicis` | TechLeads amb accés a BBDD (Docker, PDO, DAOs) | ✅ **Entregat** | 21/11/2026 08:16 |
| `Autoavaluació U4` | Qüestionari d'accés a dades | ✅ **Fet** | Superat |
| `U4_P2 Notes` | TechLeads amb notes internes per lead (1:N) | ✅ **Entregat (100%)** | 21/11/2026 08:16 |
| `U5_P1 Exercicis Bloc 1` | Introducció a Laravel 13 i Sail (Captures entorn) | ⏳ **Pendent (2a Aval)** | 21/01/2027 23:59 |
| `U5_P2 Exercicis Bloc 2` | Rutes, vistes Blade i components (Captures rutes) | ⏳ **Pendent (2a Aval)** | 21/01/2027 23:59 |

> 📢 **Avis Oficial d'Eloy (02/11/2026):** *«A partir del que fem aquesta setmana [Unitat 5: Laravel] NO serà avaluat en la primera avaluació.»* Tot el contingut de la 1a avaluació de DWES (U1 a U4) està ja completat i entregat. Laravel s'avalua en la 2a avaluació.

---

## 📚 2. Documents Tècnics de Referència Locals

### 1a Avaluació (PHP Pur, Docker LAMP i PDO):
- **[Memòria Tècnica d'Arquitectura Web](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/MEMORIA_TECNICA.md):** Manual consolidat amb el funcionament d'HTTP sense estat, `$_SESSION` (/tmp/sess_*) vs `$_COOKIE` (metàfora del tiquet del guardarroba), encaminament públic/privat, Composer/PSR-4, injecció de dependències i l'evolució de TechLeads en 3 fases.
- **[Apunts d'Accés a Dades U4](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U4/U4_Acces_a_dades_Apunts.md):** Guia exhaustiva de 12 punts sobre Docker, MySQL 8.4, models, interfícies DAO, PDO i patró PRG.
- **[Enunciat Oficial U4_P2](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U4/U4_P2_CondeNoe/ENUNCIAT.md):** Requisits de la pràctica de notes per lead.

### 2a Avaluació (Frameworks: Laravel 13 & Sail):
- **[U5 Índex General: Frameworks Laravel](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U5/U5_Index_Frameworks_Laravel.md):** Presentació del projecte anual *Etiquetes d'aliments*, RA5, RA8 i mapa de 8 blocs.
- **[U5 Bloc 1: Introducció i Laravel Sail](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U5/U5_Bloc1_Introduccio_i_Sail.md):** WSL2, contenidors `laravel.test` (PHP 8.5, Node 24, Composer), MySQL, Mailpit, phpMyAdmin, `.env`, primeres rutes, Artisan i Vite amb Tailwind.
- **[U5 Bloc 2: Rutes i vistes Blade](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U5/U5_Bloc2_Rutes_i_Vistes.md):** Del fitxer únic a MVC, rutes amb nom `route()`, components Blade `<x-...>`, layouts, directiva `@vite`, grups de rutes `prefix` i `name`.
- **[U5 Bloc 3: Controladors](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U5/U5_Bloc3_Controladors.md):** Separació de lògica, `SampleLabels`, Single Action Controller `__invoke`, Resource Controllers i controladors de panell.

---

## 🔍 3. Progrés Actual: Pràctica U4_P2 (TechLeads Notes)

- **Base de dades:** ✅ Taula `notes` creada a `databases/base-de-dades.sql` amb claus foranes `lead_id` (`ON DELETE CASCADE`) i `usuari_id`, més 3 inserts de prova.
- **Model:** ✅ `src/Model/Nota.php` amb constructor promotion, getters/setters i suport per a `$nom_usuari`.
- **DAO:** ✅ `src/DAO/NotaDAO.php` 100% completat (`insert`, `findByLead` amb `JOIN usuaris`, `findById`, `delete`, `comptarPerLead` amb `PDO::FETCH_KEY_PAIR`).
- **Controladors i Vistes:** ✅ `afegir_nota.php` i `eliminar_nota.php` (amb control de permisos d'autor i administrador al servidor), `lead.php` (llistat, formulari i avisos flash), i `leads.php` (columna Notes amb enllaç al detall). Llest per a comprimir i lliurar.

---

## 💡 4. Feedback del Professor per a Repàs d'Examen
1. **Cookies i sessions:** Revisar funcionament quan es tanca el navegador amb la casella "Recorda'm" marcada (comprovació en arrencada de sessió).
2. **Sticky forms:** Comprovar estat dels checkboxes en serveis seleccionats si falla la validació en formularis públics.

---

## 🏆 5. Entrenament Pràctic d'Examen (Simulacres 1a Avaluació)

Davant la confirmació d'Eloy que l'examen és una rèplica pràctica de l'ampliació d'entitat 1:N sobre projecte base (patró `U4_P2`), s'han completat 3 simulacres complets:

1. **Simulacre 1 (`DWES/Simulacro_Examen/` — HelpDeskPro):** Tiquets i intervencions tècniques.
2. **Simulacre 2 (`DWES/Simulacro_Examen_v2/` — VetClinic Huellas):**
   - Entitats: Pacients $\rightarrow$ Visites (referència) $\rightarrow$ Vacunes (tasca d'examen).
   - Servidors Docker en ports 8082 (web) i 8083 (phpMyAdmin).
   - Qualificació inicial: **3,5 / 10** (identificació de bloquejos crítics).
   - Depuració en viu i resolució pas a pas de cada error de sintaxi i PDO fins a deixar-lo al 100% funcional.
3. **Simulacre 3 (`DWES/Simulacro_Examen_v3/` — FitLife Studio):**
   - Entitats: Clients $\rightarrow$ Classes (referència) $\rightarrow$ Bons (tasca d'examen).
   - Servidors Docker en ports 8084 (web) i 8085 (phpMyAdmin).
   - Qualificació obtinguda: **7,8 / 10 (Notable Alt)**. Resolució autònoma d'alt nivell.

### 📋 Checklist Canònic per a l'Examen d'Eloy (Regles d'Or):
1. **SQL (`base-de-dades.sql`):**
   - Comprovar que la columna `AUTO_INCREMENT` tinga `PRIMARY KEY (id)`.
   - Vigilar comes al final de cada definició de columna abans de `FOREIGN KEY`.
   - Provar la creació a phpMyAdmin abans de tocar codi PHP.
2. **Model (`src/Model/Entitat.php`):**
   - Constructor promotion amb tipat estricte i nullables (`?int $id = null`).
   - Retorns dels getters sempre coincidents amb el tipus (`getId(): ?int`).
   - Mètode de negoci booleà: usar operadors lògics coherents (`||` per a null o data futura).
3. **DAO (`src/DAO/EntitatDAO.php`):**
   - `insert()`: Inserir a la taula correcta de la BD, sense incloure columnes que pertanyen a un `JOIN` (com `nom_usuari` o `nom_instructor`).
   - `findByPare()`: `SELECT e.*, u.usuari AS nom_alias FROM entitat e JOIN usuaris u ON e.usuari_id = u.id WHERE e.pare_id = :pare_id ORDER BY e.data_alta DESC`.
   - `setFetchMode()`: Passar SEMPRE la classe destí: `$stmt->setFetchMode(self::MODE, Entitat::class);`.
   - `comptarPerPare()`: Recordar cridar a `$stmt->execute()` abans del `fetchAll(PDO::FETCH_KEY_PAIR)`.
4. **Controladors (`afegir_entitat.php` i `eliminar_entitat.php`):**
   - Instanciació de models: **Usar sempre *named arguments*** (`new Entitat(client_id: $client_id, usuari_id: idUsuariActual(), ...)`). Evita errors fatals per alteració de l'ordre dels paràmetres.
   - Guard de seguretat en eliminació:
     `if ($entitat->getUsuariId() !== idUsuariActual() && !esAdmin()) { http_response_code(403); exit; }`
   - En redireccions `header('Location: ...')`, recuperar l'identificador pare del propi objecte (`$entitat->getPareId()`).
5. **Configuració i Vistes (`bootstrap.php`, `pare.php`, `pares.php`):**
   - Registrar la nova instància DAO a `config/bootstrap.php` (`$entitatDAO = new EntitatDAO($connexio);`).
   - A la vista de detall, no deixar variables buides actives després de la línia de recuperació del DAO.
