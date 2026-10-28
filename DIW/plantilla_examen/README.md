# 🛡️ Plantilla Maestra de Examen DIW — Guía de Uso Rápido
> **Asignatura:** Disseny d'Interfícies Web (2º DAW Semipresencial)  
> **Profesor:** Quique Savall  
> **Estudiante:** Noé Conde Vila  
> **Examen:** Viernes 20 de Noviembre de 2026, 12:00 a 15:00 (Gandia)

---

## 🎯 ¿Para qué sirve esta plantilla?
Esta plantilla es una **"Navaja Suiza"** de diseño web en HTML5 y CSS3 puro. Contiene el **100% de las estructuras, etiquetas, propiedades y selectores** evaluados en la 1ª evaluación (UD1 y UD2):

1. **Estructura HTML5 Semántica Estricta:**
   - Cumple 100% con la validación del W3C (0 errores, 0 avisos).
   - Un único `<h1>` en el documento (en la sección Hero).
   - Jerarquía lógica natural (`h1` ➔ `h2` ➔ `h3`).
   - Cero texto desnudo: todo está envuelto en etiquetas con significado.
   - Metadatos completos de autoría, SEO y viewport.
   - Enlaces accesibles con `target="_blank"` y `rel="noopener"`.

2. **CSS3 Modular con Tokens de Diseño (`:root`):**
   - **Genérico y reutilizable:** Clases con nombres estándar (`.card`, `.btn`, `.form-grupo`, `.tabla-contenedor`).
   - **Cambio de temática en 10 segundos:** Si el examen pide una web sobre "Restaurante", "Clínica Dental" o "Gimnasio", solo cambias 3 variables en `:root` (`--color-primario`, `--color-secundario`, `--color-fondo-app`) y todo el diseño se adapta solo.
   - **Mobile First Real:** Estilos base optimizados para smartphones (360px–480px), y media queries a partir de `min-width: 768px` y `1024px`.
   - **Solución al desbordamiento:** `word-break: break-word` y `overflow-wrap: anywhere` en todos los textos y tablas.
   - **Tipografía híbrida:** Soporte para Google Fonts (`Inter` / `Outfit`) y fuente local descargada vía `@font-face` (`fonts/Righteous-Regular.ttf`).
   - **Todos los tipos de controles de formulario:** Texto, email, teléfono con pattern, fecha, select, radio buttons, checkboxes, slider de rango (`<input type="range">`), textarea, botones submit y reset.

---

## 📂 Estructura de Archivos del Proyecto
```text
plantilla_examen/
│
├── index.html          ← Versión completa con CONTENIDO DE PRUEBA (TechNova) para ver el preview visual
├── esqueleto.html      ← Versión LIMPIA "en blanco" lista para rellenar en el examen con tus textos
├── README.md           ← Esta guía de referencia rápida
├── css/
│   └── estilos.css     ← Hoja de estilos compartida, 100% modular y comentada bloque por bloque
├── fonts/
│   └── Righteous-Regular.ttf  ← Fuente binaria local para la regla @font-face
└── img/
    └── pattern.png     ← Textura de fondo repetible con background-attachment: fixed
```

---

## ⚡ Estrategia para el Examen (Técnica de la Poda)
Durante el examen de 2.5 a 3 horas, crear una web desde cero consume mucho tiempo pensando nombres de clases o recordando sintaxis exactas (`scope="col"`, `pattern="[0-9]{9}"`, `box-sizing`, `grid-template-columns`, etc.).

**Tu flujo de trabajo el día del examen:**
1. **Elige tu punto de partida:**
   - **Opción A (Recomendada): Usa `esqueleto.html`:** Ya tiene todas las etiquetas semánticas y clases vinculadas pero **completamente limpias de texto** (`[Título aquí]`, `[Opción 1]`). Solo vas sustituyendo los textos por los del enunciado del examen.
   - **Opción B: Usa `index.html`:** Si prefieres ver el contenido de prueba (TechNova) e ir podando/modificando lo que ya está escrito.
2. **¿Y el CSS? ¡Mantén `css/estilos.css` intacto!:**
   - Como bien observaste, lo difícil y lento de CSS no son los selectores, sino **los atributos internos** (`repeat(auto-fit, minmax(280px, 1fr))`, `box-sizing`, `overflow-wrap`, `display: flex`, etc.).
   - Al usar las mismas clases estándar (`.card`, `.btn-primary`, `.form-grupo`, `.tabla-contenedor`), **cualquier texto que metas en `esqueleto.html` se maquetará de inmediato con aspecto 100% profesional**.
   - Solo necesitas modificar las 3 variables de colores en `:root` para darle la temática pedida (médica, deportiva, comercial, etc.).
3. **Poda lo que no te pidan (Técnica de eliminación):**
   - ¿El enunciado solo pide un formulario y una tabla? 👉 Borras las secciones `<section id="seccion-cards">` y `<section id="seccion-multimedia">`.
   - ¿Piden 4 tarjetas en vez de 3? 👉 Duplicas un bloque `<article class="card">` (el CSS Grid las recolocará automáticamente sin tocar una sola línea de CSS).
   - ¿Te piden preguntas de selectores avanzados? 👉 Tienes ejemplos funcionales de `^=`, `$=`, `:not()`, `:is()`, `:nth-child(even)` listos en la sección 14 de `estilos.css`.
4. **Valida en el Validador W3C:** Cero sorpresas.

---

## 💡 ¿Y si entra temario nuevo en las semanas que quedan?
El examen es el 20 de noviembre. Si en los próximos días Quique introduce:
- **Animaciones CSS con `@keyframes`:** Se añade una sección de animaciones en `estilos.css`.
- **Efectos de Filtro (`filter: blur / grayscale`):** Se integran en `.card:hover` o en las imágenes.
- **Transiciones avanzadas o diálogos `<dialog>`:** La base ya está construida de forma tan limpia y desacoplada que cualquier nuevo concepto entra en 2 minutos sin romper nada.
