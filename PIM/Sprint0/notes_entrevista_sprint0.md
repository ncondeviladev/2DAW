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
