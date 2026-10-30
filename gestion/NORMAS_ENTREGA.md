# 📋 Normes i Criteris de Qualitat d'Entrega (Checklists Oficials)

> Guia de verificació prèvia abans de pujar qualsevol pràctica o document PDF/ZIP a Aules.

---

## 🎯 1. Checklist General de Presentació (Tots els Mòduls)

Abans de generar el PDF o empaquetar el ZIP:

- [ ] **Portada formal o encapçalament visible:** Títol de la pràctica en gran i ben destacat.
- [ ] **Identificació de l'autor:** Nom complet (**Noé Conde Vila**) i curs (**2n DAW Semipresencial**).
- [ ] **Format dels enunciats:** El text de cada enunciat o pregunta ha d'anar en **negreta**.
- [ ] **Format de les respostes:** El text de les respostes ha d'anar en estil diferenciat i color **blau**.
- [ ] **Ubicació d'imatges i captures:** Mai deixar captures soltes a l'arrel; sempre en una carpeta dedicada `capturas/` o `img/`.
- [ ] **Nomenclatura d'arxius estricta:** 
  - Tot en minúscules (o format exigit com `S0x_PR1_CondeNoe.pdf`).
  - **Sense accents ni dièresis.**
  - **Sense 'ñ' ni caràcters especials.**
  - **Sense espais en blanc** (usar guió baix `_` o guió mitjà `-`).

---

## 🏗️ 2. Normes Estrictes de Qualitat HTML5 — DIW (Prof. Quique Savall)

> ⚠️ **Molt estricte:** Qualsevol error al validador W3C o etiqueta visual obsoleta resta puntuació greu a l'examen i pràctiques.

### Estructura del Document
- [ ] `<!DOCTYPE html>` sempre a la **línia 1**, sense cap espai ni caràcter previ.
- [ ] `<html lang="es">` — L'atribut `lang` és **obligatori** per estàndard W3C i accessibilitat.
- [ ] Fills directes de `<html>`: Únicament `<head>` i `<body>`.
- [ ] **Validació obligatòria W3C:** Passar pel validador oficial (`https://validator.w3.org`). Resultat: **0 errors** (només es toleren certs warnings justificats).

### Capçalera (`<head>`)
- [ ] `<meta charset="utf-8">` com a **primer element** del `<head>`.
- [ ] `<meta name="viewport" content="width=device-width, initial-scale=1.0">` (Mobile First).
- [ ] `<title>` obligatori, descriptiu i concís.
- [ ] Metadades de qualitat:
  ```html
  <meta name="author" content="Noé Conde Vila">
  <meta name="description" content="...">
  <meta name="keywords" content="...">
  <meta name="robots" content="index, nofollow">
  <meta name="theme-color" content="#...">
  <link rel="icon" type="image/x-icon" href="...">
  ```

### Cos (`<body>`) i Semàntica HTML5
- [ ] **Contenidors semàntics obligatoris:** Usar `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`.
- [ ] **MAI usar `<div>` com a contenidor principal** on corresponga una etiqueta semàntica.
- [ ] **Cap text nu directament al `<body>`:** Tot el contingut visible ha d'anar contingut en `<p>`, `<li>`, `<td>`, `<h1>`-`<h6>`, etc.
- [ ] **Jerarquia de títols estricta:** Un únic `<h1>` per pàgina (títol principal). Després descendir sense salts il·lògics (`h1 > h2 > h3`).
- [ ] **Etiquetes semàntiques de text:** Usar `<strong>` (mai `<b>`), `<em>` (mai `<i>`), `<mark>`, `<cite>`, `<small>`, `<code>`, `<del>` (mai `<s>`), `<ins>`, `<time>`.
- [ ] **Prohibició d'atributs visuals obsolets:** MAI fer servir `align`, `border`, `cellspacing`, `cellpadding`, `bgcolor`, `hspace`, `vspace`. Tot l'estil es programa en CSS3.

### Imatges, Enllaços i Rutes
- [ ] Atribut `alt="..."` obligatori en totes les imatges `<img>`.
- [ ] `target="_blank"` acompanyat de `rel="noopener noreferrer"` en enllaços externs.
- [ ] **Rutes sempre relatives** (mai absolutes `C:/...`).

---

## ⚙️ 3. Criteris Tècnics de DWES (Prof. Eloy Gutiérrez)

- [ ] **Docker LAMP integrat:** Verificació de contenidors en marxa (`web`, `db`, `phpmyadmin`).
- [ ] **Composer i PSR-4:** Mapeig estricte de namespaces (`App\` $\to$ `src/`).
- [ ] **Consultes PDO preparades:** Ús sistemàtic de `$stmt->prepare()` i marcadors `:nom` en totes les operacions SQL amb dades d'usuari.
- [ ] **Patró PRG (Post-Redirect-Get):** En recepcions de POST, validar, operar i redirigir (`header('Location: ...'); exit;`).
- [ ] **Seguretat de sessions:** Comprovació amb `requereixLogin()` en totes les rutes privades de `/dashboard/`.
- [ ] **Escapament XSS:** Neteja de sortides HTML mitjançant la funció helper `e($variable)`.
- [ ] **Neteja d'arxius:** Si falla l'actualització d'un registre que inclou un fitxer pujat, esborrar el fitxer físic per a no deixar brossa orfena al servidor.
