# Simulacro de Examen Práctico DaW - Convocatoria Noviembre 2026 (v3)

**Asignatura:** Desplegament d'Aplicacions Web (DaW)  
**Profesor:** Juan Ramón Collado  
**Tiempo estimado:** 90 - 110 minutos  
**Entorno de examen:** Ubuntu / Docker CLI / Docker Compose

---

## 🎯 Contexto Real del Examen
En el aula dispones de Docker instalado en la máquina anfitriona. Toda la infraestructura se desplegará mediante contenedores, sin máquinas virtuales pesadas ni herramientas externas como FileZilla.
El examen evalúa tu soltura con la terminal, gestión de contenedores, servidores web conviviendo en un mismo entorno, creación de imágenes personalizadas con `Dockerfile` y orquestación multicontenedor con `docker compose`.

---

## FASE 1: Preparación del Entorno y Despliegue del Contenedor Base (20%)
El departamento necesita un servidor Linux unificado para alojar servicios web.

1. **Crear una red puente personalizada de Docker:**
   - Nombre de la red: `red_examen_daw`.
2. **Lanzar un contenedor interactivo en segundo plano o persistente:**
   - Imagen base: `ubuntu:22.04` (o la disponible en el aula).
   - Nombre del contenedor: `servidor_web`.
   - Conectado a la red `red_examen_daw`.
   - Puertos expuestos al host:
     - Puerto `80` del host redirigido al `80` del contenedor.
     - Puerto `8080` del host redirigido al `8080` del contenedor.
3. **Acceder a la terminal del contenedor:**
   - Entrar mediante `docker exec` en una sesión `bash`.
   - Actualizar repositorios e instalar: `nano`, `curl`, `iproute2`, `apache2`, `nginx`.
   - Detener temporalmente los servicios para evitar conflictos iniciales de arranque.

---

## FASE 2: Convivencia y Configuración de Servidores Web (35%)
Dentro del contenedor `servidor_web`, debes configurar tanto **Nginx** como **Apache** para que convivan sin colisionar de puertos.

### 2.1. Configuración de Nginx (Puerto 80)
- Nginx atenderá en el puerto estándar `80`.
- Crea un Virtual Host para el dominio: `portal.daw`.
- Directorio raíz: `/var/www/portal/`.
- Contenido (`index.html`): `<h1>Bienvenido a Nginx - Portal Principal</h1>`.
- **Página de error 404 personalizada:**
  - Debe devolver el fichero `/var/www/portal/404.html` con el texto `<h2>Error 404: Recurso no encontrado en Portal</h2>`.
  - Configura la directiva `error_page 404 /404.html;` en el bloque de servidor.
- Activa el sitio mediante enlace simbólico en `sites-enabled` y verifica sintaxis con `nginx -t`.
- Inicia el servicio `nginx`.

### 2.2. Configuración de Apache (Puerto 8080)
- Modifica Apache para que escuche exclusivamente en el puerto `8080` (en `/etc/apache2/ports.conf`).
- Crea dos Virtual Hosts basados en nombre que escuchen en `<VirtualHost *:8080>`:
  1. **Sitio 1:**
     - Dominio: `apache1.daw` (`ServerName apache1.daw`).
     - Directorio raíz: `/var/www/apache1/`.
     - Contenido: `<h1>Apache VirtualHost 1 - Funcionando en 8080</h1>`.
  2. **Sitio 2:**
     - Dominio: `apache2.daw` (`ServerName apache2.daw`).
     - Directorio raíz: `/var/www/apache2/`.
     - Contenido: `<h1>Apache VirtualHost 2 - Funcionando en 8080</h1>`.
- Habilita ambos sitios con `a2ensite` y deshabilita el `000-default.conf` con `a2dissite`.
- Comprueba la sintaxis con `apachectl configtest` e inicia el servicio `apache2`.

### 2.3. Resolución Local y Comprobación
- Modifica `/etc/hosts` dentro del contenedor para resolver `portal.daw`, `apache1.daw` y `apache2.daw` a `127.0.0.1`.
- Comprueba mediante `curl -I`:
  - `curl -I http://portal.daw` (debe devolver Server: nginx y HTTP 200).
  - `curl -I http://portal.daw/noexiste` (debe devolver HTTP 404 personalizado).
  - `curl -I http://apache1.daw:8080` (debe devolver Server: Apache y HTTP 200).
  - `curl -I http://apache2.daw:8080` (debe devolver Server: Apache y HTTP 200).

---

## FASE 3: Empaquetado de Imagen con Dockerfile (20%)
*(Trabajar desde la máquina anfitriona / host, fuera del contenedor)*

Se solicita crear un microservicio web estático ligero y distribuible.

1. Crea un directorio de trabajo en el host llamado `mi_app_alpine`.
2. Dentro, crea un archivo `index.html` con un mensaje identificativo:
   `<h1>Microservicio Apache Alpine - Noe Conde</h1>`.
3. Crea un archivo `Dockerfile` basado en `httpd:alpine`:
   - Copia tu `index.html` a la ruta por defecto de Apache en Alpine (`/usr/local/apache2/htdocs/`).
   - Expón el puerto `80`.
4. Construye la imagen con el tag:
   - `docker build -t mi-web-alpine:1.0 .`
5. Lanza un contenedor a partir de dicha imagen:
   - Nombre: `web_alpine_test`.
   - Redirige el puerto `9000` del host al `80` del contenedor.
6. Comprueba con `curl -I http://localhost:9000` o desde el navegador.

---

## FASE 4: Orquestación con Docker Compose (25%)
*(Trabajar desde la máquina anfitriona / host)*

Despliega un entorno multicontenedor clásico para desarrollo web LAMP (PHP + MySQL + phpMyAdmin).

1. Crea un directorio llamado `compose_stack`.
2. Crea el fichero `compose.yml` (o `docker-compose.yml`) con los siguientes servicios:
   - **`db` (Base de Datos):**
     - Imagen: `mysql:8.0` (o `mariadb:10.6`).
     - Variables de entorno: `MYSQL_ROOT_PASSWORD=secreto`, `MYSQL_DATABASE=tienda_db`.
     - Volumen con nombre (`datos_mysql`) montado en `/var/lib/mysql` para garantizar persistencia.
   - **`admin` (Gestor Web):**
     - Imagen: `phpmyadmin/phpmyadmin` (o `adminer:latest`).
     - Puerto expuesto: `8085:80`.
     - Variable de entorno que apunte al host de la base de datos (`PMA_HOST: db`).
     - Depende de `db` (`depends_on: [db]`).
   - **`red`:**
     - Todos los servicios deben comunicarse a través de una red dedicada `red_stack`.
   - **`volúmenes`:**
     - Declaración explícita del volumen `datos_mysql`.
3. Arranca el stack en segundo plano:
   - `docker compose up -d`
4. Comprueba el estado con `docker compose ps` y verifica que los logs no muestran errores (`docker compose logs`).
5. Realiza la comprobación de acceso HTTP al puerto `8085`.

---

## 🏁 Criterios de Evaluación y Entrega
- Sin conflictos de puertos entre servidores.
- Sintaxis correcta en ficheros de configuración (`nginx -t`, `apachectl configtest`).
- Correcto uso de volúmenes persistentes en Compose.
- Limpieza final del entorno de pruebas tras verificar.
