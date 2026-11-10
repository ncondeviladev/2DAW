# Contexto del proyecto: TechLeads

## Qué es

TechLeads es una aplicación web sencilla para recibir solicitudes comerciales ("leads") de posibles clientes y permitir que el equipo comercial las consulte y gestione desde un panel privado. La interfaz y buena parte del código están en catalán.

## Tecnologías

- PHP 8.3 o superior. El contenedor usa PHP 8.5 con Apache.
- MySQL 8.4, accedido mediante PDO y el controlador `pdo_mysql`.
- Composer para el autoload PSR-4: `App\` apunta a `src/`.
- Docker Compose para ejecutar la aplicación, la base de datos y phpMyAdmin.
- Tailwind CSS cargado desde CDN en las vistas.

No se observa un framework PHP ni una suite de pruebas automatizada configurada.

## Estructura y puntos de entrada

- `public/index.php`: formulario público para crear un lead.
- `public/processar_lead.php`: recibe y valida el envío del formulario, procesa el documento adjunto y guarda el lead.
- `public/dashboard/login.php`: inicio de sesión del panel.
- `public/dashboard/leads.php`: listado, avance de estado y eliminación de leads.
- `public/dashboard/lead.php`: detalle de un lead.
- `public/dashboard/editar.php`: edición de un lead y posible sustitución de su documento.
- `public/dashboard/logout.php`: cierre de sesión.
- `config/bootstrap.php`: carga el autoloader, inicia la sesión, crea la conexión y los DAO; define la carpeta de documentos.
- `config/database.php`: configuración de conexión a MySQL.
- `src/Database/DBConnection.php`: crea y reutiliza una conexión PDO.
- `src/DAO/IDbAccess.php`: contrato genérico de acceso a datos.
- `src/DAO/LeadDAO.php` y `src/DAO/UsuariDAO.php`: consultas y persistencia de leads y usuarios.
- `src/Model/Lead.php` y `src/Model/Usuari.php`: modelos del dominio.
- `src/helpers.php`: escape HTML, validación, manejo de archivos, filtrado de servicios y comprobación de sesión.
- `databases/base-de-dades.sql`: esquema y datos iniciales.
- `vistes/`: cabeceras y pies compartidos para la web pública y el panel.
- `public/pujades/`: documentos subidos por los usuarios.
- `public/prova-*.php`: páginas auxiliares para probar modelos, DAO, conexión y carga de archivos.

## Modelo de datos

### `leads`

Incluye nombre, email, teléfono y empresa (estos dos últimos opcionales), servicios seleccionados en una columna JSON, presupuesto, mensaje opcional, nombre del documento adjunto opcional, estado y fecha de creación.

Los estados definidos en el esquema y en el modelo son `nou`, `contactat` y `tancat`. Los servicios permitidos por el modelo son `Web`, `App mòbil`, `SEO` y `Cloud`.

### `usuaris`

Guarda nombre de usuario, hash de contraseña y rol. Los roles definidos son `comercial` y `administrador`.

El SQL incluye usuarios y leads de ejemplo. Los hashes de los usuarios están guardados con el formato de `password_hash`.

## Flujos principales

### Crear un lead

1. El formulario de `public/index.php` envía los datos por POST a `public/processar_lead.php`.
2. El controlador recoge los datos, filtra los servicios y valida nombre, email y presupuesto. También comprueba que se hayan aceptado los términos.
3. Si se adjunta un documento, `pujarArxiu()` comprueba tamaño y tipo MIME real. Se permiten JPEG, PNG y PDF; el límite predeterminado es 2 MiB.
4. `LeadDAO` persiste el lead. Si falla el guardado tras subir un documento, se intenta eliminar el archivo para no dejarlo huérfano.
5. Ante errores de validación, se guardan errores y valores anteriores en la sesión y se redirige al formulario.

### Gestionar leads

El panel requiere una sesión con `$_SESSION['usuari']`. El listado permite avanzar el estado del lead y eliminarlo. El detalle muestra sus datos y el enlace al documento, y la página de edición permite cambiar los campos y sustituir el documento.

Al editar, el identificador y el estado actuales se conservan. Si se carga un documento nuevo, el anterior se elimina después de actualizar la base de datos; si falla la actualización, se intenta borrar el nuevo.

### Autenticación

Las contraseñas se verifican con `password_verify()`. Tras iniciar sesión se regenera el identificador de sesión. El cierre de sesión vacía y destruye la sesión.

## Ejecución local

La configuración de Docker Compose expone:

- Aplicación web: `http://localhost:8080`
- phpMyAdmin: `http://localhost:8081`

La aplicación se conecta al servicio Docker `db`, a la base `techleads`. Para iniciar los servicios:

```bash
docker compose up --build
```

`databases/base-de-dades.sql` contiene el esquema y datos iniciales. No aparece configurado como script de inicialización en `docker-compose.yml`; puede ser necesario importarlo manualmente en MySQL antes de usar la aplicación. El volumen `db_data` conserva los datos de la base de datos.

## Convenciones útiles al cambiar código

- Mantener el autoload PSR-4 y los namespaces bajo `App\`.
- Usar los modelos para representar entidades y los DAO para las consultas PDO.
- Usar consultas preparadas para valores recibidos de peticiones.
- Escapar contenido dinámico al mostrarlo en HTML con `e()`.
- Mantener los mensajes y el texto de interfaz en catalán, siguiendo el estilo existente.
- Al cambiar estados, respetar los valores definidos en `Lead` y en el esquema SQL.
- Al modificar el flujo de documentos, considerar tanto la base de datos como el archivo físico para evitar archivos huérfanos.
- Las páginas del panel que manejan leads deben comprobar la sesión con `requereixLogin()`.

## Aspectos a tener en cuenta

- La cookie "recordar" almacena el nombre de usuario, no un token de autenticación; el propio código señala que es una solución de ejemplo y no apropiada para producción.
- Los datos de conexión de `config/database.php` corresponden al entorno Docker local; no deben tratarse como configuración adecuada para producción.
- Los documentos se guardan bajo `public/pujades`, que está dentro del directorio público de Apache.
- El proyecto incluye páginas `prova-*.php` con fines de prueba. Revisar su exposición antes de desplegar.
- Al cambiar autenticación, permisos u operaciones de escritura, revisar el control de acceso y la protección de las peticiones además del flujo funcional.
