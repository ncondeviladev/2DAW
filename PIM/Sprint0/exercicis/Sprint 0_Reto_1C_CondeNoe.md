<style>
  body {
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    line-height: 1.6;
    color: #1e293b;
    max-width: 860px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
  }
  .portada {
    border: 2px solid #0284c7;
    border-radius: 8px;
    padding: 32px;
    background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%);
    margin-bottom: 30px;
  }
  .portada-titulo {
    font-size: 2em;
    color: #0369a1;
    margin: 0 0 8px 0;
    font-weight: 700;
  }
  .portada-subtitulo {
    font-size: 1.2em;
    color: #0284c7;
    margin-bottom: 22px;
    font-weight: 600;
  }
  .portada-meta {
    font-size: 0.95em;
    color: #334155;
    border-top: 1px solid #bae6fd;
    padding-top: 15px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  .portada-meta p {
    margin: 3px 0;
  }
  .indice {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 16px 22px;
    margin-bottom: 28px;
  }
  .indice h3 {
    margin-top: 0;
    color: #0f172a;
    font-size: 1.1em;
  }
  .indice ul {
    margin: 0;
    padding-left: 20px;
  }
  .indice li {
    margin: 5px 0;
  }
  .indice a {
    color: #0284c7;
    text-decoration: none;
    font-weight: 500;
  }
  .indice a:hover {
    text-decoration: underline;
  }
  h2 {
    color: #0369a1;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 6px;
    margin-top: 30px;
    font-size: 1.3em;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 0.92em;
  }
  th, td {
    border: 1px solid #cbd5e1;
    padding: 9px 12px;
    text-align: left;
    vertical-align: top;
  }
  th {
    background-color: #f1f5f9;
    color: #0f172a;
    font-weight: 600;
  }
  tr:nth-child(even) {
    background-color: #f8fafc;
  }
  .req-box {
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-left: 4px solid #0284c7;
    border-radius: 0 6px 6px 0;
    padding: 12px 16px;
    margin: 12px 0 16px 0;
  }
  .req-id {
    font-weight: 700;
    color: #0369a1;
  }
  .badge-must {
    background-color: #fee2e2;
    color: #991b1b;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85em;
  }
  .badge-should {
    background-color: #fef3c7;
    color: #92400e;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85em;
  }
  .badge-could {
    background-color: #e0f2fe;
    color: #0369a1;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85em;
  }
  .badge-wont {
    background-color: #f1f5f9;
    color: #475569;
    padding: 2px 7px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.85em;
  }
  .salto-pagina {
    page-break-after: always;
    break-after: page;
    height: 0;
    margin: 0;
    padding: 0;
    border: none;
    display: block;
  }
  .req-box {
    page-break-inside: avoid;
    break-inside: avoid;
  }
  table, tr, td, th {
    page-break-inside: avoid;
    break-inside: avoid;
  }
  h2, h3 {
    page-break-after: avoid;
    break-after: avoid;
  }
  p, li {
    orphans: 3;
    widows: 3;
  }
  @media print {
    body {
      padding: 10px;
      max-width: 100%;
    }
    .portada {
      page-break-inside: avoid;
      break-inside: avoid;
      margin-bottom: 20px;
    }
    .indice {
      page-break-inside: avoid;
      break-inside: avoid;
    }
  }
</style>

<div class="portada">
  <div class="portada-titulo">DOCUMENTO DE ESPECIFICACIÓN DE REQUISITOS</div>
  <div class="portada-subtitulo">Web App de Previsión Marítima Inteligente para Deportes Náuticos</div>
  <div class="portada-meta">
    <div>
      <p><strong>Módulo:</strong> Projecte Intermodular (PIM) — Sprint 0</p>
      <p><strong>Actividad:</strong> Reto 1C — Especificación de Requisitos de Usuario</p>
      <p><strong>Ciclo formativo:</strong> 2º DAW (Semipresencial)</p>
      <p><strong>Centro:</strong> IES Maria Enríquez (Gandia)</p>
    </div>
    <div>
      <p><strong>Alumno:</strong> Noé Conde Vila</p>
      <p><strong>Cliente / Entrevistado:</strong> Quique Savall</p>
      <p><strong>Entidades colaboradoras:</strong> Dunes Kite Piles / Gandia Surf</p>
      <p><strong>Fecha de la entrevista:</strong> 14 de octubre de 2026</p>
    </div>
  </div>
</div>

<div class="indice">
  <h3>Índice de Contenidos</h3>
  <ul>
    <li><a href="#sec-1">1. Resumen de la Entrevista y Necesidades del Cliente</a></li>
    <li><a href="#sec-2">2. Requisitos Funcionales (RF)</a></li>
    <li><a href="#sec-3">3. Requisitos Visuales y de Interfaz (RV)</a></li>
    <li><a href="#sec-4">4. Requisitos Técnicos y de Datos (RT)</a></li>
    <li><a href="#sec-5">5. Requisitos Legales y de Seguridad (RL)</a></li>
    <li><a href="#sec-6">6. Requisitos para Futuras Versiones</a></li>
    <li><a href="#sec-7">7. Matriz de Priorización (MoSCoW)</a></li>
  </ul>
</div>

<div class="salto-pagina"></div>

<h2 id="sec-1">1. Resumen de la Entrevista y Necesidades del Cliente</h2>

<p>En la sesión de Teams del 14 de octubre de 2026 nos reunimos con el cliente, <strong>Quique Savall</strong>, responsable del club <em>Dunes Kite Piles</em> y colaborador de <em>Gandia Surf</em>. Quique nos explicó los problemas reales que se encuentran los deportistas y escuelas náuticas de la zona a la hora de organizar sus salidas al agua:</p>

<ul>
  <li><strong>Problema actual:</strong> Actualmente tienen que consultar varias páginas independientes como <strong>Windguru, Windy o WindFinder</strong>. Aunque son fuentes fiables, ofrecen tablas densas con demasiadas filas numéricas que cuesta interpretar rápido, sobre todo desde el teléfono móvil en la arena a pleno sol.</li>
  <li><strong>Idea principal:</strong> La meta es desarrollar una aplicación web pensada para la pantalla del móvil que recopile mediciones en tiempo real (estaciones y boyas públicas) junto con previsiones numéricas, combinando ambos datos para dar una respuesta directa y visual: qué porcentaje de probabilidad (de 0% a 100%) hay de practicar cada modalidad.</li>
  <li><strong>Deportes a contemplar:</strong>
    <ol>
      <li><strong>Natación en aguas abiertas:</strong> Requiere mar plano, sin corrientes ni oleaje. Es un perfil de deportista que no para de crecer en nuestras costas.</li>
      <li><strong>Vela ligera:</strong> Busca viento suave o moderado y estado del mar manejable.</li>
      <li><strong>Kitesurf / Windsurf / Wingfoil:</strong> Necesitan viento constante a partir de unos 12-15 nudos y rachas que no sean peligrosas.</li>
    </ol>
  </li>
  <li><strong>Zonas prioritarias:</strong> Para acotar el desarrollo inicial, nos centraremos en tres spots costeros clave:
    <ol>
      <li><strong>La Safor:</strong> Playas de Piles y Gandia.</li>
      <li><strong>Dénia:</strong> Entorno del puerto y Les Marines.</li>
      <li><strong>Calpe / Altea:</strong> Costa Blanca.</li>
    </ol>
  </li>
  <li><strong>Plazos de consulta:</strong> La información debe organizarse en bloques de <strong>4 horas, 8 horas y 24 horas</strong>, que coinciden con los momentos en los que se decide preparar el equipo o salir hacia la playa.</li>
</ul>

<hr>

<h2 id="sec-2">2. Requisitos Funcionales (RF)</h2>

<div class="req-box">
  <span class="req-id">RF-01: Selección del spot costero</span><br>
  El usuario podrá elegir entre los tres spots definidos (La Safor: Piles/Gandia; Dénia: Puerto/Les Marines; y Calpe/Altea). Para ello, la aplicación cargará en pantalla las mediciones y previsiones correspondientes a la zona seleccionada.
</div>

<div class="req-box">
  <span class="req-id">RF-02: Consulta de datos en tiempo real (viento y mar)</span><br>
  El usuario tendrá acceso inmediato a la velocidad del viento en nudos, su dirección cardinal, rachas máximas, altura de ola y período en segundos. Para hacerlo, el sistema consultará lecturas actualizadas de boyas marítimas y estaciones meteorológicas oficiales.
</div>

<div class="req-box">
  <span class="req-id">RF-03: Previsión meteorológica por horas (4h, 8h y 24h)</span><br>
  El usuario podrá consultar la evolución prevista del estado del mar en ventanas de 4, 8 y 24 horas vista. Para ello, el sistema procesará los modelos meteorológicos abiertos y mostrará la tendencia de viento y oleaje en dichos tramos.
</div>

<div class="req-box">
  <span class="req-id">RF-04: Estimación de viabilidad por modalidad deportiva mediante IA</span><br>
  El usuario dispondrá de un porcentaje visual (de 0% a 100%) que indique la probabilidad de salir a nadar, hacer vela ligera o practicar deportes de viento. Para hacerlo, la aplicación enviará las lecturas reales de viento y oleaje a un servicio de inteligencia artificial que calculará la viabilidad según los rangos idóneos de cada deporte.
</div>

<div class="req-box">
  <span class="req-id">RF-05: Visualización de webcams en directo</span><br>
  El usuario podrá comprobar con sus propios ojos el estado real del agua y la arena antes de desplazarse. Para ello, la ficha de cada spot integrará los enlaces y reproducciones de las cámaras oficiales de la zona (Generalitat Valenciana y Oceanía).
</div>

<div class="req-box">
  <span class="req-id">RF-06: Guardado de spot y deporte favoritos</span><br>
  El usuario podrá guardar su playa habitual y su deporte de referencia para acceder a ellos nada más abrir la web. Para conseguirlo, la aplicación memorizará estas preferencias en el almacenamiento local del navegador.
</div>

<div class="req-box">
  <span class="req-id">RF-07: Filtro por modalidad deportiva</span><br>
  El usuario podrá personalizar la pantalla según la actividad que vaya a realizar (aguas abiertas, vela o deportes de viento). Para ello, el sistema destacará los parámetros y porcentajes específicos para esa disciplina.
</div>

<hr>

<h2 id="sec-3">3. Requisitos Visuales y de Interfaz (RV)</h2>

<div class="req-box">
  <span class="req-id">RV-01: Formato vertical pensado para teléfono móvil</span><br>
  El sitio deberá presentar una disposición vertical en una sola columna, cómoda de usar con una mano desde el móvil. Para ello, los elementos se distribuirán de forma limpia de arriba hacia abajo sin barras laterales complejas.
</div>

<div class="req-box">
  <span class="req-id">RV-02: Gráficos circulares de viabilidad deportiva</span><br>
  El sitio deberá sustituir las tablas densas de números por tres gráficos circulares con el porcentaje estimado de cada deporte (ejemplo del boceto de Quique: 75% natación, 50% vela, 25% kitesurf). Para ello, estos indicadores se ubicarán en una posición destacada al abrir el spot.
</div>

<div class="req-box">
  <span class="req-id">RV-03: Buena legibilidad bajo la luz del sol en la playa</span><br>
  El sitio deberá verse con nitidez al aire libre en plena arena y con luz solar intensa. Para ello, se emplearán tipografías grandes, trazos bien definidos y una relación de contraste visual alta.
</div>

<div class="req-box">
  <span class="req-id">RV-04: Código de colores tipo semáforo</span><br>
  El sitio deberá comunicar de un vistazo si las condiciones son favorables mediante el código del semáforo: verde (favorable), amarillo (precaución o nivel medio) y rojo (desfavorable o peligroso). Para ello, cada deporte y franja horaria mostrará este distintivo de color.
</div>

<hr>

<h2 id="sec-4">4. Requisitos Técnicos y de Datos (RT)</h2>

<div class="req-box">
  <span class="req-id">RT-01: Acceso web directo sin instalación</span><br>
  El usuario dispondrá de acceso inmediato desde cualquier navegador de teléfono móvil (Chrome, Safari o Firefox) sin necesidad de descargar una app nativa de una tienda. Para hacerlo, la aplicación se desarrollará como web adaptable.
</div>

<div class="req-box">
  <span class="req-id">RT-02: Conexión con fuentes públicas abiertas</span><br>
  El sistema deberá recopilar mediciones de servicios abiertos y gratuitos (boyas de Puertos del Estado, modelos meteorológicos abiertos y webcams institucionales). Para ello, el backend dispondrá de conectores para leer estas fuentes sin costes por licencia.
</div>

<div class="req-box">
  <span class="req-id">RT-03: Consulta en zonas de baja cobertura (Modo offline / Caché)</span><br>
  El usuario podrá revisar la última predicción cargada aunque la señal móvil sea débil o nula en la playa o el espigón. Para hacerlo, la aplicación guardará en memoria local los últimos datos y mostrará la hora de la última actualización en lugar de una pantalla de error.
</div>

<div class="req-box">
  <span class="req-id">RT-04: Procesamiento de previsiones mediante API de Inteligencia Artificial</span><br>
  El sistema deberá integrar un servicio de inteligencia artificial para evaluar conjuntamente las variables meteorológicas de cada spot. Para ello, el backend realizará peticiones automáticas a la API de IA encargada de procesar los datos y devolver los porcentajes de viabilidad deportiva.
</div>

<hr>

<h2 id="sec-5">5. Requisitos Legales y de Seguridad (RL)</h2>

<div class="req-box">
  <span class="req-id">RL-01: Aviso de descargo de responsabilidad náutica</span><br>
  El sitio deberá mostrar de forma visible una advertencia indicando que las previsiones y porcentajes son meramente estimaciones orientativas, y que la decisión final y la seguridad al entrar al mar corresponden siempre al deportista. Para ello, se incluirá este aviso legal en el pie o pantalla principal.
</div>

<div class="req-box">
  <span class="req-id">RL-02: Privacidad básica al guardar preferencias</span><br>
  El sitio deberá proteger la privacidad al almacenar el spot favorito del usuario. Para ello, no se requerirán datos personales innecesarios y se informará de manera transparente sobre el uso de almacenamiento local en el dispositivo.
</div>

<hr>

<h2 id="sec-6">6. Requisitos para Futuras Versiones</h2>
<p>Funcionalidades comentadas durante la reunión que quedan recogidas para etapas posteriores del proyecto, ya que dependen de servicios externos adicionales, interacción entre usuarios o modelos de lenguaje:</p>

<div class="req-box">
  <span class="req-id">RF-F01: Asistente conversacional para consultas del spot</span><br>
  El usuario podrá formular dudas en lenguaje natural sobre las condiciones de la playa (como preguntar a qué hora suele entrar el Garbí en Piles o si el mar está tranquilo para nadar en Gandia). Para hacerlo, el sistema consultará a un modelo de IA que responderá teniendo en cuenta las lecturas meteorológicas recientes.
</div>

<div class="req-box">
  <span class="req-id">RF-F02: Tablón de avisos comunitarios a pie de playa</span><br>
  El usuario podrá consultar y publicar advertencias rápidas sobre incidencias puntuales en el agua o la arena (presencia de medusas, afluencia alta de bañistas o bandera del puesto de socorro). Para hacerlo, la aplicación dispondrá de un apartado ágil de mensajes cortos temporales compartidos por otros deportistas.
</div>

<div class="req-box">
  <span class="req-id">RV-F01: Conmutador de modo claro y modo oscuro</span><br>
  El sitio deberá permitir alternar entre el diseño de alto contraste para sol directo y un tema oscuro para uso nocturno o interiores. Para ello, se incluirá un botón accesible en la barra superior.
</div>

<div class="req-box">
  <span class="req-id">RT-F01: Conexión desacoplada con el servicio de IA</span><br>
  El sistema deberá conectar con la API de un modelo de lenguaje para procesar las respuestas del asistente conversacional sin ralentizar la web. Para ello, dispondrá de un endpoint específico en el backend que gestione las llamadas de forma asíncrona.
</div>

<div class="salto-pagina"></div>

<h2 id="sec-7">7. Matriz de Priorización (MoSCoW)</h2>
<p>Para planificar las tareas de forma ordenada y no dispersarnos, clasificamos los requisitos según las cuatro categorías del método ágil MoSCoW:</p>

<table>
  <thead>
    <tr>
      <th style="width: 20%;">Nivel MoSCoW</th>
      <th style="width: 28%;">Requisitos incluidos</th>
      <th>Justificación práctica según la reunión con Quique</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge-must">Must Have</span><br><em>(Imprescindible)</em></td>
      <td><strong>RF-01, RF-02, RF-03, RF-04, RV-01, RV-02, RV-03, RV-04, RT-01, RT-02, RT-04, RL-01</strong></td>
      <td>La base necesaria para que la aplicación cumpla su objetivo: seleccionar spot, consultar datos en tiempo real y a 4h/8h/24h, procesar la viabilidad deportiva con la API de IA, ver los porcentajes gráficos en el móvil y mostrar el descargo de responsabilidad en el agua.</td>
    </tr>
    <tr>
      <td><span class="badge-should">Should Have</span><br><em>(Importante)</em></td>
      <td><strong>RF-05, RF-06, RF-07, RT-03, RL-02</strong></td>
      <td>Funciones muy prácticas que mejoran la experiencia de uso: confirmar el estado visual con webcams, guardar preferencias de playa y deporte, filtrar por actividad y consultar la información aunque falle la cobertura en la arena.</td>
    </tr>
    <tr>
      <td><span class="badge-could">Could Have</span><br><em>(Deseable / Futuras versiones)</em></td>
      <td><strong>RF-F01, RF-F02, RV-F01, RT-F01</strong></td>
      <td>Ampliaciones para siguientes fases: asistente conversacional, tablón de avisos comunitarios (medusas/afluencia), selector de tema oscuro e integración técnica con el modelo de lenguaje.</td>
    </tr>
    <tr>
      <td><span class="badge-wont">Won't Have</span><br><em>(Descartado por ahora)</em></td>
      <td><strong>Pasarelas de pago, venta online y previsiones a largo plazo</strong></td>
      <td>Quedan fuera para centrarnos exclusivamente en la utilidad deportiva inmediata de la costa local.</td>
    </tr>
  </tbody>
</table>
