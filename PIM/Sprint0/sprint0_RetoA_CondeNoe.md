<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.5;
    color: #24292f;
  }
  p, ul {
    orphans: 3;
    widows: 3;
  }
  blockquote {
    background-color: #f6f8fa;
    border-left: 4px solid #1e3a8a;
    padding: 8px 14px;
    margin: 10px 0 16px 0;
    color: #4b5563;
  }
  h1, h2, h3 {
    color: #24292f;
    page-break-after: avoid;
    break-after: avoid;
  }
  /* Respuestas y redacción del alumno en azul marino (criterio Quique Savall) */
  .resp {
    color: #1e3a8a;
  }
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    body {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
    *:last-child {
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
    h1, h2, h3 {
      page-break-after: avoid;
      break-after: avoid;
    }
    .resp {
      color: #1e3a8a !important;
    }
  }
</style>

# PIM — Sprint 0: Reto 1A — Preparación de la Entrevista

> **Alumno:** Noé Conde Vila  
> **Fecha:** Octubre de 2026  
> **Curso:** 2º DAW (Semipresencial) — IES Maria Enríquez (Gandia)  
> **Asignatura:** Projecte Intermodular (PIM)  
> **Profesor:** Quique Savall  

---

## Preparación previa

- **Cliente potencial:** <span class="resp">Pequeño empresario del sector de deportes acuáticos en la costa de Valencia desea crear una web app para consultar el estado meteorológico del mar enfocado a deportistas de surf y otras variantes. Así escalarla a versión premium y añadir ofertas hacia sus comercios asociados y anuncios en version gratuita.</span>
- **Contexto y entorno:** <span class="resp">Reunión virtual de 40-50 minutos aprox., para concretar requisitos, funcionalidades y especificaciones técnicas para el desarrollo.</span>

---

## Planificación de las fases de reunión:

- **Fase 1. Apertura:** <span class="resp">Presentación, explicación del propósito de la reunión y cómo se mantendrán los datos seguros con acuerdo de confidencialidad.</span>
- **Fase 2. Desarrollo:** <span class="resp">Ronda de preguntas por bloques temáticos.</span>
- **Fase 3. Cierre:** <span class="resp">Resumen de lo tratado, próximos pasos y agradecimientos.</span>

---

## Preguntas para el usuario:

### Usuarios:
- <span class="resp">¿Qué tipo de apps se usan actualmente, y cuáles son sus puntos fuertes y aspectos que disgustan a usuarios? (Estudio de competencia).</span>
- <span class="resp">¿Los usuarios saben interpretar datos técnicos marítimos? (nudos, periodos de ola, dirección de viento y corrientes...), ¿o buscan algo más visual e intuitivo para usuarios casuales?</span>

### Datos:
- <span class="resp">¿Qué datos son los más importantes para que los usuarios decidan si salen a la mar? (tiempo, oleaje, viento, corrientes...)</span>
- <span class="resp">¿Qué playas o costas son las más frecuentadas por lo tanto las prioritarias para la app?</span>
- <span class="resp">¿Cuánto tiempo de previsión necesitaríamos? (horas, días, semanas...)</span>

### Diseño:
- <span class="resp">Al usarse en sitios abiertos con mucho sol, ¿creamos una UI con tema claro y oscuro? ¿Datos, números y letras grandes y claros sin cargar la pantalla de información?</span>
- <span class="resp">¿Tenemos logo y colores corporativos o deseas crear una paleta de colores específica?</span>
- <span class="resp">¿Algún tipo de diseño específico como tarjetas, gráficos, mapas...?</span>

### Acceso y monetización:
- <span class="resp">¿Qué tipo de contenido se podrá ver solo con entrar sin registrarse? ¿Qué tipo de beneficios tendrá el registrarse aparte de creación de perfil y guardar datos personales?</span>
- <span class="resp">¿Qué tipo y cantidad de contenido quieres proporcionar gratuitamente y qué nos guardamos para la versión premium?</span>

### IA:
- <span class="resp">¿Qué esperas de la implementación de IA? ¿Recomendaciones simples pero personalizadas en base a datos personales? ¿Agente chat integrado para consultas en tiempo real de datos meteorológicos y consejos?</span>