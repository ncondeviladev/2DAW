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
| `U4_P2 Notes` | TechLeads amb notes internes per lead (1:N) | ✅ **Completat (100%)** | 21/11/2026 08:16 |

---

## 📚 2. Documents Tècnics de Referència Locals

- **[Memòria Tècnica d'Arquitectura Web](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/MEMORIA_TECNICA.md):** Manual consolidat amb el funcionament d'HTTP sense estat, `$_SESSION` (/tmp/sess_*) vs `$_COOKIE` (metàfora del tiquet del guardarroba), encaminament públic/privat, Composer/PSR-4, injecció de dependències i l'evolució de TechLeads en 3 fases.
- **[Apunts d'Accés a Dades U4](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U4/U4_Acces_a_dades_Apunts.md):** Guia exhaustiva de 12 punts sobre Docker, MySQL 8.4, models, interfícies DAO, PDO i patró PRG.
- **[Enunciat Oficial U4_P2](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWES/U4/U4_P2_CondeNoe/ENUNCIAT.md):** Requisits de la pràctica de notes per lead.

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
