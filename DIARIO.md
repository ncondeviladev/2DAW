# 📘 DIARI DE SEGUIMENT — 2n DAW (Semipresencial)
> **Alumne:** Noé Conde Vila  
> **Centre:** IES Maria Enríquez (Gandia) — Curs 2026/2027  
> **Última actualització:** 24 de setembre de 2026  

---

## 🎯 Tauler General de Tasques (Les 4 Assignatures Principals)

| Assignatura | Tasca / Activitat | Estat | Data límit / Notes |
| :--- | :--- | :---: | :--- |
| **DWES** | `U1_P1 Docker` (Preparació entorn Apache + MySQL + phpMyAdmin) | ✅ **Fet** | Contenidors operatius i fitxers creats |
| **DWES** | `U2_P1 Exercicis PHP` (Exercicis 1.1 al 6.3) | ✅ **Fet** | Tots els exercicis resolts i provats en servidor local |
| **DWES** | `U2 Qüestionari` (Test d'avaluació PHP bàsic) | ✅ **Fet** | Test superat a la plataforma Aules |
| **DaW** | `PEC1` (Apache i Nginx, Error 404, Port 8989, Multilloc, SSH/SFTP) | ✅ **Fet** | Completat al 100% i compilat a PDF |
| **DWEC** | `UD1 Activitat` (Anàlisi d'arquitectura web simple) | ✅ **Fet** | Document completat i exportat a PDF (`ud1_activitat_noeconde.pdf`) |
| **DWEC** | `UD1 Qüestionari` | ✅ **Fet** | Test superat a la plataforma Aules |
| **DWEC** | `UD2 Activitat` | 🔴 **Pendent** | Segona unitat |
| **DWEC** | `UD2 Qüestionari` | 🔴 **Pendent** | Test a la plataforma Aules |
| **DIW** | `S01_PR1` (HCI, Interfícies i Elements Web) | ✅ **Fet** | Completada, exportada a PDF i entregada |
| **DIW** | `S02_Ej PizzaDelivery` (Exercici HTML autoevaluació) | ✅ **Fet** | Completats Ej1 i Ej2 al 100%, validat a W3C (0 errors) |
| **DIW** | `S02_PR1` (CV en HTML5) | ✅ **Fet** | Completada al 100%, validada a W3C (0 errors, 0 avisos) |
| **DIW** | `Autoavaluació` | 🔴 **Pendent** | Qüestionari d'autoavaluació |

---

## 📚 Assignatures i Professorat

### 1. DWES — Desenvolupament Web en Entorn Servidor
* **Professor:** Eloy Gutiérrez Paredes (`e.gutierrezparedes@edu.gva.es`)  
* **Tutoría col·lectiva:** Dimecres vesprada (setmanes parells sessió doble, imparells sessió simple) / Dijous matí.

### 2. DaW — Desplegament d'Aplicacions Web
* **Professor:** Juan Ramón Collado Esteve (`jr.colladoesteve@edu.gva.es`)  
* **Tutoría col·lectiva:** Dimecres vesprada (setmanes imparells) / Dijous matí (setmanes parells).

### 3. DWEC — Desenvolupament Web en Entorn Client
* **Professor:** José Ramón Migueles Hernández (`jr.migueleshernand@edu.gva.es`)  
* **Tutoría col·lectiva:** Dimecres vesprada / Dijous matí.

### 4. DIW — Disseny d'Interfícies Web
* **Professor:** Quique Savall Seguí (`e.savallsegui@edu.gva.es`)  
* **Tutoría col·lectiva:** Dimecres vesprada (15:15–16:10) / Dijous matí (14:20–15:15).

---

## 📝 Normes Generals d'Entrega (Checklist de Qualitat)
*Per a recordar sempre abans d'entregar qualsevol PDF o projecte a Aules:*
- [ ] **Portada/Títol:** Títol de la pràctica visible en gran.
- [ ] **Identificació:** Nom de l'alumne (**Noé Conde Vila**) i curs (**2n DAW**) clarament indicats.
- [ ] **Format dels enunciats:** Enunciat de cada activitat sempre en **negreta**.
- [ ] **Format de respostes:** Text en estil diferent i en color **blau**.
- [ ] **Imatges/Captures:** Sempre dins d'una carpeta dedicada `capturas/` o `img/` (mai soltes a l'arrel).
- [ ] **Nomenclatura d'arxius:** Tot en minúscules, sense accents, sense 'ñ' i sense espais en blanc.

---

## 🏗️ Normes de Qualitat HTML — DIW (Prof. Savall) ← MUY ESTRICTO

### Estructura i Document
- [ ] `<!DOCTYPE html>` sempre en la primera línia, sense excepció.
- [ ] `<html lang="es">` — atribut `lang` **obligatori** (W3C i accessibilitat).
- [ ] Estructura correcta: `<head>` i `<body>` com a únics fills directes de `<html>`.
- [ ] Codi **ben indentat** (2 espais o tab consistent) — usar Prettier/Beautify a VSCode.
- [ ] **Validació obligatòria** a `https://validator.w3.org` — el resultat **només pot tenir warnings, cap error**.

### HEAD — Mínims i Extres
- [ ] `<meta charset="utf-8">` — sempre, és el primer meta.
- [ ] `<title>` — sempre present, descriptiu.
- [ ] `<meta name="author" content="Noé Conde Vila">` — identificació de l'autor.
- [ ] `<meta name="description" content="...">` — descripció del contingut.
- [ ] `<meta name="keywords" content="...">` — paraules clau.
- [ ] `<meta name="robots" content="index, nofollow">` — indexar pàgina però no les filles.
- [ ] `<meta name="theme-color" content="#...">` — color per a navegadors mòbils.
- [ ] `<link rel="icon" ...>` — favicon a la barra del navegador.
- [ ] (Opcional) Metes Open Graph (`og:title`, `og:description`, `og:image`, `og:url`).

### BODY — Semàntica i Estructura
- [ ] Usar **contenidors semàntics HTML5** (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`) — **MAI només `<div>`** on existeix l'etiqueta semàntica adequada.
- [ ] `<div>` i `<span>` per a agrupació genèrica quan no hi ha etiqueta semàntica millor.
- [ ] Tot el text visible ha d'estar dins d'un element (`<p>`, `<li>`, `<td>`, `<h1>`...) — **mai text nu directament al `<body>`**.
- [ ] Un sol `<h1>` per pàgina (títol principal), jerarquia correcta `h1 > h2 > h3...`.

### Etiquetes Semàntiques de Text
- [ ] **Usar** `<strong>` (important), `<em>` (èmfasi), `<mark>` (ressaltat), `<cite>` (citació), `<small>` (nota peu), `<code>` (codi), `<del>` (esborrat), `<ins>` (inserit), `<dfn>` (definició), `<abbr>` (abreviatura), `<time>` (data/hora), `<sub>`, `<sup>`.
- [ ] **Evitar** les etiquetes visuals obsoletes: `<b>` → usar `<strong>`, `<i>` → usar `<em>`, `<s>` → usar `<del>`, `<u>` → usar CSS.

### Imatges
- [ ] Sempre atribut `alt` a `<img>` — **obligatori** per accessibilitat i validació.
- [ ] Atributs `width` i/o `height` en HTML (pre-renderitzat), l'estil visual amb CSS.
- [ ] **No usar** atributs visuals obsolets (`align`, `border`, `hspace`, `vspace`) → usar CSS.

### Taules
- [ ] `<table>` **NOMÉS per a dades tabulars** — mai per a maquetació de pàgina.
- [ ] Usar `<th>` per a capçaleres, `<td>` per a cel·les de dades.
- [ ] `<caption>` per a donar títol a la taula.
- [ ] `colspan` i `rowspan` per a cel·les expandides.
- [ ] **No usar** atributs visuals obsolets (`border`, `cellspacing`, `cellpadding`, `bgcolor`, `align`) → usar CSS.

### Hiperenllaços
- [ ] `<a href="#id">` per a navegació interna (ancles).
- [ ] `target="_blank"` per a recursos externs (obrir en nova pestanya).
- [ ] `<a href="#">` per a "tornar al principi" (top de la pàgina).
- [ ] `mailto:` i `tel:` per a correu i telèfon respectivament.
- [ ] Els espais en URLs de `mailto` han d'anar codificats com `%20`.

### Rutes i Nomenclatura
- [ ] **Sempre rutes relatives** (mai absolutes com `C:/...`) — garanteix portabilitat al servidor.
- [ ] Noms de fitxers i carpetes: **minúscules, sense accents, sense ñ, sense espais** (usar guió `-` o guió baix `_`).
