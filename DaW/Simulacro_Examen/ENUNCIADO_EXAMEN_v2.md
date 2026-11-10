# DAW — Examen Práctico 1ª Evaluación (Simulacro v2)

> **Módulo:** Despliegue de Aplicaciones Web (DAW) — 2º DAW Semipresencial  
> **Profesor:** Juanra Collado  
> **Centro:** IES Maria Enríquez (Gandia) — Curso 2026/2027  
> **Tiempo:** 2 horas  
> **Material permitido:** Único fichero PDF entregado previamente a través de Aules.

---

## 🎯 Resultados de Aprendizaje Evaluados

- **RA1:** Implanta arquitecturas web analizando y aplicando criterios de funcionalidad y escalabilidad.
- **RA2:** Implanta aplicaciones web en servidores web, evaluando y aplicando criterios de configuración para su funcionamiento seguro y concurrente.
- **RA3:** Implanta aplicaciones web en servidores de aplicaciones y entornos de contenedores, evaluando y aplicando criterios de despliegue y persistencia.

---

## 📋 Enunciado de los Ejercicios

### Ejercicio 1 — Contenedor Ubuntu con Nginx multisitio + red Docker propia (3 puntos)

> **Escenario:** Ahora solo tienes **un servidor Nginx** (sin Apache), pero debes montar **3 sitios web distintos** en el mismo puerto 80 diferenciados por `server_name`, más una **red Docker personalizada** para comunicar este contenedor con un futuro servicio de base de datos.

#### 1.1. Red y contenedor (0,5 pts)

- Crea una red Docker personalizada de tipo bridge con nombre `red_examen`:
  ```bash
  docker network create red_examen
  ```
- Lanza el contenedor `servidor_nginx` basado en `ubuntu:22.04`:
  - En **modo interactivo** con terminal adjunta (`-it`).
  - Mapea el **puerto 8080** del host al **puerto 80** del contenedor.
  - Conectado a la red `red_examen` (`--network red_examen`).
- Dentro del contenedor: `apt update` e instala `nginx`.

#### 1.2. Tres sitios Nginx por nombre de dominio (1,5 pts)

Crea las tres carpetas de contenido y sus páginas:

```bash
mkdir -p /var/www/tienda /var/www/blog /var/www/admin
```

- `/var/www/tienda/index.html` → `Tienda Online — Noé Conde Vila`
- `/var/www/blog/index.html` → `Blog Personal — Noé Conde Vila`
- `/var/www/admin/index.html` → `Panel de Administración — Noé Conde Vila`

Crea **un fichero de configuración por sitio** en `/etc/nginx/sites-available/`:
- `tienda` → `server_name tienda.local;`, `root /var/www/tienda;`
- `blog` → `server_name blog.local;`, `root /var/www/blog;`
- `admin` → `server_name admin.local;`, `root /var/www/admin;`

Los tres escuchan en `listen 80;` y deben tener página 404 personalizada.

Activa los tres con enlaces simbólicos a `sites-enabled` y elimina el `default`.

#### 1.3. Resolución y verificación (1 pt)

- En `/etc/hosts` del contenedor:
  ```
  127.0.0.1 tienda.local blog.local admin.local
  ```
- Verifica sintaxis: `nginx -t` y arranca: `service nginx start`
- Comprueba los tres sitios:
  ```bash
  curl -I http://tienda.local
  curl -I http://blog.local
  curl -I http://admin.local
  ```
  Todos deben responder `200 OK`.
- Comprueba el 404 en uno de ellos: `curl -I http://tienda.local/no-existe` → `404`.
- **Desde PowerShell del host:** `curl.exe http://localhost:8080` debe devolver el contenido (Nginx servirá el primer sitio o el `default` si está configurado como tal).

---

### Ejercicio 2 — Imagen personalizada con `httpd:alpine` (Apache) (3,5 puntos)

> **Escenario:** Debes construir una imagen Docker propia basada en **Apache sobre Alpine** (como en la PEC2 con Octopus). La imagen debe quedar etiquetada y el contenedor desplegado y verificado.

#### 2.1. Estructura de ficheros (0,5 pts)

Crea esta estructura en `DaW/Simulacro_Examen/docker/app_estatica/`:

```
app_estatica/
├── Dockerfile
└── static/
    ├── index.html
    └── sobre-nosotros.html
```

- `static/index.html`: encabezado `<h1>Bienvenido a TechSolutions — Noé Conde Vila</h1>` y un enlace a `sobre-nosotros.html`.
- `static/sobre-nosotros.html`: página con un párrafo y enlace de vuelta a `index.html`.

#### 2.2. Dockerfile (1,5 pts)

- Imagen base: **`httpd:alpine`** (Apache sobre Alpine).
- Añade `LABEL maintainer="noeconde@daw.es"`.
- Copia `static/` al directorio raíz de Apache: `/usr/local/apache2/htdocs/`.
- Documenta el puerto con `EXPOSE 80`.

> 💡 En `httpd:alpine` el directorio web es `/usr/local/apache2/htdocs/`, **no** `/usr/share/nginx/html/`.

#### 2.3. Build, despliegue y verificación (1,5 pts)

- Construye con tag **`empresa-web:1.0`**:
  ```bash
  docker build -t empresa-web:1.0 .
  ```
- Arranca el contenedor `mi_empresa` mapeando el **puerto 9090**:
  ```bash
  docker run -d -p 9090:80 --name mi_empresa empresa-web:1.0
  ```
- Verifica con `docker ps`.
- Desde PowerShell: `curl.exe http://localhost:9090` y `curl.exe http://localhost:9090/sobre-nosotros.html`.
- Entra al shell: `docker exec -it mi_empresa sh` → `ls /usr/local/apache2/htdocs/` → `exit`.
- Limpieza: `docker stop mi_empresa` y `docker rm mi_empresa`.

---

### Ejercicio 3 — Stack completo con Docker Compose: App + MySQL + phpMyAdmin (3,5 puntos)

> **Escenario:** Despliegas un entorno de desarrollo con **tres servicios** orquestados por Docker Compose: PHP/Apache, MySQL y phpMyAdmin. Mismo esquema que la PEC3, pero con nombres y credenciales distintos.

#### 3.1. Estructura (0,5 pts)

Crea `DaW/Simulacro_Examen/docker/stack_completo/` con:

```
stack_completo/
├── compose.yml
└── web/
    └── index.php
```

#### 3.2. Fichero `compose.yml` (2 pts)

**Servicio `app`:**
- Imagen: `php:8.3-apache`
- `container_name: app_simulacro`
- Puerto: `8000:80`
- Bind mount: `./web:/var/www/html`
- `depends_on: [db]`
- `restart: always`
- Variables: `MYSQL_HOST: db`, `MYSQL_DATABASE: simulacro_db`, `MYSQL_USER: sim_user`, `MYSQL_PASSWORD: sim_pass`

**Servicio `db`:**
- Imagen: `mysql:8.0`
- `container_name: db_simulacro`
- Variables: `MYSQL_ROOT_PASSWORD: rootsim`, `MYSQL_DATABASE: simulacro_db`, `MYSQL_USER: sim_user`, `MYSQL_PASSWORD: sim_pass`
- Volumen con nombre `datos_simulacro:/var/lib/mysql`
- `restart: always`

**Servicio `phpmyadmin`:**
- Imagen: `phpmyadmin/phpmyadmin`
- `container_name: pma_simulacro`
- Puerto: `8081:80`
- Variables: `PMA_HOST: db`, `PMA_USER: root`, `PMA_PASSWORD: rootsim`
- `depends_on: [db]`
- `restart: always`

**Sección `volumes`:**
```yaml
volumes:
  datos_simulacro:
```

#### 3.3. Script PHP y verificación (1 pt)

`web/index.php`:
- Conecta a MySQL con `mysqli` usando las credenciales del Compose.
- Éxito → `<h2 style='color:green;'>Conexión exitosa a simulacro_db en el host db</h2>`
- Error → muestra el error en rojo.

Verificación:
```bash
docker compose up -d
docker compose ps          # tres contenedores Up
# Espera ~15s para que MySQL arranque
curl.exe http://localhost:8000   # conexión PHP → MySQL
# Abre http://localhost:8081 en el navegador → phpMyAdmin con simulacro_db
docker compose down -v     # limpieza al terminar
```

---

## 📊 Rúbrica de Evaluación

| Criterio | Excelente (90-100%) | Aceptable (50-89%) | Insuficiente (0-49%) | Peso |
| :--- | :--- | :--- | :--- | :---: |
| **E1: Ubuntu + Nginx 3 sitios + red** | 3 vhosts activos, curl 200 en los 3, 404 personalizado, red propia creada | 1-2 sitios bien o sin 404 | Nginx no arranca o sin sitios | **30%** |
| **E2: httpd:alpine + Dockerfile** | Imagen `empresa-web:1.0` con `httpd:alpine`, 2 páginas en 9090, `sh` correcto | Imagen construida con errores menores | Dockerfile con errores o no arranca | **35%** |
| **E3: Compose 3 servicios** | 3 contenedores Up, PHP→MySQL verde, phpMyAdmin en 8081 con la BD visible | Stack levantado pero falla conexión o phpMyAdmin sin BD | YAML con errores o servicios caídos | **35%** |

---

## ⚡ Recordatorios Anti-Trampa

1. **Alpine** → `sh`, nunca `bash`.
2. **httpd:alpine** → htdocs en `/usr/local/apache2/htdocs/` (no `/usr/share/nginx/html/`).
3. `volumes:` de nivel raíz en `compose.yml` → **dos puntos obligatorios**: `datos_simulacro:`.
4. `service nginx restart` (no `reload`) para evitar que falle si el servicio estaba parado.
5. `curl.exe` en PowerShell del host (no `curl`).
6. `depends_on` **no espera** a que MySQL esté ready → si PHP falla, espera ~15s y recarga.
7. La red propia Docker permite comunicar contenedores por **nombre de servicio** (ej. `db`), no por IP.

