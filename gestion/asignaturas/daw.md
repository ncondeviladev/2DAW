# 🚢 DaW — Desplegament d'Aplicacions Web

> **Professor:** Juan Ramón Collado Esteve (`jr.colladoesteve@edu.gva.es`)  
> **Tutories:** Dimecres vesprada (setmanes imparells) / Dijous matí (setmanes parells).

---

## 🎯 1. Estat de les Tasques de la Unitat

| Tasca | Contingut Clau | Estat | Data Límit / Nota |
| :--- | :--- | :---: | :---: |
| `PEC1 (U1)` | Arquitectura C-S, Apache, Nginx, SSH | ✅ **Entregat** | **8,00 / 10,00** |
| `PEC2 (U2)` | Introducció a Docker i desplegaments en local | ✅ **Entregat** | 25/10/2026 23:59 |
| `PEC3 (U3)` | Docker avançat: Compose + Kubernetes (3 rèpliques) | ✅ **Qualificat** | **9,50 / 10,00** |
| `Material Examen 1a Eval` | PDF únic consolidat (Comandos PECs + PECs 1-3) | 📝 **Llest (34 pàgs)** | `cheatsheetNoeConde.pdf` |

---

## 💡 2. Punts de Millora i Repàs per a l'Examen Presencial

- **Feedback de la PEC3 (10/11/2026 - Juan Ramón Collado):**
  - **Qualificació:** **9,50 / 10,00**.
  - **Comentari de retroacció:** *"1. La explicación es muy escasa. El enunciado indica que expliques punto por punto y lo haces de forma genérica."*
  - **Nota per a l'examen:** En l'examen presencial, si demanen explicacions de passos o configuracions, detallar explícitament què fa cada directiva o comanda punt per punt, no de forma resumida.
- **Feedback de la PEC1 (Exercici 4 - Vhosts):**
  - El professor va assenyalar optimitzar la configuració de múltiples vhosts basats en nom de domini agrupant-los en **només 2 ports en total**:
    - **Port 80 (Nginx):** `sitio1.daw` i `sitio2.daw` escoltant pel mateix port 80 mitjançant la directiva `server_name`.
    - **Port 8080 (Apache):** `apache1.daw` i `apache2.daw` escoltant pel port 8080 mitjançant la directiva `ServerName`.
- **Competències clau de Docker (PEC2 i PEC3):**
  - Construcció d'imatges pròpies amb `Dockerfile`.
  - Definició de serveis interconnectats amb `docker-compose.yml` (xarxes bridge internes, volums de dades persistents i mapeig de ports).
  - Desplegament de clúster Kubernetes local amb `Deployment` i `Service` (NodePort / ClusterIP) assegurant l'alta disponibilitat amb 3 rèpliques.

---

## 🚀 3. Simulacre d'Examen 1a Avaluació (Sessió 06/11/2026)

- **1a Volta Guiada Completada:**
  - **Exercici 1 (Servidors Web en Contenidor Ubuntu):**
    - Apache en port 8080 (`sitio1.daw` i `sitio2.daw`) + pàgines 404 personalitzades.
    - Nginx en port 80 (`sitio1.daw` i `sitio2.daw`) + pàgines 404 personalitzades + eliminació de `default`.
    - Resolució local única en `/etc/hosts` (`127.0.0.1 sitio1.daw sitio2.daw`) compartida per a ambdós servidors.
  - **Exercici 2 (Dockerfile Propi Alpine):**
    - Empaquetament web amb `nginx:alpine` (`/usr/share/nginx/html`).
    - Domini de sintaxi `COPY` (directe vs amb `WORKDIR`), `EXPOSE 80` i construcció `docker build -t portal-web:2.0 .`.
    - Arranque `docker run -d -p 8888:80 --name mi_portal` i comprovació amb `curl.exe` i `docker exec -it ... sh` (Alpine no té `bash`).
  - **Exercici 3 (Docker Compose Multicontenidor):**
    - `compose.yml` complet amb servei `app` (`php:8.3-apache`), `db` (`mysql:8.0`) i volum persistente nombrat `datos_examen`.
    - Script PHP de connexió provat amb èxit en `http://localhost:8000`.
- **Lliçons i Trampes d'Examen Documentades al Resum (2 Pàgines):**
  - `/etc/hosts` plural i global (no cal duplicar per cada servidor).
  - `service <srv> restart` en comptes de `reload` per a evitar errors si el servei estava aturat.
  - Coincidència de directiva `root` / `DocumentRoot` amb carpetes reals en `/var/www/`.
  - `curl.exe` en Windows PowerShell vs `curl` en Linux.
  - Consola en Alpine: `sh` en comptes de `bash`.
  - `compose.yml`: declaració de volums de nivell superior obligatòriament amb dos punts (`volum:`).
  - Controlador MySQL en PHP Docker: comanda de rescat `docker exec -it <cont> docker-php-ext-install mysqli`.
  - Utilitat de xarxa: rescat `docker exec -it <cont> apt update && apt install -y iputils-ping`.
- **Estat de la Documentació per a l'Examen:**
  - `DaW/cheatsheetNoeConde.html`: Font maquetada amb amplada fixa A4 (198 mm), zero `sudo`, estructura neta i comentaris sense trencaments.
  - `DaW/cheatsheetNoeConde.pdf`: Consolidat oficial definitiu de **34 pàgines** (Cheat Sheet tècnica de 2 pàgines + PEC 1 + PEC 2 + PEC 3), auditat amb traçabilitat 100% oficial de les pràctiques.
- **Sessió del 07/11/2026 (Consolidació de Cheat Sheet i Simulacre v2):**
  - Resolució i comprovació d'arrencada de `compose.yml` amb aplicació PHP y MySQL.
  - Identificació del format de llista per a `depends_on: [db]` i els dos punts obligatoris en `volumes: datos_examen:`.
  - Prova i validació del comandament de rescat `docker exec -it <app> docker-php-ext-install mysqli`.
  - Reorganització lògica de la Cheat Sheet: Fila superior (Linux + Docker CLI), Fila inferior (Apache + Nginx), Dockerfile unificat i recuperació íntegra de tots els flags i comandaments.
- **Objectiu Propera Sessió:**
  - Repàs ràpid de comandes de rescat i Dockerfile abans de dijous.

---

## 🚨 4. Fites i Horari Oficial d'Examen Presencial
- **Opcions d'Horari Oficial:**
  - **Opció A (Recomanada i Seleccionada):** **Dijous, 19 de novembre de 2026, de 12:00 a 13:50**. Permet fer DaW al matí, descansar o repassar DWES per a la vesprada (18:00), i deixar el divendres 20/11 100% net i enfocat a l'examen llarg de DIW (12:00 a 15:50).
  - **Opció B:** Divendres, 20 de novembre de 2026, de 18:00 a 19:50 (Desaconsellada per sobrecàrrega immediatament després de DIW).
- **Format:** Examen pràctic en ordinador (Apache/Nginx vhosts, Dockerfile, Docker Compose o Kubernetes).
- **Material Autoritzat:** Dossier imprès propi de fins a 35 pàgines.
- **Recurs Preparat:** 📄 [cheatsheetNoeConde.pdf](file:///f:/OneDrive%20-%20Conselleria%20d'Educaci%C3%B3/2DAW/DaW/cheatsheetNoeConde.pdf) (34 pàgines completes: chuleta tècnica de 2 pàgines + memòries íntegres de PEC1, PEC2 i PEC3).
