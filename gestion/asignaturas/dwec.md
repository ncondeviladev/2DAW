# ⚡ DWEC — Desenvolupament Web en Entorn Client

> **Professor:** José Ramón Migueles Hernández (`jr.migueleshernand@edu.gva.es`)  
> **Tutories:** Dimecres vesprada / Dijous matí.

---

## 🎯 1. Estat de les Tasques de la Unitat

| Tasca | Contingut Clau | Estat | Data / Qualificació |
| :--- | :--- | :---: | :---: |
| `UD1 Activitat` | Arquitectures web, Wasm i eines | ✅ **Entregat** | Tramesa a Aules |
| `UD1 Qüestionari` | Test inicial d'arquitectura | ✅ **Fet** | Superat |
| `UD2 Activitat` | Sintaxi bàsica i estructures | ✅ **Entregat** | Tramesa a Aules |
| `UD2 Qüestionari` | Test sintaxi bàsica | ✅ **Fet** | Superat |
| `UD3 Activitat` | `analizaNumeros.js` (funcions i arrays) | ✅ **Entregat** | Tramesa a Aules |
| `UD3 Qüestionari` | Test de funcions i arrays | ✅ **Fet** | **10 / 10** |
| `UD4 Activitat` | `Libro.js` (POO ES6+, camps privats) | ✅ **Entregat** | Tramesa a Aules |
| `UD4 Qüestionari` | Test d'objectes en JavaScript | ✅ **Fet** | **10 / 10** |
| `Guia d'Examen DWEC` | Manual d'estudi estil Eloy (Teoria, Test 15q i 3 Exercicis) | ✅ **Llest (14/11)** | `DWEC/guia_dwec.md` |
| `Chuleta Oficial d'Examen`| Document de 2 pàgines A4 autoritzat en paper | ✅ **Llest (14/11)** | `DWEC/cheatsheet_DWEC.pdf` |
| `Pràctica d'Examen (Codi)`| Resolució dels 6 exercicis clau (3 guiats + 3 examen) | 🔄 **En curs (4 de 6)** | `guiado_RA2..4` + `examen_RA2` fets |

---

## 📚 2. Documents de Repàs per a l'Examen Presencial

- 📄 **[Chuleta Oficial DWEC d'Examen (2 Pàgines A4)](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWEC/cheatsheet_DWEC.pdf):**  
  Document oficial imprès de referència autoritzat per José Ramón per a portar al PC. 2 pàgines A4 a dues columnes amples (97 mm) sense talls de línia:
  - *Cara 1:* Sintaxi, comparadors (`===`), falsy, `String` complet (`trim`, `slice`, `split`, `replace`, `padStart`), `Math`, `Date`, funcions, `Rest`/`Spread`, closures, i `Array` complet (`map`, `filter`, `reduce`, `some`, `every`, `sort`).
  - *Cara 2:* POO canònica ES6 amb camps privats `#`, getters/setters amb validació de tipus i rang, `extends`/`super()`, `JSON`, `RegExp` (DNI amb `.test()`), `JSDoc` i **les 3 plantilles canòniques d'examen (`ejRA2.js`, `ejRA3.js`, `ejRA4.js`)**.
  - Font HTML: [`DWEC/cheatsheet_DWEC.html`](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWEC/cheatsheet_DWEC.html).
- 📘 **[Guia Completa d'Examen DWEC (Estil Eloy)](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWEC/guia_dwec.md):**  
  Manual didàctic directe al gra:
  - *Bloque 1:* Test de 10 preguntes (teoria de tipus, mutabilitat `const`, `typeof null/NaN`, closures) + **Simulacre de 15 preguntes test resoltes i raonades**.
  - *Bloque 2:* Pràctica RA2 (`String` + `Math` + `Date`) amb exercici guiat i exercici d'examen resolt (`analizarMatricula`).
  - *Bloque 3:* Pràctica RA3 (`filter` + `map` + `reduce` + `sort`) amb exercici guiat i exercici d'examen resolt (`analizarInventario`).
  - *Bloque 4:* Pràctica RA4 (POO ES6 amb `#`, getters/setters i validacions) amb exercici guiat (`Alumno`) i exercici d'examen resolt (`Tarea`).
  - *Bloque 5:* Plantilles canòniques buides per a començar a programar a l'examen.
- 💻 **[Banc de Pràctica de Codi d'Examen](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWEC/practicaExamen/):**  
  - ✅ `guiado_RA2.js`: Neteja de text, càlcul d'edat i formateig de despesa completat.
  - ✅ `guiado_RA3.js`: Filtrats, ordenació numèrica, mitjana i validacions completat.
  - ✅ `guiado_RA4.js`: Classe `Alumno` amb camps privats `#`, mètodes de negoci i `.join(", ")` completat.
  - ✅ `examen_RA2.js`: Exercici d'examen real resolt (`analizarMatricula` amb `padStart` i `Date`).
  - ⏳ `examen_RA3.js`: Pendent per a dilluns (catàleg d'inventari).
  - ⏳ `examen_RA4.js`: Pendent per a dilluns (classe `Tarea` amb setter per defecte a 30).
- **[Quadern de Repàs Integral DWEC (7 Blocs)](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DWEC/temario_resumido.md):**  
  Document de síntesi dividit en 7 blocs fonamentals amb 21 exercicis teòrics/pràctics.

---

## 🚨 3. Fites i Horari Oficial d'Examen
- **Data i Hora Oficial:** **Dimecres, 18 de novembre de 2026, de 16:00 a 17:50** (Torn de vesprada).
- **Format:**
  1. **10 preguntes tipus test a l'ordinador** (conceptes bàsics, `typeof`, mutabilitat `const`, closures, comparadors).
  2. **3 exercicis pràctics de desenvolupament en JS pur:** `ejRA2.js` (cadenes/Math/dates), `ejRA3.js` (funcions i arrays), `ejRA4.js` (classes ES6 amb `#`).
- **Material permès a l'examen:** Document imprès o manuscrit de mètodes i sintaxi (`cheatsheet_DWEC.pdf`).

---

## 💡 4. Patrons d'Examen i Aprenentatges Tècnics Consolidats (Sessió 14/11)
- **Manipulació de cadenes i arrays auxiliars:**
  - `padStart(5, '0')` per a codis/expedients amb zeros a l'esquerra (requereix convertir el número a string primer: `String(num).padStart(5, '0')`).
  - Desglossament encadenat `bloques[0].split("-")[0].toUpperCase()`: accés al primer element del split inicial, nou split pel guió, i primer bloc a majúscules.
  - Capitalització de noms complets: `.split(" ").map(p => p[0].toUpperCase() + p.slice(1).toLowerCase()).join(" ")`.
- **Gestió de Dates en JS pur:**
  - Conversió obligatòria a objecte: `new Date("YYYY-MM-DD")`.
  - Càlcul de diferència en dies: `Math.ceil((dataFutura - dataHui) / (1000 * 60 * 60 * 24))`.
- **Classes canòniques ES6 (RA4):**
  - Camps privats declarats a l'arrel amb `#` (`#expediente`, `#nombre`, `#notas`).
  - Si un mètode intern crida un altre mètode de la mateixa instància, és imprescindible prefixar `this.altreMetode()`.
  - En JavaScript NO existeixen els arrays associatius (sempre són objectes `{}`) ni la funció `empty()` (comprovar `arr.length === 0`).
  - Retorn de formats numèrics amb decimals: `num.toFixed(2)` (sempre retorna string).
- **Entorn d'execució i depuració:**
  - Ús de Quokka.js a l'editor afegint `//?` al final de qualsevol línia per avaluar valors a temps real sense embrutar amb `console.log`. Recordar no deixar línies de sintaxi incompletes per evitar bloquejos de l'extensió.

---

## 📋 5. Pla de Treball Immediat (Dilluns al matí)
1. **Resolució de `examen_RA3.js` (Catàleg d'Inventari):**
   - Implementació de `analizarInventario(articulos)`.
   - `disponibles`: filter (`unidades > 0`), map (`ref`), sort alfabètic.
   - `valorTotalStock`: reduce (`precio * unidades`) amb format a 2 decimals.
   - `articulosHardwareCaros`: filter (`categoria === "hardware" && precio > 50`).
   - `todoConStock`: every (`unidades > 0`).
2. **Resolució de `examen_RA4.js` (Classe `Tarea`):**
   - Camps privats `#id`, `#tiempoEstimadoMinutos`.
   - Constructor, getter `id`, getter i setter `tiempoEstimadoMinutos` (valor per defecte a 30 si $\le 0$ o no és enter).
   - Mètodes `completar()`, `tiempoEnHoras()` (`toFixed(2)`), `resumen()`.
3. **Simulacre ràpid de Test (15 preguntes raonades de `guia_dwec.md`).**
4. **Impressió física en paper:** `cheatsheet_DWEC.pdf` (1 full per davant i per darrere).
