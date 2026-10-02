# 🐳 DaW — Unitat 2: Exercicis Pràctics de Docker (Diapositives i Vídeos)

Aquest directori conté totes les pràctiques proposades pel professor **Juan Ramón Collado** a les diapositives de la **Unitat 2** (*Introducció a Docker i desplegaments en local*).

---

## 📂 Índex de Pràctiques

| Carpeta | Pràctica | Diapositives | Descripció resumida |
| :--- | :--- | :---: | :--- |
| `01_practica1_ubuntu/` | **Pràctica 1** | Diap. 18 | Contenidor Ubuntu interactiu (`docker run -it ubuntu bash`), comprovació de versió i diferència entre `docker ps` i `docker ps -a`. |
| `02_ejemplo_octopus/` | **Exemple Bàsic** | Diap. 38–42 | Creació de la primera imatge pròpia amb `Dockerfile` (`FROM nginx:alpine` + `COPY static`), build i desplegament d'aplicació web del polp (`octopus-underwater-app`). |
| `03_practica2_nginx_create/` | **Pràctica 2** | Diap. 43 | Crear un contenidor anomenat `practica2` basat en `nginx:alpine` **sense executar-lo** (`docker create`) mapejant el port 80 del contenidor al 8080 del host. |
| `04_practica3_ubuntu_nano/` | **Pràctica 3** | Diap. 44 | Contenidor interactiu Ubuntu, raonament de per què no inclou `nano`/`gedit` per defecte i instal·lació manual. *(Enllaç directe amb l'exercici 1 de la PEC2)*. |
| `05_practica4_taller_docker/` | **Pràctica 4** | Diap. 50 | Pràctica guiada del taller oficial de Docker (*Getting Started: 02_our_app*). |
| `06_practica5_volumenes/` | **Pràctica 5** | Diap. 62–64 | Demostració de pèrdua de dades (`sinVolumen`) vs persistència mitjançant volums gestionats de Docker (`docker volume create mi_volumen` + `-v mi_volumen:/datos`). |
| `07_practica5.1_bind_mounts/` | **Pràctica 5.1** | Diap. 65 | Persistència mitjançant **Bind Mounts** enllaçant una carpeta física del PC al contenidor (`-v ${PWD}/mi_app_datos:/datos`). |
| `08_practica6_persistencia/` | **Pràctica 6** | Diap. 66–68 | Taller oficial de persistència (*05_persisting_data*) i administració de volums (`docker volume ls`, `inspect`, `rm`). |
| `09_practica7_node_mongo_red/` | **Pràctica 7** | Diap. 74–82 | Xarxes en Docker: comunicació entre contenidor Node.js i base de dades MongoDB en xarxa personalitzada `app-net` mitjançant resolució DNS pel nom del contenidor. |

---

## 🛠️ Comandos Ràpids de Referència

### 1. Pràctica 1 (Ubuntu interactiu)
```bash
docker run -it ubuntu bash
cat /etc/os-release
exit
docker ps
docker ps -a
```

### 2. Exemple Octopus (Construcció de Dockerfile)
```bash
cd 02_ejemplo_octopus/octopus-underwater-app
docker build -t octopus .
docker run -d -p 8080:80 --name app-octopus octopus
```

### 3. Pràctica 2 (Crear sense executar)
```bash
docker create --name practica2 -p 8080:80 nginx:alpine
docker ps -a
# Per a arrancar-lo posteriorment:
docker start practica2
```

### 4. Pràctica 3 (Instal·lació en calent)
```bash
docker run -it --name ubuntu-nano ubuntu bash
apt update && apt install -y nano
nano prueba.txt
exit
```

### 5. Pràctica 5 (Volums gestionats)
```bash
docker volume create mi_volumen
docker run -it --name con_volumen -v mi_volumen:/datos ubuntu bash
echo "Persistencia con volumenes" > /datos/nota.txt
exit
docker rm con_volumen
# Verifiquem persistència amb un nou contenidor:
docker run -it -v mi_volumen:/datos ubuntu bash
cat /datos/nota.txt
exit
```

### 6. Pràctica 5.1 (Bind Mount)
```bash
mkdir -p mi_app_datos
docker run -it --name con_bind -v ${PWD}/mi_app_datos:/datos ubuntu bash
```

### 7. Pràctica 7 (Xarxa Node + Mongo)
```bash
docker network create app-net
docker run -d --name mongo --network app-net -e MONGO_INITDB_ROOT_USERNAME=root -e MONGO_INITDB_ROOT_PASSWORD=example mongo
# Dins de 09_practica7_node_mongo_red:
docker build -t node-mongo-app .
docker run -d --network app-net -p 3000:3000 node-mongo-app
```
