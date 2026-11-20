# 📝 Examen Teòric Escrit — Disseny d'Interfícies Web (DIW)
> **Professor:** Quique Savall · 2n DAW Semipresencial (IES Maria Enríquez)  
> **Temps estimat:** 20 minuts  
> **Puntuació:** 2,5 punts (sobre 10 de la nota final de l'examen)  
> **Normativa:** Prohibit l'ús d'apunts, internet o chuletes.  

---

### Instruccions:
Respon a les preguntes directament escrivint la teua resposta (la lletra en els tests o completant els buits `_____` en el codi).

---

## Bloc 1: Conceptes d'Interfície i Components Visuals (S01)

#### 1. Quina és la diferència clau entre **Usabilitat** i **Accessibilitat**? (Respon en 1 o 2 frases breus):
*Resposta:*
La usabilitat es la facilidad, eficacioa y satisfación con la que un usuario puede usar una interfaz mientras la accesibilidad es la capacidad de la aplicacion para ser usada por personas con dificultades físicas o cognitivas. 
#### 2. Associa cada definició amb el component corresponent triant entre les opcions:
*(Opcions: `Tooltip`, `Breadcrumbs`, `Tabs`, `Popup/Modal`, `Spinner`, `Card`, `Action Bar`)*

- a) Element de navegació que mostra la ruta jeràrquica de la pàgina actual (`Inici > Productes > Calçat`): `Breadcrumbs`
- b) Text o ajuda flotant que apareix només quan passes el cursor per damunt d'un element: `popup modal`
- c) Indicador gràfic circular en moviment que informa a l'usuari que s'està carregant contingut: `spinner`
- d) Contenidor visual independent que sol agrupar una imatge, un títol, una breu descripció i un botó d'acció: `card`

---

## Bloc 2: HTML5 Estructura i Metadades (S02)

#### 3. Completa els 4 buits que falten en esta capçalera HTML5 estàndard:

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author  " content="Noé Conde">
  <meta name="robots" content="index, nofollow">
  <meta name="theme-color" content="#2563eb">
  <title>El Meu Lloc Web</title>
</head>
```

#### 4. Selecciona quina de les següents afirmacions sobre l'etiqueta `<main>` és correcta:
- A) Pot haver-hi múltiples etiquetes `<main>` visibles al mateix temps si estan dins de `<section>`.
- B) Només hi pot haver un únic `<main>` per document HTML5 i mai ha d'anar dins de `<header>` o `<footer>`.
- C) `<main>` s'utilitza exclusivament per a menús de navegació principals.
- D) És obligatori posar un `<h1>` abans d'obrir el `<main>`.
*Resposta:*
b
---

## Bloc 3: Formularis HTML5 (S03)

#### 5. Completa el següent formulari amb les etiquetes i atributs necessaris:
*(Pistes: agrupador visual, vincular label amb input, llista d'autocompletat i patró DNI)*

```html
<form action="enviar.php" method="POST">
  <!-- 1. Agrupador temàtic amb el seu títol -->
  <form>
    <fieldset>Dades del Client</legend>

    <!-- 2. Label vinculat a l'input de correu que rep el focus automàticament -->
    <label for="correu">Email:</label>
    <input type="email" id="correu" name="correu" required autofocus>

    <!-- 3. Input numèric amb límit mínim 18 i màxim 99 -->
    <label for="edat">Edat:</label>
    <input type="number" id="edat" name="edat" min="18" max="99">

    <!-- 4. Input vinculat a una llista de suggeriments (datalist) -->
    <label for="ciutat">Població:</label>
    <input type="text" id="ciutat" name="ciutat" list="llista-ciutats">
    
    <datalist id="llista-ciutats">
      <option value="Gandia">
      <option value="Oliva">
    </datalist>

    <!-- 5. Input de text amb expressió regular de 8 números i 1 lletra majúscula -->
    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni" pattern="[0-9]{8}[A-Z]">

  </fieldset>
</form>
```

---

## Bloc 4: Multimèdia i Iframe (S04)

#### 6. Completa el codi per a servir imatges adaptatives amb `<picture>`:

```html
<picture>
  <!-- Imatge gran per a pantalles d'almenys 800px -->
  <source media="(min-width: 800px)" src="gran.jpg">
  <!-- Imatge per defecte obligatòria per accessibilitat -->
  <img src="menuda.jpg" alt="Logotip del taller">
</picture>
```

#### 7. Quins són els atributs que cal posar a una etiqueta `<video>` perquè es reproduïsca automàticament sense so, en bucle i amb barra de control?
```html
<video src="promo.mp4" controls muted loop autoload _________></video>
```

#### 8. Com s'inserta un element SVG en un document HTML5?
- A) Únicament mitjançant un `<iframe>`.
- B) De dues maneres: o externament amb `<img src="logo.svg" alt="...">` o directament incrustant el codi amb l'etiqueta `<svg>`.
- C) Únicament amb l'etiqueta `<canvas>`.
- D) Amb l'etiqueta `<picture>` obligatòriament.
*Resposta:*
b
---

## Bloc 5: Selectors CSS i Especificitat (S05 - S06)

#### 9. Donat este fragment HTML, escriu el selector CSS exacte per a cada cas:

```html
<article class="noticia">
  <h2>Títol Principal</h2>
  <p class="intro">Primer paràgraf introductori</p>
  <p>Segon paràgraf de text</p>
  <a href="https://extern.com" target="_blank">Enllaç extern</a>
  <a href="arxiu.pdf">Descarregar PDF</a>
  <a href="contacte.html">Contactar</a>
</article>
```

- a) Selecciona **únicament el primer paràgraf** que va immediatament darrere del `<h2>` (germà adjacent):  
  *Selector:* `h2 + p`
- b) Selecciona **tots els enllaços que apunten a un arxiu `.pdf`** (acaba en):  
  *Selector:* `a[href$=.pdf]`
- c) Selecciona **tots els enllaços que comencen per `https`** (comença per):  
  *Selector:* `a[href^=https.]`
- d) Selecciona **els paràgrafs amb classe `.intro` que NO tinguen la classe `.destacat`**:  
  *Selector:* `p.intro:not(.destacat)`

#### 10. Ordena de MENOR a MAJOR especificitat (prioritat de pes) els següents selectors CSS:
3. `a`
2. `header nav a:hover`
4. `.boton`
1. `#menu`

*Ordre de menor a major (ex: 3 < 4 < ...):* `_____ < _____ < _____ < _____` He cambiado el orden en la lista

---

## Bloc 6: CSS3, Variables i Funcions (S07 - S08)

#### 11. Explica la diferència fonamental entre la unitat `rem` i la unitat `em`:
*Resposta:*
rem fa referencia al contenidor root y em al contenidor intern que conté la propia etiqueta
#### 12. Què fan exactament les funcions `calc()` i `color-mix()` en CSS3? Posa un exemple breu de cadascuna:
- `calc()`: calcula operacions matematiques
- `color-mix()`: mescla colors

#### 13. Completa la declaració de la transformació CSS per a moure un botó 10px a la dreta, girar-lo 45 graus i escalar-lo un 10% més gran:
```css
.boton:hover {
  transform: translate(10px, 0) rotate(45deg) scale(1.1);
  transition: transform 0.3s ease;
}
```
