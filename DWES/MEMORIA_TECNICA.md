# 🚀 Memoria Técnica y Guía de Arquitectura Web — DWES
> **Módulo:** Desenvolupament Web en Entorn Servidor (DWES — 2º DAW)  
> **Proyecto:** Evolución TechLeads (U3_P2, U4_P1 y U4_P2)  
> **Autor:** Noé Conde Vila  
> **Enfoque Pedagógico:** De Desarrollador a Cliente / Arquitectura Web para perfiles que vienen de DAM

---

## 🗺️ 1. El Árbol Genealógico de TechLeads (De U3 a U4)

Para entender este proyecto, lo primero es saber en qué punto de la evolución estamos:

```mermaid
graph TD
    U3P2["1. U3_P2 (Miniproyecto PHP Avanzado)<br/>📁 DWES/U3/projecte-final-techleads/<br/>• Sin Base de Datos (todo en $_SESSION)<br/>• Calificado: 100% Superat por Eloy.<br/>• Feedback de examen: revisar cookie recorda'm y sticky checkboxes."]
    --> 
    U4P1["2. U4_P1 (Migración a MySQL + DAOs)<br/>📁 DWES/U4/U4_P1_CondeNoe/<br/>• Docker, MySQL 8.4, Composer, Namespaces, bootstrap.php.<br/>• ¡Sticky form de checkboxes ya resuelto aquí!<br/>• Entregado al 100% con 9 capturas y memoria."]
    --> 
    U4P2["3. U4_P2 (Ampliación: Notas de Seguimiento 1:N)<br/>📁 DWES/U4/U4_P2_CondeNoe/<br/>• Sobre la base de U4_P1: tabla 'notes', modelo Nota, NotaDAO,<br/>JOIN con usuarios, PDO::FETCH_KEY_PAIR y control de roles.<br/>• Vencimiento oficial: 21 de noviembre de 2026."]
```

---

## 🎯 2. El Gran Choque Mental: ¿Por qué la Web no funciona como DAM?

Si vienes de programar en escritorio o móvil (Java, C#, Android), tu aplicación arranca una vez, se carga en la memoria RAM, los objetos viven durante horas y la interfaz gráfica responde a eventos en tiempo real dentro del mismo proceso.

En el desarrollo web con PHP el paradigma es radicalmente diferente: **el protocolo HTTP es STATELESS (sin estado)**.

```mermaid
sequenceDiagram
    autonumber
    actor Usuario as Navegador (Cliente)
    participant Servidor as Servidor Web (PHP / Apache)
    participant DiscoServidor as Disco del Servidor (/tmp/sess_*)
    participant DiscoCliente as Disco del Cliente (Cookies)

    Usuario->>Servidor: 1. Petición HTTP (GET o POST)
    Note over Servidor: PHP arranca de CERO absoluto.<br/>Carga archivos, clases y funciones.<br/>No recuerda NADA de la petición anterior.
    Servidor->>DiscoServidor: 2. Lee $_SESSION usando el ID de la cookie
    Servidor->>DiscoCliente: 3. Lee $_COOKIE que viajó en la cabecera HTTP
    Note over Servidor: Ejecuta lógica, mezcla PHP con HTML.
    Servidor->>Usuario: 4. Envía HTML plano / CSS (Texto)
    Note over Servidor: ¡PHP MUERE! Libera toda la memoria RAM.<br/>Todas las variables locales se destruyen.
```

> 💡 **La Regla de Oro de la Web:**  
> Ninguna variable PHP sobrevive entre dos clics o dos envíos de formulario. Para que algo "se recuerde", debe guardarse explícitamente en:
> 1. **`$_SESSION`:** Se guarda en el disco del servidor (archivo temporal).
> 2. **`$_COOKIE`:** Se guarda en el disco del navegador del usuario (cliente).
> 3. **Base de Datos (MySQL):** Persistencia definitiva en disco.

---

## ❓ 3. Preguntas Clave: ¿Dónde viven las variables y qué hay en el disco?

### A. ¿Dónde están las superglobales (`$_SESSION`, `$_COOKIE`, `$_POST`, `$_GET`)?
* **En tiempo de ejecución:** Son **variables de PHP en la memoria RAM del SERVIDOR**. El navegador cliente jamás ve ni una sola línea de PHP.
* **En reposo (entre clics):**
  - **`$_COOKIE`:** Los datos residen en el **disco duro del cliente (navegador)**. En cada clic, el navegador envía esas cookies en la cabecera HTTP oculta. PHP las lee al arrancar y las copia en su array `$_COOKIE`.
  - **`$_SESSION`:** Los datos residen **100% en el servidor**. El cliente solo tiene un "ticket" o puntero llamado `PHPSESSID`.

#### 🎟️ La metáfora del guardarropa de la discoteca:
* **El cliente (navegador)** solo lleva en el bolsillo un ticket de papel con un número: la cookie `PHPSESSID=d7a89f...`.
* **El servidor** tiene la taquilla física `d7a89f...` en su guardarropa donde está tu abrigo y tu cartera (`$_SESSION['leads']`, `$_SESSION['usuari']`).
* El navegador nunca lleva el abrigo encima; solo enseña el ticket en cada petición para que PHP busque su taquilla en el servidor.

### B. ¿Qué es "Disco / Sesión" cuando no hay Base de Datos (como en U3)?
Cuando no hay MySQL, PHP guarda las sesiones en **archivos físicos de texto plano dentro del disco duro del servidor** (normalmente en la carpeta `/tmp/` de Linux o Docker):
```text
Servidor Web (Linux / Docker)
└── /tmp/ (Carpeta temporal en el disco duro del servidor)
    ├── sess_4a8f9c1b...  ← Archivo de texto plano con los datos de la sesión del usuario A
    └── sess_9e2d7a04...  ← Archivo de texto plano con los datos de la sesión del usuario B
```
Cuando llamas a `session_start()`, PHP busca el archivo correspondiente al `PHPSESSID`, lo lee del disco, lo deserializa y te lo deja listo en `$_SESSION`. Al terminar el script, lo vuelve a guardar en disco y vacía la RAM.

### C. ¿Por qué las vistas están separadas: unas en la raíz (`/`) y otras en `dashboard/`?
Por una estricta separación de **roles, seguridad y experiencia de usuario (Público vs Privado)**:

```mermaid
graph TD
    subgraph ZonaPublica["🌐 ZONA PÚBLICA (En la Raíz '/')"]
        Index["index.php<br/>(Cualquier visitante del mundo sin login)"]
        Processar["processar_lead.php<br/>(Procesa el formulario público y valida)"]
    end

    subgraph ZonaPrivada["🔒 ZONA PRIVADA (En la carpeta '/dashboard/')"]
        Login["dashboard/login.php<br/>(Puerta de acceso comercial)"]
        Leads["dashboard/leads.php<br/>(Panel protegido con estadísticas y tabla)"]
        LeadDetall["dashboard/lead.php<br/>(Ficha detallada del lead y notas)"]
        Logout["dashboard/logout.php<br/>(Cierre y destrucción de sesión/cookie)"]
    end

    subgraph VistesCompartides["🧩 VISTAS COMPARTIDAS (En 'app/vistes/' o 'src/vistes/')"]
        Capcalera["capcalera.php<br/>(HTML head y barra superior)"]
        Peu["peu.php<br/>(Pie de página común)"]
    end
```

1. **En la raíz (`/`):** Acceso público sin contraseña. URLs directas (`techleads.com/`).
2. **En `/dashboard/`:** Intranet comercial. Todo archivo aquí está blindado por `requereixLogin()` o `assegurarAutenticacio()`. Si no estás logueado, te expulsa al login.
3. **En `app/vistes/`:** No son páginas completas, son trozos de plantilla (`header`, `footer`) que se cargan con `require_once`. Nunca se visitan directamente desde el navegador.

---

## 🏗️ 4. Arquitectura de Componentes de TechLeads

```mermaid
graph TD
    subgraph Cliente["Navegador Web (Frontend)"]
        NavPublico["Visitante Público<br/>(Pide presupuesto)"]
        NavComercial["Equipo Comercial<br/>(Gestión de clientes)"]
    end

    subgraph Enrutamiento["Puntos de Entrada HTTP (Controladores)"]
        Index["index.php<br/>(Formulario público)"]
        Processar["processar_lead.php<br/>(Validación + PRG)"]
        Login["dashboard/login.php<br/>(Acceso comercial)"]
        Leads["dashboard/leads.php<br/>(Panel privado de leads)"]
        Logout["dashboard/logout.php<br/>(Destrucción de sesión/cookie)"]
    end

    subgraph Logica["Capa de Negocio y Utilidades"]
        Gestor["GestorLeads.php / helpers.php<br/>(Auth, helpers de sesión)"]
        ModelLead["Lead.php / Nota.php<br/>(Clases de dominio)"]
        DBUsers["usuaris.php / UsuariDAO.php<br/>(Credenciales y hash)"]
    end

    subgraph Almacenamiento["Capa de Persistencia"]
        SesionServidor[("$_SESSION (U3)<br/>leads[], errors, valors_previs")]
        BaseDades[("MySQL 8.4 (U4)<br/>taules leads, usuaris, notes")]
        CookieNavegador[("$_COOKIE<br/>recorda_usuari / usuari (30 días)")]
        CarpetaPujades["pujades/<br/>(Documentos y briefings)"]
    end

    NavPublico -->|GET| Index
    Index -->|POST Datos + Fichero| Processar
    Processar -->|Llama| Gestor
    Processar -->|Instancia| ModelLead
    Processar -->|Guarda archivo| CarpetaPujades
    Processar -->|Persiste en| SesionServidor
    Processar -->|O persiste en| BaseDades

    NavComercial -->|GET / POST| Login
    Login -->|Verifica hash| DBUsers
    Login -->|Crea cookie 30 días| CookieNavegador
    NavComercial -->|GET| Leads
    Leads -->|Protegido por| Gestor
    Gestor -->|Valida sesión| SesionServidor
    Gestor -->|O auto-login con cookie| CookieNavegador
    NavComercial -->|GET| Logout
    Logout -->|Elimina| SesionServidor
    Logout -->|Caduca| CookieNavegador
```

---

## 🔄 5. El Patrón PRG (Post-Redirect-Get) y los *Sticky Forms*

### ¿Por qué existe el patrón PRG?
Si procesas un formulario y devuelves HTML directamente en la misma petición POST, cuando el usuario pulsa **F5 (Recargar)** en su navegador, el navegador muestra la clásica alerta: *"¿Desea volver a enviar el formulario?"*, duplicando registros o ventas.

Para evitarlo, se usa **Post-Redirect-Get**:
1. El usuario envía por **POST**.
2. El servidor procesa y responde con un código de redirección **HTTP 302** (cabecera `Location`).
3. El navegador hace un **GET limpio**. Si pulsa F5, solo recarga el GET.

```mermaid
sequenceDiagram
    autonumber
    actor U as Usuario
    participant P as processar_lead.php (POST)
    participant S as $_SESSION
    participant I as index.php (GET)

    U->>P: Envía Formulario (POST con errores: email vacío)
    Note over P: Validación del servidor:<br/>¡Error detectado!
    P->>S: Guarda $_SESSION['errors'] = ['Email invàlid']<br/>Guarda $_SESSION['valors_previs'] = ['nom'=>'Noé', 'serveis'=>['Web','SEO']]
    P-->>U: Redirección HTTP 302 a index.php
    U->>I: Petición GET limpia a index.php
    I->>S: Lee errors y valors_previs
    I->>S: unset($_SESSION['errors'], $_SESSION['valors_previs']) (Flash Data)
    Note over I: PHP inyecta en el HTML:<br/>value="Noé"<br/>checked en checkboxes Web y SEO
    I-->>U: Renderiza HTML final con los datos que el usuario escribió
```

### ¿Cómo funciona la sincronía HTML + PHP en los Sticky Forms?
El navegador **NUNCA** ejecuta PHP. PHP se ejecuta al 100% en el servidor y "escribe texto" en los atributos del HTML antes de enviarlo:

```php
<!-- Si el servicio está en el array previo, PHP escribe la palabra 'checked' -->
<input type="checkbox" name="serveis[]" value="Web" 
       <?= in_array('Web', $serveisPrevis, true) ? 'checked' : '' ?>>
```
Si la condición es verdadera, el navegador del cliente recibe literalmente:
`<input type="checkbox" name="serveis[]" value="Web" checked>`

---

## 🔐 6. Sesiones vs Cookies: El Sistema de Autenticación "Recorda'm"

### La gran diferencia técnica
- **`PHPSESSID` (Cookie de Sesión normal):** Se crea al hacer `session_start()`. Por defecto no tiene fecha de caducidad fijada (`expires: Session`), lo que significa que **cuando el usuario cierra el navegador por completo, el navegador destruye la cookie**. Al reabrir, el servidor no reconoce al usuario.
- **`recorda_usuari` (Cookie Persistente):** Se crea con `setcookie(..., time() + 30*24*3600)`. Se guarda físicamente en el disco duro del cliente durante 30 días, aunque cierre el navegador o apague el PC.

```mermaid
flowchart TD
    Inicio([Usuario intenta entrar a dashboard/leads.php]) --> CheckSesion{¿Existe $_SESSION['usuari']?}
    
    CheckSesion -- SÍ --> AccesoConcedido[Acceso Permitido al Panell de Leads]
    
    CheckSesion -- NO (Cerró el navegador) --> CheckCookie{¿Existe cookie persistente?}
    
    CheckCookie -- SÍ --> ValidaUser{¿El usuario existe en el sistema / BD?}
    
    ValidaUser -- SÍ --> AutoLogin[1. session_regenerate_id<br/>2. Recrea $_SESSION['usuari'] = cookie<br/>Auto-login transparente]
    AutoLogin --> AccesoConcedido
    
    ValidaUser -- NO --> RedirigeLogin[header Location: login.php]
    CheckCookie -- NO --> RedirigeLogin
    
    RedirigeLogin --> Fin([Muestra formulario de login])
```

---

## 🧩 7. ¿Qué son `bootstrap`, `vendor` y `autoload` en PHP?

En la Unidad 3 hacíamos `require_once` a mano en cada archivo. Pero en proyectos con bases de datos y DAOs (Unidad 4), tener 30 `require_once` al principio de cada fichero es inmanejable y propenso a errores.

Aquí es donde entra el ecosistema profesional de PHP:

```mermaid
graph LR
    subgraph EcosistemaComposer["Composer & PSR-4"]
        ComposerJSON["composer.json<br/>(Define namespaces)"] --> ComposerDump["composer dump-autoload"]
        ComposerDump --> VendorAutoload["vendor/autoload.php<br/>(Mapa automático de clases)"]
    end

    subgraph Inicializacion["Bootstrap (Punto Único de Arranque)"]
        Bootstrap["config/bootstrap.php<br/>1. Carga vendor/autoload.php<br/>2. Inicia session_start()<br/>3. Conecta a Base de Datos (PDO)<br/>4. Instancia DAOs"]
    end

    subgraph Controladores["Controladores Web"]
        ControladorA["index.php"] -->|require| Bootstrap
        ControladorB["dashboard/leads.php"] -->|require| Bootstrap
    end
```

### Conceptos Clave explicados fácil:
1. **`vendor/`:** Es la carpeta donde **Composer** descarga librerías de terceros (como si fuera el `node_modules` de Node o las librerías `.jar` de Maven/Gradle en DAM).
2. **`vendor/autoload.php`:** Un script generado automáticamente. En lugar de hacer `require 'Lead.php'`, PHP detecta cuándo usas `new Lead()` o `new App\DAO\LeadDAO()`, busca el fichero en disco y lo carga en milisegundos bajo demanda siguiendo el estándar PSR-4.
3. **`bootstrap.php`:** Es la "lista de verificación previa al despegue". Un único archivo central que todo controlador incluye para no repetir código:
   - Carga el autoload.
   - Arranca la sesión.
   - Carga las credenciales de la base de datos.
   - Configura la zona horaria y reporte de errores.

---

## 🛠️ 8. Análisis de los 2 Errores Señalados por Eloy (Para el Examen)

### ❌ Error 1: Bypass de la Cookie "Recorda'm" al cerrar el navegador
* **El síntoma que vio Eloy en U3_P2:** Marcaba "Recorda'm", cerraba el navegador por completo, escribía la URL directa `dashboard/leads.php` y la web lo expulsaba a `login.php`.
* **La causa:** En `leads.php` solo se comprobaba `if (!isset($_SESSION['usuari'])) { header('Location: login.php'); }`. Como el navegador destruyó la cookie de sesión al cerrarse, la sesión estaba vacía y `leads.php` lo echaba fuera sin comprobar si existía la cookie persistente `$_COOKIE['recorda_usuari']`.
* **La Solución de Examen:**
  ```php
  // Si no hay sesión pero hay cookie persistente válida, auto-login transparente:
  if (empty($_SESSION['usuari']) && !empty($_COOKIE['recorda_usuari'])) {
      $usuarioValido = $dao->findByUsuari($_COOKIE['recorda_usuari']);
      if ($usuarioValido !== null) {
          session_regenerate_id(true);
          $_SESSION['usuari'] = $usuarioValido->getUsuari();
      }
  }
  ```

### ❌ Error 2: Sticky Form ausente en los checkboxes `serveis[]`
* **El síntoma que vio Eloy en U3_P2:** Si el usuario marcaba *App mòbil* y *SEO*, pero cometía un error en el email, el formulario recargaba con sus datos de texto pero los checkboxes volvían a su estado inicial.
* **La causa:** Los checkboxes en `index.php` tenían valores estáticos en el HTML (el de *Web* tenía `checked` escrito a fuego).
* **La Solución (que ya aplicaste con éxito en U4_P1):**
  ```html
  <input type="checkbox" name="serveis[]" value="Web" 
         <?= in_array('Web', $old['serveis']) ? 'checked' : '' ?>>
  <input type="checkbox" name="serveis[]" value="App mòbil" 
         <?= in_array('App mòbil', $old['serveis']) ? 'checked' : '' ?>>
  ```

---

## 🏁 9. Checklist Resumen para el Examen Presencial de DWES

1. **Formularios con errores:** Siempre **PRG** (`$_SESSION['errors']`, `$_SESSION['valors_previs']`, `Location: index.php`). En la vista: `value="<?= e($valors['camp']) ?>"`, `in_array(...) ? 'checked' : ''`.
2. **Subida de archivos:** Validar siempre con `$_FILES['doc']['error'] === UPLOAD_ERR_OK`, comprobar tamaño en bytes y tipo MIME real con `new finfo(FILEINFO_MIME_TYPE)`.
3. **Cookies y Sesión:**
   - Sesión = `session_start()`, para datos volátiles o autenticación de navegación.
   - Cookie = `setcookie(nombre, valor, caducidad, '/')`, para recordar preferencias o auto-login.
   - Seguridad: Siempre `session_regenerate_id(true)` tras validar un login para evitar ataques de fijación de sesión (*Session Fixation*).
4. **Base de Datos y DAOs (U4):**
   - Siempre **consultas preparadas** (`$stmt->prepare()` y `$stmt->execute()`). Jamás concatenar variables en el SQL.
   - Usar `PDO::FETCH_CLASS` para mapear directamente a modelos, y `PDO::FETCH_KEY_PAIR` para conteos rápidos clave-valor (evitando el problema N+1).
