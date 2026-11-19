# EXAMEN PRÁCTICO 1ª EVALUACIÓN (SIMULACRO v4)

> **Módulo:** Despliegue de Aplicaciones Web (DaW) — 2º DAW Semipresencial  
> **Profesor:** Juan Ramón Collado Esteve  
> **Centro:** IES Maria Enríquez (Gandia) — Curso 2026/2027  
> **Duración:** 1 hora y 50 minutos  
> **Material permitido:** Dossier impreso oficial facilitado en el aula + Cheatsheet oficial de Docker de Aules. Prohibido el acceso a internet salvo indicación contraria del profesor.

---

## 🎯 Resultados de Aprendizaje Evaluados
- **RA1:** Implanta arquitecturas web analizando y aplicando criterios de funcionalidad y escalabilidad.
- **RA2:** Implanta aplicaciones web en servidores web, evaluando y aplicando criterios de configuración para su funcionamiento seguro y concurrente.
- **RA3:** Implanta aplicaciones web en entornos de contenedores, evaluando y aplicando criterios de despliegue, persistencia y orquestación.

---

## 📝 Instrucciones Generales de Examen
1. En los equipos de examen **no se dispone de permisos ni servidores web instalados directamente en el sistema anfitrión**. Toda la infraestructura solicitada debe desplegarse y gestionarse **mediante Docker y Docker Compose**.
2. Cada ejercicio debe contener los ficheros de configuración requeridos, la descripción justificada de los pasos realizados y las evidencias de comprobación (códigos de estado HTTP, estados de contenedores y respuestas de servicios).
3. **Criterio de evaluación:** La explicación debe ser detallada punto por punto (no se valorarán comandos o bloques de código pegados sin justificar qué realiza cada parámetro o directiva).

---

## 📋 EJERCICIOS PRÁCTICOS (Total: 10 Puntos)

---

### EJERCICIO 1 — Despliegue de Servidores Web Coexistentes con Docker (3,5 Puntos)

Se requiere implantar en un único contenedor Docker una infraestructura web donde convivan simultáneamente los dos servidores web más extendidos (**Nginx** y **Apache2**), atendiendo un total de **3 sitios web independientes basados en nombre de dominio** agrupados en solo dos puertos para no colisionar:

#### 1.1. Despliegue del Contenedor de Servidores (0,75 pts)
* Crea una red puente (*bridge*) personalizada de Docker llamada `red_servidores`.
* Despliega en dicha red un contenedor interactivo en segundo plano basado en la imagen `ubuntu:22.04` (o la imagen base facilitada en el examen) llamado `servidor_web_examen`.
* El contenedor debe exponer hacia el host los puertos necesarios para que ambos servidores sean accesibles desde el anfitrión:
  * Puerto **80** del host redirigido al puerto **80** del contenedor (para Nginx).
  * Puerto **8080** del host redirigido al puerto **8080** del contenedor (para Apache).
* Accede a la terminal del contenedor e instala los paquetes necesarios (`apache2`, `nginx`, `curl`, `nano`). Asegúrate de que los servicios arrancan de forma limpia y controlada sin bloquearse mutuamente.

#### 1.2. Servidor Nginx — Puerto 80 con Error 404 Personalizado (1,0 pts)
* Configura Nginx para escuchar exclusivamente en el puerto estándar **80**.
* Crea un bloque de servidor (*Server Block*) para el dominio **`tienda.daw`**:
  * Directorio raíz: `/var/www/tienda/`.
  * Archivo `index.html`: Debe mostrar un encabezado identificativo con tu nombre (`<h1>Tienda Online Nginx - Noé Conde Vila</h1>`).
  * Página de error 404 personalizada: Debe mostrar `/var/www/tienda/404.html` con el texto `<h2>Error 404: Recurso no encontrado en Tienda</h2>`.
* Configura la directiva de error correspondiente y el bloque de localización interno en el fichero del sitio.
* Habilita el sitio mediante su enlace simbólico en `sites-enabled` y elimina el sitio por defecto (*default*) para garantizar que no existan conflictos en el puerto 80.
* Valida la sintaxis del servidor y arranca el servicio Nginx.

#### 1.3. Servidor Apache2 — Puerto 8080 con Multisitio por Dominio (1,25 pts)
* Reconfigura Apache para que escuche exclusivamente en el puerto alternativo **`8080`** modificando su fichero global de puertos.
* Crea **dos VirtualHosts independientes** que escuchen en el puerto 8080 diferenciados por su directiva de nombre de dominio:
  1. **Sitio 1 (`blog.daw`):**
     * `ServerName blog.daw`
     * Raíz: `/var/www/blog/` con su fichero `index.html` identificativo.
     * Error 404 personalizado apuntando a `/404.html`.
  2. **Sitio 2 (`panel.daw`):**
     * `ServerName panel.daw`
     * Raíz: `/var/www/panel/` con su fichero `index.html` identificativo.
     * Error 404 personalizado apuntando a `/404.html`.
* Deshabilita el sitio por defecto (`000-default.conf`) y habilita ambos VirtualHosts.
* Comprueba la sintaxis de configuración con la herramienta oficial de Apache y arranca el servicio.

#### 1.4. Resolución Local y Verificación de Coexistencia (0,5 pts)
* Configura la resolución de nombres en `/etc/hosts` para que los 3 dominios (`tienda.daw`, `blog.daw` y `panel.daw`) resuelvan a la dirección de bucle local.
* Demuestra mediante peticiones de cabeceras (`curl -I`):
  * Que `http://tienda.daw` responde con código `200 OK` y cabecera de servidor Nginx.
  * Que una ruta inexistente en `tienda.daw` devuelve el código `404 Not Found` personalizado.
  * Que `http://blog.daw:8080` y `http://panel.daw:8080` responden independientemente con código `200 OK` y cabecera de servidor Apache.

---

### EJERCICIO 2 — Creación y Despliegue de Imagen con Dockerfile (3,0 Puntos)

Se requiere empaquetar un microservicio web estático corporativo en una imagen propia ultraligera basada en Alpine Linux:

#### 2.1. Preparación de Ficheros y Dockerfile (1,5 pts)
* En tu máquina anfitriona, crea una carpeta de trabajo llamada `microservicio_web/` y dentro una subcarpeta `html/` con:
  * `index.html`: `<h1>Microservicio Web Alpine — Noé Conde Vila</h1>`.
  * `version.txt`: Fichero de texto plano con la versión (`v1.0-produccion`).
* Diseña un fichero `Dockerfile` que cumpla las siguientes condiciones:
  * Utiliza como imagen base **`httpd:alpine`** (Apache sobre Alpine).  
    *(Nota técnica: ten en cuenta cuál es el DocumentRoot específico de Apache en esta distribución).*
  * Copia el contenido local de la carpeta `html/` al directorio web público del contenedor.
  * Documenta el puerto de escucha estándar (`80`).

#### 2.2. Construcción, Despliegue e Inspección (1,5 pts)
* Construye la imagen asignándole el nombre y etiqueta: **`micro-web:1.0`**.
* Despliega un contenedor a partir de dicha imagen con las siguientes directivas:
  * Nombre del contenedor: `app_micro_web`.
  * Ejecución desacoplada en segundo plano (*detached*).
  * Redirección de puertos: puerto **`9090`** del host al puerto `80` del contenedor.
* Verifica el estado del contenedor con las herramientas CLI de Docker.
* Realiza peticiones HTTP desde la terminal anfitriona a `http://localhost:9090` y a `http://localhost:9090/version.txt` comprobando la recepción del contenido.
* Accede a la consola interactiva del contenedor en ejecución, lista los ficheros alojados en el directorio web para certificar su correcta copia y sal de la sesión (recuerda la consola disponible en distribuciones Alpine).

---

### EJERCICIO 3 — Pila Multicontenedor con Docker Compose y Persistencia (3,5 Puntos)

Se requiere diseñar y desplegar una arquitectura multicontenedor completa para una aplicación web PHP conectada a una base de datos MySQL relacional con persistencia de datos y un gestor visual phpMyAdmin:

#### 3.1. Especificación del Fichero `compose.yml` (2,0 pts)
En una carpeta de trabajo `pila_compose/`, crea el fichero declarativo `compose.yml` estructurado con **tres servicios** conectados a una red común:

1. **Servicio Web (`app`):**
   * Imagen oficial: `php:8.3-apache`.
   * Nombre de contenedor: `web_app_examen`.
   * Mapeo de puertos: Host `8000` -> Contenedor `80`.
   * Montaje de volumen tipo *bind mount*: Carpeta local `./codigo` enlazada con `/var/www/html`.
   * Dependencia declarada: El servicio debe depender de la base de datos.
   * Política de reinicio: Siempre activo ante caídas (`always`).
   * Variables de entorno que indiquen el host y nombre de la base de datos.
2. **Servicio Base de Datos (`db`):**
   * Imagen oficial: `mysql:8.0` (o `mariadb:10.6`).
   * Nombre de contenedor: `db_datos_examen`.
   * Variables de entorno: Contraseña de root (`secreto`) y base de datos inicial (`corporativo_db`).
   * **Persistencia de datos (Crítico):** Los datos de MySQL deben almacenarse obligatoriamente en un **volumen con nombre (*Named Volume*)** registrado a nivel superior, de forma que los datos no se destruyan al reiniciar o recrear el contenedor.
   * Política de reinicio: `always`.
3. **Servicio Gestor (`phpmyadmin`):**
   * Imagen oficial: `phpmyadmin/phpmyadmin`.
   * Nombre de contenedor: `pma_examen`.
   * Mapeo de puertos: Host `8085` -> Contenedor `80`.
   * Variable de entorno para conectar automáticamente con el servicio de base de datos (`PMA_HOST`).
   * Dependencia declarada del servicio `db`.
4. **Red y Volúmenes:**
   * Definición explícita del volumen nombrado de datos.
   * Definición explícita de una red personalizada tipo *bridge* compartida por los 3 servicios.

#### 3.2. Script PHP de Conectividad a Base de Datos (0,5 pts)
* En la carpeta local `./codigo/`, implementa un script `index.php` que intente conectarse al servidor MySQL mediante `PDO` o `mysqli` leyendo las credenciales configuradas en las variables de entorno.
* Si la conexión tiene éxito, debe imprimir en verde un mensaje de confirmación con tu nombre y la base de datos conectada.
* Si la conexión falla, debe capturar la excepción y mostrar el error descriptivo en pantalla.

#### 3.3. Despliegue, Verificación y Demostración de Persistencia (1,0 pts)
* Arranca la pila completa con Docker Compose en segundo plano.
* Verifica con la CLI de Compose que los 3 contenedores se encuentran en estado `Up` y expone sus puertos correspondientes.
* *(Paso de rescate)*: Si la imagen PHP no incluye el controlador de MySQL habilitado, ejecuta el comando adecuado para instalar y habilitar las extensiones de MySQL en caliente.
* Comprueba desde el navegador o terminal anfitriona:
  * `http://localhost:8000`: Debe mostrar el mensaje de conexión satisfactoria.
  * `http://localhost:8085`: Accede a phpMyAdmin, inicia sesión con las credenciales configuradas y verifica la existencia de la base de datos `corporativo_db`.
* Muestra el comando para detener los contenedores manteniendo los volúmenes intactos para garantizar la persistencia.

---

## 📊 Rúbrica de Calificación (Sobre 10 Puntos)

| Bloque Evaluado | Puntos Máx. | Criterio de 100% | Criterio de Penalización |
| :--- | :---: | :--- | :--- |
| **E1: Contenedor Coexistencia** | **3,5 pts** | Contenedor levantado con puertos 80 y 8080, Nginx con 404, Apache en 8080 con 2 VirtualHosts, `/etc/hosts` y `curl -I` correctos. | Faltan VirtualHosts, colisión de puertos, sin página 404 o sin comprobación HTTP (-1 a -2 pts). |
| **E2: Dockerfile Alpine** | **3,0 pts** | `Dockerfile` canónico, DocumentRoot correcto en Alpine, build con tag, contenedor en puerto 9090 e inspección interna con `sh`. | Ruta web errónea de Alpine, puerto mal mapeado o sintaxis de `Dockerfile` incorrecta (-1 a -1,5 pts). |
| **E3: Compose Multicontenedor** | **3,5 pts** | 3 servicios coordinados, volumen nombrado persistente con sintaxis correcta, PHP conectado a MySQL con mensaje verde y phpMyAdmin operativo. | Fallo en conexión PHP-BD, volumen no declarado o sintaxis errónea en `compose.yml` (-1 a -2 pts). |

---

## ⚠️ Checklist Rápido de Errores Críticos a Evitar
* [ ] En Alpine Linux la consola es **`sh`**, nunca `bash`.
* [ ] El DocumentRoot en `httpd:alpine` es `/usr/local/apache2/htdocs/` (en Nginx Alpine es `/usr/share/nginx/html/`).
* [ ] En Nginx, los enlaces simbólicos en `sites-enabled/` deben usar **rutas absolutas** que empiecen por `/`.
* [ ] En Apache, cambiar el puerto en `/etc/apache2/ports.conf` (`Listen 8080`) antes de habilitar los VirtualHosts en `<VirtualHost *:8080>`.
* [ ] En `compose.yml`, los volúmenes con nombre en la raíz **deben llevar dos puntos al final**: `nombre_volumen:`.
* [ ] En PowerShell anfitrión, usar **`curl.exe`** en lugar del alias `curl` para evitar problemas de compatibilidad.
