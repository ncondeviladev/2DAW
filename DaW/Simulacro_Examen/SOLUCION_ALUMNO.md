# DAW — Examen Práctico 1ª Evaluación
**Alumno:** Noé Conde Vila  
**Fecha:** 5 de noviembre de 2026  
**Profesor:** Juanra Collado  

---

## Ejercicio 1: Coexistencia Apache2 + Nginx con Multisitio por Dominio (3,5 pts)

### 1. Configuración de Apache2 (Puerto 8080 - apache1.daw y apache2.daw)
- **Fichero `/etc/apache2/ports.conf`:**
```apache
Listen 8080
```

- **Fichero VirtualHost 1 (`apache1.conf`):**
```apache
# VirtualHost para apache1.daw (puerto 8080, DocumentRoot /var/www/apache1)
```

- **Fichero VirtualHost 2 (`apache2.conf`):**
```apache
# VirtualHost para apache2.daw (puerto 8080, DocumentRoot /var/www/apache2)
```

### 2. Configuración de Nginx (Puerto 80 - sitio1.daw y sitio2.daw)
- **Fichero Server Block 1 (`sitio1`):**
```nginx
# Server Block para sitio1.daw (puerto 80, root /var/www/sitio1)
```

- **Fichero Server Block 2 (`sitio2`):**
```nginx
# Server Block para sitio2.daw (puerto 80, root /var/www/sitio2)
```

### 3. Resolución en `/etc/hosts` y Comprobaciones
- **Fichero `/etc/hosts`:**
```text
127.0.0.1 apache1.daw apache2.daw sitio1.daw sitio2.daw
```

- **Comandos de activación, validación y curl:**
```bash
# Comandos a2ensite, ln -s, apachectl configtest, nginx -t y curl -I
```

---

## Ejercicio 2: Creación de Imagen con Dockerfile (3 pts)

### 1. Fichero Dockerfile
```dockerfile
# Escribe aquí tu Dockerfile
```

### 2. Comandos de construcción y ejecución
```bash
# Escribe aquí los comandos docker build y docker run
```

### 3. Comprobaciones de contenedor y acceso
```bash
# Escribe aquí los comandos docker ps, logs y curl
```

---

## Ejercicio 3: Entorno Multicontenedor con Docker Compose (3,5 pts)

### 1. Fichero `compose.yml`
```yaml
# Escribe aquí tu compose.yml completo
```

### 2. Script PHP de conexión (`web/index.php`)
```php
<?php
// Escribe aquí la conexión a MySQL con mysqli o PDO
?>
```

### 3. Comprobación y despliegue
```bash
# Comandos docker compose up, ps y comprobación
```

