# 🗒️ Chuleta DaW — Comandos y Referencias Rápidas

---

## Linux — Comandos esenciales

### Navegación
```bash
pwd                    # ¿Dónde estoy?
ls                     # Listar archivos
ls -la                 # Listar con ocultos + permisos + tamaño
cd /ruta/carpeta       # Entrar a carpeta
cd ..                  # Subir un nivel
cd ~                   # Ir a carpeta home (usuario)
```

### Archivos
```bash
cat archivo.txt        # Ver contenido
nano archivo.txt       # Editar archivo (editor terminal)
cp origen destino      # Copiar
mv origen destino      # Mover / renombrar
rm archivo.txt         # Borrar archivo
rm -rf carpeta/        # Borrar carpeta y todo su contenido ⚠️
mkdir carpeta          # Crear carpeta
```

### Permisos
```bash
sudo comando                          # Ejecutar como administrador
sudo chown user:user archivo          # Cambiar propietario
sudo chown -R www-data:www-data /var/www/html   # Apache: dar permisos correctos
chmod 755 archivo                     # Cambiar permisos (rwx r-x r-x)
```

### Red
```bash
curl http://localhost   # Petición HTTP — ver respuesta HTML
ip a                   # Ver IP de la máquina (= ipconfig en Windows)
ping google.com        # Comprobar conexión a internet
```

### Paquetes (Ubuntu/Debian)
```bash
sudo apt update              # Actualizar lista de paquetes
sudo apt install nombre      # Instalar programa
sudo apt remove nombre       # Desinstalar programa
```

### Servicios (systemctl)
```bash
sudo systemctl status apache2    # Ver estado
sudo systemctl start apache2     # Arrancar
sudo systemctl stop apache2      # Parar
sudo systemctl restart apache2   # Reiniciar
sudo systemctl reload apache2    # Recargar config sin parar
sudo systemctl enable apache2    # Arrancar automáticamente al iniciar
```

---

## Nano — Editor de terminal

```
Ctrl + O  → Guardar (luego Enter para confirmar nombre)
Ctrl + X  → Salir
Ctrl + K  → Cortar línea completa
Ctrl + U  → Pegar línea cortada
Ctrl + W  → Buscar texto
Ctrl + G  → Ayuda
```

---

## sudo — Super User DO

`sudo` = ejecutar un comando con permisos de administrador.
Sin él, muchos comandos están bloqueados (instalar, modificar ficheros del sistema...).
Te pedirá tu contraseña la primera vez.

---

## Apache

### Rutas importantes (Ubuntu)
```
/etc/apache2/apache2.conf              → Config global
/etc/apache2/ports.conf                → Puertos de escucha
/etc/apache2/sites-available/          → Sitios configurados
/etc/apache2/sites-enabled/            → Sitios activos
/var/www/html/                         → Carpeta raíz web por defecto
/var/log/apache2/access.log            → Log de accesos
/var/log/apache2/error.log             → Log de errores
```

### Comandos útiles
```bash
sudo apt install apache2               # Instalar Apache
curl http://localhost                  # Verificar que funciona
sudo apachectl configtest              # Verificar sintaxis config
sudo a2ensite sitio.conf               # Habilitar sitio
sudo a2dissite sitio.conf              # Deshabilitar sitio
sudo systemctl reload apache2          # Aplicar cambios
```

### Error 404 personalizado
```bash
# 1. Crear el HTML personalizado
sudo nano /var/www/miproyecto/404.html

# 2. Añadir directiva en el VirtualHost (dentro de <VirtualHost ...>):
sudo nano /etc/apache2/sites-available/000-default.conf
# → ErrorDocument 404 /404.html

# 3. Comprobar y recargar:
sudo apachectl configtest && sudo systemctl reload apache2
curl http://localhost/ruta-inexistente
```

### Cambiar puerto (¡En DOS archivos obligatoriamente!)
```bash
# 1. Archivo de puertos:
sudo nano /etc/apache2/ports.conf
# → Listen 8089 (o el puerto pedido)

# 2. Archivo del VirtualHost:
sudo nano /etc/apache2/sites-available/000-default.conf
# → <VirtualHost *:8089>

# 3. Comprobar y recargar:
sudo apachectl configtest && sudo systemctl reload apache2
```

### Cambiar DocumentRoot
```bash
sudo nano /etc/apache2/sites-available/000-default.conf
# Cambiar: DocumentRoot /var/www/html → DocumentRoot /var/www/miproyecto
```

---

## Nginx

### Rutas importantes (Ubuntu)
```
/etc/nginx/nginx.conf                  → Config global
/etc/nginx/sites-available/            → Sitios configurados
/etc/nginx/sites-enabled/              → Sitios activos (enlaces simbólicos)
/var/www/ o /usr/share/nginx/html/     → Carpetas raíz web
/var/log/nginx/access.log              → Log de accesos
/var/log/nginx/error.log               → Log de errores
```

### Comandos útiles
```bash
sudo apt install nginx                 # Instalar Nginx
sudo nginx -t                          # Verificar sintaxis config (FUNDAMENTAL)
sudo systemctl reload nginx            # Aplicar cambios sin caída
sudo systemctl restart nginx           # Reiniciar servicio
```

### Error 404 personalizado
```bash
# 1. Crear el HTML
sudo nano /var/www/miproyecto/404.html

# 2. Añadir dentro del bloque server { ... }:
sudo nano /etc/nginx/sites-available/default
# → error_page 404 /404.html;

# 3. Verificar y recargar:
sudo nginx -t && sudo systemctl reload nginx
curl http://localhost/ruta-inexistente
```

### Cambiar puerto
```bash
# En el bloque server { ... } cambiar ambas líneas:
sudo nano /etc/nginx/sites-available/default
# → listen 8089 default_server;
# → listen [::]:8089 default_server;

# Verificar y recargar:
sudo nginx -t && sudo systemctl reload nginx
```

### Multisitio en Nginx (Virtual Hosts por dominio) — Secuencia de examen
```bash
# 1. Carpetas y permisos:
sudo mkdir -p /var/www/sitio1 /var/www/sitio2
sudo chown -R www-data:www-data /var/www/sitio1 /var/www/sitio2

# 2. Crear index.html en cada una:
sudo nano /var/www/sitio1/index.html
sudo nano /var/www/sitio2/index.html

# 3. Fichero de configuración para cada sitio:
sudo nano /etc/nginx/sites-available/sitio1.conf
# Contenido mínimo esencial:
# server {
#     listen 80;
#     server_name sitio1.daw;
#     root /var/www/sitio1;
#     index index.html;
# }

# 4. Habilitar sitios mediante enlaces simbólicos:
sudo ln -sf /etc/nginx/sites-available/sitio1.conf /etc/nginx/sites-enabled/
sudo ln -sf /etc/nginx/sites-available/sitio2.conf /etc/nginx/sites-enabled/

# 5. Comprobar sintaxis y recargar:
sudo nginx -t && sudo systemctl reload nginx

# 6. Comprobar con curl simulando la cabecera Host:
curl -H "Host: sitio1.daw" http://localhost
curl -H "Host: sitio2.daw" http://localhost
```

---

## ⚡ Convivencia simultánea: Apache + Nginx en la misma máquina

Para tener ambos servidores a la vez con múltiples sitios:
* **Nginx** atiende en el puerto **80** (múltiples dominios con `server_name`).
* **Apache** se configura en puertos libres alternativos (ej: **8181** y **8282**) para no colisionar.

```bash
# 1. En Apache, definir los puertos alternativos:
sudo nano /etc/apache2/ports.conf
# → Listen 8181
# → Listen 8282

# 2. Crear los VirtualHosts de Apache:
sudo nano /etc/apache2/sites-available/apache1.conf
# → <VirtualHost *:8181>
#       DocumentRoot /var/www/apache1
#   </VirtualHost>

# 3. Habilitar sitios y recargar Apache:
sudo a2ensite apache1.conf apache2.conf
sudo apachectl configtest
sudo systemctl reload apache2

# 4. Comprobación simultánea:
curl -H "Host: sitio1.daw" http://localhost   # Nginx (puerto 80)
curl http://localhost:8181                    # Apache 1
curl http://localhost:8282                    # Apache 2
```

---

## 🌐 Resolución de nombres local (archivo hosts en Windows)

Para acceder a nombres de dominio de la MV (`sitio1.daw`) desde el navegador del PC anfitrión:
1. Abrir el **Bloc de notas como Administrador**.
2. Abrir archivo: `C:\Windows\System32\drivers\etc\hosts`.
3. Añadir la IP de la MV asociada a los dominios:
```text
192.168.0.23  sitio1.daw
192.168.0.23  sitio2.daw
```

---

## VirtualBox

| Acción | Cómo |
|--------|------|
| **Snapshot (instantánea)** | Máquina → Tomar instantánea |
| **Restaurar snapshot** | Panel Instantáneas → clic derecho → Restaurar |
| **Clonar MV** | Clic derecho sobre la MV → Clonar |
| **Modo puente** | Config MV → Red → Adaptador 1 → Adaptador puente |
| **Portapapeles compartido** | Dispositivos → Portapapeles compartido → Bidireccional |
| **Pegar en la MV** | `Shift + Insert` o clic derecho → Paste |
| **Ver IP de la MV** | En la MV: `ip a` |

---

## SSH & SFTP — Conexión y Transferencia Remota

### Servidor (Ubuntu Server)
```bash
sudo apt update && sudo apt install -y openssh-server  # Instalar servidor SSH
sudo systemctl status ssh                              # Verificar que está activo
```

### Cliente (PowerShell en Windows anfitrión)
```powershell
ssh usuario@192.168.0.23      # Conectarse por terminal
exit                          # Salir de la sesión
```

### Transferencia de archivos con FileZilla (SFTP)
* **Protocolo:** SFTP - SSH File Transfer Protocol (funciona sobre el puerto 22 de SSH).
* **Servidor / Host:** `192.168.0.23` (IP de la MV).
* **Puerto:** `22`.
* **Usuario y contraseña:** Credenciales del usuario de la máquina virtual.
* Comprobar en terminal con `ls` o `ls -la` en la carpeta destino.

---

## Teclado español en Ubuntu Server

```bash
sudo loadkeys es               # Cargar layout español (temporal)
sudo localectl set-keymap es   # Cargar layout español (permanente)
```

---

## 🐳 Docker — Comandos y Conceptos (Unidad 2)

### Conceptos Clave
* **Imagen:** Plantilla de solo lectura compuesta por capas (como una ISO).
* **Contenedor:** Instancia en ejecución (máquina virtual ligera) creada a partir de una imagen.
* **Dockerfile:** Fichero de instrucciones para construir una imagen propia.

### Gestión de Imágenes
```bash
docker pull <imagen>:<tag>           # Descargar imagen de Docker Hub (ej: nginx:alpine)
docker images                         # Listar imágenes en local
docker rmi <ID/nombre>               # Eliminar una imagen
docker image prune -a                 # Limpiar todas las imágenes sin contenedor asociado
docker history <imagen>               # Ver historial de capas de una imagen
docker build -t <nombre>[:tag] <dir>  # Construir imagen desde Dockerfile (ej: docker build -t octopus .)
```

### Gestión de Contenedores
```bash
# Arrancar en segundo plano con puertos y nombre
docker run -d -p 8080:80 --name mi-web nginx:alpine

# Modo interactivo con terminal (Ubuntu / Alpine)
docker run -it --name mi-ubuntu ubuntu bash
docker run -it alpine sh

# Crear contenedor SIN arrancarlo
docker create --name practica2 -p 8080:80 nginx:alpine

# Mantener activo un contenedor que no corre ningún servicio
docker run -d --name mi-test ubuntu tail -f /dev/null

# Control de estado
docker ps                             # Ver contenedores activos
docker ps -a                          # Ver TODOS los contenedores (activos y parados)
docker stop <nombre/ID>               # Parar contenedor
docker start <nombre/ID>              # Arrancar contenedor parado
docker restart <nombre/ID>            # Reiniciar contenedor
docker rm <nombre/ID>                 # Eliminar contenedor (debe estar parado)
docker rm -f <nombre/ID>              # Forzar eliminación de contenedor activo

# Ejecutar comandos dentro de un contenedor en marcha
docker exec -it <nombre/ID> bash
docker exec -it <nombre/ID> sh        # Para contenedores ligeros tipo Alpine
```

### Opciones más comunes de `docker run`
* `-d`: Segundo plano (*detached*).
* `-it`: Interactivo conectado a la terminal (*tty + stdin*).
* `--name <nombre>`: Asignar nombre identificativo.
* `-p <puerto_host>:<puerto_contenedor>`: Redirigir puertos (ej: `-p 8080:80`).
* `-v <volumen>:<ruta_contenedor>`: Montar volumen o carpeta compartida.
* `--network <red>`: Conectar a una red específica.
* `-e VARIABLE=valor`: Pasar variables de entorno (ej: `-e MYSQL_ROOT_PASSWORD=secret`).
* `--rm`: Eliminar contenedor automáticamente al pararse.

### Instrucciones de un `Dockerfile`
```dockerfile
FROM node:18                    # Imagen base de partida
WORKDIR /usr/src/app            # Directorio de trabajo interno
COPY package.json ./            # Copiar dependencias del host al contenedor
RUN npm install                 # Se ejecuta al CREAR la imagen (build)
COPY . .                        # Copiar resto de archivos
EXPOSE 3000                     # Puerto informativo de la aplicación
CMD ["node", "app.js"]          # Comando al ARRANCAR el contenedor (run)
```
> **Diferencia clave:** `RUN` prepara el entorno en tiempo de construcción (`build`), mientras que `CMD` es el comando por defecto que se lanza al encender el contenedor (`run`).

### Almacenamiento y Persistencia (Volúmenes)
```bash
# 1. Volúmenes gestionados por Docker (Managed Volumes) - Recomendado para Bases de Datos
docker volume create mi_volumen       # Crear volumen
docker volume ls                      # Listar volúmenes
docker inspect mi_volumen             # Ver ruta real en el host (Mountpoint)
docker volume rm mi_volumen           # Eliminar volumen
docker run -d --name mi-db -v mi_volumen:/var/lib/mysql mysql:8.0

# 2. Enlace de directorios del PC (Bind Mounts) - Ideal para desarrollo
docker run -d -p 8080:80 -v ${PWD}/html:/usr/share/nginx/html nginx:alpine
```

### Redes en Docker (Networks)
```bash
docker network ls                     # Listar redes (bridge, host, none)
docker network create -d bridge mi-red# Crear red propia con DNS automático por nombre

# Conectar contenedores a la misma red:
docker run -d --name mongo --network mi-red mongo
docker run -d --name app --network mi-red -p 3000:3000 mi-app-node
# En la app nos conectamos usando el nombre: mongodb://root:pass@mongo:27017
```

---

## 📋 Resumen de Prácticas DaW

### PEC 1 — Introducción al despliegue, Apache, Nginx, Multisitio y Acceso Remoto
> ✅ **Completada y entregada** (Revisada al 100%, con documentación paso a paso y capturas).

### PEC 2 — Introducción a Docker y despliegues en local
> ⏳ **Próxima entrega (vence 25/10/2026)**. Entorno de contenedores, Dockerfile y despliegue de aplicaciones.

