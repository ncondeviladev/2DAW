# 📘 Guía de Resolución Paso a Paso — Simulacro DaW v4

> **Asignatura:** Despliegue de Aplicaciones Web (DaW) — 2º DAW Semipresencial  
> **Alumno:** Noé Conde Vila  
> **Uso:** Solucionario canónico con todas las directivas, ficheros y comandos explicados para obtener el 10/10 en el examen práctico de Juanra Collado.

---

## 🚀 EJERCICIO 1: Coexistencia Apache + Nginx en Contenedor Docker (3,5 Pts)

### Paso 1.1: Lanzar el contenedor base en la máquina anfitriona (Enfoque Docker CLI)
Desde la terminal PowerShell o Bash de la máquina de examen:

```bash
# 1. Crear red de examen:
docker network create red_servidores

# 2. Arrancar contenedor Ubuntu en segundo plano manteniendo proceso activo:
docker run -d -p 80:80 -p 8080:8080 \
  --name servidor_web_examen \
  --network red_servidores \
  ubuntu:22.04 tail -f /dev/null

# 3. Entrar a la terminal interactiva del contenedor:
docker exec -it servidor_web_examen bash
```

---

#### 💡 Variante Alternativa: Si Juanra pide levantarlo mediante Dockerfile en lugar de CLI:
Si el enunciado pide construir la imagen con Dockerfile para no instalar a mano dentro:
```dockerfile
# Dockerfile para Servidores Web Coexistentes
FROM ubuntu:22.04
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update && apt install -y apache2 nginx curl nano && rm -rf /var/lib/apt/lists/*
EXPOSE 80 8080
CMD service apache2 start && nginx -g "daemon off;"
```
Y se construye y lanza con:
```bash
docker build -t servidores-base:1.0 .
docker run -d -p 80:80 -p 8080:8080 --name servidor_web_examen servidores-base:1.0
docker exec -it servidor_web_examen bash
```

---

Dentro del contenedor Ubuntu (tanto en Opción CLI como Dockerfile):
```bash
# Actualizar repositorios e instalar paquetes necesarios:
apt update && apt install -y apache2 nginx nano curl

# Detener servicios por si arrancaron solos y colisionan:
service apache2 stop
service nginx stop
```

---

### Paso 1.2: Configuración de Nginx (Puerto 80 — `tienda.daw`)

```bash
# 1. Crear directorios y ficheros web:
mkdir -p /var/www/tienda
echo "<h1>Tienda Online Nginx - Noe Conde</h1>" > /var/www/tienda/index.html
echo "<h1>Error 404: Producto o pagina no encontrada en Tienda</h1>" > /var/www/tienda/404.html

# 2. Crear configuración del Server Block:
nano /etc/nginx/sites-available/tienda
```

**Contenido de `/etc/nginx/sites-available/tienda`:**
```nginx
server {
    listen 80;
    server_name tienda.daw;

    root /var/www/tienda;
    index index.html;

    # Página de error 404 personalizada:
    error_page 404 /404.html;
    location = /404.html {
        internal;
    }
}
```

```bash
# 3. Activar sitio mediante enlace simbólico (ruta absoluta obligatoria):
ln -s /etc/nginx/sites-available/tienda /etc/nginx/sites-enabled/

# 4. Eliminar el sitio default de Nginx para liberar el puerto 80:
rm -f /etc/nginx/sites-enabled/default

# 5. Validar sintaxis y arrancar Nginx:
nginx -t
service nginx start
```

---

### Paso 1.3: Configuración de Apache (Puerto 8080 — `blog.daw` y `panel.daw`)

```bash
# 1. Cambiar puerto de escucha de Apache a 8080:
nano /etc/apache2/ports.conf
```
*Modificar la línea `Listen 80` por:*
```apache
Listen 8080
```

```bash
# 2. Crear directorios y páginas web de ambos sitios:
mkdir -p /var/www/blog /var/www/panel
echo "<h1>Blog Tecnologico - Apache 8080</h1>" > /var/www/blog/index.html
echo "<h1>Error 404 - Pagina no encontrada</h1>" > /var/www/blog/404.html

echo "<h1>Panel de Control - Apache 8080</h1>" > /var/www/panel/index.html
echo "<h1>Error 404 - Pagina no encontrada</h1>" > /var/www/panel/404.html

# 3. Crear VirtualHost para blog.daw:
nano /etc/apache2/sites-available/blog.conf
```

**Contenido de `/etc/apache2/sites-available/blog.conf`:**
```apache
<VirtualHost *:8080>
    ServerName blog.daw
    DocumentRoot /var/www/blog
    ErrorDocument 404 /404.html

    ErrorLog ${APACHE_LOG_DIR}/blog_error.log
    CustomLog ${APACHE_LOG_DIR}/blog_access.log combined
</VirtualHost>
```

```bash
# 4. Crear VirtualHost para panel.daw:
nano /etc/apache2/sites-available/panel.conf
```

**Contenido de `/etc/apache2/sites-available/panel.conf`:**
```apache
<VirtualHost *:8080>
    ServerName panel.daw
    DocumentRoot /var/www/panel
    ErrorDocument 404 /404.html

    ErrorLog ${APACHE_LOG_DIR}/panel_error.log
    CustomLog ${APACHE_LOG_DIR}/panel_access.log combined
</VirtualHost>
```

```bash
# 5. Habilitar sitios y deshabilitar default:
a2ensite blog.conf panel.conf
a2dissite 000-default.conf

# 6. Comprobar sintaxis y arrancar Apache:
apachectl configtest       # Debe devolver: Syntax OK
service apache2 start
```

---

### Paso 1.4: Resolución en `/etc/hosts` y Comprobaciones

Dentro del contenedor:
```bash
nano /etc/hosts
```
Añadir a la línea `127.0.0.1`:
```text
127.0.0.1 localhost tienda.daw blog.daw panel.daw
```

**Comprobaciones con `curl -I`:**
```bash
# Nginx:
curl -I http://tienda.daw           # HTTP/1.1 200 OK (Server: nginx)
curl -I http://tienda.daw/noexiste  # HTTP/1.1 404 Not Found (Server: nginx)

# Apache:
curl -I http://blog.daw:8080        # HTTP/1.1 200 OK (Server: Apache)
curl -I http://blog.daw:8080/err    # HTTP/1.1 404 Not Found (Server: Apache)
curl -I http://panel.daw:8080       # HTTP/1.1 200 OK (Server: Apache)
```
*(Para salir del contenedor de vuelta al host: escribir `exit`)*.

---

## 📦 EJERCICIO 2: Microservicio Web con Dockerfile Propio (3,0 Pts)

Desde el host (tu máquina):

```bash
# 1. Crear estructura de carpetas:
mkdir -p microservicio_web/html
cd microservicio_web

# 2. Crear ficheros estáticos:
echo "<h1>Microservicio Web Alpine - Noe Conde Vila</h1>" > html/index.html
echo "Release 1.0 - Despliegue Produccion Alpine" > html/version.txt

# 3. Crear Dockerfile:
nano Dockerfile
```

**Contenido de `Dockerfile` (Opción Apache Alpine):**
```dockerfile
FROM httpd:alpine

# Copiamos la carpeta html al DocumentRoot por defecto de Apache en Alpine:
COPY ./html/ /usr/local/apache2/htdocs/

# Documentamos el puerto de escucha interno:
EXPOSE 80
```

*(Si el enunciado pidiera Nginx: `FROM nginx:alpine` y `COPY ./html/ /usr/share/nginx/html/`)*.

```bash
# 4. Construir la imagen (¡con el punto final . !):
docker build -t micro-web:1.0 .

# 5. Ejecutar el contenedor:
docker run -d -p 9090:80 --name app_micro_web micro-web:1.0

# 6. Comprobaciones de estado y acceso web:
docker ps
curl.exe http://localhost:9090
curl.exe http://localhost:9090/version.txt

# 7. Inspección interactiva (Alpine usa sh, no bash):
docker exec -it app_micro_web sh
ls -la /usr/local/apache2/htdocs/
exit
```

---

## 🚢 EJERCICIO 3: Entorno Multicontenedor con Docker Compose (3,5 Pts)

```bash
# 1. Crear estructura:
mkdir -p pila_compose/codigo
cd pila_compose
```

**Script `codigo/index.php`:**
```php
<?php
$host = getenv('MYSQL_HOST') ?: 'db';
$bd = 'corporativo_db';
$pass = 'secreto';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$bd", "root", $pass);
    echo "<h1>Conexion Exitosa a MySQL desde Docker Compose - Noe Conde</h1>";
} catch (PDOException $e) {
    echo "<h1>Error de conexion: " . $e->getMessage() . "</h1>";
}
?>
```

**Fichero `compose.yml`:**
```yaml
services:
  # 1. Servicio Web (PHP 8.3 + Apache)
  web:
    image: php:8.3-apache
    container_name: web_app_examen
    ports:
      - "8000:80"
    volumes:
      - ./codigo:/var/www/html
    environment:
      MYSQL_HOST: db
    depends_on:
      - db
    networks:
      - red_corporativa
    restart: always

  # 2. Base de Datos (MySQL 8.0)
  db:
    image: mysql:8.0
    container_name: db_datos_examen
    environment:
      MYSQL_ROOT_PASSWORD: secreto
      MYSQL_DATABASE: corporativo_db
    volumes:
      - datos_persistentes:/var/lib/mysql
    networks:
      - red_corporativa
    restart: always

  # 3. Gestor Gráfico (phpMyAdmin)
  gestor:
    image: phpmyadmin/phpmyadmin
    container_name: pma_examen
    ports:
      - "8085:80"
    environment:
      PMA_HOST: db
    depends_on:
      - db
    networks:
      - red_corporativa
    restart: always

# Registro de volúmenes persistentes con nombre (dos puntos finales obligatorios):
volumes:
  datos_persistentes:

# Red interna bridge:
networks:
  red_corporativa:
    driver: bridge
```

```bash
# 2. Desplegar la pila:
docker compose up -d

# 3. Comando de rescate si PHP necesita la extensión pdo_mysql:
docker exec -it web_app_examen docker-php-ext-install pdo_mysql mysqli
docker restart web_app_examen

# 4. Comprobar que los servicios están 'Up':
docker compose ps

# 5. Comprobación en navegador o terminal:
curl.exe http://localhost:8000     # Debe mostrar "Conexion Exitosa..."
# phpMyAdmin disponible en http://localhost:8085

# 6. Apagado del entorno al terminar el examen:
docker compose down        # Mantiene los datos
# docker compose down -v   # Si el profesor pide borrar volúmenes
```
