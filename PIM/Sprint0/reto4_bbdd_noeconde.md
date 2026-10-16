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
  h3 {
    color: #0f172a;
    margin-top: 20px;
    font-size: 1.1em;
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
  .info-box {
    background-color: #f0fdf4;
    border-left: 4px solid #16a34a;
    padding: 12px 16px;
    margin: 15px 0;
    border-radius: 0 6px 6px 0;
  }
  .placeholder-box {
    background-color: #f8fafc;
    border: 1px dashed #94a3b8;
    border-radius: 6px;
    padding: 16px;
    margin: 15px 0;
    color: #475569;
  }
</style>

<div class="portada">
  <div class="portada-titulo">ESTUDIO Y DISEÑO DE LA ESTRUCTURA DE DATOS</div>
  <div class="portada-subtitulo">Proyecto de Previsiones Marítimas — Módulo DWES</div>
  <div class="portada-meta">
    <div>
      <p><strong>Módulo:</strong> Proyecto Intermodular (PIM) / DWES</p>
      <p><strong>Actividad:</strong> Sprint 0 — Reto 4: DWS BBDD</p>
      <p><strong>Ciclo:</strong> 2º DAW (Semipresencial)</p>
      <p><strong>Centro:</strong> IES Maria Enríquez (Gandia)</p>
    </div>
    <div>
      <p><strong>Alumno:</strong> Noé Conde Vila</p>
      <p><strong>Profesor:</strong> Eloy Gutiérrez / Quique Savall</p>
      <p><strong>Fecha de entrega:</strong> 19 de octubre de 2026</p>
    </div>
  </div>
</div>

<div class="indice">
  <h3>Índice de Contenidos</h3>
  <ul>
    <li><a href="#sec-1">1. Análisis de Necesidades y Estudio de APIs de Terceros</a></li>
    <li><a href="#sec-2">2. Propuesta de Entidades, Atributos y Relaciones</a></li>
    <li><a href="#sec-3">3. Diseño del Diagrama Entidad-Relación (ER)</a></li>
  </ul>
</div>

<h2 id="sec-1">1. Análisis de Necesidades y Estudio de APIs de Terceros</h2>

<p>Para alimentar nuestra aplicación con datos fiables de viento, olas y estado del mar sin costes de licencia, hemos analizado y comparado las tres fuentes públicas más relevantes:</p>

<table>
  <thead>
    <tr>
      <th style="width: 22%;">Criterio de análisis</th>
      <th style="width: 26%;">API 1: Open-Meteo Marine</th>
      <th style="width: 26%;">API 2: AEMET OpenData</th>
      <th style="width: 26%;">API 3: Puertos del Estado (Portus)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Formato de los datos</strong></td>
      <td><strong>JSON directo</strong>.<br>Devuelve un archivo de texto con los datos listos para leer directamente en PHP o JavaScript.</td>
      <td><strong>JSON en dos pasos</strong>.<br>La primera consulta devuelve un enlace temporal y, al abrir ese enlace, se descarga el archivo final también en <strong>formato JSON</strong>.</td>
      <td><strong>JSON y tablas web</strong>.<br>Permite consultar datos en JSON o descargar registros históricos en tablas CSV.</td>
    </tr>
    <tr>
      <td><strong>Variables que capturamos para la «coctelera»</strong></td>
      <td>
        <ul>
          <li><strong>Viento:</strong> Predicción horaria de velocidad en nudos, dirección y rachas.</li>
          <li><strong>Oleaje:</strong> Predicción matemática de altura de ola (metros) y período (segundos).</li>
          <li><strong>Temperatura:</strong> Temperatura del aire y de la superficie marina.</li>
        </ul>
      </td>
      <td>
        <ul>
          <li><strong>Viento:</strong> Predicción de viento medio y rachas en estaciones costeras.</li>
          <li><strong>Oleaje:</strong> Descripción del estado del mar (marejada, mar gruesa).</li>
          <li><strong>Temperatura:</strong> Temperatura ambiente y sensación térmica.</li>
          <li><strong>Avisos oficiales:</strong> Alertas por temporal marítimo (amarilla/naranja/roja).</li>
        </ul>
      </td>
      <td>
        <ul>
          <li><strong>Viento:</strong> Velocidad y dirección real medida por el anemómetro de la boya.</li>
          <li><strong>Oleaje:</strong> Medición física real de la altura de ola y período registrada en el agua.</li>
          <li><strong>Temperatura:</strong> Temperatura real del agua tomada directamente por la boya.</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td><strong>¿Cubre nuestros 3 spots?</strong></td>
      <td><strong>Sí, al 100%</strong>.<br>Funciona por coordenadas GPS exactas (latitud y longitud), por lo que cubre perfectamente Gandia, Piles, Dénia y Calpe.</td>
      <td><strong>Sí</strong>.<br>Ofrece información por municipios costeros y zonas marítimas oficiales.</td>
      <td><strong>Sí</strong>.<br>Dispone de boyas oficiales fondeadas frente a Valencia, Gandia y Dénia.</td>
    </tr>
    <tr>
      <td><strong>Autenticación y coste</strong></td>
      <td><strong>Gratuita</strong> para uso educativo y personal.<br>No requiere registro ni clave de acceso.</td>
      <td><strong>Gratuita</strong>.<br>Obliga a registrarse con un email en su web para obtener una clave personal (API Key).</td>
      <td><strong>Gratuita y pública</strong>.<br>Acceso abierto a través del portal estatal de puertos.</td>
    </tr>
    <tr>
      <td><strong>Límite de peticiones</strong></td>
      <td>Hasta <strong>10.000 consultas al día</strong>.<br>Margen más que suficiente para actualizar nuestra base de datos.</td>
      <td>Límite estricto por minuto para evitar saturación de sus servidores.</td>
      <td>Sin límite estricto de llamadas, pero las boyas actualizan sus mediciones una vez por hora.</td>
    </tr>
    <tr>
      <td><strong>Web oficial</strong></td>
      <td><a href="https://open-meteo.com/en/docs/marine-weather-api" target="_blank">open-meteo.com/marine</a></td>
      <td><a href="https://opendata.aemet.es/centrodedescargas/inicio" target="_blank">opendata.aemet.es</a></td>
      <td><a href="https://www.puertos.es/es-es/oceanografia/Paginas/portus.aspx" target="_blank">puertos.es (Portus)</a></td>
    </tr>
  </tbody>
</table>

<div class="info-box">
  <strong>Conclusión y decisión técnica:</strong><br>
  La mejor solución para nuestro proyecto es utilizar <strong>Open-Meteo Marine</strong> como motor principal de predicción a 4h, 8h y 24h (por su rapidez, precisión por GPS y porque no exige claves ni registros), complementada con las boyas de <strong>Puertos del Estado</strong> para contrastar la altura real de las olas en la costa de la Safor y la Marina.
</div>

<hr>

<h2 id="sec-2">2. Propuesta de Entidades, Atributos y Relaciones</h2>

<div class="placeholder-box">
  <p><em>(Espacio preparado para definir las tablas de la base de datos, tipos de datos, claves primarias y foráneas, y cardinalidades)</em></p>
</div>

<hr>

<h2 id="sec-3">3. Diseño del Diagrama Entidad-Relación (ER)</h2>

```mermaid
erDiagram
    USUARIO {
        int id_usuario PK
        varchar nombre
        varchar email
        varchar password_hash
        varchar foto_perfil
        int id_deporte_preferido FK
        datetime fecha_registro
    }

    SPOT {
        int id_spot PK
        varchar nombre
        varchar municipio
        decimal latitud
        decimal longitud
        varchar url_webcam
    }

    DEPORTE {
        int id_deporte PK
        varchar nombre
        decimal viento_min
        decimal viento_max
        decimal ola_min
        decimal ola_max
    }

    MEDICION_METEO {
        int id_medicion PK
        int id_spot FK
        datetime fecha_hora
        decimal velocidad_viento
        decimal racha_viento
        int direccion_viento
        decimal altura_ola
        decimal periodo_ola
        decimal temperatura_agua
    }

    USUARIO_SPOT_FAVORITO {
        int id_usuario PK,FK
        int id_spot PK,FK
        datetime fecha_agregado
    }

    DEPORTE ||--o{ USUARIO : "1 a N"
    SPOT ||--o{ MEDICION_METEO : "1 a N"
    USUARIO ||--o{ USUARIO_SPOT_FAVORITO : "1 a N"
    SPOT ||--o{ USUARIO_SPOT_FAVORITO : "1 a N"
```
