<style>
  body {
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    line-height: 1.6;
    color: #1e293b;
    max-width: 900px;
    margin: 0 auto;
    padding: 24px;
    background-color: #ffffff;
  }
  blockquote {
    background-color: #f0fdf4;
    border-left: 5px solid #0284c7;
    padding: 12px 18px;
    margin: 16px 0;
    color: #0f172a;
    border-radius: 0 6px 6px 0;
  }
  h1 {
    color: #0c4a6e;
    border-bottom: 3px solid #0284c7;
    padding-bottom: 10px;
    font-size: 1.9em;
  }
  h2 {
    color: #0369a1;
    border-bottom: 1px solid #cbd5e1;
    padding-bottom: 6px;
    margin-top: 28px;
    font-size: 1.35em;
  }
  h3 {
    color: #0f172a;
    margin-top: 20px;
    font-size: 1.15em;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 16px 0;
    font-size: 0.95em;
  }
  th, td {
    border: 1px solid #cbd5e1;
    padding: 8px 12px;
    text-align: left;
    vertical-align: top;
  }
  th {
    background-color: #f8fafc;
    color: #0f172a;
    font-weight: 600;
  }
  tr:nth-child(even) {
    background-color: #f8fafc;
  }
  .req-id {
    font-weight: bold;
    color: #0369a1;
  }
  .badge {
    display: inline-block;
    padding: 2px 7px;
    font-size: 0.8em;
    font-weight: 600;
    border-radius: 4px;
  }
  .badge-must { background-color: #fee2e2; color: #991b1b; }
  .badge-should { background-color: #fef3c7; color: #92400e; }
  .badge-could { background-color: #e0f2fe; color: #075985; }
  .badge-wont { background-color: #f1f5f9; color: #475569; }
</style>

# PIM — Sprint 0: Reto 1C — Especificación de Requisitos de Usuario (Borrador Resumido)

> **Documento:** Especificación de Requisitos de Usuario (SRS) — Versión Resumida de Revisión  
> **Proyecto:** Web App de Previsión Marítima Inteligente para Deportes Náuticos  
> **Alumno:** Noé Conde Vila (2º DAW — Semipresencial) — IES Maria Enríquez (Gandia)  
> **Cliente / Entrevistado:** Quique Savall (Dunes Kite Piles / Gandia Surf)  
> **Fecha de la entrevista:** 14 de octubre de 2026 (Reunión Teams con Quique y el equipo de alumnos)  
> **Objetivo de este borrador:** Documento ceñido 100% a lo tratado en la entrevista para revisión antes de la versión final limpia.

---

## 1. Resumen y Contexto Extraído de la Entrevista

* **Problema detectado por el cliente:**  
  Actualmente, para decidir si salir a navegar o al mar, Quique consulta **Windguru** (muy fiable pero con tablas numéricas densas y difíciles de interpretar a pleno sol en el móvil), **Windy** o **WindFinder**, y las **webcams** de la costa. Los usuarios casuales y deportistas pierden tiempo interpretando números y necesitan algo directo, visual y adaptado al móvil.
* **Solución acordada:**  
  Una aplicación web enfocada al móvil donde la Inteligencia Artificial actúa como una **«coctelera»** que cruza datos en tiempo real (boyas y estaciones oficiales) con modelos predictivos, mostrando de forma directa el **porcentaje de viabilidad (0% a 100%)** para cada deporte en **gráficos circulares («quesitos»)**.
* **Deportes tratados en la reunión:**
  1. **Natación en aguas abiertas:** Requiere mar plano, poco viento y ausencia de corrientes peligrosas (nicho en fuerte crecimiento).
  2. **Embarcaciones de vela ligera:** Sensibles a la fuerza y dirección del viento.
  3. **Deportes de viento (Kitesurf, Windsurf, Wingfoil):** Requieren viento constante (mínimo 12-15 nudos) y control de rachas.
* **Los 3 Spots prioritarios definidos por Quique:**
  1. **La Safor:** Piles (Dunes Kite) y Gandia (Gandia Surf / playa norte).
  2. **Dénia:** Zona del puerto y Les Marines.
  3. **Calpe / Altea:** Costa Blanca.
* **Ventanas de tiempo acordadas:** **4 horas, 8 horas y 24 horas**.

---

## 2. Requisitos Funcionales (RF)
*Redactados bajo la fórmula solicitada por Quique: «El usuario podrá/dispondrá [acción]. Para hacerlo, el sistema [mecanismo]»*

* **RF-01: Selección de los 3 spots costeros prioritarios**  
  El usuario dispondrá de un selector inicial con los 3 spots acordados (La Safor: Piles/Gandia, Dénia: Marines/Puerto, y Calpe/Altea). Para hacerlo, el sistema cargará al inicio la selección de spot y filtrará toda la información meteorológica en base a esa playa.

* **RF-02: Consulta de datos de viento y mar en tiempo real**  
  El usuario podrá consultar la velocidad del viento (en nudos), la dirección y las rachas máximas, así como el oleaje (altura y período). Para hacerlo, el sistema consumirá lecturas en tiempo real de boyas marítimas y estaciones oficiales abiertas.

* **RF-03: Previsión en tramos de 4h, 8h y 24h**  
  El usuario dispondrá de predicciones a corto plazo divididas en las ventanas clave de 4 horas, 8 horas y 24 horas. Para hacerlo, el sistema procesará los modelos meteorológicos y los agrupará en dichos intervalos.

* **RF-04: Visualización de webcams en directo del spot**  
  El usuario podrá ver la imagen en directo de las cámaras web oficiales de la zona (Generalitat Valenciana y Oceanía) para comprobar visualmente la arena y el rompiente antes de desplazarse. Para hacerlo, el sistema integrará el reproductor/feed de las webcams en la ficha del spot.

* **RF-05: Motor de viabilidad por IA con porcentaje gráfico (0% a 100%)**  
  El usuario dispondrá de un porcentaje de viabilidad (del 0% al 100%) para cada deporte en las franjas de 4h, 8h y 24h. Para hacerlo, la IA funcionará como «coctelera», cruzando los datos en tiempo real de boyas y modelos predictivos para calcular la probabilidad de practicar cada disciplina.

* **RF-06: Chatbot asistente: «Experto local a pie de playa»**  
  El usuario podrá consultar un asistente conversacional inteligente con el rol de un experto náutico local. Para hacerlo, el chatbot responderá preguntas sobre condiciones marítimas, vientos térmicos (Garbí/Llebeig), estado de banderas y recomendaciones de seguridad para el spot consultado.

* **RF-07: Registro y perfil de usuario (CRUD)**  
  El usuario deberá registrarse mediante un formulario sencillo para acceder de forma personalizada y guardar sus spots preferidos como favoritos. Para hacerlo, el sistema contará con gestión de cuentas de usuario almacenadas en base de datos.

* **RF-08: Indicador de afluencia comunitaria en el spot**  
  El usuario podrá consultar cuántos deportistas hay actualmente en la playa o navegando (*check-in* voluntario). Para hacerlo, el sistema permitirá a los usuarios registrados marcar su presencia en el spot.

* **RF-09: Promoción de escuelas y comercios locales asociados**  
  El usuario dispondrá de información de servicios, cursos y alquiler de material de los clubes colaboradores (Dunes Kite Piles, Gandia Surf). Para hacerlo, el sistema mostrará tarjetas de patrocinadores locales contextualizadas en el spot.

* **RF-10: Preparación para modelo Freemium / Premium**  
  El sitio deberá dejar su arquitectura preparada para una futura monetización de pago (ampliación de días de previsión o alertas personalizadas). Para ello, las funciones avanzadas quedarán desacopladas en la base de datos sin implementarse el cobro en esta fase inicial.

---

## 3. Requisitos Visuales y de Interfaz (RV)

* **RV-01: Enfoque prioritario Mobile-First**  
  La interfaz se diseñará exclusivamente pensada para el teléfono móvil, con navegación rápida y botones táctiles amplios para poder utilizarse con una sola mano en exteriores.

* **RV-02: Gráficos circulares («quesitos») y adiós a las tablas numéricas**  
  La pantalla principal del spot mostrará los porcentajes de viabilidad mediante **tres gráficos circulares de sectores («quesitos»)** o barras visuales (ejemplo del croquis de Quique: 75% nadar, 50% vela ligera, 25% kitesurf), eliminando las tablas complejas de números.

* **RV-03: Legibilidad y contraste extremo para sol directo en la playa**  
  El sitio deberá garantizar que los datos se lean con total claridad bajo la radiación solar en la arena. Para ello, se usarán números grandes, tipografía de trazo grueso y una relación de alto contraste visual.

* **RV-04: Conmutador de Modo Claro y Modo Oscuro**  
  El sitio dispondrá de un selector accesible para alternar entre modo claro (óptimo para luz solar en la playa) y modo oscuro (para interiores o noche).

* **RV-05: Semáforo visual unificado**  
  El estado del mar se representará con el código universal de semáforo:
  - 🟢 **Verde:** Condiciones óptimas y seguras para el deporte.
  - 🟡 **Amarillo:** Precaución (nivel técnico medio o avanzado).
  - 🔴 **Rojo:** Desfavorable o peligroso (no entrar al agua).

* **RV-06: Identidad visual marina con acentos de contraste**  
  La paleta cromática se basará en tonos azules marinos que evoquen el mar y el agua, combinados con colores de acento llamativos (naranjas o rojos) para destacar botones de acción y advertencias.

---

## 4. Requisitos Técnicos y de Arquitectura (RT)

* **RT-01: Arquitectura Web PWA con el stack de 2º DAW**  
  La aplicación será una Progressive Web App (PWA) desarrollada con las tecnologías del curso:
  - **Backend:** PHP 8 orientado a objetos con base de datos relacional MySQL/MariaDB.
  - **Frontend:** HTML5 semántico, CSS3 nativo responsive y JavaScript moderno asíncrono para consumir las APIs.
* **RT-02: Integración de fuentes oficiales y abiertas de datos**  
  El sistema recopilará datos de boyas en tiempo real (Puertos del Estado), estaciones meteorológicas oficiales y modelos marinos abiertos, sin depender de servicios privados de pago.
* **RT-03: Integración de webcams públicas**  
  El sistema incrustará las transmisiones de las cámaras web públicas de la Generalitat Valenciana y la red Oceanía correspondientes a los 3 spots definidos.
* **RT-04: Conexión con servicio de Inteligencia Artificial**  
  El backend se conectará con una API de IA para alimentar el motor de cálculo del porcentaje de viabilidad y las respuestas del chatbot local a pie de playa.

---

## 5. Requisitos Legales y de Seguridad (RL)

* **RL-01: Descargo explícito de responsabilidad (*Disclaimer*)**  
  El sitio deberá mostrar de forma obligatoria un aviso legal advirtiendo que **las estimaciones meteorológicas y de la IA son orientativas y pueden fallar**. La responsabilidad de adentrarse en el agua recae exclusivamente en el usuario, eximiendo al promotor y a los clubes de cualquier responsabilidad civil.
* **RL-02: Protección de datos y privacidad (RGPD)**  
  El registro de usuarios solicitará únicamente los datos imprescindibles, con almacenamiento seguro de contraseñas y política de privacidad accesible.
* **RL-03: Política de Cookies**  
  El sitio incluirá un aviso claro para la aceptación o configuración de cookies y almacenamiento de preferencias locales del usuario.

---

## 6. Matriz de Priorización (MoSCoW)

| Nivel MoSCoW | Requisitos Incluidos | Justificación según la reunión con Quique |
| :--- | :--- | :--- |
| **Must Have** *(Obligatorio)* | **RF-01, RF-02, RF-03, RF-05, RF-07, RV-01, RV-02, RV-03, RV-05, RT-01, RT-02, RL-01** | Es el núcleo pedido por el cliente: los 3 spots, datos de viento/mar en 4h/8h/24h, cálculo de viabilidad (0-100%) por IA en quesitos, registro de usuarios, diseño legible al sol y descargo legal de responsabilidad. |
| **Should Have** *(Importante)* | **RF-04, RF-06, RV-04, RV-06, RT-03, RT-04, RL-02, RL-03** | Webcams de GVA/Oceanía, chatbot experto local a pie de playa, selector de modo claro/oscuro y cumplimiento de privacidad/cookies. |
| **Could Have** *(Deseable)* | **RF-08, RF-09** | Indicador de afluencia comunitaria en la playa y tarjetas de servicios de las escuelas asociadas (Dunes Kite, Gandia Surf). |
| **Won't Have** *(Futuro)* | **RF-10** | La pasarela de cobro de suscripciones Premium queda pospuesta para versiones comerciales posteriores. |
