<div style="text-align: center; padding: 60px 20px 40px 20px; font-family: sans-serif;">

<p style="text-transform: uppercase; letter-spacing: 2px; font-size: 11px; color: #6366f1; font-weight: bold; margin-bottom: 10px;">
    Desenvolupament Web en Entorn Servidor · 2n DAW
</p>

<h1 style="font-size: 30px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; letter-spacing: -0.5px;">
    Unitat 4 · Accés a Dades
</h1>

<h2 style="font-size: 17px; font-weight: 500; color: #475569; margin: 0 0 30px 0;">
    Pràctica U4_P1 · Projecte TechLeads amb MySQL i PDO
</h2>

<div style="display: inline-block; text-align: left; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 24px; font-size: 13px; line-height: 1.8; color: #334155;">
    <div><strong>Alumne:</strong> Noé Conde Vila</div>
    <div><strong>Mòdul:</strong> DWES · IES Maria Enríquez</div>
    <div><strong>Curs acadèmic:</strong> 2026 / 2027</div>
</div>

</div>

<div style="page-break-after: always;"></div>

## 1. Proves de funcionament intern (Punts 5 a 11)

### 1.1. `prova-model.php` (Punt 5.5)
Comprovem la instanciació dels models `Lead` i `Usuari`, el cicle d'estats i la verificació de contrasenyes amb hash.

![prova-model](./capturas/prova-model.png)

---

### 1.2. `prova-connexio.php` (Punt 7.6)
Verifiquem la connexió amb èxit al servei MySQL de Docker mitjançant PDO i la classe `DBConnection`.

![prova-connexio](./capturas/prova-conexio.png)

---

### 1.3. `prova-dao.php` (Punt 8.6)
Comprovem les operacions CRUD dels DAO recuperant objectes reals directament amb `FETCH_CLASS`.

![prova-dao](./capturas/prova-dao.png)

---

### 1.4. `prova-arxiu.php` (Punt 9.6)
Validem la pujada segura d'arxius (formats, grandària màxima i noms únics) i la seua eliminació del disc.

![prova-arxiu](./capturas/prova-arxiu.png)

---

### 1.5. `prova-usuari.php` (Punt 11.4)
Inserció d'un usuari nou a la base de dades amb contrasenya xifrada i comprovació de la restricció `UNIQUE`.

![prova-usuari](./capturas/prova-usuari.png)

<div style="page-break-after: always;"></div>

## 2. Vistes finals de l'aplicació web

### 2.1. Formulari públic (`index.php`)
Pàgina pública on el client envia la sol·licitud i els documents, guardant-se de forma persistent a MySQL.

![index](./capturas/index.png)

---

### 2.2. Panell general de leads (`dashboard/leads.php`)
Llistat protegit per sessió amb la taula de leads, estats per colors i les accions de detall, avançar estat i eliminar.

![leads](./capturas/leads.png)

---

### 2.3. Fitxa de detall (`dashboard/lead.php`)
Vista completa de tota la informació d'un lead concret recuperat per ID, amb accés a l'arxiu adjunt i botó d'editar.

![lead](./capturas/lead.png)

---

### 2.4. Edició del lead (`dashboard/editar.php`)
Formulari per a modificar les dades del lead i substituir l'arxiu adjunt eliminant automàticament el fitxer vell.

![canvis](./capturas/canvis.png)

*Confirmació al guardar canvis:*

![canvisFets](./capturas/canvisFets.png)

<div style="page-break-after: always;"></div>

## 3. Diagrames d'ajuda

> Aquests dos diagrames els he anat fent durant la pràctica per a aclarirme millor amb l'estructura i el fluxe, ja que al inici amb tants fitxers i carpetes noves em feia un lio.

---

### 3.1. Arquitectura de capes
Visió general de les capes del projecte, des del navegador fins a la persistència en MySQL i disc.

![diagrama-arquitectura](./diagrames/diagrama-arquitectura.png)

---

### 3.2. Diagrama de classes UML
Estructura de classes, interfície `IDbAccess`, injecció de dependències i models de dades.

![diagrama-clases](./diagrames/diagrama-clases.png)
