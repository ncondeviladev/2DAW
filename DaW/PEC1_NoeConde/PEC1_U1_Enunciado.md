# DAW — Unidad 1: Práctica de Evaluación Continua 1 (PEC1)
> **Mòdul:** Despliegue de Aplicaciones Web (DAW) — 2º DAW 2025/2026  
> **Professor:** Juanra Collado  
> **Entrega:** Formato PDF en Aules (los enunciados deben aparecer en el PDF).  
> **Punto de partida:** Final de la Práctica 3 de las diapositivas de la Unidad 1.

---

## 🎯 Resultados de Aprendizaje (RA's)
- **RA1:** Implanta arquitecturas web analizando y aplicando criterios de funcionalidad.
- **RA2:** Implanta aplicaciones web en servidores web, evaluando y aplicando criterios de configuración para su funcionamiento seguro.

---

## 📋 Enunciado de los Ejercicios

### 1. Página de Error 404 personalizada (15% rúbrica)
Cuando el servidor no encuentra una página web arroja un error 404 y muestra una página por defecto.
- Busca cómo cambiar esta página web e incluye una personalizada que incluya tu nombre (**Noé Conde Vila**) tanto para **Apache** como para **Nginx**.
- **Entregable:** Capturas de los ficheros de configuración y del navegador mostrando el 404 personalizado.

---

### 2. Cambio de puerto por defecto a 8989 (10% rúbrica)
- Modifica ambos servidores (**Apache** y **Nginx**) para que el sitio web por defecto escuche en el puerto **8989**.
- **Entregable:** Capturas de los ficheros de configuración (`ports.conf`, `000-default.conf`, `default` de Nginx) y del navegador accediendo por el puerto 8989.

---

### 3. Nginx Multisitio en NginxMV (25% rúbrica)
- Sobre la máquina **NginxMV**, investiga cómo tener varios sitios (al menos 2) en la misma máquina e impleméntalo.
- **Entregable:** 
  - Tutorial paso a paso con capturas de los pasos seguidos.
  - Capturas de los sitios funcionando simultáneamente.

---

### 4. Coexistencia Apache + Nginx con Multisitio (mínimo 4 sitios) (35% rúbrica)
- Sobre **una de las máquinas virtuales** (indiferente cuál), instala el otro servidor.
- Configura multisitio en ambos de tal forma que en la **misma máquina virtual tengamos dos servidores funcionando de forma simultánea** (Apache + Nginx).
- Cada uno debe tener más de un sitio funcionando (como mínimo tendremos **4 sitios** en total en la misma máquina).
- **Entregable:** 
  - Capturas de los pasos más importantes con una mini-explicación.
  - Capturas de los ficheros de configuración involucrados.
  - Capturas de las 4 webs funcionando de forma simultánea.

---

### 5. Acceso Remoto: SSH y FTP en Nginx (15% rúbrica)
- **A.** Conéctate al servidor de Nginx por **SSH** desde la máquina anfitriona (u otra de la red).
  - *Entregable:* Capturas de la conexión SSH realizada.
- **B.** Sube un fichero al servidor Nginx a través de **FTP** (ej. FileZilla) desde la máquina anfitriona.
  - *Entregable:* Capturas de la transferencia de archivos correctamente realizada.

---

## 📊 Rúbrica de Evaluación

| Criterio | 90-100% | 50-90% | 0-40% | Peso |
| :--- | :--- | :--- | :--- | :---: |
| **Error 404 personalizado** | Páginas personalizadas con nombre en ambos servidores. Capturas de configuración y navegador. | Personalizadas solo en uno o capturas incompletas. | Sin personalización o capturas muy incompletas. | **15%** |
| **Puerto 8989 por defecto** | Cambiado en ambos servidores y verificado en navegador con capturas. | Solo en un servidor o capturas incompletas. | No cambiado o no verificado. | **10%** |
| **Multisitio Nginx (≥2 sitios)** | Multisitio correcto, tutorial paso a paso claro y capturas simultáneas completas. | Multisitio parcial, tutorial poco claro o capturas incompletas. | No configurado o sin evidencias. | **25%** |
| **Apache + Nginx simultáneos (≥4 sitios)** | Ambos servidores y ≥4 sitios funcionando simultáneamente con capturas y explicaciones claras. | Solo un servidor bien o sitios incompletos. | No funciona multiserver ni multisitio. | **35%** |
| **SSH y subida por FTP** | SSH exitoso y archivo subido por FTP con capturas claras. | Conexión parcial o subida sin verificación completa. | No realizado. | **15%** |
