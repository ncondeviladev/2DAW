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

### Cambiar puerto (ports.conf)
```bash
sudo nano /etc/apache2/ports.conf
# Cambiar: Listen 80 → Listen 8080
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
/usr/share/nginx/html/                 → Carpeta raíz web por defecto
/var/log/nginx/access.log              → Log de accesos
/var/log/nginx/error.log               → Log de errores
```

### Comandos útiles
```bash
sudo apt install nginx                 # Instalar Nginx
sudo nginx -t                          # Verificar sintaxis config
sudo systemctl reload nginx            # Aplicar cambios
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

## SSH — Conexión remota

```bash
ssh usuario@192.168.1.50       # Conectarse al servidor
exit                           # Desconectarse

# Si da error de conexión:
sudo ufw allow ssh
sudo ufw enable
```

---

## Teclado español en Ubuntu Server

```bash
sudo loadkeys es               # Cargar layout español (temporal)
sudo localectl set-keymap es   # Cargar layout español (permanente)
```

---

## 📋 Resumen de Prácticas
*(se irá completando al terminar cada una)*

### Práctica 1 — Apache en MV Ubuntu Server
> 🚧 En progreso...

### Práctica 1.1 — Acceso remoto SSH + FTP
> ⏳ Pendiente

### Práctica 2 — Nginx en MV Ubuntu Server
> ⏳ Pendiente

### Práctica 3 — Cambiar puertos + DocumentRoot
> ⏳ Pendiente

### Práctica Final — Nginx multisitio
> ⏳ Pendiente
