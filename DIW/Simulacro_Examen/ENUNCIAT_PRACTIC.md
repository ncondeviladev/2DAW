# 🎨 Simulacre d'Examen Pràctic: EcoGandia Mobile (HTML5 & CSS3)

> **Mòdul:** Disseny d'Interfícies Web (DIW) · 2n CFGS DAW  
> **Professor:** Quique Savall  
> **Temps estimat:** 2 hores i 10 minuts  
> **Puntuació:** 7,5 punts (sobre 10)  
> **Material permès:** Chuleta oficial de Manz (`CSS_Chuletas.pdf`) + Chuleta A4 pròpia (`CHULETA_A4_DEFINITIVA.pdf`). Sense frameworks CSS ni internet extern.  

---

## 1. Context del Projecte

L'empresa de mobilitat sostenible **EcoGandia** et demana desenvolupar la **versió mòbil (Mobile First)** del seu lloc web corporatiu.

Hauràs de crear **3 pàgines HTML vinculades entre si** mitjançant un menú de navegació mòbil comú:
1. **`index.html` (Portada):** Header amb logo, banner d'impacte (Hero), graella a 2 columnes amb Flexbox dels vehicles destacats i footer.
2. **`tarifes.html` (Preus i Condicions):** Taula de preus estilizada amb files alternes (zebra striping), integració multimèdia (mapa iframe o vídeo) i botó de reserva.
3. **`contacte.html` (Reserva i Contacte):** Formulari accessible complet amb camps validats, llista de suggeriments (`<datalist>`) i botó d'enviament.

Tot el disseny estarà controlat per un únic arxiu de full d'estils: **`css/estilos.css`**.

---

## 2. Mockups Visuals (Disseny Mòbil ~380px)

### Pàgina 1: `index.html` (Portada)
```text
+------------------------------------------+
|  [Logo] EcoGandia           [ Menú ☰ ]  |  <- Header Sticky (position: sticky; top:0)
+------------------------------------------+
|  [ Inil ]   [ Tarifes ]   [ Contacte ]   |  <- Nav (Flexbox horitzontal amb botons)
+------------------------------------------+
| ======================================== |
|       MOBILITAT VERDA A GANDIA           |  <- Hero / Banner d'impacte
|   Lloga patinets i bicicletes elèctriques|
|   [ Veure Tarifes -> ]                   |  <- Botó CTA amb transició hover
| ======================================== |
|                                          |
|  Els Nostres Vehicles Destacats          |  <- Section amb H2
|  +-------------------+-----------------+ |
|  | [Foto Patinet]    | [Foto Bici]     | |  <- Graella Flexbox (2 columnes mòbil)
|  | Patinet CityPro   | Bici UrbanE     | |     (flex-flow: row wrap; gap: 10px)
|  | Des de 5€/hora    | Des de 8€/hora  | |     Targetes (.card) amb transform: scale
|  +-------------------+-----------------+ |
|                                          |
+------------------------------------------+
|  (c) 2026 EcoGandia - Noé Conde Vila     |  <- Footer semàntic
+------------------------------------------+
```

### Pàgina 2: `tarifes.html` (Taula i Multimèdia)
```text
+------------------------------------------+
|  [Logo] EcoGandia           [ Menú ☰ ]  |
+------------------------------------------+
|  [ Inil ]   [ Tarifes ]   [ Contacte ]   |
+------------------------------------------+
|  Tarifes de Lloguer i Abonaments         |  <- H2
|                                          |
|  +-------------------------------------+ |
|  | Vehicle    | 1 Hora  | Dia Sencer   | |  <- <table> amb <thead>, <th>
|  +------------+---------+--------------+ |
|  | Patinet    | 5,00 €  | 22,00 €      | |  <- <tbody> amb zebra striping
|  | Bici Urb.  | 8,00 €  | 30,00 €      | |     (:nth-child(even))
|  | Bici Càrrec| 12,00 € | 45,00 €      | |
|  +-------------------------------------+ |
|                                          |
|  On Trobar-nos? (Punts de Recollida)     |  <- H2
|  [ Iframe Mapa o Vídeo Promocional ]     |  <- Iframe responsive (width: 100%)
|                                          |
+------------------------------------------+
|  (c) 2026 EcoGandia - Noé Conde Vila     |
+------------------------------------------+
```

### Pàgina 3: `contacte.html` (Formulari)
```text
+------------------------------------------+
|  [Logo] EcoGandia           [ Menú ☰ ]  |
+------------------------------------------+
|  [ Inil ]   [ Tarifes ]   [ Contacte ]   |
+------------------------------------------+
|  Reserva el teu Vehicle                  |  <- H2
|  +-------------------------------------+ |
|  |  Dades de la Reserva (Fieldset)     | |  <- <fieldset> i <legend>
|  |                                     | |
|  |  Nom i Cognoms *                    | |  <- <label for="nom">
|  |  [ Ex: Maria Garcia            ]   | |  <- input required autofocus
|  |                                     | |
|  |  Correu Electrònic *                | |  <- input type="email" required
|  |  [ usuari@correu.com           ]   | |
|  |                                     | |
|  |  Punt de Recollida * (Datalist)     | |  <- input list="punts"
|  |  [ Selecciona o escriu...      ]   | |  <- <datalist id="punts">
|  |                                     | |
|  |  Hores de lloguer (Min: 1, Max: 8)  | |  <- input type="number" min="1" max="8"
|  |  [ 2                           ]   | |
|  |                                     | |
|  |  [ Reservar Ara ]                   | |  <- input type="submit"
|  +-------------------------------------+ |
+------------------------------------------+
|  (c) 2026 EcoGandia - Noé Conde Vila     |
+------------------------------------------+
```

---

## 3. Requisits Tècnics Obligatoris (Criteris Savall)

### 3.1. Estructura de Carpetes i Arxius:
```text
Simulacro_Examen/practica/
├── index.html
├── tarifes.html
├── contacte.html
├── css/
│   └── estilos.css
└── img/
    ├── logo.svg (o logo.png)
    ├── patinet.jpg
    └── bici.jpg
```

### 3.2. Qualitat HTML5 (Sense errors W3C):
1. **Zero text nu:** Tot text dins del `<body>` ha d'estar embolicat en elements semàntics (`<p>`, `<li>`, `<h1>`, `<th>`, `<td>`).
2. **Jerarquia de títols estricta:** Un **únic `<h1>`** per pàgina en el `<header>`. Els apartats interns van amb `<h2>` o `<h3>`.
3. **Imatges accessibles:** Totes amb atribut `alt="..."` descriptiu obligatori.
4. **Metadades a les 3 pàgines:** `charset="utf-8"`, `viewport`, `author="Noé Conde"`, `robots="index, follow"` i `theme-color`.

### 3.3. Estils CSS3 (`css/estilos.css`):
1. **Inicialització obligatòria:**
   ```css
   @charset "utf-8";
   * {
     box-sizing: border-box;
     margin: 0;
     padding: 0;
   }
   :root {
     --color-primari: #059669; /* Verd maragda */
     --color-secundari: #0f172a; /* Blau fosc pissarra */
     --color-fons: #f8fafc;
     --color-text: #1e293b;
     --font-ppal: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
   }
   ```
2. **Menú de Navegació Sticky:**
   El menú o capçalera ha de romandre fix a la part superior en fer scroll (`position: sticky; top: 0; z-index: 100;`).
3. **Flexbox Canònic per a les targetes:**
   La secció de vehicles destacats a `index.html` ha d'utilitzar Flexbox per a posar les dues targetes a 2 columnes:
   ```css
   .grid-vehicles {
     display: flex;
     flex-flow: row wrap;
     gap: 12px;
   }
   .card {
     flex: 1 1 calc(50% - 12px);
     min-width: 140px;
   }
   ```
4. **Efectes i Transicions:**
   Les targetes `.card` o el botó CTA han de tindre un efecte de pujada suau en fer hover:
   `transition: transform 0.3s ease, box-shadow 0.3s ease;` i `transform: translateY(-4px) scale(1.02);`.
5. **Taula Estilitzada a `tarifes.html`:**
   - Amplada `100%`, `border-collapse: collapse;`.
   - `thead` amb fons fosc i lletra blanca.
   - Files del `tbody` amb zebra striping: `tbody tr:nth-child(even) { background-color: #f1f5f9; }`.

---

## 4. Recursos Disponibles

- Pots utilitzar la teua chuleta impresa: [**`CHULETA_A4_DEFINITIVA.pdf`**](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DIW/CHULETA_A4_DEFINITIVA.pdf).
- I la guia teòrica completa: [**`guia_DIW.md`**](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DIW/guia_DIW.md).
