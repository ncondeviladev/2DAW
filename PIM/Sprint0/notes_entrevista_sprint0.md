# 📝 Notes en Brut — Entrevista Usuari / Client (Sprint 0 - Reto 1B)
> **Data:** 14 d'octubre de 2026 (Sessió Teams)  
> **Client / Entrevistat:** Quique Savall (Rol: Empresari d'esports aquàtics / Dunes Kite Piles / Gandia Surf / MirandoAlMar)  
> **Entrevistador:** Noé Conde Vila (2n DAW — Semipresencial)  
> **Participants de l'equip:** Noé Conde, Cristian, José María, Mónica, Bruno i Antoni

---

## 🎯 Panell de Control de les Meues Preguntes (Reto 1A)
*(Estat: [⭐] Feta per mi / defensada, [X] Formulada per un altre company de l'equip)*

### Bloc 1: Usuaris i Competència
- [X] **P1.1:** Apps que s'usen actualment, què agrada i què disgusta (Windguru, Windy, etc. - estudi de competència).  
  *Nota: Formulada per Cristian. Quique va compartir pantalla mostrant Windguru i Windy, destacant que Windguru és molt potent però massa dens en taules i difícil d'interpretar a ple sol.*
- [⭐] **P1.2:** Nivell tècnic dels usuaris (saben interpretar nusos, període d'ona, etc. o necessiten un semàfor / consell visual?).  
  *Nota: El client confirma que els usuaris casuals i esportistes volen respostes visuals directes (gràfics de quesito amb percentatge de viabilitat 0-100% i semàfor verd/groc/roig) en lloc de taules d'arxiu numèric.*

### Bloc 2: Dades Marítimes i Previsions
- [X] **P2.1:** Dades imprescindibles per a decidir si entrar al mar (vent, ratxes, ones, mar de fons, període, marees, temperatura).  
  *Nota: Formulada per José María / Quique. Imprescindible vent (nusos i ratxes), altura i període d'ona, i diferenciar clarament entre esports de vent i aigües obertes.*
- [X] **P2.2:** Costes / platges prioritàries de la Comunitat Valenciana.  
  *Nota: Formulada per Mónica. Es prioritzen exactament 3 spots: 1. La Safor (Piles i Gandia), 2. Dénia (Port i Les Marines), 3. Calp / Altea.*
- [⭐] **P2.3:** Finestra temporal de previsió requerida (temps real, hores, dies, setmanes).  
  *Nota: S'acorda dividir la previsió en blocs clau d'acció immediata: 4 hores, 8 hores i 24 hores, a més d'una tendència setmanal bàsica.*

### Bloc 3: Disseny, UI i Usabilitat
- [⭐] **P3.1:** Usabilitat sota la llum solar intensa (mode clar d'alt contrast, targetes i números grans).  
  *Nota: Requisit crític acceptat pel client: la gent consulta el mòbil a la platja a ple sol; calen tipografies grans, contrast elevat (WCAG AAA) i conmutador de Mode Clar i Mode Fosc.*
- [X] **P3.2:** Identitat de marca (hi ha logotip/colors corporatius o es crea de zero?).  
  *Nota: Es crearà estil marítim: tons blaus marins i cian d'aigua/cel, combinats amb colors d'accent enèrgics (taronges i rojos nàutics) per a botons i alertes.*
- [X] **P3.3:** Format visual clau (mapa interactiu de spots, llistat de targetes per platja, gràfiques temporals).  
  *Nota: Formulada per Bruno. Quique va ensenyar un croquis amb 3 gràfics circulars (format quesito) amb percentatges de probabilitat per disciplina.*

### Bloc 4: Accés, Registre i Monetització (Freemium)
- [⭐] **P4.1:** Contingut obert sense registre vs. avantatges de registrar-se com a usuari gratuït.  
  *Nota: Es requereix registre d'usuari (CRUD complet) per a personalitzar l'experiència i guardar spots preferits, inicialment 100% gratuït.*
- [⭐] **P4.2:** Què es reserva per al model Premium / de pagament (dies de previsió extra, alertes, descomptes en botigues associades, sense anuncis).  
  *Nota: L'arquitectura es deixarà preparada per a futur model Freemium, desacoblant la base de dades per a alertes SMS/Push i prediccions exteses a 14 dies.*

### Bloc 5: Intel·ligència Artificial
- [X] **P5.1:** Paper de la IA a l'app (xatbot interactiu meteorològic, recomanador segons nivell i esport, notificacions predictives).  
  *Nota: Formulada per José María / equip. La IA actuarà com a «coctelera» creuant dades de boies en temps real, AEMET i models, més un xatbot entrenat com a «expert local a peu de platja».*

---

## 👥 Registre de Preguntes dels Altres Alumnes
*(Resum de les intervencions dels companys durant la sessió per a coordinar la informació)*

1. **Cristian (Rutines d'accés i fonts d'informació):**  
   *Pregunta:* Quina rutina segueix el client abans d'anar al mar i quines webs consulta?  
   *Resposta de Quique:* Consulta principalment Windguru per al vent al seu spot habitual (Piles). Si vol contrastar, obri Windy o WindFinder. A més, 1 o 2 hores abans d'entrar a l'aigua comprova les càmeres web de la Generalitat Valenciana i de la web Oceania per a verificar visualment la platja.

2. **José María (Ús actual de la IA vs. visió de futur):**  
   *Pregunta:* Quin ús fan actualment de la IA i com voldrien que s'aplicara?  
   *Resposta de Quique:* Actualment no usen cap IA; es basen únicament en la seua intuïció i l'experiència llegint taules de previsions. Volen que l'aplicació faça un «ús intensiu de la IA»: una mena de coctelera que agafe dades de boies en temps real (vents, ones, marees) i models predictius i calcule una probabilitat molt més fiable i directa.

3. **Mónica (Delimitació de costes i spots prioritaris):**  
   *Pregunta:* Quines platges o zones costaneres concretes de la Comunitat Valenciana són imprescindibles per al llançament?  
   *Resposta de Quique:* Per a no dispersar el projecte, s'ha de centrar exclusivament en **tres spots estratègics**:  
   - **Spot 1 — La Safor:** Piles (club Dunes Kite Piles) i Gandia (Gandia Surf / platja nord).  
   - **Spot 2 — Marina Alta / Dénia:** Port de Dénia i zona de Les Marines.  
   - **Spot 3 — Marina Baixa:** Costa de Calp / Altea.

4. **Bruno (Recomanador de viabilitat per esport):**  
   *Pregunta:* L'aplicació ha de recomanar quins esports són més convenients segons l'estat del mar?  
   *Resposta de Quique:* Sí, absolutament. Va ensenyar a la càmera un esbós en paper amb un disseny mòbil amb tres cercles gràfics (quesitos) indicant percentatges: p. ex., **75% Nadar**, **50% Vela lleugera**, **25% Kitesurf/Windsurf**. Va recalcar que nadar necessita mar plat, poc vent i sense corrents, mentre que el kite necessita mínim 12-15 nusos.

5. **Antoni / Altres companys (Comunitat i aspectes legals):**  
   *Pregunta:* Es preveu interacció social i avisos de responsabilitat per mal temps?  
   *Resposta de Quique:* Es valora molt positivament poder indicar quanta gent hi ha al spot (funció check-in/afluència). Quant a la part legal, és imprescindible un bon avís legal (*disclaimer*) deixant clar que les previsions d'IA són estimacions i la responsabilitat d'entrar al mar és del navegant.

---

## 🎙️ Respostes del Client / Idees Clau
*(Apunts estructurats de les declaracions i necessitats del client Quique Savall)*

* **Sobre el perfil d'usuari i model de negoci:**
  * **Públic heterogeni:** Esportistes de vent (kitesurf, windsurf, wingfoil), navegants de vela lleugera, i un gran nínxol emergent: **nadadors d'aigües obertes** i practicants de Paddle Surf / Caiac que busquen condicions oposades (mar en calma absoluta).
  * **Clubes impulsors:** Dunes Kite Piles (playa de Piles) i Gandia Surf (Gandia).
  * **Monetització escalable:** Accés inicial obert amb registre bàsic gratuït per a guanyar massa crítica d'usuaris. Futura activació de subscripció *Premium* (alertes personals, 14 dies de previsió) i targetes de botigues locals associades (lloguer de taules, cursos d'iniciació).

* **Sobre la informació meteorològica i marítima:**
  * **Mesures en temps real vs. models:** Combinar la lectura de boies de Puertos del Estado i estacions d'AEMET amb models globals (GFS, ECMWF, ICON).
  * **Variables imprescindibles:** Velocitat del vent (nusos), direcció cardinal, ratxes màximes, altura significativa d'ona (metres), període d'ona (segons, clau per a saber si l'ona té força o és mar picat), temperatura de l'aigua i estat de marees/corrents.
  * **Ventanes temporals clau:** Predicció d'alta resolució en trams de **4 hores, 8 hores i 24 hores**, acompanyada d'una vista resum a 5-7 dies.

* **Sobre el disseny, UI i navegació:**
  * **Mobile-First absolut:** L'app s'usarà a peu de platja i al cotxe abans de baixar el material.
  * **Minimalisme visual extrem:** Descartar les taules interminables de xifres. La informació s'ha de captar en 3 segons mitjançant gràfics de sectors («quesitos»), barres de progrés i codis de color.
  * **Semàfor intuïtiu de condicions:** Verd (apte i segur), Groc (precaució / nivell mitjà-alt), Roig (desfavorable o perillós).
  * **Alt contrast i conmutador clar/fosc:** Garantir la visibilitat directa sota el sol estiuenc de la platja.

* **Sobre càmeres web i verificació visual:**
  * Integració de les càmeres oficials de la **Generalitat Valenciana** i de la xarxa **Oceania** (spots de Gandia, Calp, etc.) directament en la pestanya del spot seleccionat per a contrastar el número amb la imatge real de l'arena i les ones.

* **Sobre el paper de la Intel·ligència Artificial (IA):**
  * **Algorisme «Coctelera»:** Ponderació creuada de múltiples fonts per a calcular l'índex percentual de viabilitat (0 a 100%) per a cada esport.
  * **Chatbot Assistent Local a peu de platja:** Un bot conversacional que actua com a expert veterà de la zona que resol qüestions com: *"Com entrarà el Garbí a Piles aquesta vesprada?", "Quina bandera hi ha a Gandia?", "És bon moment per a creuar nedant a la Marineta Cassiana?"*.

---

## 📋 Calaix de Requisits per al Reto 1C (Extracció Directa)
*Classificació consolidada i traslladada al Document Formal d'Especificacions (`PIM/requisitos.md`):*

### 1. Requisits Funcionals (El que l'app ha de fer)
- **RF-01:** Catàleg i selector interactiu de spots costers (La Safor: Piles/Gandia, Dénia: Marines/Port, Marina Baixa: Calp/Altea).
- **RF-02:** Monitoratge de vent (velocitat mitjana en nusos/km/h, direcció amb fletxes i ratxes màximes).
- **RF-03:** Monitoratge d'onatge i mar de fons (altura d'ona en metres, període en segons i swell).
- **RF-04:** Variables ambientals (temperatura de l'aigua i aire, pluja, radiació UV via AEMET).
- **RF-05:** Previsions horàries en finestres estratègiques de 4h, 8h i 24h.
- **RF-06:** Visualització de webcams oficials en viu (Generalitat Valenciana i Oceania).
- **RF-07:** Conmutació ràpida en un clic entre mètriques meteorològiques i feed de càmera en directe.
- **RF-08:** Motor IA «coctelera» amb càlcul del percentatge de viabilitat (0% a 100%) per esport.
- **RF-09:** Chatbot interactiu amb rol d'«expert local a peu de platja» alimentat amb context en temps real.
- **RF-10:** Filtre per disciplina esportiva (Kite, Windsurf, Wingfoil, Vela lleugera, Surf, Aigües obertes).
- **RF-11:** Alertes predictives automàtiques de seguretat (girs sobtats de vent tèrmic, mar picada perillosa).
- **RF-12:** Sistema d'autenticació i gestió de comptes d'usuari (CRUD en base de dades).
- **RF-13:** Marcatge i consulta prioritària de spots favorits.
- **RF-14:** Indicador social d'afluència de deportistes al spot (check-in voluntari).
- **RF-15:** Espai de promoció d'escoles i botigues nàutiques associades (Dunes Kite, Gandia Surf).
- **RF-16:** Arquitectura modular preparada per a subscripcions Freemium / Premium.

### 2. Requisits Visuals i de Disseny (Aspecte, UI/UX)
- **RV-01:** Disseny concebut exclusivament com a *Mobile-First* amb grans àrees tàctils.
- **RV-02:** Interfície sintètica basada en gràfics de quesito, barres cromàtiques i velocímetres, sense taules numèriques denses.
- **RV-03:** Tipografia marcada i alt contrast (nivell AAA WCAG) per a visibilitat directa sota la radiació solar a la platja.
- **RV-04:** Conmutador accessible de Mode Clar / Mode Fosc (*Dark/Light Mode*).
- **RV-05:** Codi de color de semàfor universal (Verd / Groc / Roig).
- **RV-06:** Paleta corporativa inspirada en el medi marí (blaus marins, cian, blanc) amb accents energètics (rojos i taronges).

### 3. Requisits Tècnics i d'Arquitectura (RT)
- **RT-01:** Arquitectura Progressive Web App (PWA) instal·lable, desenvolupada amb el stack oficial de 2n DAW (PHP 8 POO per a backend DWES, MySQL/MariaDB, HTML5/CSS3/JS natiu per a DIW/DWEC, contenidors Docker Compose i manifestos Kubernetes per a DaW).
- **RT-02:** Consum d'APIs obertes sense cost: Puertos del Estado (boies), AEMET OpenData, Open-Meteo Marine i webcams institucionals GVA.
- **RT-03:** Resiliència i memòria cau (*Service Worker* + *localStorage*) per a funcionar sense cobertura mòbil en espigons i platges aïllades.
- **RT-04:** Càrrega ultra-ràpida (<1,5 s en xarxes 4G) i càrrega diferida (*lazy loading*) de feeds de vídeo/imatges de càmeres.
- **RT-05:** Connexió desacoblada amb el servei de processament d'Intel·ligència Artificial (Google Gemini API).

### 4. Requisits Legals i de Seguretat (RL)
- **RL-01:** Descàrrec de responsabilitat obligatori (*disclaimer* nàutic): avís explícit que les previsions d'IA són merament orientatives i la responsabilitat civil de la navegació recau en l'esportista.
- **RL-02:** Compliment estricte del RGPD i LOPDGDD (consentiment exprés, drets ARCO, hashing de contrasenyes amb BCRYPT/Argon2).
- **RL-03:** Banner de política de cookies i emmagatzematge local segons directrius de l'AEPD.

---

## 🎙️ Transcripció Literal Completa de la Sessió (00:00 - 69:35)
> **Font:** Àudio original de la sessió de Teams (69 min 38 s) transcrit amb Whisper (CUDA).

**[00:00 - 00:16]** Me presenté en este caso Quique Savall a un club de kitesurf que tenia así en la playa de Piles, con el show Piles que está al costado de Oliva, un club que es de Dunes Kite Piles.

**[00:16 - 00:41]** Ja fa aquest practic de pornàutics, vela, kitesurf, i un dia parlant d'una treta que també té un club así en Gandia, Gandia Surf, està en mirant que un dia en el tema dels aigües i totes les xocs, a veure si foren capaços de crear una aplicació que mos diguerà la predicció.

**[00:41 - 00:55]** Això, per exemple, a Puerta i a Nisflas, per exemple, pues no sé, 4 hores, 8 hores, 24 hores, de quina probabilitat n'hauria de practicar de pornàutics.

**[00:55 - 01:07]** Obri 46, totes les fictícies, el que estic amb les dues. És el play i intentaré personalitzar les mateixes detalls que vulguis.

**[01:08 - 01:23]** Bueno, se'ns va a ocurrir que a banda de pornàutics, com serien de Ben, de Vela, Kitesurf, Winsurf, també n'hi ha cada vegada més comunitats de n'ha de dos que n'ha de n'ha de n'ha de volar.

**[01:23 - 01:33]** També volien pensar que n'hi havia un nicho de mercat entre gent que n'ha de nada i gent que practica de pornàutics.

**[01:34 - 01:51]** La idea seria fer una aplicació web mes enfocada per la mòbil que mostrarà datos interreal de bolles o de datos marítis meteorològics, que n'han datos en obert,

**[01:51 - 01:57]** i que també n'estan alguna tècnica cridada a la lla, que mos donara una predicció.

**[01:58 - 02:05]** Por res, este más sí, pero que me feu preguntes y con ese mes de quién es el propósit y quién es el de la repisi.

**[02:05 - 02:11]** Si voleu demà fer un turno de preguntes, suposo que tot se ho prepara més o menos un cuestionari,

**[02:11 - 02:16]** a mi me'n faré una pregunta a l'uno o una ronda.

**[02:16 - 02:20]** Valgo algo sin asintín primera a Cristian?

**[02:20 - 02:24]** Si vols ser tu una primera pregunta.

**[02:24 - 02:34]** Jo estructurat un poc l'entrevista i primer parlaré del context general.

**[02:34 - 02:45]** Volia saber quins són les rutines que feu de cara a organitzar i si desalmar.

**[02:45 - 02:51]** Una rutina seguiu que vulgui jugar, ajudar.

**[02:51 - 02:58]** Normalment, quan tinc les botes i, per exemple,

**[02:58 - 03:01]** vull fer l'any amb les botes i demà puc anar a l'edat.

**[03:01 - 03:05]** Lo primer que faig és entrar a pàgines de predicció d'event,

**[03:05 - 03:08]** sobretot de base en dos o tres.

**[03:08 - 03:13]** Una és WinGuru, persona d'event, WinGuru.

**[03:13 - 03:17]** I ahir en WinGuru poden buscar, per exemple,

**[03:17 - 03:22]** l'espot on jo navegue, que és Piles.

**[03:22 - 03:25]** I ahir m'he donat una predicció més o menys fiable

**[03:25 - 03:29]** de lo que seria la predicció d'event, l'H,

**[03:29 - 03:32]** i també, si m'aprova la voluntat, la lucha.

**[03:32 - 03:35]** Després contrasten altres que es poden ser

**[03:35 - 03:40]** WinGuru i WinFinder o WinV.

**[03:40 - 03:44]** Totes els enllaços jo després puc crear un document i passar-los,

**[03:44 - 03:46]** que seria jo el que mire.

**[03:46 - 03:49]** I després també, si és una, per exemple,

**[03:49 - 03:52]** ara m'he posat, si vaig a navegar en una o dues,

**[03:52 - 03:55]** també miraria les webcams.

**[03:55 - 03:58]** Hi ha webcams disponibles.

**[03:58 - 04:01]** Si busqués webcams de la Generalitat Valenciana,

**[04:01 - 04:05]** doncs ahir entraré prou.

**[04:05 - 04:08]** I també n'hi ha una altra web, que es diu Oceania,

**[04:08 - 04:12]** que també té càmeres d'alguns d'espots

**[04:12 - 04:15]** que puguin ser calcs.

**[04:15 - 04:18]** I també em pensé que t'ho hi era, també.

**[04:18 - 04:22]** També se dio una forma de borrelló, lo que m'hi he.

**[04:22 - 04:25]** Vale?

**[04:25 - 04:28]** Si voleu, passem a la pregunta,

**[04:28 - 04:30]** si n'hi ha un despregunte.

**[04:30 - 04:32]** Puc entendre un moment? Perdona.

**[04:32 - 04:35]** Perdona, és que jo tinc ganes de treballar en un moment

**[04:35 - 04:37]** que jo haig de veure una pregunta.

**[04:37 - 04:39]** Ah, valis tu.

**[04:39 - 04:41]** Te dones, te dones.

**[04:41 - 04:45]** Torna tu, que eres, que no he vist el nom.

**[04:45 - 04:47]** Sí, José Mario, tu.

**[04:47 - 04:50]** José María, te dones, torna tu.

**[04:50 - 04:52]** Perdona, em pregunto la dinàmica.

**[04:52 - 04:54]** Sí, pero es que tinc un poc de prensa.

**[04:54 - 04:56]** Que valis la dinàmica.

**[04:56 - 04:58]** Que tinc que fer una pregunta, ara.

**[04:58 - 05:00]** Sí.

**[05:00 - 05:02]** Vale.

**[05:02 - 05:05]** Yo también que tengo un poc de estructura con Cristian.

**[05:05 - 05:08]** Entonces, con escritinitas, te voy a perdonar.

**[05:08 - 05:11]** Normalmente, con qué tipo de aplicaciones

**[05:11 - 05:14]** relacionadas a estos ámbitos trabajáis como persona,

**[05:14 - 05:18]** y eso, más o menos, lo responde.

**[05:18 - 05:20]** Sí, exacte.

**[05:20 - 05:26]** Y el uso que le dais a la IA

**[05:26 - 05:30]** es más informativo o más para conocer el estado actual?

**[05:30 - 05:32]** De momento no le damos ningún uso.

**[05:32 - 05:34]** Por eso nos gustaría hacer una aplicación

**[05:34 - 05:37]** que tiene ese uso intensivo de la IA.

**[05:37 - 05:41]** De momento nos basamos en nuestra intuición

**[05:41 - 05:43]** y en los datos que nos da la aplicación

**[05:43 - 05:45]** respecto a convicciones.

**[05:45 - 05:47]** Vale.

**[05:47 - 05:49]** Pero si todo esto lo pudiésemos,

**[05:49 - 05:51]** no sé, coger en una contelera

**[05:51 - 05:53]** todos los datos que nos da esas páginas web.

**[05:53 - 05:56]** Más también pensar que hay muchas voyas públicas

**[05:56 - 05:59]** que nos dan...

**[05:59 - 06:02]** O sea, las que os he dicho antes son predicciones,

**[06:02 - 06:04]** pero también hay datos en real.

**[06:04 - 06:07]** De estaciones meteorolóficas, de viento, leace,

**[06:07 - 06:09]** areas.

**[06:09 - 06:11]** Si todo eso se ponera una contelera

**[06:11 - 06:13]** y entregar a una IA

**[06:13 - 06:15]** perquè no hi hagi una predicción más fiable,

**[06:15 - 06:18]** estaría muy guai.

**[06:18 - 06:20]** Jo entenc que les previsions que donen allà

**[06:20 - 06:24]** és en base a les dades actuals en temps real.

**[06:24 - 06:27]** El que?

**[06:27 - 06:29]** Que les previsions que has mencionat,

**[06:29 - 06:31]** bien, en base a les dades reals actuals.

**[06:31 - 06:34]** Busquen les dades de mi,

**[06:34 - 06:36]** i al millor és per preveir

**[06:36 - 06:38]** lo que va a fer a la VESPERA o demás.

**[06:38 - 06:40]** No entenc.

**[06:40 - 06:43]** Si voleu vosaltres compartir un moment la pantalla,

**[06:43 - 06:46]** i si me veu el que seria Wendy,

**[06:46 - 06:49]** veu la pantalla?

**[06:49 - 06:52]** Sí.

**[06:52 - 07:02]** Si jo entre la pàtida de Guimburú,

**[07:02 - 07:07]** bueno, ja sí per deixar que ja tingui el esport

**[07:07 - 07:09]** que ells sol gastar.

**[07:09 - 07:11]** Però si en busca de esport,

**[07:11 - 07:15]** jo puc buscar piles,

**[07:15 - 07:17]** i m'apareix dos coses.

**[07:17 - 07:20]** Una veu que és això, una veleta,

**[07:20 - 07:22]** i una de les gansa és que,

**[07:22 - 07:25]** una veleta és la predicció.

**[07:25 - 07:28]** Això són models predictives,

**[07:28 - 07:30]** que no sé què sé.

**[07:30 - 07:43]** Per exemple, això seria el dimentre,

**[07:43 - 07:46]** la LES-14, el SEDG,

**[07:46 - 07:48]** el Sliwit, el Svint,

**[07:48 - 07:51]** i n'hi ha diversos models predictives.

**[07:51 - 07:53]** Però bueno,

**[07:53 - 07:55]** realment aquí hi ha ells que ho entren,

**[07:55 - 07:57]** aghòbamos a la LES-14,

**[07:57 - 07:59]** el SEDG, el Sliwit, el Svint,

**[07:59 - 08:02]** i que ens plenarà la interpretació.

**[08:02 - 08:05]** Bueno, el que us diria així, en WinGuru,

**[08:05 - 08:10]** jo puc veure el que seria les prediccions

**[08:10 - 08:18]** o el que seria el ten real.

**[08:18 - 08:22]** Això seria interreal la medició que està feme de vent.

**[08:22 - 08:26]** Ara mateixa, el digo interreal,

**[08:26 - 08:35]** n'hi ha 5.1 mux de noreste.

**[08:35 - 08:39]** Això seria datos interreal.

**[08:39 - 08:41]** Jo estic mirant per aquesta plataforma

**[08:41 - 08:43]** i n'hi ha una partada que podria poder,

**[08:43 - 08:47]** incluso, passar-los els arxius diaris estadístiques

**[08:47 - 08:51]** i tot això, en format ocesiu.

**[08:51 - 08:55]** Seria una de les fonts que podria gastar.

**[08:55 - 08:58]** Però n'hi ha n'hi ha n'hi ha webs on podria ser windy,

**[08:58 - 09:11]** també depenent dels spots.

**[09:11 - 09:13]** Ara estàs més visual,

**[09:13 - 09:16]** però també té una partada que podria gastar.

**[09:16 - 09:21]** Datos interreal.

**[09:21 - 09:24]** Això seria el quant de vent,

**[09:24 - 09:27]** que és el que jo me marca

**[09:27 - 09:30]** per al deport de les nenes.

**[09:30 - 09:32]** Suposo que per a dalt,

**[09:32 - 09:35]** a la meva influirà més les corrents

**[09:35 - 09:38]** i també el loliatge.

**[09:38 - 09:42]** Això també vull que la ia

**[09:42 - 09:45]** no t'ac…?

**[09:45 - 09:51]** ¿Sabe a la posició de l'estil de l'estil?

**[09:51 - 09:54]** ¿Ve a la posició de l'estil?

**[09:54 - 09:59]** ¿Ve a la posició de l'estil?

**[09:59 - 10:04]** Se senten molt mal,

**[10:04 - 10:15]** i se senten molt malament.

**[10:15 - 10:34]** La pregunta és si la podem escoltar.

**[10:34 - 10:37]** No sé si he entès...

**[10:37 - 10:51]** Si no, pides la informaci

**[10:51 - 10:56]** La información concreta que me gustaría ver en la aplicación.

**[10:58 - 11:02]** ¿Qué es eso?

**[11:02 - 11:04]** Que lo escriban en el chat.

**[11:04 - 11:09]** Escríbenlo en el chat y mientras voy pasando el turno a Bruno.

**[11:09 - 11:11]** Escríbenlo en el chat, Mónica.

**[11:11 - 11:13]** Ya lo he escrito, ya lo he escrito.

**[11:13 - 11:14]** Ah, ja està.

**[11:14 - 11:16]** A mi me puede dar la pregunta.

**[11:16 - 11:19]** ¿Qué playas o zonas concretas de la costa de Valencia

**[11:19 - 11:22]** queréis poner sí o sí cuando lancemos la...

**[11:22 - 11:30]** ¿Cómo la aplicación podría ser muy amplia?

**[11:30 - 11:35]** Sólo la vamos a definir para tres spots, ¿vale?

**[11:35 - 11:40]** Uno que sería la SAFOR, que sería como Piles Grandia,

**[11:40 - 11:46]** que vais a encontrar bastante información de Piles y Grandia en concreto.

**[11:46 - 11:50]** Eso sería el spot del SAFOR, ¿vale?

**[11:50 - 11:55]** Luego, otro spot sería Denia, que abarcaría el puerto,

**[11:55 - 12:03]** y Denia Marines, ¿vale?

**[12:03 - 12:06]** Y el tercer spot sería Calte Altea,

**[12:06 - 12:13]** que es un poco más hacia abajo en la costa blanca.

**[12:13 - 12:17]** Entonces, en principio solo tres spots.

**[12:17 - 12:21]** Tres spots que, por ejemplo, el usuario cuando entra

**[12:21 - 12:24]** selecciona uno de estos tres y toda la información

**[12:24 - 12:28]** aparecen relativa al spot que has seleccionado.

**[12:28 - 12:32]** Ya sea las predicciones, las webcams

**[12:32 - 12:34]** y la información en tiempo real del...

**[12:34 - 12:37]** Lo primero que tendrá el usuario es la selección del spot.

**[12:37 - 12:39]** Así lo hace.

**[12:39 - 12:41]** Si en el futuro veamos que la aplicación va bien,

**[12:41 - 12:43]** pues ya se puede meter más spots.

**[12:43 - 12:45]** Vale.

**[12:45 - 12:47]** ¿En una comprobación se escucha un poco mejor?

**[12:47 - 12:49]** Mucho mejor.

**[12:49 - 12:51]** Es que cambia el microteñal de la cámara,

**[12:51 - 12:53]** a veces vale, gracias.

**[12:53 - 12:57]** Vale.

**[12:57 - 12:59]** Pasamos a Bruno.

**[12:59 - 13:01]** Vale, hola.

**[13:01 - 13:03]** Mi pregunta.

**[13:03 - 13:05]** ¿Quieres que la aplicación recomiende qué deportes acuáticos

**[13:05 - 13:09]** son más adecuados según las condiciones meteorológicas y marítimas?

**[13:09 - 13:14]** A ver, yo lo que había pensado

**[13:14 - 13:17]** es que cuando yo estaba antes

**[13:17 - 13:20]** ganaba de ando más o menos.

**[13:20 - 13:23]** Esto era una foto y lo pasaré.

**[13:23 - 13:25]** Se ve muy bien.

**[13:25 - 13:28]** No, la cámara lo tapa.

**[13:28 - 13:30]** O el cuando de atrás.

**[13:30 - 13:32]** Sí, voy a quitar el desenfoque.

**[13:32 - 13:53]** Vale, no sé si se ve muy bien.

**[13:53 - 13:56]** Vale, luego esto lo pasaré.

**[13:56 - 13:58]** No hagas caso lo que pone aquí.

**[13:58 - 14:02]** Esto imaginaos que esto es como un móvil alargado hacia abajo.

**[14:02 - 14:04]** Yo creo que había pensado que cuando tú entres

**[14:04 - 14:06]** y selecciones el spot,

**[14:06 - 14:09]** que te salga como tres circulitos gráficos

**[14:09 - 14:11]** y te diga la probabilidad, por ejemplo,

**[14:11 - 14:14]** de lo que sería, por ejemplo, aquí he puesto,

**[14:14 - 14:16]** un 75% nadar,

**[14:16 - 14:18]** un 50%

**[14:18 - 14:20]** ve la ligera

**[14:20 - 14:22]** y un 25%

**[14:22 - 14:24]** eh...

**[14:24 - 14:26]** ¿Vale?

**[14:26 - 14:28]** Deportes con mocaisur

**[14:28 - 14:30]** y windsurf que necesitan más viento.

**[14:30 - 14:32]** ¿Vale?

**[14:32 - 14:34]** Pensad que para nadar normalmente necesitamos

**[14:34 - 14:36]** poco viento, poco leazo

**[14:36 - 14:38]** y poca corriente


**[14:37 - 14:43]** para barco el ligero nos importa un poquito si está mareado,

**[14:43 - 14:46]** pero sobre todo que hay algo de viento.

**[14:46 - 14:49]** Pero con poco viento ya se pueden alobar.

**[14:49 - 14:51]** Y sin embargo el deporte de velar, como Windsor,

**[14:51 - 14:55]** no nos importa tanto las corrientes de lo leaje,

**[14:55 - 14:58]** pero si que nos importa que haya bastante viento,

**[14:58 - 15:02]** así como el de la ligera con poco viento puede decir en kaisur y...

**[15:02 - 15:06]** Pero bueno, eso sí luego lo preguntáis a la ya, os dirá más o menos las condiciones.

**[15:06 - 15:08]** Pero la idea sería esta, vale.

**[15:08 - 15:13]** Tus selecciones en el spot y nos da porcentajes de lo que él diría que puedes hacer

**[15:13 - 15:15]** en estos deportes.

**[15:15 - 15:17]** Vale.

**[15:17 - 15:20]** Luego más abajo puedes poner información en tiempo.

**[15:20 - 15:25]** Esto sería predicción, esto sería tiempo real y luego también se puede poner hueca,

**[15:25 - 15:26]** o fosillas, vale.

**[15:26 - 15:32]** Pero también más cosas y vamos viendo que más podría mostrar por la anticipada.

**[15:32 - 15:34]** Vale.

**[15:34 - 15:37]** Christian Arce, estás por ahí?

**[15:37 - 15:39]** Sí, sí, se me escucha, buenas tardes.

**[15:39 - 15:41]** Buenas tardes.

**[15:41 - 15:45]** Vale, me preguntaba más un poco más por la idea.

**[15:45 - 15:49]** Exactamente que es lo que esperaste la idea, por tal experiencia en los usuarios.

**[15:49 - 15:52]** Pero en el tema de la idea es algo como un resumen en el buen aclado,

**[15:52 - 15:55]** alguna recomendación o un chate de la pregunta.

**[15:55 - 16:02]** Pero lo pique los que a la hora de elaborar esos porcentajes,

**[16:02 - 16:10]** que la idea se acaba de haciendo un mix de toda la información que le paseis de tiempo real

**[16:10 - 16:14]** y de modelos positivos que tiene un número del cero al cien.

**[16:14 - 16:20]** Entonces, la idea al final tiene que dar unas predicciones, vale.

**[16:20 - 16:24]** Tiene que dar una predicción del cero y en la probabilidad de hacer deporte

**[16:24 - 16:29]** y luego también cuatro parámetros, vale.

**[16:29 - 16:37]** Es el el viento o le hace corriente y temperatura del agua.

**[16:37 - 16:40]** Y también estas cuatro predicciones.

**[16:40 - 16:43]** Bien, ahí va a ser como nuestra bola de cristal.

**[16:43 - 16:48]** Y el todo le hace corriente y temperatura del agua.

**[16:48 - 16:54]** Estas cuatro cubrimos un montón de deportes, ¿no?

**[16:54 - 16:55]** Con estas cuatro.

**[16:55 - 16:56]** Sí.

**[16:56 - 16:59]** Yo lo pongo aquí, pues, circulito con el porcentaje,

**[16:59 - 17:03]** luego al ladito que pusiese la predicción del viento, tal.

**[17:03 - 17:06]** Yo he pensado la aplicación que tu cuando entras, seleccionas el esport.

**[17:06 - 17:13]** Pero luego también la predicción que pueda seleccionar si es a cuatro, ocho o veinticuatro horas.

**[17:13 - 17:16]** Y dependiendo de eso, pues, la idea.

**[17:16 - 17:18]** Vale.

**[17:18 - 17:19]** ¿Dónde?

**[17:19 - 17:20]** Pondiendo el cristiano.

**[17:20 - 17:22]** ¿Qué es lo que va a hacer la idea?

**[17:22 - 17:24]** Sacar esas predicciones.

**[17:24 - 17:27]** Vale, yo no me fio de las predicciones que dan las otras páginas.

**[17:27 - 17:34]** Quiero que la idea hago mix con los datos que vosotros podáis buscar en tiempo real y de predicciones.

**[17:34 - 17:35]** ¿Qué es?

**[17:35 - 17:36]** ¿Qué des los hijos?

**[17:36 - 17:37]** Y luego.

**[17:37 - 17:41]** Es que las deja me cavar y luego te doy voz.

**[17:41 - 17:46]** Y luego otra experiencia de usuario que me gustaría incorporar.

**[17:46 - 17:48]** Sería un chatbot.

**[17:48 - 17:50]** Vale.

**[17:50 - 17:54]** Esa parte también es enriquecería las criaciones del usuario.

**[17:54 - 17:56]** El chatbot.

**[17:56 - 17:59]** Yo puedo hacerle más preguntas.

**[17:59 - 18:01]** Vale.

**[18:02 - 18:05]** Lo que tendremos que hacer es el chatbot.

**[18:05 - 18:11]** Entrenarlo como si fuera un experto en cortes náuticos o incluso también.

**[18:11 - 18:13]** De podemos dar.

**[18:13 - 18:19]** Más información y nutrirle de temas de salvamento marítimo o de socorrísmo.

**[18:19 - 18:21]** Y que le podamos preguntar.

**[18:21 - 18:26]** Temos si fuera alguien experto a pied de playa que yo le puedo decir oye.

**[18:27 - 18:31]** Y como ves la mareja o si me pasa esto a quien podría llamar.

**[18:31 - 18:35]** Vale, Cristian.

**[18:35 - 18:37]** Querías alguna cosa más.

**[18:37 - 18:38]** Sí.

**[18:38 - 18:43]** ¿Cómo te gustaría que se me ofrece como siempre que la recomendación que genera la idea,

**[18:43 - 18:46]** pues se puede estar equivocando?

**[18:46 - 18:50]** Hay que poner un disclaimer obviamente.

**[18:50 - 18:53]** Lo más diable va a ser que siempre es tiempo real.

**[18:53 - 18:55]** Pero vamos a jugar un poco.

**[18:56 - 18:58]** Ya ves si la dia.

**[18:58 - 18:59]** Vale.

**[18:59 - 19:01]** Podremos haber mejor una apartada en la web.

**[19:01 - 19:02]** Sería.

**[19:02 - 19:05]** No sé, comentarios sobre la aplicación mejoras.

**[19:05 - 19:07]** Si también la.

**[19:07 - 19:12]** La gente puede interactuar y decir si han fallado o si no ha fallado.

**[19:12 - 19:14]** Obviamente esto va a arrancar en beta.

**[19:14 - 19:20]** Vamos a ver si la idea es capaz de ayudarnos o por el consaglio a marear.

**[19:20 - 19:22]** Vale, una última cosa.

**[19:23 - 19:29]** Es su manera que sentimos por real, pero si queréis saber para el futuro con cuántos días

**[19:29 - 19:32]** ahora ante la acción, si quieres, se puede ver la previsión.

**[19:32 - 19:34]** A ver estas opciones.

**[19:34 - 19:37]** 4, 8 o 24 horas.

**[19:37 - 19:39]** Vale.

**[19:39 - 19:42]** Entonces tampoco es un modelo de predición a largo.

**[19:42 - 19:43]** Es muy corto.

**[19:43 - 19:48]** Va a ser lo que haya ahora y en una previsión de datos meteorológicos.

**[19:48 - 19:51]** Si no es un modelo de previsión de los que te dita lo mejor que un virus.

**[19:51 - 19:54]** Vamos a intentar atinar.

**[19:54 - 19:58]** Esas previsiones a 8 a 4 o 8 y 24.

**[19:58 - 20:02]** Vale.

**[20:02 - 20:04]** Antonio.

**[20:04 - 20:07]** Hola, bona vez por la incendidú.

**[20:07 - 20:09]** Sí, perfecte.

**[20:09 - 20:14]** Vale, vamos con pan, que les pedra un pequeño metrín adulto.

**[20:14 - 20:19]** Entonces, podrías preguntar que en cuanto a experiencia de luz barri.

**[20:19 - 20:25]** La verdad es que en su ahí podrías afectar espots.

**[20:25 - 20:27]** No, es al aplicativo.

**[20:27 - 20:32]** Y después, si veo que sería ver que la idea tendría ser a un tipo de adiante

**[20:32 - 20:36]** cuando ha habido alguna manera de seleccionar un espot favor preferir.

**[20:36 - 20:42]** Pero al irte que en ese momento es gran y per la fe de tu esponuh.

**[20:42 - 20:46]** Estamos bien teniendo preguntas sobre el usuario.

**[20:46 - 20:55]** El usuario que hablaba que el aplicación fuera para el usuario registrar.

**[20:55 - 21:05]** El funcionamiento de la aplicación es un pop-up, el que teities.

**[21:05 - 21:13]** El usuario va a ser la gratuita y ha disparado con un excepter atentador.

**[21:13 - 21:18]** de pago reducer lo que fue la predominant para tu y tal.

**[21:18 - 21:24]** Deica eso porque sigue siendo que tendrá un club para el gestión de usuarios.

**[21:24 - 21:26]** Esa es lo que es un club, no?

**[21:26 - 21:32]** O de tener un alto resistre de usuarios, borrarlo, policiarlo, tal.

**[21:32 - 21:34]** Respecte a estos spots.

**[21:34 - 21:36]** Respecte a estos spots.

**[21:36 - 21:39]** O pueden les apreparar en una base de lades.

**[21:39 - 21:42]** O sea que no siga piñón la aplicación que esté en este spot,

**[21:42 - 21:47]** sino que la aplicación o a la base de datos y en el futuro,

**[21:47 - 21:50]** pues ya intentan enferos caladones.

**[21:50 - 21:54]** Pero de momento, no siga una tabla o fiquen el nombre del spot,

**[21:54 - 21:55]** la ubicación,

**[21:55 - 21:58]** para un y os poder ficar tan de datos,

**[21:58 - 22:01]** no es nutris, la webcam,

**[22:01 - 22:03]** 4 recosetes de fixes,

**[22:03 - 22:06]** y es si nací el día de la voler manclarla,

**[22:06 - 22:08]** también faríem un club de spots.

**[22:08 - 22:10]** Pero de momento,

**[22:10 - 22:14]** limitar un poco que te les pongo de la aplicación,

**[22:14 - 22:16]** o faríem,

**[22:16 - 22:19]** pero tres spots.

**[22:19 - 22:21]** ¿Alguna pregunta de...

**[22:21 - 22:24]** Sí, lo ha tren, no había pensado,

**[22:24 - 22:27]** se pote incluir y después si donara temps,

**[22:27 - 22:31]** a lo mejor se podía hacer algún tipo de automatismo.

**[22:31 - 22:37]** Habrí para antes y no nos dará desde implementar todo lo que vos estés y de mamá.

**[22:37 - 22:40]** Ahora sí parlamos con maquite, profesor.

**[22:40 - 22:42]** No nos asusteu,

**[22:42 - 22:46]** pero después falen lo que podré,

**[22:46 - 22:48]** pero en la parte de especificación,

**[22:48 - 22:50]** si que volen,

**[22:50 - 22:52]** si no ha de majer otro real,

**[22:52 - 22:55]** después la fase de desarrollo,

**[22:55 - 22:58]** lo que ofrece.

**[22:58 - 22:59]** Pero bueno,

**[22:59 - 23:02]** tan que paréntesis contestan lo de ando a mí,

**[23:02 - 23:04]** siguen malgrados de software,

**[23:04 - 23:06]** que pudieran usuarios,

**[23:06 - 23:09]** habilitar alertas sobre un spot,

**[23:09 - 23:14]** y también,

**[23:14 - 23:15]** y también,

**[23:15 - 23:17]** ya tan deshablas.

**[23:17 - 23:20]** En el entro,

**[23:20 - 23:22]** el trans en el espoct,

**[23:22 - 23:25]** pues que estiguen viendo el mar de esos spots,

**[23:25 - 23:28]** y en el neto que están de perolochía y a mí,

**[23:28 - 23:29]** poder voler esta mala,

**[23:29 - 23:33]** o que siga una paca diferente en la aplicación

**[23:33 - 23:35]** que tú puedes hablar.

**[23:35 - 23:37]** Eso es conforme,

**[23:37 - 23:40]** conforme hubo una planta de llarme.

**[23:40 - 23:42]** Y es que en esto es una única,

**[23:42 - 23:44]** intento testar una cosa más de la etra,

**[23:44 - 23:46]** o pod Hospital de llarme una parte,

**[23:46 - 23:47]** sigues datos de real

**[23:47 - 23:49]** y webTams.

**[23:49 - 23:52]** Una cosa más de la etra.

**[23:52 - 23:54]** No existe,

**[23:54 - 23:55]** todo un memo cap,

**[23:55 - 23:58]** si voler aquí en el estilo,

**[23:58 - 24:00]** no sé si voy lomen a,

**[24:00 - 24:04]** pero el correo es que si les hueca,

**[24:04 - 24:06]** les poden buscar,

**[24:06 - 24:08]** si busca webTams eneralitada Valenciana,

**[24:08 - 24:10]** o web oce-naria,

**[24:10 - 24:26]** A qué momento sí.

**[24:26 - 24:31]** En cuanto a la ہو de general de la aplicación,

**[24:31 - 24:35]** he tenido algún manual de marca de grupos logotips que vuelven a utilizar

**[24:35 - 24:38]** o tiene que fer unos altres.

**[24:38 - 24:42]** Y yo poderé confiar unos altres?

**[24:42 - 24:49]** Si tenien una imàtica del club y de fet vaig demostrar-vos

**[24:49 - 24:54]** a retornar a compartir en pantalla.

**[24:54 - 25:37]** Atences va intentar fer un redesign de una patina buen morantiga

**[25:37 - 25:42]** que tenien que era del club de capíles.

**[25:42 - 25:47]** La soia estará en 2020.

**[25:48 - 25:53]** La patina va fer un redesign de la patina de la web.

**[25:53 - 26:14]** La patina va fer un redesign de la web.

**[26:14 - 26:25]** La patina va fer un redesign de la web.

**[26:26 - 26:31]** La patina va fer un redesign de la web.

**[26:31 - 26:37]** La patina va fer un redesign de la web.

**[26:37 - 26:42]** La patina no tenia la predicció.

**[26:43 - 26:51]** La patina va fer un redesign de la web.

**[26:51 - 26:58]** La patina va fer un redesign de la web.

**[26:58 - 27:05]** La patina va fer un redesign de la web.

**[27:05 - 27:09]** que sigui que volia que el que placa es feu un estudi de marpa.

**[27:09 - 27:12]** A mi me sabía que hubiera perdido algunos noms,

**[27:12 - 27:15]** que es ligue de a todos no sé, mirando al mar,

**[27:15 - 27:20]** o mirando al mar, o que sé, o que sé,

**[27:20 - 27:22]** o que sé, win, seekers, o muy gaud.

**[27:22 - 27:26]** Pero un estudi de conduz a la dignidad de explicar si pensan

**[27:26 - 27:29]** para que eres un público objetivo.

**[27:29 - 27:31]** Y sí que me agradaría, obviamente,

**[27:31 - 27:34]** comer una plat alginas dedicadas al mar,

**[27:34 - 27:37]** porque tingueira a todos los blaus,

**[27:37 - 27:39]** obviamente, todo lo que boca al mar,

**[27:39 - 27:41]** pero esté que es en blau.

**[27:41 - 27:43]** Pero también con boca después,

**[27:43 - 27:47]** que tingueira también algún color de acción que fuera més energético.

**[27:47 - 27:50]** Que tingueira a chorar, a chorar, a anja.

**[27:50 - 27:52]** Entonces, llueveu como un color primar,

**[27:52 - 27:55]** y tienes blau y tienes tranquil, como es la mar,

**[27:55 - 28:00]** pero también un color secundario de acento que siga més energético.

**[28:00 - 28:03]** Entonces, ahí también puede gastar la hía

**[28:03 - 28:08]** para que vos se duede a pejarle un nomba a esta aplicación.

**[28:08 - 28:13]** Habliz paréntesis, parla para ver cómo aquí qué.

**[28:13 - 28:18]** El repaso de este proyecto intermolular es que gasteuía a saco.

**[28:18 - 28:21]** Está todo.

**[28:21 - 28:24]** Para que vos proposa el nomba,

**[28:24 - 28:27]** para que vos proposa el nomba, para que vos proposa el nomba.

**[28:27 - 28:30]** Y no vas a penalizar o al revés.

**[28:30 - 28:33]** Y que gasteuía a pejar todo.

**[28:33 - 28:35]** Transpilarlo.

**[28:35 - 28:37]** Para que paréntesis.

**[28:37 - 28:42]** Vale, dese de compartir y torne a la...

**[28:42 - 28:46]** Vale, no he.

**[28:46 - 28:48]** Bueno, arriba el último.

**[28:48 - 28:51]** Tienes tres preguntes de les teft respostes.

**[28:51 - 28:53]** Les agresvencionar que es hora de gastar con un gru,

**[28:53 - 28:54]** y todo eso.

**[28:54 - 28:55]** Podemos verlo.

**[28:55 - 28:57]** Nosotros positivos, pero ni algo que ninguna tinga,

**[28:57 - 28:59]** que tiene de menos lo que vos sabrán,

**[28:59 - 29:01]** que tiene la vuestra aplicación.

**[29:01 - 29:05]** A lo que hace diferente es respecto a la competencia.

**[29:05 - 29:08]** A mi per ella, un gru,

**[29:08 - 29:10]** yo per te la conecte,

**[29:10 - 29:12]** pero ahora para interpretar las modelas,

**[29:12 - 29:15]** cuando entren, ni amo, o yo de información,

**[29:15 - 29:17]** yo lo que voy, que es algo midif,

**[29:17 - 29:19]** que yo cuando entre tres,

**[29:19 - 29:21]** y que me lleva,

**[29:21 - 29:23]** no l'han de presentar nada,

**[29:23 - 29:25]** 25 de tal y ya está.

**[29:25 - 29:28]** Entonces, voy que siga muy visual.

**[29:28 - 29:31]** El azonateixo, en parlano una pregunta,

**[29:31 - 29:33]** les dades que vos que has mostré,

**[29:33 - 29:34]** porque es un per nu,

**[29:34 - 29:35]** o periódia,

**[29:35 - 29:37]** de eso, o sea, más formular fixa lo que siga.

**[29:37 - 29:39]** Vos que siga técnico,

**[29:39 - 29:41]** pero expérsense en el Deporto

**[29:41 - 29:42]** o que siga més a nivel usual,

**[29:42 - 29:43]** que por suhor persona,

**[29:43 - 29:44]** puedo dejar regarla.

**[29:44 - 29:46]** Alguien que siga comencen a fer caer

**[29:46 - 29:47]** y todo lo que siga,

**[29:47 - 29:49]** que siga un nivel de entrada,

**[29:49 - 29:50]** es básicamente basic,

**[29:50 - 29:51]** y no está en técnica.

**[29:51 - 29:53]** Es básicamente basic.

**[29:53 - 29:55]** Yo, como entre,

**[29:55 - 29:57]** lo primero que va a ser duros

**[29:57 - 29:58]** por el gordo,

**[29:58 - 29:59]** es que el día de hoy,

**[29:59 - 30:00]** es así que es eso.

**[30:00 - 30:01]** Y después lo consta,

**[30:01 - 30:03]** sí que puedo pasar.

**[30:03 - 30:04]** Bien,

**[30:04 - 30:05]** ya os dije que,

**[30:05 - 30:09]** cuál se va al que practico un Deport de vent,

**[30:09 - 30:12]** en la que siga en lo bat,

**[30:12 - 30:15]** la unidad que va ser més nudos,

**[30:15 - 30:17]** y que es más o menos kilómetros esperada.

**[30:17 - 30:18]** Y que todo el entran,

**[30:18 - 30:19]** pero es un motor repetir,

**[30:19 - 30:21]** el valor es más simple,

**[30:21 - 30:23]** y no es que no es que va ser el vent,

**[30:23 - 30:24]** la manera al marchón,

**[30:24 - 30:27]** y que es más vent o le hazle,

**[30:27 - 30:29]** le hazle vent,

**[30:29 - 30:32]** vent y temperatura de laiva,

**[30:32 - 30:33]** y temperatura,

**[30:33 - 30:34]** mube.

**[30:34 - 30:37]** La temperatura afecta a nada 2,

**[30:37 - 30:40]** así que tenda un nivel a un insult noo,

**[30:40 - 30:42]** y no.

**[30:43 - 30:45]** ¿Entonces,

**[30:45 - 30:49]** unidad vent nudos o le hazle,

**[30:49 - 30:54]** así que normalmente fican metros o en centímetros,

**[30:54 - 30:56]** que sería la,

**[30:56 - 31:00]** el metros de té la ola,

**[31:00 - 31:02]** y después la corrente,

**[31:02 - 31:05]** normalmente fica la dirección de la cita,

**[31:05 - 31:07]** pero también se fican nudos,

**[31:07 - 31:09]** y temperatura de la oya,

**[31:09 - 31:11]** de la oya,

**[31:11 - 31:12]** a los beneficios,

**[31:12 - 31:13]** ¿vale?

**[31:13 - 31:14]** ¿De acuerdo?

**[31:14 - 31:15]** Vale, y contestan.

**[31:15 - 31:16]** Al alguna cosa tanés,

**[31:16 - 31:17]** que bueno,

**[31:17 - 31:21]** me preguntáis que es lo que volía que,

**[31:21 - 31:22]** por la diferenciador,

**[31:22 - 31:24]** pues primera gente ha hecho qualche entre,

**[31:24 - 31:25]** ¿porque le un vistazo,

**[31:25 - 31:27]** no tienes que ponerle allí historias,

**[31:27 - 31:29]** sino que,

**[31:29 - 31:31]** architectos, ¿vale?

**[31:31 - 31:33]** De ahí, pues tengo 1 de otra mança.

**[31:33 - 31:36]** Y después tindes también,

**[31:36 - 31:37]** en una traslerta,

**[31:37 - 31:45]** Ali Tet доп se ven y limit��,

**[31:45 - 31:54]** plus el document Intergarlooky.

**[31:54 - 31:58]** Lore, se va a el document Intergarlooky

**[31:58 - 32:01]** y lo va apfatear o es

**[32:01 - 32:05]** que se val, lo se les importa bajar,

**[32:05 - 32:07]** que es pot fer un resum,

**[32:07 - 32:09]** respecte a les datares que agafen.

**[32:09 - 32:12]** Però resum que pot fer el charbot són les matícies de datares

**[32:12 - 32:14]** que el mostre la campanya principal.

**[32:14 - 32:17]** Però què vol dir és que un resum de la ia

**[32:18 - 32:20]** que ja t'ho està mostrant en els gravis i les datares de la campanya?

**[32:20 - 32:22]** No vull que la ia mostre el resum.

**[32:22 - 32:24]** Vull que em fa una finestra

**[32:25 - 32:28]** en què jo puga preguntar-les la ia coses diferents.

**[32:28 - 32:30]** Jo ho avia més.

**[32:30 - 32:32]** Jo ho avia més.

**[32:32 - 32:35]** I més o més, la campanya no està mostrant.

**[32:35 - 32:39]** Tres espals i entre esmenys.

**[32:39 - 32:40]** 4.

**[32:40 - 32:43]** Jo el mireu a la ia i jo puc preguntar.

**[32:43 - 32:45]** I quina predicció me donaria a 48 a uns?

**[32:46 - 32:51]** Jo penso que encara que no hi ha 25% podria anar al

**[32:51 - 32:54]** i si me pasaran alguna cosa, aquí un teléfono podría pudrir.

**[32:54 - 32:57]** A tots l'aïa, com és més amplia que el que no has fet,

**[32:57 - 32:59]** puc interactuar molt més.

**[32:59 - 33:02]** La ia, la ia, la ia, la ia, la ia, la ia.

**[33:02 - 33:05]** La ia, la ia, la ia, la ia, la ia, la ia.

**[33:05 - 33:08]** La ia, la ia, la ia, la ia, la ia, la ia, la ia.

**[33:09 - 33:12]** I bueno, la ia tan de la gasteupa

**[33:12 - 33:16]** perquè us donéssos paràmetros de los 85, 25, 50.

**[33:16 - 33:18]** Sí, que mejor ha de ser unes 20.

**[33:19 - 33:21]** Això és un any, un poc més conduida,

**[33:22 - 33:25]** que és perquè us donés uns datos con creix.

**[33:25 - 33:28]** És un poc de paràmetros i de presentatge.

**[33:28 - 33:38]** El problema de la red es una iaberta que agrena un modelo de model que pugamos atrozar un clío con un context.

**[33:38 - 33:46]** El problema de la red es la de la red.

**[33:46 - 33:52]** Cristiano? Sí, en clase vas comentar la idea de monetizarla.

**[33:53 - 33:56]** Vale, entonces, yo lo voy a saber es como

**[33:56 - 34:02]** justificar bien un pao premium, pero ya me, yo te fiqué supostos,

**[34:02 - 34:07]** pero ya me voy a añadir info sobre aparcamenz o sones de descada,

**[34:08 - 34:14]** porque se añadir mi info o se me va a ocurrir también lo de el fondo marino,

**[34:14 - 34:19]** si es roca, arena, cosas de estes, no se peron tirar bien

**[34:19 - 34:24]** para implementar una función de premium, que podría ser el salvo también.

**[34:24 - 34:28]** Obviamente, con todo, me la tomará de mal al usuario

**[34:28 - 34:31]** y registrar de mal donarlo y practicando todas las primeras.

**[34:32 - 34:37]** Pero me estaré al usuario normal,

**[34:37 - 34:43]** y mostraremos presentajes, pero no tiene accesso al salvo ni al millora

**[34:43 - 34:46]** de expedicions interviales.

**[34:46 - 34:50]** Las datos interviales, pero de momento me mando a mostrar a todo.

**[34:50 - 34:55]** Así que saber que pudeu posar una parte de posibles ampliacions,

**[34:55 - 35:00]** que al millorar no no contenit lentes, pero por tener que esforçar tanto.

**[35:00 - 35:03]** Así que estaría igual que donde voy a descarar el futuro

**[35:03 - 35:06]** que podría ampliar con más o visita en mí.

**[35:06 - 35:11]** No es una esté que contempla mala en este estadio,

**[35:11 - 35:16]** pero sí que puede haber una excel y de futiles millores.

**[35:16 - 35:21]** Vale, y el tema de experiencia del usuario, que sabéis,

**[35:21 - 35:26]** la idea de mostrar un menú, triar el de por, triar el spot,

**[35:26 - 35:29]** y que ya tiene de esa información meta.

**[35:29 - 35:33]** Me les diéndole todo ahí en la web,

**[35:33 - 35:38]** y que no tengo res, lo que más me mostré ahí.

**[35:38 - 35:43]** La idea sería, me es filtrar hasta el salvo.

**[35:43 - 35:46]** Selección en el de por, selección en el spot, y ya como filtrar todo.

**[35:46 - 35:50]** Yo fique bachado por la tu metrán, fique piles,

**[35:50 - 35:54]** y que a esta feira me busco el burdo,

**[35:54 - 35:57]** y con la trozo de un esguapet,

**[35:57 - 36:01]** las sofrinpátriares, y así ya me mostré.

**[36:01 - 36:06]** Esteve roscos, y después, en ínconos, pues el bien,

**[36:06 - 36:10]** un segon de arros en mostre, en pelatunda,

**[36:10 - 36:17]** la maria, y un...

**[36:17 - 36:20]** un segon de estivis, estivis el bien.

**[36:39 - 36:41]** No sé si se ve,

**[36:41 - 36:44]** la imagina que sors el mou, ¿vale?

**[36:44 - 36:48]** Yo con entre, simplemente pose el spot, piles,

**[36:48 - 36:54]** y después, ahí trié, y voy a ser como un radio,

**[36:54 - 36:57]** pero el de por, el de por, esguapet, ¿vale?

**[36:57 - 37:02]** Entonces, yo voy a ser un triar, 4 a 3 o 4 a 3,

**[37:02 - 37:06]** y después, ya así bach, ve, redoblinzacina.

**[37:06 - 37:09]** En un percentatge, me he posu 75%

**[37:09 - 37:13]** y después un íncono del ven, predixió del ven,

**[37:13 - 37:17]** predixió de temperatura, predixió de oleaje,

**[37:17 - 37:19]** predixió de col·lent, y ya está.

**[37:19 - 37:21]** Hay más 3 de poros.

**[37:21 - 37:25]** La visual sería més grafic, ¿no?

**[37:25 - 37:27]** Pero creo grafic, que mape es irritable.

**[37:27 - 37:29]** No, no, grafic, ¿vale?

**[37:29 - 37:31]** Avui pagentesis, ¿vale?

**[37:31 - 37:33]** Como aquí qué profesor.

**[37:33 - 37:39]** Ni angipleries, compúga ser chart, JSS,

**[37:39 - 37:43]** de simple facins de integrar,

**[37:43 - 37:46]** y donen, y mostrar graficos de percinto,

**[37:46 - 37:49]** de barres, todo eso queda volver.

**[37:49 - 37:51]** Vale, vale.

**[37:51 - 37:53]** Entonces, el idioma grafic de la aplicación,

**[37:53 - 37:56]** cuanto menos texto, vale, que el siga todo,

**[37:56 - 38:00]** y conografía, graficos de percinto,

**[38:00 - 38:02]** y suave,

**[38:02 - 38:04]** muy disuán.

**[38:04 - 38:08]** Vale, por contexto, mucha graficismo, ¿vale?

**[38:08 - 38:10]** En espo los candít,

**[38:10 - 38:14]** y guardando tu una estética consistent

**[38:14 - 38:16]** en el logo que diseñen,

**[38:16 - 38:19]** pues podría funcionar, ¿vale?

**[38:19 - 38:21]** Mónica.

**[38:21 - 38:24]** Sí, a ver, queda tus mínimos,

**[38:24 - 38:27]** le vamos a pedir a los usuarios que añaden

**[38:27 - 38:29]** para registrarse en hombres, apeídos,

**[38:29 - 38:33]** la fechas nacimiento, ¿qué cosas son más importantes?

**[38:33 - 38:36]** Eso es que has dicho más un teléfono

**[38:36 - 38:38]** y un nivel de contacto,

**[38:38 - 38:40]** y ya está.

**[38:40 - 38:42]** Y luego, opcional,

**[38:42 - 38:45]** que podrían poner, o sea, obligatorio,

**[38:45 - 38:46]** el municipio donde viven,

**[38:46 - 38:48]** y opcional en dirección.

**[38:48 - 38:55]** Vale.

**[38:55 - 38:56]** A ver, si tengo...

**[38:56 - 39:00]** Bueno, también guarda también campos

**[39:00 - 39:03]** para posible tema de monetización,

**[39:03 - 39:06]** pues número de cuentas de alcaldea,

**[39:06 - 39:09]** al vegetadisa.

**[39:09 - 39:12]** Hay una cosa importante que nadie me ha habéis preguntado,

**[39:12 - 39:16]** pero el momento que recogen vosotros de usuario,

**[39:16 - 39:18]** tenemos que poner,

**[39:18 - 39:20]** por lo menos en el pie de página,

**[39:20 - 39:22]** en el lace,

**[39:22 - 39:26]** a otra página que explica nuestra política de legado.

**[39:26 - 39:27]** Vale.

**[39:27 - 39:29]** Por lo menos,

**[39:29 - 39:32]** porque en el momento que recogen de personas,

**[39:32 - 39:37]** pues hay que hacer mención de que usos vamos a dar resultados.

**[39:37 - 39:41]** Hay una ley que es la ley de servicios de la sociedad

**[39:41 - 39:44]** y la información y del comercio electrónico,

**[39:44 - 39:46]** que os va a ser en laces,

**[39:46 - 39:49]** pero siempre hay que ponerlo.

**[39:49 - 39:50]** Vale.

**[39:50 - 39:51]** Descosta también.

**[39:51 - 39:54]** Si vamos a recoger tupis de usuarios,

**[39:54 - 39:59]** y no sé, que queremos guardar el espot favorito de cada usuario.

**[39:59 - 40:01]** Cuando entres que se gede guardado,

**[40:01 - 40:03]** los últimos podcas visitando.

**[40:03 - 40:06]** Se puede guardar en la CUC en una variable de usuario.

**[40:06 - 40:10]** Pues también hay que poner el famoso banner de política de CUCIS.

**[40:10 - 40:11]** Vale.

**[40:11 - 40:12]** Por eso,

**[40:12 - 40:14]** hablamos para el Nese como Kike.

**[40:14 - 40:15]** Siempre,

**[40:15 - 40:17]** cuando hablamos del requisitos,

**[40:17 - 40:19]** hay requisitos funcionales.

**[40:19 - 40:21]** Vale, hay requisitos,

**[40:21 - 40:23]** los jorvisuales o de experiencia usual.

**[40:23 - 40:27]** Y también siempre hay un apartado requisitos legales.

**[40:27 - 40:30]** No le dejes o también hay que contemplarlo.

**[40:30 - 40:34]** Entonces, ¿no ha tenido huevo tu pregunta mónica para la banda?

**[40:34 - 40:35]** Sí.

**[40:35 - 40:36]** Lo he preguntado ahí,

**[40:36 - 40:38]** en algún punto lo te queda mencionado.

**[40:38 - 40:39]** Vale,

**[40:39 - 40:40]** perdón una pregunta.

**[40:40 - 40:43]** Que veo que ya están casitos más que todo.

**[40:43 - 40:45]** Como va a estar en la playa,

**[40:45 - 40:46]** va a haber muchos reflejos.

**[40:46 - 40:48]** Ha de falta que la aplicación,

**[40:48 - 40:49]** al entrar,

**[40:49 - 40:52]** tenga mucho contraste o que es así normal, como todas.

**[40:52 - 40:54]** Bueno,

**[40:54 - 40:55]** la playa no se verá bien con el sol.

**[40:55 - 40:58]** Estaría guay que tuviese un selector de modo claro,

**[40:58 - 40:59]** modo escuro.

**[40:59 - 41:01]** Hablo paréntesis,

**[41:01 - 41:04]** luego eso no es si llegan ¿no se ha implementado?

**[41:04 - 41:06]** Pero por lo menos que esté por ahí el selector.

**[41:06 - 41:07]** Vale.

**[41:07 - 41:08]** Que no paréntesis.

**[41:08 - 41:09]** Le doy voz,

**[41:09 - 41:10]** pero no vale,

**[41:10 - 41:11]** que más es todo esto.

**[41:11 - 41:12]** Un.

**[41:12 - 41:13]** Bueno,

**[41:13 - 41:14]** voy, voy.

**[41:14 - 41:19]** Vaya referenta al modelo de negocio sobre la monitización.

**[41:19 - 41:23]** inkret Toro al Parallero de Son Fighters,

**[41:23 - 41:27]** el parallero del Partido de la Constitución,

**[41:27 - 41:29]** que estaría incluida el laces,

**[41:29 - 41:31]** que es especializado hacia el deporte,

**[41:31 - 41:38]** para que los usuarios puedan consultar o comprar material deporte.

**[41:38 - 41:41]** Es una cosa que estoy pensando un poco en el mocaf,

**[41:41 - 41:43]** el trabajo del todo,

**[41:43 - 41:44]** después de las vuertad,

**[41:44 - 41:45]** abajo del todo de todo,

**[41:45 - 41:48]** también tendríamos una partada del laces,

**[41:48 - 41:55]** El que aparece con su logo en más tal y los enlaces que no, por los con unas pequeños.

**[41:55 - 42:02]** El azo también está guay, pongamos todos los enlaces a las requerencias, a otras,

**[42:02 - 42:10]** a todos lo que se dice a Wendy, a Wing Blue, a la página de web de la comunidad valenciana,

**[42:10 - 42:12]** también en algún sitio hay que poner enlaces.

**[42:12 - 42:16]** Si alguien quiere aparte de ver nuestra aplicación ampliar,

**[42:16 - 42:20]** si a nuestra aplicación va del menos que lo más fácil,

**[42:20 - 42:26]** o que lo que muestra los roscos, pero luego también nos da ventana que podamos investigar más.

**[42:26 - 42:30]** Y eso también se puede lanzar con el modelo de negocios, tener el azo patrocinial

**[42:30 - 42:32]** para el que más arriba.

**[42:32 - 42:37]** Pero de momento para esta primera versión no le vamos a dar tanto peso a eso.

**[42:37 - 42:41]** Los enlaces más al final o una parcinasecundaria.

**[42:42 - 42:51]** Y otra pregunta, bueno, en este referente a lo que es los usuarios y el deporte.

**[42:51 - 42:56]** ¿Qué deporte, esa cuáticos, quieres incluir en la aplicación?

**[42:56 - 42:58]** O sea, has nombrado natación.

**[42:58 - 43:00]** Solo va a ver tres.

**[43:00 - 43:01]** Va a ver tres.

**[43:01 - 43:05]** Nada en aguas abiertas.

**[43:06 - 43:13]** El segundo sería la embarcación de Bella.

**[43:13 - 43:18]** Esos son los mapitos veleros pequeñitos que salen de puerto.

**[43:18 - 43:22]** Y los ojos van con un poquito más grande.

**[43:22 - 43:25]** Se te meten dos loras.

**[43:25 - 43:30]** Luego ya los deportes, los otros lo englobaríamos como deportes más.

**[43:31 - 43:34]** Necesitan marviento que hay tres.

**[43:34 - 43:39]** Es WinSurf, KaiSurf y WinFoy.

**[43:39 - 43:42]** Pero al final eso son el mismo deporte.

**[43:42 - 43:45]** El calor representar con los tres incógnitos.

**[43:45 - 43:47]** Pon es uno.

**[43:47 - 43:49]** El primer rostro sería para nadar.

**[43:49 - 43:57]** El segundo rostro sería para embarclar a Bella, que eso con pocos nudos y con pocos leajes.

**[43:58 - 44:00]** Pero también, si es un ojo, salen bien.

**[44:00 - 44:01]** Aunque el agua esté súper frío.

**[44:01 - 44:05]** Y el tercer rostro sí que necesitas más viento, pero ahí no te importa tanto lo leaje.

**[44:05 - 44:08]** Los agentes que lo disfruta.

**[44:08 - 44:13]** Al final son varios deportes, pero tres.

**[44:13 - 44:17]** Sería como nadar.

**[44:17 - 44:22]** En barca o en de Bella.

**[44:22 - 44:24]** ¿No están dispuestos al mismo tiempo?

**[44:24 - 44:25]** ¿Estás en el mismo tiempo?

**[44:25 - 44:27]** ¿Pasos a Christian?

**[44:27 - 44:28]** Christian, ¿no está radio?

**[44:28 - 44:31]** Sí, ¿vale?

**[44:31 - 44:34]** Christian, ¿vale?

**[44:34 - 44:37]** Si en algún momento lo usuario,

**[44:37 - 44:39]** los datos no están disponibles.

**[44:39 - 44:41]** ¿Qué debería ver lo usuario?

**[44:47 - 44:50]** Claro, claro, porque si yo estaba pensando si era mejor lo sueno,

**[44:50 - 44:54]** ¿Dónde podríamos estar en los últimos datos que guardó la aplicación?

**[44:54 - 45:02]** Sí, se podría poner datos de última actualización de los roscos, por ejemplo.

**[45:02 - 45:09]** En un momento dodado, pues te pongo la sin conexión y datos de última actualización.

**[45:09 - 45:11]** Si estás buena.

**[45:11 - 45:17]** Vale, esta en función de ser multidiuma o solo tienes experiencia para...

**[45:18 - 45:20]** Esa es buena.

**[45:20 - 45:25]** Yo idioma, en un momento que pensaba que tuviese selector de español y inglés.

**[45:25 - 45:28]** Vale.

**[45:28 - 45:35]** Avlo para el decis. Seguramente cuando ha dado la implementación solo en el área de ese un idioma.

**[45:35 - 45:45]** Al decir, pero sí que pondremos en algún sitio como selector multidiuma.

**[45:46 - 45:47]** Vale.

**[45:47 - 45:49]** Y los dos dos idiomas.

**[45:49 - 45:53]** Ahora te digo también sobre eso, que siempre lo digo.

**[45:53 - 46:01]** Cuando hagas selector los multidiumas, evitar poner párdelas, poner esto o en fin.

**[46:01 - 46:02]** Algo así.

**[46:02 - 46:06]** A veces he visto cositas que ponen un icono.

**[46:06 - 46:08]** Vale.

**[46:09 - 46:16]** Y supongo que cuando hemos puesto aplicaciones multidiumas, incluyendo el balanceano catalán,

**[46:16 - 46:21]** el acceder a misiones a banderas se grega a usuarios.

**[46:21 - 46:26]** Algunos consideran que el balanceano está catalán.

**[46:26 - 46:32]** Ya hace tiempo que cuando pido algo multidiumas no meto banderas.

**[46:32 - 46:35]** Es una petición mía con usuario.

**[46:36 - 46:38]** Una última cosa.

**[46:38 - 46:41]** Habrá alín que misro la aplicación.

**[46:41 - 46:44]** Habrá alín que misro la aplicación.

**[46:44 - 46:47]** Que puede configurar alguna cosa o otra.

**[46:47 - 46:55]** Sí, alguien podrá ir al grupo de usuarios para mantener el balanceano.

**[46:55 - 46:57]** Oificar.

**[46:57 - 46:59]** Vale.

**[47:00 - 47:02]** Vale.

**[47:02 - 47:05]** Vale.

**[47:05 - 47:06]** Vale.

**[47:06 - 47:09]** Antóní.

**[47:09 - 47:14]** Yo te había pensado en la tendencia de su aplicación con Vilo.

**[47:14 - 47:20]** Es que no sé si a la semana la sepa comentar les tindrán de puta o que les heus de puta.

**[47:20 - 47:24]** No sé si la daría a mí que a mí les heus de ingera o al millor.

**[47:24 - 47:28]** Una planta esperada en cada dos mil porcentes.

**[47:28 - 47:33]** que no es una forma de poder saber commentar y sobre el default para poder poder saber el default.

**[47:33 - 47:38]** Y también, a lo mejor, alguna manera, entre que ahora estoy para estar en ese default,

**[47:38 - 47:45]** si en algún enambotamiento o en una población que también se le hagas en este momento,

**[47:45 - 47:47]** la actividad del VICEVA o de Santa,

**[47:47 - 47:52]** es si no es la 184, en si yo.

**[47:52 - 48:11]** El tema de posar quan usuarien en ese spot y en cada modalitat estaria bé.

**[48:41 - 48:54]** El tema de posarien en cada modalitat estaria bé.

**[49:14 - 49:24]** El tema de posarien en cada modalitat estaria bé.

**[49:49 - 50:01]** El tema de posarien en cada modalitat estaria bé.

**[50:21 - 50:33]** El tema de posarien en cada modalitat estaria bé.

**[50:53 - 51:03]** El tema de posarien en cada modalitat estaria bé.

**[51:25 - 51:35]** El tema de posarien en cada modalitat estaria bé.

**[51:55 - 52:05]** El tema de posarien en cada modalitat estaria bé.

**[52:25 - 52:35]** El tema de posarien en cada modalitat estaria bé.

**[52:55 - 53:05]** El tema de posarien en cada modalitat estaria bé.

**[53:25 - 53:35]** El tema de posarien en cada modalitat estaria bé.

**[53:55 - 54:05]** El tema de posarien en cada modalitat estaria bé.

**[54:27 - 54:48]** El tema de posarien en cada moralitat estaria bé.

**[54:48 - 54:55]** El tema de posarien en cadauralitat.

**[54:56 - 54:58]** La voler m'estrarà una relic.

**[54:58 - 55:02]** Però sí que vull que la memòria que me fareu la primera,

**[55:02 - 55:03]** la primera és primer esprint,

**[55:03 - 55:06]** sí que és content de un presupor real,

**[55:06 - 55:08]** és un menú dels portes computant,

**[55:08 - 55:10]** quan tens gastar eú

**[55:10 - 55:16]** i ja vas explicar un poquet com fer el presupost.

**[55:16 - 55:19]** Una part que serà el corde,

**[55:19 - 55:22]** però després també es podré ficar una partat

**[55:22 - 55:25]** que serà un cos de manteniment igual,

**[55:25 - 55:29]** que seria el tema de tenir una base de tots allò,

**[55:29 - 55:31]** tingue el servidor de hosting,

**[55:31 - 55:33]** tingue el contracte de menys,

**[55:33 - 55:36]** tingue un cicot de manteniment que faria sobre la web,

**[55:36 - 55:38]** sobre les decisions,

**[55:38 - 55:41]** però no està tan cap de noi.

**[55:41 - 55:48]** Són jo en su glace.

**[55:48 - 55:52]** Bueno, a ella no peror de algú

**[55:52 - 55:55]** que alguna pregunta que sa queda tenet el dientero,

**[55:55 - 55:58]** que vull que hua,

**[55:58 - 56:02]** a disar,

**[56:02 - 56:04]** i el premio per veritat que he de respondre

**[56:04 - 56:06]** de la cosa que tenia el contracte.

**[56:06 - 56:10]** Dejepo en traure requisitos funcionals

**[56:10 - 56:13]** y en desperfeable sin un faltado,

**[56:13 - 56:15]** no? El foro.

**[56:15 - 56:16]** Con este.

**[56:16 - 56:17]** Sempre,

**[56:17 - 56:19]** hoy palentes de travega,

**[56:19 - 56:22]** cuando una entrevista normalmente en una entrevista

**[56:22 - 56:24]** no sabe qué es la total.

**[56:24 - 56:25]** Pero con pegueu,

**[56:25 - 56:27]** si he usigut estructuráticos,

**[56:27 - 56:29]** el que tu me llista de Eficix,

**[56:29 - 56:31]** ahora sí que podeu realizar rápidamente,

**[56:31 - 56:32]** si no és o menos un tig,

**[56:32 - 56:35]** s'ha parlat de todo lo que volia,

**[56:35 - 56:36]** y si queda algo,

**[56:36 - 56:38]** pues en cada tiene un just menú,

**[56:38 - 56:39]** espera preguntarme.

**[56:39 - 56:40]** Que no,

**[56:40 - 56:41]** pues,

**[56:41 - 56:44]** tan o donar el premio para la entrevista,

**[56:44 - 56:46]** fíicale un foro

**[56:46 - 56:49]** en el au les,

**[56:49 - 56:51]** y ahí vengan según lo que he hecho.

**[56:52 - 56:54]** Para la pregunta,

**[56:54 - 56:55]** que me falla uno,

**[56:55 - 56:58]** pues, que todo es lo que no puedes ver a ti.

**[56:58 - 56:59]** Bueno, a mí,

**[56:59 - 57:00]** se me ha quedo una pregunta,

**[57:00 - 57:02]** que la acabo de ver respecto a registro y lo GM,

**[57:02 - 57:04]** vamos a registrarnos

**[57:04 - 57:05]** con,

**[57:05 - 57:06]** usuario,

**[57:06 - 57:07]** contraseña,

**[57:07 - 57:09]** o podremos sacar con Google

**[57:09 - 57:11]** con Apple 8 o todo,

**[57:11 - 57:13]** o directamente sencillo,

**[57:13 - 57:15]** y mie nombre y contraseña.

**[57:15 - 57:18]** Que tenga nombre,

**[57:18 - 57:20]** y contraseña,

**[57:20 - 57:30]** el nombre y contraseña, el nombre de usuario contraseña o que sea el nombre de usuario que sea el correo electrónico, mejor.

**[57:30 - 57:38]** Y contraseña y que también permita el login con Google.

**[57:38 - 57:48]** Y si lo vamos a intentar ver y integrar.

**[57:48 - 57:58]** No sé si bien el caso respecto si el usuario solver la contraseña, tendremos que automatizar para que se lo vuelva a mandar y entrar un enlace y se lo paga caminar la contraseña.

**[59:35 - 59:45]** ¿Perdón una pregunta respecto a la pregunta de UCL?

**[59:45 - 59:55]** ¿Es que en cualquier avance con invitación? ¿Cómo va a entrar los usuarios? ¿Solver la de estar en Google o invitación?

**[59:55 - 60:05]** No es descargable, va ser una aplicación web que estará en un servidor de hosting y va estar pensada para móvil.

**[60:05 - 60:12]** Lo voy a pensar demos si lo queremos hacer que sea el responsable y que se pueda ver en el escritorio.

**[60:12 - 60:20]** Lo primero que vamos a implementar es que lo primero que es va a pedir es los Wi-Fi para la descripción móvil.

**[60:20 - 60:24]** ¿Cómo va a hacer la aplicación? ¿Por la principi va a ser al boca oca?

**[60:24 - 60:30]** Lo ponemos en foros y cuando llegaras lo primero que te va a mostrar es que te resistes.

**[60:30 - 60:41]** Una vez te resistes, ya puedes acceder y en un principio lo que hemos dicho, vamos a liberar todos los que tengamos.

**[60:41 - 60:46]** Lo voy a hacer el tiempo a cotar en los niveles de servicio.

**[60:46 - 60:51]** Fli y un farío.

**[60:51 - 60:56]** Pero a priori cuando llegues un login,

**[60:56 - 61:04]** va a ventar a una gente con el login y cuando ya te lo ves, ya que no es tu la privación.

**[61:05 - 61:07]** Perfecto.

**[61:07 - 61:10]** Vale. Una cosa, pero...

**[61:10 - 61:15]** O sea que sin login no derríamos buscar nada, no es resolver o no poder ver nada si no se resistran.

**[61:15 - 61:21]** No, de momento es que quiero tener que actudar todo el mundo, que lo utiliza.

**[61:21 - 61:26]** Porque lo voy a hacer lo que ya puedo,

**[61:26 - 61:32]** para poder enviar el campamento de marketing o si voy a hacer servicio premium.

**[61:32 - 61:37]** Pero el problema que tenemos ahí será la contraseña, ¿no?

**[61:37 - 61:44]** Si alguien, como manejamos, si alguien, se olvide de su contraseña.

**[61:44 - 61:51]** No es como apuntada mónica de ser recuperarla con traseña.

**[61:51 - 61:56]** Y que nos lleguen un correo y ya...

**[61:56 - 62:00]** Y torno a preparar el desiguala sonocen, pero que si que es verga en el login,

**[62:00 - 62:06]** no hay contraseña o es que es verar contraseña.

**[62:06 - 62:11]** Y está, y que está palegando a otra finestreta que ponga,

**[62:11 - 62:15]** te llegará un mensaje tal en que a que después no farem seguramente,

**[62:15 - 62:19]** pero que estigue la interficie, digeren,

**[62:19 - 62:22]** te que estar toda con si no ha animado a todo.

**[62:22 - 62:26]** Que después fue más todo el espacio, no les he enviado en.

**[62:26 - 62:31]** Y ya de cara profesor también pueden fer que restan viscala con traseña,

**[62:31 - 62:33]** ya usen se demanar y res,

**[62:33 - 62:38]** o sea que jacé una otra contraseña y que arriba a las edades y ya está.

**[62:38 - 62:41]** Y sustituirla.

**[62:41 - 62:45]** Para primera es versión, para no revolucrar.

**[62:45 - 62:48]** No le me acuerdo la razón producción, Cristian.

**[62:48 - 62:51]** Sóc un producte que se va quedar en el aula y no me lo puedo.

**[62:51 - 62:55]** Pero en el paquete, a Parigut Serio, Parlambos y Funcín,

**[62:55 - 62:58]** y ya es un pertenzado, es que un porco de una hora de ser santo,

**[62:58 - 63:02]** no es una idea ni que tienen el café, lo patísquio.

**[63:02 - 63:05]** Es que el vis que las entrevistas la complicanza, la complicanza,

**[63:05 - 63:07]** la llamar complicancia y al final va a ser.

**[63:07 - 63:14]** Sí, pero está complicanza a nivel de que no va a fer de no estudiar requisitos,

**[63:14 - 63:16]** pero ya pues mi que yo,

**[63:16 - 63:20]** tienes que hacer implementar en las asoctrades, que obviamente no no la hacía ni el.

**[63:20 - 63:23]** Ni el vinpercente de todo lo que en parlado.

**[63:23 - 63:26]** Vale, por favor, un fruit para manejar usuarios,

**[63:26 - 63:31]** tres datos con tres quesitos y tres ventanitas que no estrenen tal.

**[63:31 - 63:33]** De paso yo va a fer así,

**[63:33 - 63:36]** y ahora una pagina web que teníamos requisitos,

**[63:36 - 63:41]** y después en el sprint 3 yo ya vas a dir a los alumnes.

**[63:41 - 63:45]** Si fe un aso, ya sea, pues un tuve un saque.

**[63:45 - 63:47]** Si no, ya sea, un total.

**[63:47 - 63:52]** Y no va a fer ni el 30% de lo que la aplicación.

**[63:52 - 63:55]** Y esta que en parlamos de mis pasos no fueron ni el vin.

**[63:55 - 63:58]** Pero lo menos lo que es el documentito,

**[63:58 - 64:01]** con si siquiera mal.

**[64:01 - 64:03]** No se hace esteu.

**[64:03 - 64:05]** Vale.

**[64:05 - 64:06]** Vale.

**[64:06 - 64:07]** ¿Y lo algo?

**[64:07 - 64:10]** No, de como un profesor ya,

**[64:10 - 64:11]** no, de,

**[64:11 - 64:15]** me tiene que una primera versión funcional.

**[64:15 - 64:16]** Sería eso, ¿no?

**[64:16 - 64:18]** Visualizables sports,

**[64:18 - 64:20]** es de sports y

**[64:20 - 64:27]** y tiene información sobre es y me saban ya la idea y todo el rollo, ¿no?

**[64:27 - 64:32]** Moda tus problemas desarrollar hasta después de

**[64:32 - 64:35]** pasar a la segunda volación.

**[64:35 - 64:37]** La primera volación no,

**[64:37 - 64:39]** pero voy a hacerme un primer sprint,

**[64:39 - 64:42]** que es la preparación de la entrevista y un,

**[64:42 - 64:45]** un estudi inicial,

**[64:45 - 64:48]** que será el modo borrador que me pasareu.

**[64:48 - 64:51]** No he estado en la intelligentía,

**[64:51 - 64:54]** así que hay que estar en la pared,

**[64:54 - 64:56]** structuring la implementación del historiario,

**[64:56 - 64:58]** y esté en la tinta de los propiosos.

**[64:58 - 65:06]** estivemos ficaré con si fuera lo usual y conexión.

**[65:06 - 65:07]** Pues salten requisito,

**[65:07 - 65:10]** respite lo que va a parlar.

**[65:10 - 65:13]** O esté vai teniendo el misconception,

**[65:13 - 65:16]** y también me puedes hacer un y Trump del profesor.

**[65:16 - 65:23]** El que va a ser un primer borrador de documento de especificació.

**[65:23 - 65:30]** El sprint 1, que coincidirà en les altres de la primera evaluació,

**[65:30 - 65:32]** un poquetant de les escurs d'examus,

**[65:32 - 65:35]** segurament de fa en les escurs de la setmana d'examus.

**[65:35 - 65:39]** Allà m'entrega el document, ni que l'acte.

**[65:39 - 65:43]** Si ingèn't en contra el tot el meu fit va que vosaltres dones.

**[65:43 - 65:51]** També fa una presentació en pobó el poquetant i la presentaré en 1 minuts.

**[65:51 - 65:54]** Seria que em seguratros n'aregua, imagina't sé que,

**[65:54 - 65:57]** que en vez de ser este proyate, fue un proyate de la setmana.

**[65:57 - 65:59]** Jo he cri de 3 empresas,

**[65:59 - 66:03]** perquè em presenten un dia que en la setmana de la setmana proposta.

**[66:03 - 66:14]** M'ha de ser el primer borrador de documento de la setmana d'examus.

**[66:14 - 66:18]** Després de dia, també prepararem i vindrem,

**[66:18 - 66:23]** i pagarem de quines altres especificacions de quines altres especificacions

**[66:23 - 66:27]** mostraven vosaltres quina idea teniu, mostraven vosaltres bai,

**[66:27 - 66:32]** mostraven els baiefres, mostrant un mocap, etc.

**[66:32 - 66:34]** el que es va a fer.

**[66:34 - 66:36]** Ara, a un splint,

**[66:36 - 66:39]** que jo li dit el dos,

**[66:39 - 66:41]** que tenim espinsario,

**[66:41 - 66:42]** una primera evaluació,

**[66:42 - 66:43]** i el dos,

**[66:43 - 66:44]** i el final,

**[66:44 - 66:46]** se ve la segunda evaluació.

**[66:46 - 66:48]** El splint dos

**[66:48 - 66:50]** serà un punt de intermit

**[66:50 - 66:51]** perquè es me mostreu,

**[66:51 - 66:52]** però, al menos,

**[66:52 - 66:54]** la l'any d'integit o a trecos detes,

**[66:54 - 66:56]** encara que l'applicació no estic acabat.

**[66:56 - 66:59]** És un prototip ja funcional,

**[66:59 - 67:01]** que és una també valida en un poble de interacció.

**[67:01 - 67:03]** La lúmica ja hi hauria,

**[67:03 - 67:04]** o no hi hauria.

**[67:04 - 67:07]** M'hem mostrat un rossos en el estátics,

**[67:07 - 67:08]** i ara mira,

**[67:08 - 67:10]** l'úmica ja s'allà ja fa tal godia,

**[67:10 - 67:11]** al godia,

**[67:11 - 67:12]** i el brut,

**[67:12 - 67:14]** però la rei va a manerar usuals,

**[67:14 - 67:15]** però també.

**[67:15 - 67:17]** I la tercera,

**[67:17 - 67:19]** i el final,

**[67:19 - 67:22]** seria entregar lo que vos demana,

**[67:22 - 67:24]** que no será totes la aplicació.

**[67:24 - 67:27]** Que faigar, que faigar,

**[67:27 - 67:28]** que faigar,

**[67:28 - 67:29]** que faigar,

**[67:29 - 67:31]** que faigar,

**[67:31 - 67:32]** tu specific,

**[67:32 - 67:34]** o tant,

**[67:34 - 67:35]** faigar,

**[67:35 - 67:44]** que faigar,

**[67:44 - 67:45]** i també torn en Blazn,

**[67:45 - 67:46]** o xinguda l'indomària,

**[67:46 - 67:57]** apui que faigar el concept,

**[69:03 - 69:13]** ¿Y si no se puede poner en el caso de la ley?

**[69:13 - 69:18]** que tira un dia, li podrà explicar la lli,

**[69:18 - 69:23]** que és el que demà no contextem i després la lli,

**[69:23 - 69:26]** també us pot dir informació,

**[69:26 - 69:28]** però si la feira està aplicació,

**[69:28 - 69:30]** saber-lo que sé també li preguntaria la lli,

**[69:30 - 69:35]** que diria, d'un podria agarrar tot.
