<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.5;
    color: #24292f;
  }
  img {
    max-width: 85%;
    max-height: 320px;
    object-fit: contain;
    display: block;
    margin: 10px auto 4px auto;
    border: 1px solid #d0d7de;
    border-radius: 4px;
  }
  small {
    display: block;
    text-align: center;
    color: #57606a;
    margin-bottom: 16px;
    font-size: 0.85em;
  }
  h2, h3 {
    page-break-after: avoid;
    break-after: avoid;
  }
  blockquote {
    background-color: #f6f8fa;
    border-left: 4px solid #0969da;
    padding: 6px 12px;
    margin: 8px 0 16px 0;
    color: #57606a;
  }
</style>

# DAW — Unidad 1: PEC 1
**Alumno:** Noé Conde Vila  

---

## Ejercicio 1
> *Como habrás podido observar, cuando el servidor no encuentra una página web arroja un error 404 y muestra una página web por defecto. Busca cómo cambiar esta página web e incluye una tuya personalizada que incluya tu nombre tanto para Apache como para Nginx. Incluye capturas de los ficheros de configuración y navegador.*

- **Apache:** `192.168.0.22`
- **Nginx:** `192.168.0.23`

### Apache

Primero creamos un archivo HTML llamado `404.html` en la carpeta `miproyecto` (creada previamente) y luego modificamos el archivo de configuración de Apache para añadir la directiva de error 404 por defecto.

![Comandos Apache](capturas/1/apacheComandos.png)  
<small>*Comandos para crear el HTML, configurar el archivo default, comprobar sintaxis, recargar servidor y comprobar con curl.*</small>

![Captura error 404 Apache](capturas/1/apache404.png)  
<small>*Contenido HTML del archivo de error 404.*</small>

![Config Apache](capturas/1/apacheConf.png)  
<small>*Archivo de configuración default (`000-default.conf`) con la directiva ErrorDocument.*</small>

![Web Apache](capturas/1/apacheWeb.png)  
<small>*Comprobación desde el navegador accediendo a una ruta inexistente.*</small>

### Nginx

Con Nginx los pasos son similares, creando el mismo archivo error 404 en la misma ruta de `miproyecto` y modificando el archivo de configuración `default` aunque con otro tipo de sintaxis.

![Comandos Nginx](capturas/1/nginxComandos.png)  
<small>*Comandos realizados en Nginx.*</small>

![Config Nginx](capturas/1/nginxConf.png)  
<small>*Archivo de configuración de Nginx con error_page.*</small>

![Web Nginx](capturas/1/nginxWeb.png)  
<small>*Comprobación desde el navegador en Nginx.*</small>

<div style="page-break-after: always;"></div>

---

## Ejercicio 2
> *Modifica los servidores para que el sitio web por defecto escuche en el 8989. Incluye capturas de los ficheros de configuración y navegador.*

*(Juanra, en les captures del navegador apareixen ports 8080 8081 dels html dels exercicis anteriors, no faxes cas la url esta be)*

### Apache

Para cambiar el puerto en Apache hay que hacerlo en dos archivos.

En el archivo `ports.conf` cambiamos la directiva `Listen` al puerto 8089:

![](capturas/2/apachePorts89.png)  
<small>*Archivo de configuración con el puerto 8989.*</small>

Y en el archivo `default` que modificamos en anteriores ejercicios, cambiamos la primera línea de `VirtualHost` al puerto 8089:

![](capturas/2/apacheConf89.png)  
<small>*Archivo de configuración con el puerto 8989.*</small>

![](capturas/2/apacheWeb89.png)  
<small>*Comprobación desde el navegador en el puerto 8989.*</small>

### Nginx

En Nginx tan solo hace falta modificar el archivo `default` cambiando ambas líneas de `listen` al puerto 8089 y recargar el servidor.

![](capturas/2/nginxConf89.png)  
<small>*Archivo de configuración default con el puerto 8989.*</small>

![](capturas/2/nginxWeb89.png)  
<small>*Comprobación desde el navegador en el puerto 8989.*</small>

<div style="page-break-after: always;"></div>

---

## Ejercicio 3
> *Sobre la NginxMV, investiga cómo podemos tener varios sitios (al menos 2) en la misma máquina e impleméntalo. Haz un tutorial paso a paso con capturas de los pasos seguidos y muestra capturas de los sitios funcionando simultáneamente.*

### Paso 1: Creación de carpetas y permisos

Creamos dos carpetas para cada sitio y les otorgamos permisos de lectura y escritura al usuario `www-data`.

![](capturas/3/crearDirrectoriosPermisos.png)  
<small>*Creación de directorios y asignación de permisos.*</small>

### Paso 2: Creación de los index.html

Creamos los index con `sudo nano`, aquí uso `cat` para mostrarlos ya que se crearon previamente.

![](capturas/3/crearIndex.png)  
<small>*Creación y contenido de los archivos index.html.*</small>

### Paso 3: Ficheros de configuración en sites-available

Creamos los archivos de configuración en `sites-available`, definimos la escucha en el puerto 80 para HTTP, asignamos el nombre del sitio con `server_name`, el directorio raíz, el index y los logs de error y acceso.

![](capturas/3/crearConf.png)  
<small>*Archivos de configuración de los sitios.*</small>

### Paso 4: Habilitar sitios (enlaces simbólicos)

En Nginx los sitios se habilitan creando enlaces desde `sites-available` a `sites-enabled` con el comando `ln -sf`.

![](capturas/3/enlace.png)  
<small>*Enlaces simbólicos en sites-enabled.*</small>

### Paso 5: Comprobación por terminal (curl)

Comprobamos la configuración y la sintaxis, y hacemos un curl a ambos después de resetear el servidor.

![](capturas/3/curl.png)  
<small>*Comprobación mediante curl.*</small>

### Paso 6: Comprobación en navegador (sitios simultáneos)

Para este paso debemos añadir las IP en el archivo `hosts` de nuestra máquina anfitrión, entrando al Bloc de notas como administrador y accediendo a la ruta `C:\Windows\System32\drivers\etc\`, donde añadimos las IP y sus URL en el archivo hosts.

![](capturas/3/host.png)  
<small>*Apertura del archivo hosts en el Bloc de notas como administrador.*</small>

![](capturas/3/hostIp.png)  
<small>*Líneas añadidas al archivo hosts con las IP y dominios de los sitios.*</small>

Finalmente comprobamos en el navegador ambas direcciones:

![](capturas/3/sitios.png)  
<small>*Ambos sitios funcionando simultáneamente desde el navegador.*</small>

<div style="page-break-after: always;"></div>

---

## Ejercicio 4
> *Sobre una de las máquinas virtuales (es indiferente cuál), instala el otro servidor, configura multisitio en ambos de tal forma que en la misma máquina virtual tengamos dos servidores funcionando de forma simultánea (Apache + Nginx), teniendo cada uno de ellos más de un sitio funcionando (como mínimo tendremos 4 sitios en la misma máquina). Incluye capturas de los pasos más importantes con una mini-explicación de los pasos que has dado, así como capturas de los ficheros de configuración involucrados y de las webs funcionando de forma simultánea.*

Para crear un servidor adicional al existente que ya ocupa el puerto 80 con los sitios.daw de ejercicios anteriores, tenemos que cambiar los puertos del nuevo servidor.

Una vez instalado y comprobado que ambos funcionan simultáneamente, accedemos al archivo de configuración de puertos para cambiar el 80 por defecto a 8181 y 8282.

![](capturas/4/serversActivos.png)  
<small>*Servicios Nginx y Apache activos simultáneamente en la misma máquina.*</small>

![](capturas/4/puertos.png)  
<small>*Configuración de ports.conf en Apache con los puertos 8181 y 8282 para evitar conflictos con Nginx.*</small>

Una vez tenemos los puertos, creamos los directorios y sus correspondientes index, dando los permisos necesarios a ambos. En la captura se puede ver que tenemos los dos nuevos apache, los dos 'sitio' de nginx y 'miproyecto' de ejercicios anteriores.

![](capturas/4/crearIndex.png)  
<small>*Creación de directorios y páginas web index.html para Apache.*</small>

El siguiente paso es crear los archivos de configuración para ambos apache cada uno con su propio puerto, abajo en la captura se puede ver las dos configuraciones, con 'a2ensite' los activamos y con 'configtest' comprobamos que esté todo correcto.

![](capturas/4/conf.png)  
<small>*Archivos de configuración de los VirtualHosts de Apache (apache1.conf y apache2.conf).*</small>

Recargamos apache y comprobamos con curl y en navegador, mostrando los cuatro sitios simultáneamente.

![](capturas/4/curls.png)  
<small>*Comprobación mediante curl de los 4 sitios respondiendo a la vez.*</small>

![](capturas/4/navegadores.png)  
<small>*Las 4 webs funcionando de forma simultánea desde el navegador.*</small>

<div style="page-break-after: always;"></div>

---

## Ejercicio 5
> *A. Conéctate al servidor de Nginx por SSH desde la máquina anfitriona (u otra de la red). Añade capturas con la conexión correctamente realizada.*  
> *B. Sube un fichero al servidor Nginx a través de FTP desde la máquina anfitriona (u otra de la red). Añade capturas con la transferencia correctamente realizada.*

### A. Conexión SSH

Para poder conectarse con SSH primero hay que instalar el servicio en la MV. Aquí se muestra ya instalado porque en ejercicios anteriores ya he estado trabajando así.

![](capturas/5/openssh.png)  
<small>*Instalación y estado del servicio openssh-server en la máquina virtual.*</small>

Accedemos con `ssh usuario@ip` desde PowerShell para comprobar que funciona.

![](capturas/5/ssh.png)  
<small>*Conexión SSH realizada desde PowerShell en la máquina anfitriona.*</small>

### B. Transferencia FTP

En FileZilla accedemos con los mismos datos: nombre de usuario, IP, contraseña y puerto 22 correspondiente a SSH. Creamos un simple `.txt` y lo movemos a la carpeta de usuario de la MV por ejemplo.

![](capturas/5/ftp.png)  
<small>*Conexión y transferencia de archivo mediante FileZilla por protocolo SFTP.*</small>

Comprobamos en terminal para asegurarnos de que el archivo se ha movido correctamente.

![](capturas/5/ls.png)  
<small>*Comprobación en la terminal del archivo transferido en el servidor.*</small>