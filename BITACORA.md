# BITÁCORA — 2DAW

> Diario de abordo del curso. Registro cronológico de errores, soluciones y decisiones.
>
> **Cómo usarla con la IA:**
> - Por defecto NO se pasa a la IA (demasiado larga).
> - Cuando tengas un error conocido: *"Busca en BITACORA.md cómo solucioné [X]"*

---

## Formato de entrada

`
### YYYY-MM-DD — Título breve
**Asignatura/Contexto:**
**Problema/Situación:**
**Solución:**
**Aprendizaje:**
`

---

### 2026-09-10 — Inicio del curso 2DAW

**Contexto:** Inicio de curso. Reorganización completa del entorno de trabajo.

**Situación:** Venía de 2DAM con carpetas dispersas en OneDrive (raíz) y duplicadas
entre portátil y sobremesa. OneDrive daba conflictos constantes con archivos compilados
y bases de datos.

**Decisiones tomadas:**
- Todo el material de 2DAM consolidado dentro de 2DAM/ (raíz limpia)
- Nueva carpeta 2DAW/ como monorepo Git para el curso actual
- Sistema de dos archivos por proyecto: STATUS.md (contexto IA, conciso) + BITACORA.md (historial largo)
- .gitignore configurado para excluir node_modules, vendor, compilados, BD locales

**Aprendizaje:** Las carpetas de OneDrive gestionadas por organización (Conselleria)
no permiten compartir por red con el método estándar de Windows. Para transferencias
entre dispositivos: mejor Git o SyncThing que SMB/red local.
