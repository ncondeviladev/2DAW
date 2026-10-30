# 🚢 DaW — Desplegament d'Aplicacions Web

> **Professor:** Juan Ramón Collado Esteve (`jr.colladoesteve@edu.gva.es`)  
> **Tutories:** Dimecres vesprada (setmanes imparells) / Dijous matí (setmanes parells).

---

## 🎯 1. Estat de les Tasques de la Unitat

| Tasca | Contingut Clau | Estat | Data Límit / Nota |
| :--- | :--- | :---: | :---: |
| `PEC1 (U1)` | Arquitectura C-S, Apache, Nginx, SSH | ✅ **Entregat** | **8,00 / 10,00** |
| `PEC2 (U2)` | Introducció a Docker i desplegaments en local | ✅ **Entregat** | 25/10/2026 23:59 |
| `PEC3 (U3)` | Docker avançat: Compose + Kubernetes (3 rèpliques) | ✅ **Entregat** | 08/11/2026 23:59 |

---

## 💡 2. Punts de Millora i Repàs per a l'Examen Presencial

- **Feedback de la PEC1 (Exercici 4 - Vhosts):**
  - El professor va assenyalar optimitzar la configuració de múltiples vhosts basats en nom de domini agrupant-los en **només 2 ports en total**:
    - **Port 80 (Nginx):** `sitio1.daw` i `sitio2.daw` escoltant pel mateix port 80 mitjançant la directiva `server_name`.
    - **Port 8080 (Apache):** `apache1.daw` i `apache2.daw` escoltant pel port 8080 mitjançant la directiva `ServerName`.
- **Competències clau de Docker (PEC2 i PEC3):**
  - Construcció d'imatges pròpies amb `Dockerfile`.
  - Definició de serveis interconnectats amb `docker-compose.yml` (xarxes bridge internes, volums de dades persistents i mapeig de ports).
  - Desplegament de clúster Kubernetes local amb `Deployment` i `Service` (NodePort / ClusterIP) assegurant l'alta disponibilitat amb 3 rèpliques.
