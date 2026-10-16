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
    <li><a href="#sec-6">6. Matriz de Priorización (MoSCoW)</a></li>
  </ul>
</div>

<h2 id="sec-1">1. Resumen de la Entrevista y Necesidades del Cliente</h2>

<p>En la sesión de Teams del 14 de octubre de 2026 nos reunimos con el cliente, <strong>Quique Savall</strong>, responsable del club <em>Dunes Kite Piles</em> y colaborador de <em>Gandia Surf</em>. Quique nos planteó la necesidad real que tienen los deportistas náuticos y los clubes de la zona a la hora de planificar sus salidas al mar:</p>

<ul>
  <li><strong>Punto de partida y problema actual:</strong> Para saber si las condiciones son buenas, Quique nos mostró que actualmente consulta páginas como <strong>Windguru, Windy o WindFinder</strong>. Son herramientas muy fiables, pero muestran tablas llenas de números y modelos que cuesta interpretar rápidamente, especialmente desde el móvil en la playa a pleno sol.</li>
  <li><strong>La idea de Quique (la «coctelera» de datos):</strong> La meta es crear una web orientada a la pantalla del móvil que actúe como una coctelera. La aplicación recogerá lecturas en tiempo real (boyas y estaciones oficiales) y predicciones numéricas, y mediante IA procesará todo para dar una respuesta directa y visual: qué probabilidad (de 0% a 100%) hay de practicar cada deporte.</li>
  <li><strong>Los 3 deportes analizados:</strong>
    <ol>
      <li><strong>Natación en aguas abiertas:</strong> Necesita mar en calma (mar plato), sin oleaje ni corrientes. Es un colectivo que no para de crecer en la costa.</li>
      <li><strong>Vela ligera:</strong> Busca viento suave o moderado y mar navegable.</li>
      <li><strong>Kitesurf / Windsurf / Wingfoil:</strong> Requieren viento constante (a partir de 12-15 nudos) y rachas controladas.</li>
    </ol>
  </li>
  <li><strong>Los 3 spots iniciales:</strong> Para no abarcar demasiado en esta primera fase, la app se centrará en tres zonas concretas:
    <ol>
      <li><strong>La Safor:</strong> Piles y Gandia.</li>
      <li><strong>Dénia:</strong> Zona del puerto y Les Marines.</li>
      <li><strong>Calpe / Altea:</strong> Costa Blanca.</li>
    </ol>
  </li>
  <li><strong>Ventanas de tiempo:</strong> La previsión se organizará en bloques de <strong>4 horas, 8 horas y 24 horas</strong>, que son los momentos clave en los que un deportista decide si preparar el material o desplazarse al spot.</li>
</ul>

<hr>

<h2 id="sec-2">2. Requisitos Funcionales (RF)</h2>


<div class="req-box">
  <span class="req-id">RF-01: Selección del spot costero</span><br>
  El usuario dispondrá de un selector inicial con los tres spots acordados (La Safor: Piles/Gandia; Dénia: Puerto/Les Marines; y Calpe/Altea). Para hacerlo, el sistema cargará en pantalla toda la información y previsiones filtradas según la playa elegida.
</div>

<div class="req-box">
  <span class="req-id">RF-02: Consulta de datos en tiempo real (viento y mar)</span><br>
  El usuario podrá consultar la velocidad del viento en nudos, la dirección, las rachas máximas, y la altura y el período del oleaje. Para hacerlo, el sistema consultará lecturas actualizadas de boyas marítimas y estaciones meteorológicas públicas.
</div>

<div class="req-box">
  <span class="req-id">RF-03: Previsión por horas (4h, 8h y 24h)</span><br>
  El usuario dispondrá de predicciones del estado marítimo en bloques de 4 horas, 8 horas y 24 horas. Para hacerlo, el sistema procesará los modelos meteorológicos abiertos y organizará la información en esas tres ventanas de tiempo.
</div>

<div class="req-box">
  <span class="req-id">RF-04: Cálculo de viabilidad por deporte con IA («Coctelera»)</span><br>
  El usuario dispondrá de un porcentaje estimado (del 0% al 100%) que indique la probabilidad de salir a nadar, navegar en vela ligera o hacer kitesurf/windsurf. Para hacerlo, el sistema utilizará un motor de Inteligencia Artificial que cruzará los datos reales de boyas y los modelos predictivos según los requisitos de cada deporte.
</div>

<div class="req-box">
  <span class="req-id">RF-05: Visualización de webcams en directo</span><br>
  El usuario podrá ver la imagen en directo de las cámaras oficiales de la zona (Generalitat Valenciana y Oceanía) para comprobar con sus propios ojos el estado del agua y la arena antes de salir de casa. Para hacerlo, el sistema enlazará o incrustará las emisiones públicas de dichas cámaras dentro de la ficha de cada spot.
</div>

<div class="req-box">
  <span class="req-id">RF-06: Guardado del spot preferido</span><br>
  El usuario podrá marcar su playa habitual como favorita para que se cargue directamente al abrir la web. Para hacerlo, el sistema recordará la elección del usuario en el navegador o mediante una cuenta sencilla.
</div>

<hr>

<h2 id="sec-3">3. Requisitos Visuales y de Interfaz (RV)</h2>


<div class="req-box">
  <span class="req-id">RV-01: Formato vertical para teléfono móvil</span><br>
  El sitio deberá mostrarse en una estructura vertical pensada para la pantalla del móvil, de modo que todo se pueda consultar cómodamente con una sola mano. Para ello, los contenidos se colocarán en una columna limpia de arriba a abajo.
</div>

<div class="req-box">
  <span class="req-id">RV-02: Tres gráficos circulares («Quesitos») con porcentajes</span><br>
  El sitio deberá sustituir las tablas complejas de números por tres gráficos circulares de sectores («quesitos») con el porcentaje de cada deporte (ejemplo del croquis de Quique: 75% nadar, 50% vela ligera, 25% kitesurf). Para ello, la pantalla principal mostrará estos tres círculos bien visibles nada más entrar al spot.
</div>

<div class="req-box">
  <span class="req-id">RV-03: Buena legibilidad bajo la luz del sol en la playa</span><br>
  El sitio deberá verse con total claridad al aire libre y en la arena a pleno sol. Para ello, se utilizarán tipografías grandes, trazos gruesos y colores con alto contraste visual.
</div>

<div class="req-box">
  <span class="req-id">RV-04: Código de colores tipo semáforo</span><br>
  El sitio deberá indicar rápidamente si las condiciones son favorables mediante el código del semáforo: verde (buenas condiciones), amarillo (atención o nivel medio/alto) y rojo (desfavorable o peligroso). Para ello, cada deporte y bloque horario llevará asociado este distintivo de color.
</div>

<hr>

<h2 id="sec-4">4. Requisitos Técnicos y de Datos (RT)</h2>

<div class="req-box">
  <span class="req-id">RT-01: Acceso web directo sin instalación</span><br>
  El usuario dispondrá de acceso inmediato desde cualquier navegador de teléfono móvil (Chrome, Safari, Firefox) sin verse obligado a descargar o instalar nada de una tienda de aplicaciones. Para hacerlo, la aplicación se programará como una web adaptable a móviles.
</div>

<div class="req-box">
  <span class="req-id">RT-02: Conexión con fuentes públicas abiertas</span><br>
  El sistema deberá alimentarse de datos abiertos y gratuitos (boyas de Puertos del Estado, previsiones meteorológicas abiertas y cámaras de acceso público). Para ello, incluirá módulos de conexión preparados para leer estas fuentes sin costes de licencias.
</div>

<div class="req-box">
  <span class="req-id">RT-03: Consulta sin conexión (Modo offline / Caché)</span><br>
  El usuario podrá consultar la última predicción cargada aunque se quede sin cobertura móvil al llegar a la playa o al espigón. Para hacerlo, el sistema guardará en la memoria del navegador los últimos datos consultados y mostrará un aviso con la hora de la última actualización en vez de mostrar una pantalla de error de conexión.
</div>

<hr>

<h2 id="sec-5">5. Requisitos Legales y de Seguridad (RL)</h2>

<div class="req-box">
  <span class="req-id">RL-01: Aviso de descargo de responsabilidad náutica</span><br>
  El sitio deberá incluir un aviso legal claro que recuerde que las previsiones y los porcentajes de la IA son únicamente una estimación orientativa, y que la decisión y la seguridad de entrar al mar son siempre responsabilidad del propio deportista. Para ello, se mostrará este aviso de forma visible en la aplicación.
</div>

<div class="req-box">
  <span class="req-id">RL-02: Privacidad básica al guardar preferencias</span><br>
  El sitio deberá respetar la privacidad de los usuarios si estos guardan su playa preferida o sus datos de acceso. Para ello, no se recopilará información personal innecesaria y se informará de forma clara sobre el almacenamiento local en el dispositivo.
</div>

<hr>

<h2 id="sec-6">6. Matriz de Priorización (MoSCoW)</h2>
<p>Para organizar el desarrollo del proyecto por orden de necesidad, clasificamos los requisitos según el método ágil MoSCoW:</p>

<table>
  <thead>
    <tr>
      <th style="width: 20%;">Nivel MoSCoW</th>
      <th style="width: 30%;">Requisitos incluidos</th>
      <th>Justificación según la entrevista con el cliente</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="badge-must">Must Have</span><br><em>(Imprescindible)</em></td>
      <td><strong>RF-01, RF-02, RF-03, RF-04, RV-01, RV-02, RV-03, RV-04, RT-01, RT-02, RL-01</strong></td>
      <td>Es el núcleo central que pidió Quique en la reunión: elegir entre los 3 spots, ver datos en tiempo real y a 4h/8h/24h, calcular la viabilidad con IA en los tres círculos gráficos en el móvil, y dejar claro el aviso legal de responsabilidad en el agua.</td>
    </tr>
    <tr>
      <td><span class="badge-should">Should Have</span><br><em>(Importante)</em></td>
      <td><strong>RF-05, RF-06, RT-03, RL-02</strong></td>
      <td>Funciones muy útiles que aportan comodidad y robustez: ver las webcams en directo para confirmar visualmente el estado del mar, memorizar el spot favorito y poder consultar la última predicción guardada en caché si no hay cobertura en la arena.</td>
    </tr>
    <tr>
      <td><span class="badge-could">Could Have</span><br><em>(Deseable / Si hay tiempo)</em></td>
      <td><strong>Alertas y contacto de escuelas locales</strong></td>
      <td>Avisos automáticos si el viento gira bruscamente y tarjetas con información de contacto o alquiler de los clubes colaboradores (Dunes Kite Piles y Gandia Surf). Se desarrollará si los plazos lo permiten.</td>
    </tr>
  </tbody>
</table>
