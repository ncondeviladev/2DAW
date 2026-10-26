# 🎨 Chuleta DIW — Guía Completa de HTML5 y CSS3
> **Mòdul:** Disseny d'Interfícies Web (2n DAW)  
> **Professor:** Quique Savall  
> **Propòsit:** Referència ràpida per a pràctiques, qüestionaris i exàmens presencials.

---

## 📑 ÍNDEX RÀPID
1. [Estructura y Reglas de Oro HTML5 (W3C y Savall)](#1-estructura-y-reglas-de-oro-html5)
2. [Etiquetas Semánticas y Contenedores](#2-etiquetas-semánticas-y-contenedores)
3. [Formularios Accesibles](#3-formularios-accesibles)
4. [Selectores CSS: Tipos y Sintaxis Completa](#4-selectores-css-tipos-y-sintaxis-completa)
5. [Combinadores de Jerarquía (Relaciones en el DOM)](#5-combinadores-de-jerarquía-relaciones-en-el-dom)
6. [Selectores de Atributo (Regla Mnemotécnica)](#6-selectores-de-atributo-regla-mnemotécnica)
7. [Pseudoclases y Pseudoelementos](#7-pseudoclases-y-pseudoelementos)
8. [Cálculo de Especificidad y Cascada](#8-cálculo-de-especificidad-y-cascada)
9. [Modelo de Caja (Box Model) y Unidades](#9-modelo-de-caja-box-model-y-unidades)
10. [Display, Posicionamiento y Buenas Prácticas](#10-display-posicionamiento-y-buenas-prácticas)
11. [Variables CSS (Custom Properties)](#11-variables-css-custom-properties)
12. [Mobile First y Resolución de Desbordamientos (Overflow)](#12-mobile-first-y-resolución-de-desbordamientos-overflow)
13. [Tipografía en CSS3: Google Fonts vs @font-face](#13-tipografía-en-css3-google-fonts-vs-font-face)
14. [Efectos Visuales CSS3: Sombras, Degradados y Fondos](#14-efectos-visuales-css3-sombras-degradados-y-fondos)
15. [Sintaxis Extendida: Con Espacio vs Sin Espacio](#15-sintaxis-extendida-con-espacio-vs-sin-espacio)
---

## 1. Estructura y Reglas de Oro HTML5

### Plantilla Base Perfecta (Validación W3C sin errores)
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título Descriptivo de la Página</title>
    
    <!-- Metadatos de autoría y SEO obligatorios para Savall -->
    <meta name="author" content="Noé Conde Vila">
    <meta name="description" content="Descripción breve del contenido de la web">
    <meta name="keywords" content="interfaces, html5, css, diseño">
    <meta name="robots" content="index, nofollow">
    <meta name="theme-color" content="#1a202c">
    
    <!-- Favicon y Estilos -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Título Principal Único (Solo un H1 por página)</h1>
    </header>
    <main>
        <!-- Contenido principal -->
    </main>
    <footer>
        <p><small>&copy; 2026 Noé Conde Vila</small></p>
    </footer>
</body>
</html>
```

### 🚨 Reglas de Calidad Estrictas de Quique Savall
1. **Atributo `lang` obligatorio:** Siempre `<html lang="es">` o `<html lang="ca">`.
2. **Jerarquía de títulos:** **Un único `<h1>` por documento**. La jerarquía debe ser natural: `h1 > h2 > h3...` (nunca saltar de `h1` a `h3`).
3. **Cero texto desnudo:** Todo texto en el `<body>` debe estar envuelto en un elemento semántico (`<p>`, `<li>`, `<h1>`, `<td>`...).
4. **Imágenes accesibles:** Siempre con `alt="..."` descriptivo. Atributos `width` y `height` en el HTML (para pre-renderizado) y estilo visual en CSS.
5. **Rutas siempre relativas:** `img/foto.jpg`, `css/style.css` (nunca `C:/...` ni absolutas).
6. **Nombres de archivo:** Minúsculas, sin espacios, sin tildes ni 'ñ' (`mi_pagina.html`, `foto-logo.png`).
7. **Tablas solo para datos:** Siempre con `<caption>`, `<thead>`, `<tbody>`, `<th>` para cabeceras y `<td>` para celdas. **Nunca tablas para maquetar layout**.

---

## 2. Etiquetas Semánticas y Contenedores

### Contenedores de Sección (HTML5 Estructural)
| Etiqueta | Cuándo se usa | Evitar |
| :--- | :--- | :--- |
| `<header>` | Cabecera del sitio o de un `<article>` (logos, títulos, autores). | No confundir con `<head>`. |
| `<nav>` | Bloque de enlaces de navegación principal del sitio. | No meter enlaces sueltos fuera de menús. |
| `<main>` | Contenido central y único de la página (solo 1 por documento). | No meter dentro de `<header>` o `<footer>`. |
| `<section>` | Agrupación temática de contenido, suele tener su propio `<h2>`. | No usar como sustituto genérico de `<div>`. |
| `<article>` | Contenido autónomo y reusable (post, noticia, comentario, ficha). | |
| `<aside>` | Contenido tangencial o complementario (sidebar, notas, banners). | |
| `<footer>>` | Pie del sitio o de un bloque (copyright, enlaces legales, contacto). | |
| `<div>` | Contenedor comodín neutro sin valor semántico (solo para CSS). | **Solo si no existe etiqueta semántica.** |

### Formato de Texto Semántico vs Visual Obsoleto
| Usar (Semántica moderna) | En lugar de (Obsoleto) | Significado real |
| :--- | :--- | :--- |
| `<strong>` | `<b>` | Importancia o gravedad semántica. |
| `<em>` | `<i>` | Énfasis o tono diferente en la lectura. |
| `<mark>` | `<span class="resaltado">` | Texto resaltado visualmente como con fluorescente. |
| `<small>` | `<span class="pequeño">` | Letra pequeña legal, avisos de copyright, notas al pie. |
| `<code>` | Fuente monoespaciada | Fragmento de código informático. |
| `<time datetime="2026-10-12">` | Texto normal | Fecha/hora comprensible para máquinas y lectores. |
| `<del>` / `<ins>` | `<s>` / `<u>` | Texto eliminado y texto insertado (historial de cambios). |
| `<abbr title="Cascading...">` | Texto plano | Abreviaturas y siglas con significado al pasar el ratón. |

---

## 3. Formularios Accesibles

### Estructura de Control Accesible
Siempre vincular cada `<label>` con su `<input>` mediante `for` e `id`:
```html
<fieldset>
    <legend>Datos personales</legend>

    <label for="campo-nombre">Nombre completo:</label>
    <input type="text" id="campo-nombre" name="nombre" required placeholder="Ej: Noé Conde">

    <label for="campo-email">Correo electrónico:</label>
    <input type="email" id="campo-email" name="email" required>

    <label for="campo-edad">Edad:</label>
    <input type="number" id="campo-edad" name="edad" min="18" max="99" step="1">

    <label for="campo-pais">País:</label>
    <select id="campo-pais" name="pais">
        <option value="" disabled selected>Selecciona una opción...</option>
        <option value="es">España</option>
        <option value="fr">Francia</option>
    </select>
</fieldset>
```

---

## 4. Selectores CSS: Tipos y Sintaxis Completa

| Tipo de selector | Sintaxis | Ejemplo | Qué selecciona |
| :--- | :--- | :--- | :--- |
| **Universal** | `*` | `* { box-sizing: border-box; }` | **Absolutamente todos** los elementos del documento. |
| **De Elemento (Tipo)** | `etiqueta` | `p { color: blue; }` | Todos los elementos `<p>` del documento. |
| **De Clase** | `.nombre` | `.destacado { font-weight: bold; }` | Cualquier elemento con `class="destacado"`. |
| **De ID** | `#nombre` | `#cabecera { background: black; }` | El elemento único con `id="cabecera"`. |
| **Elemento + Clase** | `etiqueta.clase` | `h3.fondo_amarillo { color: red; }` | Solo los `<h3>` que además tengan `class="fondo_amarillo"`. |
| **Elemento + ID** | `etiqueta#id` | `button#btn-guardar { ... }` | El botón específico con ese ID. |
| **Agrupación** | `sel1, sel2` | `h1, h2, h3 { margin-bottom: 0.5em; }` | Aplica el mismo estilo a `h1`, `h2` **y** `h3`. |

---

## 5. Combinadores de Jerarquía (Relaciones en el DOM)

Representan cómo se relacionan los elementos en el árbol HTML:

```
<main>                ← Padre / Ancestro
   <div>              ← Hijo directo de main
       <p>            ← Hijo directo de div, descendiente de main
           <a></a>    ← Hijo directo de p
           <strong>   ← Hermano de a
       </p>
   </div>
</main>
```

| Combinador | Símbolo | Ejemplo | Significado exacto |
| :--- | :---: | :--- | :--- |
| **Descendiente** | *(espacio)* | `main p` | Cualquier `<p>` que esté **dentro** de `<main>` (a cualquier nivel de profundidad). |
| **Hijo Directo** | `>` | `main > div` | Solo los `<div>` que sean **hijos inmediatos** de `<main>` (1er nivel). |
| **Hermano Adyacente** | `+` | `h2 + p` | El elemento `<p>` que viene **inmediatamente después** de un `<h2>` (pegado a él). |
| **Hermano General** | `~` | `a ~ strong` | Cualquier `<strong>` que sea hermano de `<a>` y esté situado **después de él** en el mismo padre. |

---

## 6. Selectores de Atributo (Regla Mnemotécnica)

Permiten seleccionar elementos según sus atributos HTML (`href`, `type`, `src`, `title`, `target`...):

```css
/* 1. Tiene el atributo (sin importar el valor) */
input[required] { border: 2px solid red; }

/* 2. Coincidencia EXACTA */
input[type="email"] { background-color: #f0f8ff; }
```

### 🧠 Regla Mnemotécnica para subcadenas:
| Símbolo | Mnemotecnia | Ejemplo | Significado |
| :---: | :--- | :--- | :--- |
| **`^=`** | El acento circunflejo `^` apunta hacia **arriba/inicio**. | `a[href^="https:"]` | El valor **empieza por** `"https:"`. |
| **`$=`** | El dólar `$` va al **final** (como fin de línea en Regex). | `a[href$=".es"]` | El valor **termina en** `".es"` (ej: webs de España). |
| **`*=`** | El asterisco `*` es un comodín **universal**. | `a[href*="google"]` | El valor **contiene** `"google"` en cualquier parte. |
| **`~=`** | La tilde de la eñe `~` separa palabras sueltas. | `img[alt~="logo"]` | Contiene la palabra `"logo"` aislada entre espacios. |
| **`\|=`** | La barra `\|` separa idiomas o guiones. | `[lang\|="es"]` | Empieza por `"es"` o `"es-ES"`, `"es-MX"`... |

---

## 7. Pseudoclases y Pseudoelementos

### Pseudoclases de Estado e Interacción
* `:hover`: Cuando el ratón pasa por encima (`a:hover`).
* `:active`: En el momento en que se hace clic (`button:active`).
* `:focus`: Cuando el control tiene el foco de teclado/escritura (`input:focus`).
* `:visited`: Enlaces ya visitados (`a:visited`).

### Pseudoclases Estructurales y de Filtro (Muy habituales en examen)
* `:not(selector)`: **Negación**. Selecciona todos excepto el indicado:
  ```css
  h3:not(#titulo3b) { color: red; } /* Todos los h3 excepto el de id titulo3b */
  ```
* `:first-child`: El elemento si es el primer hijo de su padre.
* `:last-child`: El elemento si es el último hijo de su padre.
* `:first-of-type` / `:last-of-type`: El primer/último de su tipo de etiqueta dentro del padre.
* `:nth-child(n)`: Selecciona según una fórmula matemática:
  ```css
  tr:nth-child(even) { background: #f2f2f2; }  /* Filas pares */
  tr:nth-child(odd)  { background: #ffffff; }  /* Filas impares */
  li:nth-child(3)    { font-weight: bold; }    /* Solo el 3er elemento */
  li:nth-child(3n+1) { color: blue; }          /* El 1º, 4º, 7º, 10º... */
  ```
* `:is(sel1, sel2)`: **Agrupador compacto**. Aplica estilos si coincide con cualquiera de la lista:
  ```css
  :is(section, aside).tarjeta { padding: 1rem; } /* Equivale a section.tarjeta, aside.tarjeta */
  ```

### Pseudoclases de Formularios
* `:checked`: Checkbox o radio button marcado.
* `:disabled` / `:enabled`: Elementos deshabilitados o activos.
* `:valid` / `:invalid`: Campos que cumplen o no la validación HTML5.

### Pseudoelementos (`::`)
Afectan a partes específicas del texto o generan contenido decorativo:
* `::before` y `::after`: Generan contenido virtual antes o después del elemento (requieren `content: ""`):
  ```css
  a[href^="http"]::after {
      content: " ↗"; /* Icono de enlace externo */
  }
  ```
* `::first-letter`: Primera letra de un texto (para capitulares).
* `::placeholder`: Da estilo al texto de ayuda del input.

---

## 8. Cálculo de Especificidad y Cascada

Cuando dos o más reglas CSS compiten por el mismo elemento, el navegador aplica la de **mayor especificidad**.

### La regla de los 4 dígitos: `(A, B, C, D)`
1. **A — Estilos en línea:** Atributo `style="..."` en la etiqueta HTML = `(1, 0, 0, 0)`.
2. **B — IDs:** Cada `#identificador` suma `(0, 1, 0, 0)`.
3. **C — Clases, Pseudoclases y Atributos:** Cada `.clase`, `:hover`, `:not()` y `[attr]` suma `(0, 0, 1, 0)`.
4. **D — Elementos y Pseudoelementos:** Cada `p`, `h1`, `div`, `::before` suma `(0, 0, 0, 1)`.
5. *(El selector universal `*` y los combinadores `>`, `+`, `~` tienen peso `(0, 0, 0, 0)`).*

### Ejemplos Prácticos de Cálculo (Típico ejercicio de examen):
| Selector CSS | Desglose (Línea, ID, Clase, Elem) | Puntuación | Ganador |
| :--- | :---: | :---: | :---: |
| `p` | 0, 0, 0, 1 | `(0, 0, 0, 1)` | 4º |
| `.texto-azul` | 0, 0, 1, 0 | `(0, 0, 1, 0)` | 3º |
| `p.texto-azul` | 0, 0, 1, 1 | `(0, 0, 1, 1)` | 2º |
| `main > p.texto-azul` | 0, 0, 1, 2 | `(0, 0, 1, 2)` | Gana a la anterior |
| `#parrafo-destacado` | 0, 1, 0, 0 | `(0, 1, 0, 0)` | **1º (Gana a todas las clases)** |
| `!important` | *(Fuerza bruta: anula el cálculo ordinario)* | — | ⚠️ Evitar en lo posible |

> 📌 **Regla de oro de empate:** Si dos selectores tienen exactamente la misma puntuación de especificidad, **gana el que esté escrito más abajo** en la hoja de estilos (orden de cascada).

---

## 9. Modelo de Caja (Box Model) y Unidades

### Estructura de la Caja
```
+------------------------------------+
|               MARGIN               | (Espacio exterior transparente)
|  +------------------------------+  |
|  |           BORDER             |  | (Borde visible)
|  |  +------------------------+  |  |
|  |  |        PADDING         |  |  | (Sangría / relleno interior)
|  |  |  +------------------+  |  |  |
|  |  |  |     CONTENT      |  |  |  | (Texto, imagen o hijos)
|  |  |  +------------------+  |  |  |
|  |  +------------------------+  |  |
|  +------------------------------+  |
+------------------------------------+
```

### El Reseteo Moderno Universal
```css
*, *::before, *::after {
    box-sizing: border-box; /* El padding y border NO aumentan el ancho total */
    margin: 0;
    padding: 0;
}
```

### Shorthand (Sentido de las agujas del reloj: Arriba → Derecha → Abajo → Izquierda)
```css
/* 4 valores: Arriba, Derecha, Abajo, Izquierda (TRBL) */
margin: 10px 20px 30px 40px;

/* 2 valores: [Arriba/Abajo] [Derecha/Izquierda] */
margin: 1rem auto; /* Centrado horizontal automático */

/* 1 valor: Los 4 lados iguales */
padding: 1.5rem;
```

### Unidades en CSS
| Unidad | Tipo | Referencia | Uso ideal |
| :--- | :--- | :--- | :--- |
| `px` | Absoluta | Píxeles de pantalla. | Bordes finos (`1px solid #ccc`). |
| `rem` | Relativa | Al `font-size` del `<html>` (raíz: 16px por defecto). | **Tipografía, paddings y layout (escalable).** |
| `em` | Relativa | Al `font-size` del padre directo (se acumula). | Márgenes dependientes del tamaño de su propio texto. |
| `%` | Relativa | Al ancho o alto del contenedor padre. | Anchos fluidos de columnas. |
| `vw` / `vh` | Relativa | 1% del ancho (`vw`) o alto (`vh`) de la ventana del navegador. | Secciones a pantalla completa (`min-height: 100vh`). |

---

## 10. Display, Posicionamiento y Buenas Prácticas

### Tipos de `display` básicos
* `block`: Ocupa todo el ancho disponible y fuerza salto de línea (`<div>`, `<p>`, `<h1>`, `<header>`).
* `inline`: Solo ocupa el espacio de su contenido, no acepta `width`/`height` ni márgenes verticales (`<a>`, `<span>`, `<strong>`).
* `inline-block`: Se comporta como línea pero **sí** admite dimensiones y padding.
* `none`: Oculta el elemento por completo (desaparece del flujo y no ocupa espacio).

### Propiedades de `position`
* `static`: Posición natural por defecto según el flujo del documento.
* `relative`: Se desplaza respecto a su posición original (`top`, `left`), pero mantiene el hueco libre.
* `absolute`: Se despega del flujo y se posiciona relativo al **ancestro posicionado más cercano** (el primer padre con `position: relative`).
* `fixed`: Se fija en la pantalla y no se mueve aunque hagas scroll (menús fijos, botones de chat flotantes).
* `sticky`: Fluye con el scroll pero se "pega" arriba o abajo al llegar a cierta coordenada (`top: 0`).

---

## 11. Variables CSS (Custom Properties)

Permiten centralizar colores, tipografías y espaciados para no repetir valores mágicos a mano:

### Declaración en `:root` (Visibilidad Global)
```css
:root {
    /* Colores */
    --color-primario: #1e3a5f;
    --color-fondo-app: #f4f6f8;
    --color-borde: #e2e8f0;

    /* Tipografía y Tamaños */
    --fuente-principal: system-ui, sans-serif;
    --tamano-base: 16px;
    --tamano-sm: 0.875rem;

    /* Espaciados */
    --espacio-xs: 0.25rem;
    --espacio-sm: 0.5rem;
    --espacio-md: 1rem;
}
```

### Uso con `var(--nombre)`
```css
body {
    font-family: var(--fuente-principal);
    background-color: var(--color-fondo-app);
    padding: var(--espacio-md);
}

/* Con valor de respaldo (fallback) por si la variable no existe */
h1 {
    color: var(--color-primario, #000000);
}
```

### ¿Cuándo SÍ y cuándo NO usar variables CSS?
* **SÍ usar variables:** Para valores del **sistema de diseño global** que se reutilizan en múltiples sitios (paleta de colores, escala tipográfica, escala de `margin`/`padding`, radios de bordes `--radio-sm`, sombras estándar).
* **NO usar variables:** Para dimensiones puntuales exclusivas de un solo elemento (ej: el ancho de una foto de carnet `width: 85px;` o anchos en porcentaje `width: 32%;`). Llenar `:root` de variables de un solo uso solo añade ruido y dificulta el mantenimiento.

---

## 12. Mobile First y Resolución de Desbordamientos (Overflow)

### Contenedor Estándar Mobile First (Savall)
Para maquetar centrado y adaptable en móviles sin frameworks:
```css
body {
    width: 100%;
    max-width: 650px; /* Ancho máximo para que no se estire en pantallas grandes */
    margin: 0 auto;   /* Centrado horizontal automático */
    padding: var(--espacio-md);
}
```

### ¿Por qué desbordan los emails/URLs en móvil y cómo arreglarlo?
* **El problema:** Por defecto, los navegadores consideran que las cadenas continuas sin espacios (`ncondevila@gmail.com` o `https://muy-larga...`) son una sola palabra indivisible. En pantallas estrechas (360px), esto fuerza a la celda de una tabla o párrafo a ensancharse más allá de la pantalla, rompiendo la maquetación.
* **La solución profesional:**
```css
td, p, a {
    word-break: break-word;   /* Permite partir palabras solo si desbordan */
    overflow-wrap: anywhere;  /* Garantiza ruptura limpia en cualquier punto necesario */
}
```

### Distribución de Columnas en Tablas Móviles
Si una tabla tiene varias columnas en móvil:
1. Dar un ancho fijo y contenido a la foto (`width: 85px` y `img { max-width: 75px; }`).
2. Reducir el padding lateral de las celdas a `var(--espacio-xs)`.
3. Dejar que los valores de texto respiren sin forzar porcentajes rígidos que ahoguen la tercera columna.

---

## 13. Tipografía en CSS3: Google Fonts vs @font-face

Para cumplir con rúbricas de fuentes externas y locales:

### 1. Fuente Externa con `@import` (Google Fonts)
Solo sirve para importar **archivos CSS o URLs web que devuelven CSS**. **NUNCA** se usa para enlazar archivos binarios directos (`.ttf`, `.otf`).
```css
/* Debe ir siempre arriba del todo, justo debajo de @charset */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
}
```

### 2. Fuente Local Descargada con `@font-face`
Es la regla nativa de CSS3 para registrar archivos binarios locales (`.ttf`, `.otf`) colocados en una carpeta `fonts/`:
```css
@font-face {
    font-family: 'MiFuenteLocal';
    src: url('../fonts/NombreFuente-Regular.ttf') format('truetype');
    /* Si fuera .otf se usa format('opentype') */
}

h1, h2 {
    font-family: 'MiFuenteLocal', cursive, sans-serif;
}
```

---

## 14. Efectos Visuales CSS3: Sombras, Degradados y Fondos

### Sombras (`box-shadow` y `text-shadow`)
Sintaxis: `desplazamiento-X  desplazamiento-Y  difuminado  color`
```css
/* Sombra en cajas/tarjetas (da relieve y profundidad) */
.tarjeta {
    box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12);
}

/* Sombra en texto (para títulos destacados) */
h1 {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
```

### Degradados (`linear-gradient`)
```css
/* Fondo o botón con degradado en ángulo */
button {
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    border: none;
    color: #ffffff;
}

/* Línea divisoria elegante que se difumina por los lados */
hr {
    border: 0;
    height: 2px;
    background: linear-gradient(to right, transparent, #e0e7ff, transparent);
}
```

### Fondos con Patrón y Fijos (`background-attachment: fixed`)
```css
body {
    background-color: #f0f2f5;
    background-image: url('../img/pattern.png');
    background-repeat: repeat;
    background-attachment: fixed; /* El fondo se queda quieto mientras el contenido hace scroll */
}
```

---

## 15. Sintaxis Extendida: Con Espacio vs Sin Espacio

La presencia o ausencia de un espacio cambia radicalmente el significado del selector:

| Selector | Espacio | Significado | Ejemplo HTML que coincide |
| :--- | :---: | :--- | :--- |
| `aside#intereses` | **Sin espacio** | El **mismo elemento** es un `<aside>` y tiene el `id="intereses"`. | `<aside id="intereses">` |
| `aside #intereses` | **Con espacio** | Busca un elemento `#intereses` que esté **dentro** de un `<aside>` (descendiente). | `<aside><div id="intereses"></div></aside>` |
| `button.btn-estilo` | **Sin espacio** | Una etiqueta `<button>` que tiene la clase `.btn-estilo`. | `<button class="btn-estilo">` |
| `table td.celda-foto` | Combinado | Un `<td>` con clase `.celda-foto` que está dentro de una `table`. | `<table><tr><td class="celda-foto">` |

> 💡 **Recomendación de examen (Savall):** Usa siempre selectores con sintaxis extendida (`main .tarjeta>h2`, `table tr td.foto`) para ganar especificidad natural y evitar colisiones de estilos sin recurrir a `!important`.

