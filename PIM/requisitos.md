<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.6;
    color: #24292f;
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
  }
  blockquote {
    background-color: #f6f8fa;
    border-left: 4px solid #1e3a8a;
    padding: 10px 16px;
    margin: 14px 0;
    color: #374151;
  }
  h1 {
    color: #0f172a;
    border-bottom: 2px solid #1e3a8a;
    padding-bottom: 8px;
  }
  h2 {
    color: #1e3a8a;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 6px;
    margin-top: 28px;
  }
  h3 {
    color: #1e293b;
    margin-top: 20px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 16px 0;
  }
  th, td {
    border: 1px solid #cbd5e1;
    padding: 8px 12px;
    text-align: left;
  }
  th {
    background-color: #f1f5f9;
    color: #0f172a;
  }
  .req-id {
    font-weight: bold;
    color: #1e3a8a;
    white-space: nowrap;
  }
  .req-formula {
    color: #1e3a8a;
  }
  .badge {
    display: inline-block;
    padding: 2px 8px;
    font-size: 0.85em;
    font-weight: bold;
    border-radius: 4px;
    background-color: #e0e7ff;
    color: #1e3a8a;
  }
  @media print {
    body {
      max-width: 100%;
      padding: 0;
    }
    h1, h2, h3 {
      page-break-after: avoid;
      break-after: avoid;
    }
    table, tr {
      page-break-inside: avoid;
    }
  }
</style>

# PIM — Sprint 0: Reto 1C — Documento de Especificación de Requisitos de Usuario

> **Documento:** Especificación Formal de Requisitos (SRS Preliminar)  
> **Proyecto:** Web App Meteorológica y Marítima para Deportes Náuticos y Aguas Abiertas  
> **Alumno:** Noé Conde Vila (2º DAW — Modalidad Semipresencial)  
> **Centro:** IES Maria Enríquez (Gandia)  
> **Módulo:** Projecte Intermodular (PIM) — Sprint 0  
> **Cliente / Profesor:** Quique Savall (Dunes Kite Piles / Gandia Surf / MirandoAlMar)  
> **Fecha:** Octubre de 2026  

---

## 📑 Índice de Contenidos
1. [Introducción y Contexto del Proyecto](#1-introducción-y-contexto-del-proyecto)
   - 1.1. Propósito y Misión de la Aplicación
   - 1.2. Perfil del Cliente y Clubes Promotores
   - 1.3. Público Objetivo y Nicho de Mercado
2. [Estado del Arte y Estudio de Competencia](#2-estado-del-arte-y-estudio-de-competencia)
3. [Requisitos Funcionales (RF)](#3-requisitos-funcionales-rf)
   - 3.1. Gestión de Datos Meteorológicos y Marítimos
   - 3.2. Visualización Multimedia y Webcams en Tiempo Real
   - 3.3. Motor de Predicción Inteligente e Inteligencia Artificial (IA)
   - 3.4. Gestión de Usuarios, Personalización y Favoritos
   - 3.5. Módulo Comercial y Negocio Local (Comercios Asociados)
4. [Requisitos Visuales y de Interfaz (UI/UX)](#4-requisitos-visuales-y-de-interfaz-uiux)
5. [Requisitos Técnicos y de Arquitectura (RT)](#5-requisitos-técnicos-y-de-arquitectura-rt)
6. [Requisitos Legales y de Seguridad (RL)](#6-requisitos-legales-y-de-seguridad-rl)
7. [Matriz de Priorización de Requisitos (MoSCoW)](#7-matriz-de-priorización-de-requisitos-moscow)

---

## 1. Introducción y Contexto del Proyecto

### 1.1. Propósito y Misión de la Aplicación
El proyecto nace de la necesidad de proporcionar una herramienta digital ágil, moderna y visualmente intuitiva que permita consultar en tiempo real el estado del mar y la previsión meteorológica en las costas de la Comunidad Valenciana (con foco prioritario en la comarca de La Safor y comarcas limítrofes).

A diferencia de las plataformas tradicionales basadas en tablas numéricas densas y de difícil lectura en dispositivos móviles, esta solución unifica:
- Mediciones fiables en directo (boyas y estaciones oficiales).
- Predicción basada en modelos abiertos contrastados.
- Transmisión visual directa (webcams en directo).
- Recomendaciones sintéticas generadas mediante técnicas de Inteligencia Artificial (IA).

### 1.2. Perfil del Cliente y Clubes Promotores
- **Cliente:** Quique Savall, profesional y promotor náutico.
- **Entidades vinculadas:**
  - **Dunes Kite Piles:** Club de kitesurf ubicado en la playa de Piles (adyacente a Oliva).
  - **Gandia Surf:** Club de deportes náuticos en Gandia.
- **Objetivo estratégico:** Mejorar la seguridad de los deportistas, dinamizar la comunidad local de deportes de mar y canalizar usuarios hacia servicios asociados (cursos, alquiler de material y comercios náuticos).

### 1.3. Público Objetivo y Nicho de Mercado
Se identifican dos grandes grupos de usuarios:
1. **Deportistas de viento y olas (alta dependencia técnica):** Practicantes de kitesurf, windsurf, wingfoil y surf que requieren datos precisos de fuerza y rachas de viento, dirección y periodo de ola.
2. **Deportistas de mar plana y aguas abiertas (nicho en auge):** Comunidad creciente de nadadores de aguas abiertas (travesías), practicantes de stand-up paddle (SUP) y kayak, que buscan condiciones de mar calma, temperatura del agua y ausencia de corrientes peligrosas o medusas.

---

## 2. Estado del Arte y Estudio de Competencia

A partir de las rutinas de consulta expuestas por el cliente en la entrevista, se analiza la competencia de referencia:

| Plataforma | Puntos Fuertes Identificados | Carencias / Puntos de Fricción | Oportunidad para Nuestra App |
| :--- | :--- | :--- | :--- |
| **Windguru** | Alta fiabilidad en predicción de viento y olas; gran detalle de modelos (GFS, ICON). | Interfaz anticuada, tablas de números densas, difícil de interpretar rápidamente en móvil bajo la luz del sol. | Presentar los datos clave mediante tarjetas limpias, códigos de color y resúmenes visuales. |
| **Windy** | Animaciones visuales de corrientes y viento excelentes en mapa global. | Requiere un aprendizaje elevado; saturación de capas y alto consumo de datos/batería. | Focalizar en spots concretos con información pre-filtrada lista para consumir. |
| **WindFinder** | Buena localización de spots y alertas de viento. | Publicidad intrusiva en versión gratuita; falta de integración de webcams locales fiables. | Modelo freemium limpio, integración directa de webcams autonómicas y locales. |
| **Webcams oficiales (GVA / Oceanía)** | Permiten verificar el estado visual real del mar en Calp, Tavernes, Gandia, etc. | Dispersas en distintas páginas web institucionales sin vinculación a los datos numéricos de la estación. | Centralizar los feeds de webcam junto a la tarjeta meteorológica del spot. |

---

## 3. Requisitos Funcionales (RF)

> *Nota de formato:* Siguiendo las directrices del enunciado, los requisitos se definen mediante la fórmula normalizada:  
> **«El usuario podrá/dispondrá [acción]. Para hacerlo, el sistema [mecanismo]»** o **«El sitio deberá [funcionalidad]. Para ello, [implementación]»**.

### 3.1. Gestión de Datos Meteorológicos y Marítimos

* <span class="req-id">RF-01: Consulta de spots prioritarios</span>  
  <span class="req-formula">El usuario dispondrá de un listado y selector de spots costeros prioritarios (playa de Piles, Gandia, Oliva, Tavernes, Calp y litoral valenciano). Para hacerlo, el sistema ofrecerá un buscador predictivo y un acceso directo a las ubicaciones más populares.</span>

* <span class="req-id">RF-02: Visualización de variables de viento</span>  
  <span class="req-formula">El usuario podrá consultar en tiempo real y en previsión la velocidad del viento (en nudos y km/h), la dirección cardinal/flecha gráfica y la intensidad de las rachas máximas. Para hacerlo, el sistema consultará APIs meteorológicas abiertas y procesará los datos horarios.</span>

* <span class="req-id">RF-03: Visualización de variables de oleaje y mar</span>  
  <span class="req-formula">El usuario dispondrá de métricas marítimas esenciales: altura significativa de ola (metros), periodo entre olas (segundos) y dirección del mar de fondo (*swell*). Para lograrlo, el sistema integrará datos de boyas de Puertos del Estado y modelos marinos en abierto.</span>

* <span class="req-id">RF-04: Estado general del tiempo y temperatura</span>  
  <span class="req-formula">El usuario podrá verificar la probabilidad de lluvia, temperatura ambiente, temperatura superficial del agua y radiación UV. Para ello, el sistema integrará el pronóstico por franjas horarias de las estaciones AEMET/Open-Meteo correspondientes.</span>

* <span class="req-id">RF-05: Ventana temporal de pronóstico</span>  
  <span class="req-formula">El usuario dispondrá de una previsión detallada a corto plazo (horas actuales y próximas 48 horas) y una tendencia extendida a 5-7 días. Para hacerlo, el sistema estructurará la información en una línea temporal horizontal interactiva.</span>

---

### 3.2. Visualización Multimedia y Webcams en Tiempo Real

* <span class="req-id">RF-06: Centralización de webcams de playas</span>  
  <span class="req-formula">El usuario podrá visualizar imágenes en vivo o feeds actualizados de webcams situadas en los spots clave (cámaras de la Generalitat Valenciana y proveedores como Oceanía). Para hacerlo, el sistema integrará reproductores embebidos y capturas sincronizadas por spot para validar las condiciones antes de desplazarse.</span>

* <span class="req-id">RF-07: Verificación de estado visual inmediato</span>  
  <span class="req-formula">El sitio deberá permitir al usuario alternar entre la vista de datos técnicos y la vista de cámara en un solo toque. Para ello, cada ficha de spot contará con una pestaña multimedia vinculada.</span>

---

### 3.3. Motor de Predicción Inteligente e Inteligencia Artificial (IA)

* <span class="req-id">RF-08: Resumen inteligente del estado del mar (IA Asistencial)</span>  
  <span class="req-formula">El usuario dispondrá de una interpretación en lenguaje natural elaborada por IA que sintetice si las condiciones son favorables, complejas o peligrosas. Para hacerlo, un modelo de lenguaje o agente IA analizará el cruce de viento, rachas y periodo de ola traduciéndolo en una recomendación clara (ej.: *"Excelente para kitesurf a partir de las 15:00 con viento térmico de Garbí; desaconsejado para nado por resaca"*).</span>

* <span class="req-id">RF-09: Clasificación por perfil de deporte</span>  
  <span class="req-formula">El usuario podrá filtrar la idoneidad del spot según su deporte (Kitesurf, Windsurf, Surf, Natación en aguas abiertas, Paddle Surf). Para hacerlo, el sistema evaluará las condiciones contra reglas paramétricas adaptadas a cada disciplina (ej.: el surf requiere ola con periodo alto; el paddle surf requiere mar plato sin viento).</span>

* <span class="req-id">RF-10: Detección preventiva de alertas de seguridad</span>  
  <span class="req-formula">El sitio deberá generar avisos preventivos automáticos mediante IA cuando se detecten caídas bruscas de presión, giros de viento repentinos o condiciones peligrosas de resaca. Para ello, el sistema monitorizará las anomalías en los modelos de predicción cada 60 minutos.</span>

---

### 3.4. Gestión de Usuarios, Personalización y Favoritos

* <span class="req-id">RF-11: Acceso abierto vs. Registro de usuario</span>  
  <span class="req-formula">El usuario podrá consultar las condiciones generales y spots principales de forma pública sin registro. Para acceder a personalización (guardar spots favoritos, historial y alertas), el sistema ofrecerá un registro gratuito y sencillo mediante email o federación social.</span>

* <span class="req-id">RF-12: Lista de spots favoritos</span>  
  <span class="req-formula">El usuario registrado podrá anclar sus playas preferidas en el panel principal (*dashboard*). Para hacerlo, el sistema guardará sus preferencias asociadas a su cuenta para presentarlas al iniciar la app.</span>

---

### 3.5. Módulo Comercial y Negocio Local (Comercios Asociados)

* <span class="req-id">RF-13: Promoción de escuelas y comercios locales</span>  
  <span class="req-formula">El usuario podrá visualizar ofertas, servicios de alquiler de material y cursos impartidos por clubes asociados (Dunes Kite Piles, Gandia Surf). Para hacerlo, el sistema mostrará tarjetas de patrocinador no invasivas contextualizadas al spot seleccionado.</span>

* <span class="req-id">RF-14: Funcionalidades Premium / Monetización futura</span>  
  <span class="req-formula">El sitio deberá prever la segregación de cuentas gratuitas y cuentas *Pro/Premium*. Para ello, el sistema contemplará en su arquitectura accesos avanzados (previsión a 14 días, alertas SMS/push inmediatas y descuentos exclusivos en comercios náuticos).</span>

---

## 4. Requisitos Visuales y de Interfaz (UI/UX)

* <span class="req-id">RV-01: Enfoque *Mobile-First*</span>  
  El sitio deberá diseñarse prioritariamente para smartphones y pantallas táctiles, garantizando que el 100% de las funciones de consulta se ejecuten cómodamente con una sola mano.

* <span class="req-id">RV-02: Usabilidad bajo radiación solar intensa</span>  
  El sitio deberá ofrecer una interfaz con paleta de alto contraste, tipografías legibles y números de gran tamaño para las variables críticas (nudos, metros de ola), evitando contrastes pobres que impidan la lectura en la playa a pleno sol.

* <span class="req-id">RV-03: Semáforo visual de condiciones</span>  
  El sitio dispondrá de indicadores cromáticos unificados (verde = óptimo, amarillo = precaución / nivel avanzado, rojo = desfavorable / peligroso) que permitan al usuario evaluar en un vistazo el estado del spot sin necesidad de analizar cada cifra.

* <span class="req-id">RV-04: Diseño limpio y modular en tarjetas (*Cards*)</span>  
  La interfaz organizará la información en tarjetas modulares auto-contenidas: tarjeta de viento, tarjeta de mar, tarjeta de webcam y tarjeta de recomendación IA, minimizando el desplazamiento vertical excesivo.

* <span class="req-id">RV-05: Identidad náutica y deportiva</span>  
  El diseño visual adoptará una estética marina profesional (tonos azules marinos, cian, blancos puros y acentos de advertencia en naranja/amarillo náutico), transmitiendo fiabilidad, dinamismo y frescura.

---

## 5. Requisitos Técnicos y de Arquitectura (RT)

* <span class="req-id">RT-01: Arquitectura Web Responsive y PWA (Progressive Web App)</span>  
  El sistema se desarrollará como una aplicación web responsiva capaz de instalarse en la pantalla de inicio del móvil como una PWA ligera, permitiendo carga rápida sin necesidad de descargas desde tiendas de aplicaciones.

* <span class="req-id">RT-02: Integración de fuentes de datos abiertas y estandarizadas</span>  
  El backend consumirá datos de APIs meteorológicas públicas y contrastadas:
  - **Open-Meteo Marine / ECMWF / GFS** para modelos de viento y oleaje.
  - **Puertos del Estado / AEMET** para mediciones en tiempo real de boyas costeras de la zona.
  - Formatos de intercambio: REST en formato JSON con tipado estricto.

* <span class="req-id">RT-03: Caché eficiente y mitigación de baja cobertura</span>  
  Debido a que la cobertura móvil en espigones y playas puede ser irregular, el sistema implementará almacenamiento local en el cliente (*localStorage* / *IndexedDB*) y estrategias de caché (*Service Workers*) para mostrar la última previsión consultada en caso de pérdida de señal.

* <span class="req-id">RT-04: Rendimiento y optimización de carga</span>  
  El sitio deberá cargar los datos meteorológicos críticos en menos de 2 segundos en conexiones móviles 4G/5G, aplicando carga diferida (*lazy loading*) para las transmisiones de vídeo de las webcams.

* <span class="req-id">RT-05: Integración modular con servicio de IA</span>  
  La arquitectura dispondrá de un microservicio o endpoint que conectará con una API de Inteligencia Artificial (Gemini API) enviando el contexto numérico del spot para devolver la síntesis textual de recomendación sin bloquear la carga principal de datos.

---

## 6. Requisitos Legales y de Seguridad (RL)

* <span class="req-id">RL-01: Descargo de responsabilidad marítima (*Disclaimer*)</span>  
  El sitio deberá mostrar de forma visible un aviso legal explícito indicando que los datos mostrados son estimaciones y que la responsabilidad última de seguridad al ingresar al agua recae siempre en el propio navegante o nadador, eximiendo a la plataforma de accidentes derivados de cambios meteorológicos sobrevenidos.

* <span class="req-id">RL-02: Cumplimiento RGPD y LOPDGDD</span>  
  El sitio garantizará el cumplimiento estricto de la normativa europea de protección de datos: política de privacidad transparente, consentimiento explícito para usuarios registrados y posibilidad de ejercitar los derechos de acceso, rectificación y supresión de datos.

* <span class="req-id">RL-03: Política de cookies y almacenamiento local</span>  
  El sistema dispondrá de un banner de consentimiento de cookies conforme a las directrices de la AEPD, permitiendo al usuario configurar y aceptar únicamente las cookies técnicas necesarias si así lo desea.

---

## 7. Matriz de Priorización de Requisitos (MoSCoW)

Para planificar las siguientes fases del Sprint 0 y los sprints de desarrollo (DAW, DIW, DWS, DWC), se clasifican los requisitos acordados:

| Categoría | Requisitos Asignados | Justificación |
| :--- | :--- | :--- |
| **Must Have** *(Imprescindible para MVP)* | RF-01, RF-02, RF-03, RF-04, RV-01, RV-02, RV-03, RT-01, RT-02, RL-01 | Sin datos fiables de viento/mar en móvil y el aviso legal, la app no es viable operativamente. |
| **Should Have** *(Muy importante)* | RF-05, RF-06, RF-07, RF-08, RF-09, RV-04, RT-03, RT-04, RL-02, RL-03 | Webcams, resúmenes de IA por deporte y caché offline marcan la diferencia competitiva frente a Windguru. |
| **Could Have** *(Deseable si hay tiempo)* | RF-10, RF-11, RF-12, RF-13, RV-05, RT-05 | Alertas preventivas automatizadas, registro de usuarios para guardar favoritos y tarjetas comerciales. |
| **Won't Have** *(Para versiones futuras)* | RF-14 (Pasarela de pago y suscripción Premium activa) | Se diseña la arquitectura preparada, pero la monetización de cobro se abordará en sprints posteriores. |

---

> **Aprobado para entrega preliminar:** Documento elaborado siguiendo las directrices del Sprint 0 (PIM Reto 1C) para su validación por el cliente y el equipo docente.
