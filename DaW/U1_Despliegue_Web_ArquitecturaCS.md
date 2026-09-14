# U1 — Introducción al despliegue web y arquitectura cliente-servidor
> **Mòdul:** Despliegue de Aplicaciones Web (DAW) — 2º DAW 2025/2026
> **Professor:** Juanra Collado — jr.colladoesteve@edu.gva.es

---

## Resultats d'aprenentatge (RA's)

- **RA1** — Implanta arquitecturas web analizando y aplicando criterios de funcionalidad *(también en U2 y U4)*
- **RA2** — Implanta aplicaciones web en servidores web, evaluando y aplicando criterios de configuración para su funcionamiento seguro *(también en U2, U3 y U4)*

---

## 1. Introducción al despliegue web

**Desplegar** una aplicación web = hacer que esté accesible desde internet para otros usuarios.

> ⚠️ No confundir:
> - **Programar:** escribir código (HTML, Python, JS, PHP, etc.)
> - **Desplegar:** instalar, configurar y publicar la aplicación en un servidor web para que cualquiera pueda acceder a ella desde un navegador.

Cuando desarrollamos en local, la app solo es accesible desde nuestro propio PC.
Para que otros la vean → hay que subirla a un servidor web.
*Lo que funciona en local puede fallar en el servidor remoto.*

---

## 2. Componentes básicos de un despliegue web

| Componente | Descripción |
|-----------|-------------|
| **Software cliente** | Dispositivo/software que realiza las peticiones (normalmente un navegador) |
| **Servidor web** | Software que gestiona las peticiones del cliente (Apache, Nginx...) |
| **Aplicación (código)** | Ficheros y código que forman la web (parte cliente + parte servidor) |
| **Red/Internet** | Red que conecta las partes (local o Internet) |

> Sin estos 4 elementos, **no hay despliegue posible**.

**Sobre el código:**
- La **parte cliente** (DWEC) se descarga desde el servidor y se ejecuta en el navegador.
- La **parte servidor** (DWES) se ejecuta en el propio servidor.
- Ambas partes se alojan en el servidor web.

---

## 3. ¿Dónde podemos desplegar?

| Opción | Características |
|--------|----------------|
| **Servidor físico propio** | Más control, más coste, mantenimiento complejo |
| **VPS** (Virtual Private Server) | Servidor virtualizado en uno físico compartido (OVH, IONOS...). Económico y flexible |
| **Contenedores (Docker)** | Aislamiento a nivel de aplicación. Funciona igual independientemente del servidor o infraestructura |
| **Cloud público** (AWS, Azure) | Pago por uso, escalabilidad inmediata |

---

## 4. Arquitectura Cliente-Servidor

**Flujo básico:**
1. Cliente escribe una URL (indica el recurso que solicita)
2. El navegador genera una petición **HTTP** (o HTTPS con capa de seguridad)
3. El servidor responde con un documento (HTML, JSON, etc.)
4. El navegador interpreta la respuesta y la muestra

### Protocolos: HTTP vs HTTPS

| | HTTP | HTTPS |
|--|------|-------|
| **Nombre** | HyperText Transfer Protocol | HyperText Transfer Protocol Secure |
| **Seguridad** | Sin cifrado | Cifrado con SSL/TLS |
| **Ventajas HTTPS** | — | Seguridad de datos + confianza del sitio |

---

## 5. Web estática VS Web dinámica

| | Web estática | Web dinámica |
|--|-------------|-------------|
| **Contenido** | Siempre el mismo | Varía según cuándo/cómo accedemos |
| **Ejemplo** | HTML/CSS puro (Lenguaje de Marcas) | Webs con BD, APIs (DWES) |

---

## 6. Servidores web: Apache vs Nginx

| | Apache | Nginx |
|--|--------|-------|
| **Lanzamiento** | 1995 | 2004 |
| **Configuración** | `.conf` + `.htaccess` | `nginx.conf` |
| **Uso habitual** | Hosting compartido, muy extendido | Proxy inverso, balanceador de carga |
| **Recursos** | Más consumo | Más ligero y eficiente |
| **Popularidad** | Mayor implantación histórica | Ganando terreno por rendimiento |

> Los dos pueden coexistir: uno sirve el front-end y otro el back-end.

---

## 7. Archivos de configuración

### Apache (Debian/Ubuntu)
```
/etc/apache2/apache2.conf          # Global
/etc/apache2/ports.conf            # Puertos
/etc/apache2/sites-available/000-default.conf  # Sitio por defecto
```
```bash
sudo a2ensite sitio.conf           # Habilitar sitio
sudo a2dissite sitio.conf          # Deshabilitar sitio
sudo systemctl reload apache2      # Recargar
sudo apachectl configtest          # Verificar sintaxis
```

### Nginx (Debian/Ubuntu)
```
/etc/nginx/nginx.conf              # Global
/etc/nginx/sites-available/        # Sitios disponibles
/etc/nginx/sites-enabled/          # Sitios activos (enlaces simbólicos)
```
```bash
sudo systemctl reload nginx        # Recargar
sudo nginx -t                      # Verificar sintaxis
```

---

## 8. Puerto de escucha

- **Puertos por defecto:** `80` (HTTP), `443` (HTTPS)

**Cambiar puerto en Apache:**
```bash
sudo nano /etc/apache2/ports.conf
# Cambiar: Listen 80 → Listen 8080
# También modificar el VirtualHost: <VirtualHost *:80> → <VirtualHost *:8080>
```

**Cambiar puerto en Nginx:**
```
# En /etc/nginx/sites-available/default
listen 8080 default_server;
listen [::]:8080 default_server;
```

---

## 9. Directorios raíz

| Servidor | Directorio por defecto |
|----------|----------------------|
| Apache | `/var/www/html` |
| Nginx | `/usr/share/nginx/html` |

**Permisos correctos:**
```bash
sudo chown -R www-data:www-data /var/www/miproyecto   # Apache
sudo chown -R nginx:nginx /var/www/miproyecto          # Nginx
```

**Cambiar DocumentRoot en Apache:**
```apache
# /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/miproyecto
</VirtualHost>
```

**Cambiar root en Nginx:**
```nginx
# /etc/nginx/sites-available/default
root /var/www/miproyecto;
```

---

## 10. Logs y errores

```
Apache:  /var/log/apache2/access.log   y   error.log
Nginx:   /var/log/nginx/access.log     y   error.log
```

---

## 11. Virtual Hosts (Apache) — múltiples webs en un servidor

Los Virtual Hosts permiten alojar varias webs en un mismo servidor con diferentes nombres de dominio o puertos.

**Pasos:**

**1. Editar `/etc/hosts` (simular DNS en local):**
```
127.0.0.1   empresa1.daw
127.0.0.1   empresa2.daw
```

**2. Crear carpetas para cada sitio:**
```bash
sudo mkdir -p /var/www/empresa1 /var/www/empresa2
sudo chown -R www-data:www-data /var/www/empresa1 /var/www/empresa2
ls -l /var/www/    # Verificar permisos
```

**3. Crear fichero `.conf` por sitio en `/etc/apache2/sites-available/`:**
```apache
# empresa1.conf
<VirtualHost *:80>
    ServerName empresa1.daw
    DocumentRoot /var/www/empresa1
    ErrorLog ${APACHE_LOG_DIR}/empresa1-error.log
    CustomLog ${APACHE_LOG_DIR}/empresa1-access.log combined
</VirtualHost>
```

**4. Habilitar los sitios y recargar:**
```bash
sudo a2ensite empresa1.conf
sudo a2ensite empresa2.conf
sudo apachectl configtest      # Verificar sintaxis primero!
sudo systemctl reload apache2
```

---

## Buenas prácticas

- Un `DocumentRoot` por sitio
- Un `.conf` por sitio con nombre coherente (`empresaX.conf`)
- Logs separados por sitio para depurar más rápido
- **Siempre verificar sintaxis antes de recargar:**
  ```bash
  apachectl configtest   # Apache
  nginx -t               # Nginx
  ```

---

## Prácticas

### Práctica 1 — Apache en local (MV Ubuntu Server)
1. Crear MV con VirtualBox → Ubuntu Server sin GUI → nombre: `ApacheMV`
2. Crear **snapshot** antes de instalar nada
3. Instalar Apache: `sudo apt install apache2`
4. Verificar: `curl http://localhost` (sin GUI) o `http://IPSERVIDOR` desde el anfitrión
5. Modificar `/var/www/html/index.html` con tu nombre + explicación cliente-servidor (imagen + CSS separado)

### Práctica 1.1 — Acceso remoto
1. MV en **adaptador puente** + copiar IP de la MV
2. Conectarse por SSH: `ssh usuario@192.168.1.50`
3. Si hay problemas: `sudo ufw allow ssh && sudo ufw enable`
4. Conectarse por FTP con **Filezilla** y mover ficheros

### Práctica 2 — Nginx en local (MV Ubuntu Server)
1. Clonar MV desde el snapshot de la Práctica 1 → nombre: `NginxMV`
2. Buscar e instalar Nginx
3. Verificar desde el navegador del anfitrión
4. Modificar `index.html` igual que en la Práctica 1

### Práctica 3
1. Modificar el puerto por defecto de Apache y Nginx
2. Crear carpeta `miproyecto` y configurarla como DocumentRoot en ambos servidores

### Práctica final (enunciado en Aules)
- Configurar Nginx multisitio
- Parámetros avanzados de configuración
- Dos servidores en paralelo en la misma máquina sirviendo páginas diferentes
