# ⚡ CHULETA RÁPIDA DE EXAMEN — DaW (Despliegue de Aplicaciones Web)
> **Asignatura:** Despliegue de Aplicaciones Web (2º DAW Semipresencial) — IES Maria Enríquez  
> **Profesor:** Juan Ramón Collado Esteve  
> **Uso:** Guía rápida de consulta en Markdown optimizada para búsqueda rápida (`Ctrl + F`).

---

## 📑 ÍNDICE RÁPIDO
1. [Linux & Gestión de Servicios](#1-linux--gestión-de-servicios)
2. [Apache 2 — Configuración y VirtualHosts](#2-apache-2--configuración-y-virtualhosts)
3. [Nginx — Configuración y Server Blocks](#3-nginx--configuración-y-server-blocks)
4. [Resolución de Nombres (/etc/hosts)](#4-resolución-de-nombres-etchosts)
5. [Docker CLI — Comandos Esenciales](#5-docker-cli--comandos-esenciales)
6. [Dockerfile — Plantillas Canónicas](#6-dockerfile--plantillas-canónicas)
7. [Docker Compose — Plantilla Multicontenedor (compose.yml)](#7-docker-compose--plantilla-multicontenedor-composeyml)
8. [Kubernetes — Manifiesto y Comandos (kube.yml)](#8-kubernetes--manifiesto-y-comandos-kubeyml)
9. [Comandos de Rescate y Emergencia](#9-comandos-de-rescate-y-emergencia)
10. [Localizador Rápido en tu Dossier de PECs (32 Páginas)](#10-localizador-rápido-en-tu-dossier-de-pecs)

---

## 1. Linux & Gestión de Servicios

### Control de Servicios (En Contenedor o VM)
```bash
# Iniciar / Reiniciar / Detener servicio (funciona en Docker y VM sin systemd)
service apache2 start
service apache2 restart
service apache2 status
service nginx restart
service mysql restart

# Si el sistema usa systemctl (VM completa):
sudo systemctl restart apache2
sudo systemctl restart nginx
```

### Comprobaciones y Pruebas con `curl`
```bash
# Ver cabeceras HTTP (código 200, 404, etc.):
curl -I http://localhost:8080
curl -I http://sitio1.daw:80
curl -I http://sitio1.daw:80/ruta-inexistente   # Debe dar 404

# Ver contenido HTML completo:
curl http://sitio1.daw
```

---

## 2. Apache 2 — Configuración y VirtualHosts

### A. Fichero de Puertos (`/etc/apache2/ports.conf`)
Define en qué puertos escucha Apache. Si convive con Nginx, Apache va al puerto **8080** (o el que pida el examen):
```apache
Listen 8080
```

### B. Plantilla de VirtualHost (`/etc/apache2/sites-available/apache1.conf`)
```apache
<VirtualHost *:8080>
    ServerName apache1.daw
    DocumentRoot /var/www/apache1

    # Página de error 404 personalizada:
    ErrorDocument 404 /404.html

    ErrorLog ${APACHE_LOG_DIR}/apache1_error.log
    CustomLog ${APACHE_LOG_DIR}/apache1_access.log combined
</VirtualHost>
```

### C. Activar Sitio, Comprobar y Reiniciar
```bash
# 1. Crear directorio y archivos web:
mkdir -p /var/www/apache1
echo "<h1>Bienvenido a Apache 1</h1>" > /var/www/apache1/index.html
echo "<h1>Error 404 - Pagina no encontrada</h1>" > /var/www/apache1/404.html

# 2. Habilitar el sitio y deshabilitar el default si molesta:
a2ensite apache1.conf
a2dissite 000-default.conf

# 3. Validar sintaxis (¡OBLIGATORIO antes de reiniciar!):
apachectl configtest       # Debe responder: Syntax OK

# 4. Reiniciar Apache:
service apache2 restart
```

---

## 3. Nginx — Configuración y Server Blocks

### A. Plantilla de Server Block (`/etc/nginx/sites-available/sitio1.conf`)
En Nginx el puerto se define directamente en la directiva `listen`:
```nginx
server {
    listen 80;
    server_name sitio1.daw;

    root /var/www/sitio1;
    index index.html;

    # Página de error 404 personalizada:
    error_page 404 /404.html;
    location = /404.html {
        root /var/www/sitio1;
        internal;
    }

    access_log /var/log/nginx/sitio1_access.log;
    error_log /var/log/nginx/sitio1_error.log;
}
```

### B. Activar Sitio con Enlace Simbólico, Comprobar y Reiniciar
```bash
# 1. Crear directorio y archivos web:
mkdir -p /var/www/sitio1
echo "<h1>Bienvenido a Nginx 1</h1>" > /var/www/sitio1/index.html
echo "<h1>Error 404 - Pagina no encontrada en Nginx</h1>" > /var/www/sitio1/404.html

# 2. Crear enlace simbólico en sites-enabled:
ln -sf /etc/nginx/sites-available/sitio1.conf /etc/nginx/sites-enabled/

# 3. Eliminar el sitio default si ocupa el puerto 80:
rm -f /etc/nginx/sites-enabled/default

# 4. Validar sintaxis (¡OBLIGATORIO!):
nginx -t                   # Debe responder: syntax is ok / test is successful

# 5. Reiniciar Nginx:
service nginx restart
```

---

## 4. Resolución de Nombres (`/etc/hosts`)

Para que la máquina reconozca dominios como `sitio1.daw` o `apache1.daw` apuntando a local:

```bash
# Editar fichero:
nano /etc/hosts
```
Añadir al final de la línea `127.0.0.1`:
```text
127.0.0.1 localhost apache1.daw apache2.daw sitio1.daw sitio2.daw
```
*(En Windows la ruta equivalente es `C:\Windows\System32\drivers\etc\hosts` editado como Administrador).*

---

## 5. Docker CLI — Comandos Esenciales

### Gestión de Contenedores
```bash
# Arrancar contenedor en segundo plano con puerto y nombre:
docker run -d -p 8080:80 --name mi-web nginx:alpine

# Arrancar contenedor interactivo con terminal bash/sh:
docker run -it --name mi-ubuntu ubuntu:22.04 bash

# Ver contenedores en ejecución:
docker ps

# Ver TODOS los contenedores (incluidos parados):
docker ps -a

# Detener y eliminar contenedor:
docker stop mi-web
docker rm mi-web
docker rm -f mi-web        # Fuerza parada y borrado

# Entrar a la consola de un contenedor ya en marcha:
docker exec -it mi-web sh   # (En Alpine usar sh, en Ubuntu/Debian bash)

# Ver logs de un contenedor:
docker logs mi-web
docker logs -f mi-web       # En tiempo real (follow)
```

### Redes y Volúmenes por CLI
```bash
# Redes (bridge por defecto):
docker network create red-examen
docker network ls

# Volúmenes persistentes con nombre:
docker volume create datos-mysql
docker volume ls

# Contenedor conectado a red y volumen nombrado:
docker run -d --name bbdd \
  --network red-examen \
  -v datos-mysql:/var/lib/mysql \
  -e MYSQL_ROOT_PASSWORD=secreto \
  mysql:8.0
```

### Limpieza de Sistema
```bash
docker image prune -a      # Borra imágenes no usadas
docker container prune     # Borra contenedores detenidos
docker volume prune        # Borra volúmenes huérfanos
docker system prune -a     # Limpieza total de todo lo que no esté corriendo
```

---

## 6. Dockerfile — Plantillas Canónicas

### Opción A: Servidor Web Estático con Apache (`httpd:alpine`)
```dockerfile
FROM httpd:alpine

# Copiar archivos web locales a la carpeta pública de Apache:
COPY ./static /usr/local/apache2/htdocs/

# Puerto de escucha documentado:
EXPOSE 80
```

### Opción B: Servidor Web con Nginx (`nginx:alpine`)
```dockerfile
FROM nginx:alpine

# Copiar archivos web a la carpeta pública de Nginx:
COPY ./static /usr/share/nginx/html/

EXPOSE 80
```

### Opción C: Ubuntu con Servidores Web Instalados
```dockerfile
FROM ubuntu:22.04

# Evitar preguntas interactivas de zona horaria:
ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && apt install -y \
    apache2 \
    nginx \
    curl \
    nano \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 80 8080

CMD ["service", "apache2", "start", "&&", "service", "nginx", "start"]
```

### Comandos de Construcción y Ejecución de Dockerfile
```bash
# Construir imagen (¡No olvidar el punto final . !):
docker build -t mi-portal:1.0 .

# Ejecutar contenedor desde esa imagen:
docker run -d -p 8888:80 --name portal-web mi-portal:1.0
```

---

## 7. Docker Compose — Plantilla Multicontenedor (`compose.yml`)

Estructura completa de 3 servicios (Web PHP + BBDD MySQL + phpMyAdmin):

```yaml
services:
  # 1. SERVIDOR WEB (PHP + Apache)
  app:
    image: php:8.3-apache
    container_name: app_web
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    depends_on:
      - db
    networks:
      - red_interna

  # 2. BASE DE DATOS (MySQL)
  db:
    image: mysql:8.0
    container_name: db_mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: examen_db
      MYSQL_USER: user
      MYSQL_PASSWORD: user123
    volumes:
      - datos_db:/var/lib/mysql
    networks:
      - red_interna

  # 3. GESTOR WEB DE BBDD (phpMyAdmin)
  phpmyadmin:
    image: phpmyadmin:latest
    container_name: pma
    ports:
      - "8081:80"
    environment:
      PMA_HOST: db
    depends_on:
      - db
    networks:
      - red_interna

# Volúmenes nombrados persistentes (los dos puntos finales son obligatorios):
volumes:
  datos_db:

# Redes compartidas:
networks:
  red_interna:
    driver: bridge
```

### Comandos Docker Compose
```bash
docker compose up -d       # Levanta todos los servicios en segundo plano
docker compose ps          # Muestra estado de los servicios del compose
docker compose logs app    # Ver logs del servicio 'app'
docker compose down        # Detiene y borra contenedores y redes del compose
docker compose down -v     # Detiene y ADEMÁS borra los volúmenes persistentes
```

---

## 8. Kubernetes — Manifiesto y Comandos (`kube.yml`)

Despliegue con **3 réplicas** de servidor web y servicio para exponerlo:

```yaml
# 1. DEPLOYMENT (3 Réplicas de la App Web)
apiVersion: apps/v1
kind: Deployment
metadata:
  name: deployment-web
spec:
  replicas: 3
  selector:
    matchLabels:
      app: web
  template:
    metadata:
      labels:
        app: web
    spec:
      containers:
      - name: contenedor-apache
        image: php:8.3-apache
        ports:
        - containerPort: 80

---

# 2. SERVICE (Para acceder a los Pods)
apiVersion: v1
kind: Service
metadata:
  name: servicio-web
spec:
  type: NodePort
  selector:
    app: web
  ports:
    - protocol: TCP
      port: 80
      targetPort: 80
      nodePort: 30080
```

### Comandos Kubernetes (`kubectl`)
```bash
# Aplicar el manifiesto:
kubectl apply -f kube.yml

# Ver el estado de los Pods (debe haber 3 en estado Running):
kubectl get pods

# Ver servicios y puertos asignados:
kubectl get services

# Ver logs de un pod específico:
kubectl logs <nombre-del-pod>

# Eliminar infraestructura:
kubectl delete -f kube.yml
```

---

## 9. Comandos de Rescate y Emergencia

* **Si la app PHP en Docker dice que no encuentra el driver de MySQL (`mysqli` / `pdo_mysql`):**
  ```bash
  docker exec -it <nombre-contenedor-php> docker-php-ext-install mysqli pdo_mysql
  docker restart <nombre-contenedor-php>
  ```
* **Si necesitas hacer ping dentro de un contenedor y no está instalado:**
  ```bash
  docker exec -it <contenedor> apt update && apt install -y iputils-ping
  ```
* **Si una consola en Alpine no reconoce `bash`:**
  ```bash
  # Alpine usa 'sh' en lugar de 'bash':
  docker exec -it <contenedor-alpine> sh
  ```

---

## 10. Localizador Rápido en tu Dossier de PECs

*(Páginas impresas que te entregará Juanra en el examen):*

| Lo que pide el examen | PEC | Pág en cabecera del documento |
| :--- | :---: | :---: |
| **Apache 404 personalizado** (`ErrorDocument 404`) | PEC 1 | **2 / 19** |
| **Nginx 404 personalizado** (`error_page 404`) | PEC 1 | **3 / 19** y **4 / 19** |
| **Apache cambiar puerto** (`ports.conf Listen 8089`) | PEC 1 | **5 / 19** |
| **Nginx cambiar puerto** (`listen 8089 default_server`) | PEC 1 | **6 / 19** y **7 / 19** |
| **Nginx Server Blocks** (`server_name sitio1.daw`) | PEC 1 | **9 / 19** y **10 / 19** |
| **Resolución en `/etc/hosts`** (`127.0.0.1 ...`) | PEC 1 | **12 / 19** |
| **Apache VirtualHosts** (`<VirtualHost *:8080>`) | PEC 1 | **14 / 19** y **15 / 19** |
| **Dockerfile Apache Alpine** (`FROM httpd:alpine`) | PEC 2 | **1 / 6** |
| **Docker build & run** (`docker build -t ... .`) | PEC 2 | **2 / 6** |
| **Docker Red y Volumen CLI** (`network create`, `volume create`) | PEC 2 | **4 / 6** y **5 / 6** |
| **Docker Compose YAML** (`services: app, db, phpmyadmin`) | PEC 3 | **1 / 7** y **3 / 7** |
| **Kubernetes 3 Réplicas** (`Deployment replicas: 3`) | PEC 3 | **6 / 7** |
| **Kubernetes Verificación** (`kubectl get pods`) | PEC 3 | **7 / 7** |
