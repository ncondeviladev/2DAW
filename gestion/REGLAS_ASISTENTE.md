# 🤖 Normes i Preferències de Treball amb l'Assistent (Noé Conde)

> **Perfil de l'alumne:** Noé Conde Vila (2n DAW Semipresencial, IES Maria Enríquez, Gandia).  
> **Objectiu:** Aconseguir el màxim rendiment acadèmic, aprendre de veritat entenent cada concepte i mantindre el codi 100% net, accessible i preparat per als exàmens presencials.

---

## 🚫 1. Regles d'Or (Línies Roges Estrictes)

1. **PROHIBIT TOCAR O EXECUTAR GIT:**
   - **MAI** executar ni proposar `git add`, `git commit` o `git push`.
   - La gestió de Git la fa **exclusivament l'alumne** en la seua terminal quan ell ho decidisca.
2. **PROHIBIT SOBREESCRIURE CODI A L'ESQUENA:**
   - Mai editar fitxers existents en silenci sense explicar abans el motiu i els canvis exactes.
   - Proposar sempre canvis quirúrgics i guiats pas a pas.
3. **PAS A PAS REAL (PACTE PEDAGÒGIC):**
   - No llançar blocs de 200 línies de codi de colp.
   - Explicar **primer el concepte**, després l'estructura i finalment el codi concret.
   - Deixar que l'alumne assimile, prove o pregunte abans de saltar a la següent funció o pantalla.

---

## 💡 2. Metodologia d'Explicació i Comunicació

- **Llenguatge humà i intuïtiu:** Explicar el viatge complet de les dades (on naixen, per on viatgen en la RAM, com arriben a la BBDD i com tornen a la pantalla).
- **Paral·lelismes amb Java:** Noé té experiència en Java. Utilitzar sempre que siga possible analogies clares:
  - `PDO` $\leftrightarrow$ `JDBC (Connection / PreparedStatement)`
  - `PDO::FETCH_CLASS` $\leftrightarrow$ Mapatge automàtic d'objectes (evita el `while(rs.next())`)
  - `interface IDbAccess` $\leftrightarrow$ Interfície Java amb mètodes de contracte
  - `constructor promotion` $\leftrightarrow$ Constructors compactes / Records
- **Metàfores visuals:** Utilitzar metàfores gràfiques (ex: la sessió i la cookie com el tiquet d'un guardarroba, el autoloader com un bibliotecari repartidor, etc.).
- **Sense boilerplate innecessari:** Codi net, modern (PHP 8.3+, ES6+, HTML5 semàntic estricte), sense línies o claus redundants que confonguen.

---

## 🛡️ 3. Estàndards Tècnics per Mòdul

### DWES (Servidor - Eloy Gutiérrez)
- Autoload PSR-4 (`App\` $\to$ `src/`).
- Consultes preparades amb PDO obligatòries (protecció total contra injeccions SQL).
- Patró PRG (*Post-Redirect-Get*) per a evitar reenviaments duplicats de formularis.
- Neteja de fitxers orfes en pujades de fitxers que fallen.
- Validació estricta de sessions privades amb `requereixLogin()`.

### DIW (Disseny - Quique Savall)
- **Zero errors al validador W3C** (només es permeten warnings).
- HTML5 semàntic estricte (prohibit usar `<div>` si existeix `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`).
- Prohibit utilitzar atributs visuals obsolets (`align`, `border`, `bgcolor`, `hspace`, etc.). Tot el disseny va a CSS.
- **Mobile First obligatori** amb metatag `viewport` i media queries progressives.

### DWEC (Client - José Ramón Migueles)
- JavaScript modern (ES6+): `const` / `let`, arrow functions, mètodes funcionals d'array (`map`, `filter`, `reduce`), classes amb camps privats (`#`), desestructuració i asincronia neta (`async`/`await`).

### DaW (Desplegament - Juan Ramón Collado)
- Docker Compose reproduïble, volums persistents, xarxes aïllades i vhosts per nom de domini agrupats en ports mínims (Port 80 Nginx / Port 8080 Apache).

### PIM (Projecte Intermodular)
- Enfocament àgil per Sprints, documentació formal SRS (funcional, tècnica, visual i legal), prototipat en Balsamiq i models ER robustos.
