# DAW — Examen Práctico 1ª Evaluación (Simulacro)

> **Módulo:** Despliegue de Aplicaciones Web (DAW) — 2º DAW Semipresencial  
> **Profesor:** Juanra Collado  
> **Centro:** IES Maria Enríquez (Gandia) — Curso 2026/2027  
> **Tiempo estimado:** 2 horas  
> **Material permitido:** Único fichero PDF entregado previamente a través de Aules.

---

## 🎯 Resultados de Aprendizaje (RA's) Evaluados
- **RA1:** Implanta arquitecturas web analizando y aplicando criterios de funcionalidad y escalabilidad.
- **RA2:** Implanta aplicaciones web en servidores web, evaluando y aplicando criterios de configuración para su funcionamiento seguro y concurrente.
- **RA3:** Implanta aplicaciones web en servidores de aplicaciones y entornos de contenedores, evaluando y aplicando criterios de despliegue y persistencia.

---

## 📝 Instrucciones Generales
1. Los ejercicios se pueden resolver de forma aislada o encadenada.
2. Todo el código de configuración, ficheros (`Dockerfile`, `compose.yml`, `.conf`) y capturas de comprobación deben quedar registrados para la entrega.
3. El examen consta de **3 bloques prácticos** puntuados sobre un total de **10 puntos**. Para aprobar se exige una puntuación mínima de 5 puntos globales.

---

## 📋 Enunciado de los Ejercicios

### Ejercicio 1: Coexistencia Apache2 + Nginx con Multisitio por Dominio (3,5 puntos)

Se requiere configurar un entorno de servidores web donde convivan **Apache2** y **Nginx** en la misma máquina, implementando **multisitio por nombre de dominio** en ambos servidores (un total de **4 sitios web simultáneos** agrupados en solo 2 puertos):

1. **Configuración de Apache2 (Puerto 8080 - 2 sitios por dominio) (1,5 pts):**
   - Configura Apache para escuchar únicamente en el puerto **8080** en `/etc/apache2/ports.conf`.
   - Crea dos VirtualHosts independientes que escuchen en el puerto 8080 y se diferencien por su directiva `ServerName`:
     - **Sitio A1:** `ServerName apache1.daw`, con `DocumentRoot /var/www/apache1/`. Su `index.html` debe mostrar: `Bienvenido a Apache 1 - [Tu Nombre]`.
     - **Sitio A2:** `ServerName apache2.daw`, con `DocumentRoot /var/www/apache2/`. Su `index.html` debe mostrar: `Bienvenido a Apache 2 - [Tu Nombre]`.
   - Ambos sitios deben tener configurada su página de error **404** personalizada con `ErrorDocument 404 /404.html`.
   - Habilita ambos sitios con `a2ensite` y deshabilita el default previo.

2. **Configuración de Nginx (Puerto 80 - 2 sitios por dominio) (1,5 pts):**
   - Configura Nginx en el puerto **80** con dos bloques de servidor independientes diferenciados por `server_name`:
     - **Sitio N1:** `server_name sitio1.daw;`, con `root /var/www/sitio1;`. Su `index.html` debe mostrar: `Bienvenido a Nginx 1 - [Tu Nombre]`.
     - **Sitio N2:** `server_name sitio2.daw;`, con `root /var/www/sitio2;`. Su `index.html` debe mostrar: `Bienvenido a Nginx 2 - [Tu Nombre]`.
   - Ambos sitios deben contar con error 404 personalizado (`error_page 404 /404.html;`).
   - Activa ambos sitios mediante sus enlaces simbólicos (`ln -s`) y elimina el default previo de `sites-enabled`.

3. **Resolución Local y Comprobaciones (0,5 pts):**
   - Configura el fichero `/etc/hosts` para que resuelva los 4 dominios a la dirección local:
     ```text
     127.0.0.1 apache1.daw apache2.daw sitio1.daw sitio2.daw
     ```
   - Comprueba la sintaxis de ambos servidores (`apachectl configtest` y `nginx -t`) y reinicia los servicios.
   - Realiza peticiones por terminal con `curl -I` para verificar que los 4 sitios responden con código `200 OK` en su raíz y `404 Not Found` en rutas inexistentes:
     - `curl -I http://apache1.daw:8080` y `curl -I http://apache1.daw:8080/err`
     - `curl -I http://apache2.daw:8080` y `curl -I http://apache2.daw:8080/err`
     - `curl -I http://sitio1.daw:80` y `curl -I http://sitio1.daw:80/err`
     - `curl -I http://sitio2.daw:80` y `curl -I http://sitio2.daw:80/err`

---

### Ejercicio 2: Creación de Imagen Personalizada con Dockerfile (3 puntos)

Se necesita empaquetar un portal corporativo estático en una imagen propia, optimizada y ligera de contenedor, simulando el flujo real visto en la PEC 2 (Octopus) y las prácticas guiadas de la Unidad 2:

1. **Estructura y Fichero Dockerfile (1,5 pts):**
   - Dentro de una carpeta de trabajo `portal_estatico/`, crea una subcarpeta llamada `static/` que contenga:
     - Un fichero `index.html` con un encabezado `H1` que indique: `Portal Corporativo Docker - Noé Conde`.
     - Un fichero complementario `info.txt` con la versión y autor: `Version 2.0 - Despliegue Alpine Nginx`.
   - Crea un fichero `Dockerfile` en la raíz de `portal_estatico/` que cumpla con los estándares de la PEC 2:
     - Imagen base: `nginx:alpine` (ultraligera).
     - Directorio de trabajo interno: `WORKDIR /usr/share/nginx/html`.
     - Copia del contenido de la carpeta local `static` al directorio raíz del servidor Nginx contenedor.
     - Documentación de puerto con la directiva `EXPOSE 80`.
   - Construye la imagen con el tag: `portal-web:2.0` asegurando el contexto del directorio actual (`.`).

2. **Despliegue, Inspección y Comprobaciones (1,5 pts):**
   - Arranca un contenedor en segundo plano basado en la nueva imagen con el nombre `mi_portal`.
   - Mapea el puerto interno al puerto **8888** de tu máquina anfitriona (`-p 8888:80`).
   - Verifica el estado del contenedor con `docker ps` y consulta sus registros con `docker logs mi_portal`.
   - Comprueba el acceso web desde PowerShell con `curl.exe http://localhost:8888` y accediendo también a `http://localhost:8888/info.txt`.
   - Accede a la consola interactiva del contenedor en ejecución mediante `docker exec -it mi_portal sh` (recordando que las imágenes Alpine no tienen `bash`, sino `sh`), comprueba con `ls` que los ficheros se han copiado correctamente y sal con `exit`.
   - Una vez verificado todo, detén y elimina el contenedor con `docker stop` y `docker rm`.

---

### Ejercicio 3: Entorno Multicontenedor con Docker Compose (3,5 puntos)

Simula un entorno de desarrollo completo orquestado mediante **Docker Compose** que comunique un servicio de aplicación web con un motor de base de datos MySQL relacional con persistencia:

1. **Definición de Servicios en `compose.yml` (2 pts):**
   - **Servicio `app`:**
     - Imagen oficial: `php:8.3-apache`.
     - Nombre del contenedor: `app_examen`.
     - Mapeo de puertos: Host `8000` -> Contenedor `80`.
     - Montaje de volumen local: carpeta `./web` del host montada en `/var/www/html` del contenedor.
     - Dependencia: debe depender del servicio `db` (`depends_on`).
     - Política de reinicio: `restart: always`.
     - Variables de entorno para la conexión: `MYSQL_HOST: db`, `MYSQL_DATABASE: examen_db`, `MYSQL_USER: examen_user`, `MYSQL_PASSWORD: examen_pass`.
   - **Servicio `db`:**
     - Imagen oficial: `mysql:8.0`.
     - Nombre del contenedor: `db_examen`.
     - Variables de entorno: `MYSQL_ROOT_PASSWORD: rootpass`, `MYSQL_DATABASE: examen_db`, `MYSQL_USER: examen_user`, `MYSQL_PASSWORD: examen_pass`.
     - Persistencia: volumen con nombre `datos_examen` mapeado a `/var/lib/mysql`.
     - Política de reinicio: `restart: always`.
   - **Sección `volumes`:** Declaración del volumen nombrado `datos_examen`.

2. **Fichero PHP de Conexión y Verificación (1,5 pts):**
   - En la carpeta `./web/`, crea un script `index.php` que lea las variables de entorno o use las credenciales fijadas y realice una conexión mediante `mysqli` o `PDO`.
   - Si la conexión tiene éxito, debe imprimir: `<h2 style='color:green;'>Conexión exitosa a la base de datos examen_db en el host db</h2>`.
   - Si falla, debe capturar el error y mostrarlo en rojo.
   - Levanta el stack completo con `docker compose up -d`, verifica que ambos contenedores están `Up` con `docker compose ps` y comprueba la respuesta en `http://localhost:8000`.

---

## 📊 Rúbrica de Evaluación

| Criterio | Excelente (90-100%) | Aceptable (50-89%) | Insuficiente (0-49%) | Peso |
| :--- | :--- | :--- | :--- | :---: |
| **E1: Apache & Nginx (Puertos y 404)** | Ambos servidores corriendo a la vez en puertos distintos (8080 y 80) con 404 personalizado y sintaxis validada. | Solo un servidor bien configurado o 404 no personalizado. | Servidores no operativos o conflictos de puertos no resueltos. | **35%** |
| **E2: Dockerfile & Contenedor** | Imagen Alpine creada limpiamente con `COPY`, etiquetada `examen-web:1.0` y accesible en el puerto 9090. | Imagen construida pero errores en puertos o nombres de contenedor. | Fallos de sintaxis en Dockerfile o no arranca. | **30%** |
| **E3: Docker Compose (App + DB)** | Fichero `compose.yml` completo, persistencia en volumen, conexión PHP a MySQL correcta por nombre de host `db`. | Stack levantado pero falla la conexión PHP-BD o falta persistencia. | `compose.yml` con errores de indentación YAML o servicios caídos. | **35%** |

