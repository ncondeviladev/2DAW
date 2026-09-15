# Guía Práctica — Apache y Nginx (U1 DAW)
> Referencia rápida con los pasos clave de las prácticas 1, 2, 3 y PEC1.

---

## 1. Entorno: VirtualBox + Ubuntu Server

- **Red:** Adaptador puente (bridge) → la MV obtiene IP del router real.
- **Ver IP de la MV:** `ip a` → busca `inet 192.168.X.X` en la interfaz `enp0s3`.
- **Teclado español en consola:** `sudo loadkeys es`
- **Scroll en VirtualBox:** No hay scroll fácil → usar SSH desde Windows para copiar/pegar.

---

## 2. Apache (ApacheMV)

### Instalación y verificación
```bash
sudo apt update
sudo apt install -y apache2
curl http://localhost           # Debe devolver el HTML de bienvenida
```

### Archivos clave
| Archivo | Para qué sirve |
| :--- | :--- |
| `/etc/apache2/ports.conf` | Define en qué puertos escucha Apache (`Listen 80`) |
| `/etc/apache2/sites-available/000-default.conf` | Configuración del sitio por defecto |
| `/var/www/html/` | Directorio raíz por defecto |

### Comandos esenciales
```bash
sudo apachectl configtest          # Comprobar sintaxis antes de recargar
sudo systemctl reload apache2      # Recargar config (sin cortar conexiones)
sudo systemctl restart apache2     # Reiniciar del todo
sudo apache2ctl -S                 # Ver mapa de VirtualHosts activos
sudo a2ensite nombre.conf          # Activar un sitio
sudo a2dissite nombre.conf         # Desactivar un sitio
```

### Cambiar el puerto por defecto
1. `sudo nano /etc/apache2/ports.conf` → cambiar `Listen 80` → `Listen 8080`
2. `sudo nano /etc/apache2/sites-available/000-default.conf` → cambiar `<VirtualHost *:80>` → `<VirtualHost *:8080>`
3. `sudo systemctl restart apache2`

> ⚠️ Si el `<VirtualHost>` no coincide con el puerto del `Listen`, Apache NO atiende la petición y cae al `Main DocumentRoot`.

### Cambiar el DocumentRoot
En `/etc/apache2/sites-available/000-default.conf`:
```apache
<VirtualHost *:8080>
    DocumentRoot /var/www/miproyecto
    ErrorDocument 404 /404.html
</VirtualHost>
```
Crear y dar permisos a la nueva carpeta:
```bash
sudo mkdir -p /var/www/miproyecto
sudo chown -R www-data:www-data /var/www/miproyecto
```

### Virtual Hosts (multisitio)
1. Asegurarse de que `ports.conf` escucha en el puerto deseado (ej. `Listen 80`).
2. Crear carpetas y contenido:
   ```bash
   sudo mkdir -p /var/www/empresa1 /var/www/empresa2
   sudo chown -R www-data:www-data /var/www/empresa1 /var/www/empresa2
   sudo nano /var/www/empresa1/index.html   # Contenido de la empresa 1
   sudo nano /var/www/empresa2/index.html   # Contenido de la empresa 2
   ```
3. Crear un fichero `.conf` por sitio en `/etc/apache2/sites-available/`:
   ```apache
   # /etc/apache2/sites-available/empresa1.conf
   <VirtualHost *:80>
       ServerName empresa1.daw
       DocumentRoot /var/www/empresa1
       ErrorLog ${APACHE_LOG_DIR}/empresa1-error.log
       CustomLog ${APACHE_LOG_DIR}/empresa1-access.log combined
   </VirtualHost>
   ```
4. Activar y recargar:
   ```bash
   sudo a2ensite empresa1.conf empresa2.conf
   sudo apachectl configtest
   sudo systemctl reload apache2
   ```
5. Probar sin tocar el `hosts` de Windows:
   ```bash
   curl -H "Host: empresa1.daw" http://localhost
   curl -H "Host: empresa2.daw" http://localhost
   ```

### Error 404 personalizado
En el `.conf` del sitio:
```apache
ErrorDocument 404 /404.html
```
Crear `/var/www/miproyecto/404.html` con tu nombre. Reiniciar Apache.

---

## 3. Nginx (NginxMV)

### Instalación y verificación
```bash
sudo apt update
sudo apt install -y nginx
curl http://localhost           # Debe devolver el HTML de bienvenida de Nginx
```
> Si Apache está instalado, pararlo antes: `sudo systemctl stop apache2 && sudo systemctl disable apache2`

### Archivos clave
| Archivo | Para qué sirve |
| :--- | :--- |
| `/etc/nginx/sites-available/default` | Configuración del sitio por defecto |
| `/etc/nginx/sites-enabled/` | Sitios activos (enlaces simbólicos) |
| `/usr/share/nginx/html/` | Directorio raíz de la instalación inicial |
| `/var/www/html/` o `/var/www/miproyecto/` | Directorio raíz personalizado |

### Comandos esenciales
```bash
sudo nginx -t                      # Comprobar sintaxis
sudo systemctl reload nginx        # Recargar config
sudo systemctl restart nginx       # Reiniciar del todo
```

### Cambiar el puerto y el directorio raíz
Editar `/etc/nginx/sites-available/default`, bloque `server { }`:
```nginx
server {
    listen 8081 default_server;
    listen [::]:8081 default_server;

    root /var/www/miproyecto;
    index index.html;
    ...
}
```
```bash
sudo nginx -t && sudo systemctl restart nginx
```

### Server Blocks (multisitio en Nginx)
1. Crear carpetas y contenido:
   ```bash
   sudo mkdir -p /var/www/empresa1 /var/www/empresa2
   sudo chown -R www-data:www-data /var/www/empresa1 /var/www/empresa2
   ```
2. Crear un fichero `.conf` por sitio en `/etc/nginx/sites-available/`:
   ```nginx
   # /etc/nginx/sites-available/empresa1.conf
   server {
       listen 80;
       server_name empresa1.daw;
       root /var/www/empresa1;
       index index.html;
       access_log /var/log/nginx/empresa1_access.log;
       error_log  /var/log/nginx/empresa1_error.log;
       location / { try_files $uri $uri/ =404; }
   }
   ```
3. Activar creando el enlace simbólico a `sites-enabled`:
   ```bash
   sudo ln -s /etc/nginx/sites-available/empresa1.conf /etc/nginx/sites-enabled/
   sudo ln -s /etc/nginx/sites-available/empresa2.conf /etc/nginx/sites-enabled/
   sudo nginx -t && sudo systemctl reload nginx
   ```

### Error 404 personalizado
Dentro del bloque `server { }` en el fichero de configuración:
```nginx
error_page 404 /404.html;
location = /404.html {
    internal;
}
```
Crear `/var/www/miproyecto/404.html` con tu nombre. Reiniciar Nginx.

---

## 4. SSH y FTP

### Instalar y activar SSH en la MV
```bash
sudo apt install -y openssh-server
sudo systemctl status ssh    # Debe poner active (running)
sudo ufw allow ssh           # Solo si el cortafuegos está activo
```

### Conectarse desde Windows (PowerShell)
```powershell
ssh usuario@192.168.X.XX
```
- Primera vez: escribir `yes` para aceptar la clave.
- Salir: `exit` o `Ctrl + D`.
- **Ventaja:** En PowerShell se puede hacer clic derecho para pegar texto → ideal para copiar HTML/comandos largos.

### FTP (FileZilla desde Windows)
1. Instalar `vsftpd` en la MV: `sudo apt install -y vsftpd`
2. En FileZilla: `Archivo → Gestor de sitios → Nuevo sitio`
   - Host: `192.168.X.XX` | Puerto: `21` | Protocolo: FTP
   - Modo de acceso: Normal | Usuario y contraseña de la MV.

---

## 5. Acceder desde el navegador de Windows por nombre de dominio

Como `empresa1.daw` no existe en Internet, hay que engañar al DNS local de Windows editando el archivo `hosts`:

1. Abrir **Bloc de notas como administrador**.
2. Ir a `Archivo → Abrir → C:\Windows\System32\drivers\etc\hosts`.
3. Cambiar el filtro de tipo de archivo a "Todos los archivos".
4. Al final del archivo, añadir:
   ```text
   192.168.X.XX  empresa1.daw
   192.168.X.XX  empresa2.daw
   ```
5. Guardar. Ya puedes entrar desde el navegador a `http://empresa1.daw`.

---

## 6. Diferencias clave Apache vs Nginx

| Aspecto | Apache | Nginx |
| :--- | :--- | :--- |
| **Estructura config** | Etiquetas XML (`<VirtualHost>`) | Bloques con llaves `server { }` |
| **Puerto** | `ports.conf` + `<VirtualHost *:PUERTO>` | `listen PUERTO;` dentro del `server {}` |
| **Directorio raíz** | `DocumentRoot /ruta` | `root /ruta;` |
| **Error personalizado** | `ErrorDocument 404 /404.html` | `error_page 404 /404.html;` + bloque `location` |
| **Activar sitio** | `sudo a2ensite nombre.conf` | `sudo ln -s sites-available/... sites-enabled/` |
| **Verificar sintaxis** | `sudo apachectl configtest` | `sudo nginx -t` |
| **Ver VirtualHosts** | `sudo apache2ctl -S` | — |

---

## 7. PEC1 — Resumen de lo realizado (Ejercicios 1 a 5)

### Ejercicio 1: Páginas de error 404 personalizadas
- **Apache (`ApacheMV`):**
  - Archivo de error: `/var/www/miproyecto/404.html` (con nombre).
  - En `/etc/apache2/sites-available/000-default.conf`:
    ```apache
    ErrorDocument 404 /404.html
    ```
  - `sudo apachectl configtest && sudo systemctl restart apache2`
- **Nginx (`NginxMV`):**
  - Archivo de error: `/var/www/miproyecto/404.html` (con nombre).
  - En `/etc/nginx/sites-available/default`:
    ```nginx
    error_page 404 /404.html;
    location = /404.html {
        internal;
    }
    ```
  - `sudo nginx -t && sudo systemctl restart nginx`

### Ejercicio 2: Cambio de puerto por defecto a 8989
- **Apache (`ApacheMV`):**
  - `/etc/apache2/ports.conf` → `Listen 8989`
  - `/etc/apache2/sites-available/000-default.conf` → `<VirtualHost *:8989>`
  - `sudo systemctl restart apache2` → Acceso: `http://IP_APACHE:8989`
- **Nginx (`NginxMV`):**
  - `/etc/nginx/sites-available/default` → `listen 8989 default_server;` y `listen [::]:8989 default_server;`
  - `sudo systemctl restart nginx` → Acceso: `http://IP_NGINX:8989`

### Ejercicio 3: Nginx Multisitio en NginxMV (Server Blocks)
Objetivo: Alojamiento de dos sitios web independientes (`sitio1.daw` y `sitio2.daw`) en el mismo servidor de forma simultánea.

1. **Crear directorios y asignar permisos:**
   ```bash
   sudo mkdir -p /var/www/sitio1 /var/www/sitio2
   sudo chown -R www-data:www-data /var/www/sitio1 /var/www/sitio2
   ```
2. **Crear páginas web (`index.html`):**
   - `/var/www/sitio1/index.html` (Fondo azul, nombre del alumno).
   - `/var/www/sitio2/index.html` (Fondo naranja, nombre del alumno).
3. **Crear los Server Blocks en `/etc/nginx/sites-available/`:**
   - `/etc/nginx/sites-available/sitio1.conf`:
     ```nginx
     server {
         listen 80;
         listen [::]:80;
         server_name sitio1.daw;
         root /var/www/sitio1;
         index index.html;
         location / { try_files $uri $uri/ =404; }
     }
     ```
   - `/etc/nginx/sites-available/sitio2.conf`:
     ```nginx
     server {
         listen 80;
         listen [::]:80;
         server_name sitio2.daw;
         root /var/www/sitio2;
         index index.html;
         location / { try_files $uri $uri/ =404; }
     }
     ```
4. **Habilitar los sitios mediante enlaces simbólicos:**
   ```bash
   sudo ln -s /etc/nginx/sites-available/sitio1.conf /etc/nginx/sites-enabled/
   sudo ln -s /etc/nginx/sites-available/sitio2.conf /etc/nginx/sites-enabled/
   ```
5. **Verificar sintaxis y recargar Nginx:**
   ```bash
   sudo nginx -t
   sudo systemctl reload nginx
   ```
6. **Comprobación simultánea:**
   - **Terminal:**
     ```bash
     curl -H "Host: sitio1.daw" http://localhost
     curl -H "Host: sitio2.daw" http://localhost
     ```
   - **Navegador (desde Windows):**
     - En `C:\Windows\System32\drivers\etc\hosts`:
       ```text
       192.168.0.23    sitio1.daw
       192.168.0.23    sitio2.daw
       ```
     - Acceso simultáneo en el navegador: `http://sitio1.daw` y `http://sitio2.daw`.

### Ejercicio 4: Coexistencia Apache + Nginx Multisitio (4 sitios simultáneos en 1 MV)
Objetivo: Instalar Apache en la máquina donde ya corre Nginx (`NginxMV`), configurando puertos diferentes para evitar conflictos (Nginx en puerto 80, Apache en puertos 8181 y 8282), alcanzando 4 sitios activos simultáneamente.

1. **Instalar Apache en la misma MV:**
   ```bash
   sudo apt install -y apache2
   ```
2. **Evitar conflicto de puertos (Apache a 8181 y 8282):**
   - En `/etc/apache2/ports.conf`:
     ```apache
     Listen 8181
     Listen 8282
     ```
     *(Eliminar o comentar `Listen 80` para que Nginx conserve el puerto 80).*
3. **Crear directorios y webs para Apache:**
   ```bash
   sudo mkdir -p /var/www/apache1 /var/www/apache2
   sudo chown -R www-data:www-data /var/www/apache1 /var/www/apache2
   sudo nano /var/www/apache1/index.html
   sudo nano /var/www/apache2/index.html
   ```
4. **Configurar VirtualHosts en `/etc/apache2/sites-available/`:**
   - `/etc/apache2/sites-available/apache1.conf`:
     ```apache
     <VirtualHost *:8181>
         ServerName apache1.daw
         DocumentRoot /var/www/apache1
     </VirtualHost>
     ```
   - `/etc/apache2/sites-available/apache2.conf`:
     ```apache
     <VirtualHost *:8282>
         ServerName apache2.daw
         DocumentRoot /var/www/apache2
     </VirtualHost>
     ```
5. **Activar sitios y recargar servicios:**
   ```bash
   sudo a2ensite apache1.conf apache2.conf
   sudo apachectl configtest
   sudo systemctl restart apache2
   ```
6. **Comprobación simultánea de los 4 sitios:**
   - `sitio1.daw` (Nginx, puerto 80)
   - `sitio2.daw` (Nginx, puerto 80)
   - `http://IP_MV:8181` (Apache)
   - `http://IP_MV:8282` (Apache)
   - Con `curl`:
     ```bash
     curl -H "Host: sitio1.daw" http://localhost
     curl -H "Host: sitio2.daw" http://localhost
     curl http://localhost:8181
     curl http://localhost:8282
     ```

### Ejercicio 5: Acceso Remoto — SSH y SFTP/FTP en NginxMV
Objetivo: Administrar el servidor mediante consola remota segura (SSH) y transferir ficheros gráficamente (SFTP/FTP).

#### A. Conexión por SSH
1. **Instalar y verificar el servidor OpenSSH en la MV:**
   ```bash
   sudo apt install -y openssh-server
   sudo systemctl status ssh
   ```
2. **Conectar desde Windows (PowerShell / CMD):**
   ```powershell
   ssh usuario@192.168.0.23
   ```
   *(Aceptar la huella con `yes` si es la primera vez e introducir la contraseña).*

#### B. Transferencia de ficheros por SFTP / FTP (FileZilla)
1. Abrir **FileZilla** en Windows.
2. Ir a `Archivo → Gestor de sitios → Nuevo sitio`:
   - **Protocolo:** `SFTP - SSH File Transfer Protocol` (aprovecha el puerto seguro 22 de SSH sin necesidad de configurar vsftpd).
   - **Servidor (Host):** `192.168.0.23`
   - **Puerto:** `22`
   - **Modo de acceso:** `Normal`
   - **Usuario y Contraseña:** credenciales del usuario de la máquina virtual.
3. Conectar y arrastrar ficheros (ej. `archivo.txt`) desde el panel local al panel remoto (directorio de usuario `/home/usuario`).
4. **Verificación en la consola de la MV:**
   ```bash
   ls -la ~
   ```



