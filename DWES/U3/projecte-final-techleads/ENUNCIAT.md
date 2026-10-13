# Projecte final — Unitat 3. PHP Avançat

## Context

TechLeads necessita dos coses: una **web pública** on els visitants puguen sol·licitar informació, i un **panell intern** on l'equip comercial puga veure eixes sol·licituds i fer-ne seguiment.

Este projecte reunix pràcticament tot el que hem treballat en la unitat: formularis avançats, XSS, sticky forms, pujada d'arxius, sessions, cookies, autenticació, excepcions i classes. No cal base de dades: ho farem tot amb `$_SESSION`.

A diferència dels exercicis anteriors, ara **no se't dona cap línia de PHP feta**. Només tens les maquetes en HTML pur (carpeta `maquetes/`), amb el disseny i el contingut d'exemple ja fets amb Tailwind. El teu treball és convertir eixes maquetes en una aplicació PHP completa: triar on va cada peça de lògica, com es passen les dades d'una pàgina a una altra, i com s'integra tot dins de l'HTML.

## Estructura de carpetes que has de crear

```
index.php                 → formulari públic (a partir de maquetes/index.html)
processar_lead.php        → rep el POST del formulari, valida i guarda el lead
pujades/                  → ací es guarden els documents pujats (ja creada)
dashboard/
    login.php              → formulari d'accés (a partir de maquetes/dashboard-login.html)
    logout.php             → tanca la sessió
    leads.php              → llistat de leads (a partir de maquetes/dashboard-leads.html)
app/
    lib/
        Lead.php            → la classe Lead
        GestorLeads.php      → funcions per a gestionar els leads dins de la sessió
        usuaris.php           → array amb els usuaris i els seus hashes
    vistes/
        capcalera.php         → capçalera HTML comuna (<head>, <body>, l'inici del <header>)
        peu.php                → peu HTML comú
```

No és obligatori seguir exactament estos noms, però sí mantindre la idea: la **lògica** (classes, funcions, validació) separada de les **vistes**, tal com vam vore al punt 3 dels apunts.

## 1. Formulari públic (`index.php` i `processar_lead.php`)

Parteix de `maquetes/index.html`. Camps del formulari:

- `contacte[nom]`, `contacte[email]`, `contacte[telefon]` (opcional), `contacte[empresa]` (opcional)
- `serveis[]`: checkboxes múltiples (Web, App mòbil, SEO, Cloud)
- `pressupost`: text
- `missatge`: textarea
- `document`: arxiu opcional (PDF, JPG o PNG, màxim 2 MB)
- `termes`: checkbox (no cal validar-lo, és només per a l'experiència d'usuari)

**Validació** (en `processar_lead.php`):
- El nom és obligatori.
- L'email ha de ser vàlid (`filter_var`).
- El pressupost ha de ser un número positiu.
- Si s'ha pujat un document: comprova l'error de pujada, la grandària i el **tipus real** de l'arxiu (amb `finfo`, mai amb el camp `type`). Si no hi ha cap arxiu, no és un error: el document és opcional.
- Si ha marcat la casella de confirmar els termes i condicions.

**Patró a seguir:** com el formulari i el processament estan en dos arxius distints, no pots fer un sticky form "senzill" (el de la secció 4.4 dels apunts). Has d'utilitzar el patró alternatiu que apareix al mateix punt: `processar_lead.php` guarda els errors i els valors previs a `$_SESSION`, redirigix a `index.php` i este els llig i els esborra. És el patró **PRG** (Post/Redirect/Get) que ja coneixes de la secció 2.

Si tot és correcte, `processar_lead.php` ha de:
1. Crear un objecte `Lead` amb les dades (i el nom de l'arxiu guardat, si n'hi ha).
2. Afegir-lo a la llista de leads de la sessió.
3. Redirigir a `index.php?enviat=1` (per a mostrar el missatge d'èxit sense tornar a enviar el formulari si es recarrega la pàgina).

## 2. La classe `Lead`

Crea la classe amb:
- Un identificador (`id`), de només lectura.
- Les dades del formulari: nom, email, telèfon, empresa, serveis (array), pressupost, missatge i el nom de l'arxiu adjunt (pot ser `null`).
- Tres constants per a l'estat: `nou`, `contactat` i `tancat` (el valor inicial sempre és `nou`).
- Els *getters* necessaris per a mostrar les dades a la vista.
- Un mètode `avancarEstat()` que faça avançar l'estat un pas (si ja és `tancat`, no canvia).

⚠️ **Sobre l'identificador:** NO utilitzes el patró de comptador estàtic del punt 8.3 dels apunts (`private static int $totalCreats`). Una propietat estàtica només es manté mentre dura **una** petició HTTP; en la següent petició, PHP torna a arrencar de zero i el comptador es perd. Com que ara els leads han de sobreviure entre peticions (estan a la sessió), calcula l'id a partir del nombre de leads que ja hi ha guardats.

## 3. Gestionar els leads amb `$_SESSION`

Necessites funcions (o mètodes d'una classe, com preferisques) per a:
- Obtindre la llista de leads de la sessió.
- Calcular el pròxim id disponible.
- Afegir un lead nou a la sessió.
- Fer avançar l'estat d'un lead concret (busca'l dins de l'array per `id`).

⚠️ **Pista important:** carrega sempre la definició de la classe `Lead` (amb `require_once`) **abans** de cridar `session_start()`, en tots els arxius. Quan PHP arranca la sessió, deserialitza automàticament tot el que hi haja guardat a `$_SESSION`; si la classe `Lead` encara no existix en eixe moment, els objectes es recuperen "incomplets" (`__PHP_Incomplete_Class`) i qualsevol mètode que crides sobre ells fallarà. És un error típic i difícil de detectar si no saps per què passa.

## 4. Accés al panell (`dashboard/login.php` i `logout.php`)

Parteix de `maquetes/dashboard-login.html`. Usa el mateix patró d'autenticació de la secció 6: un array d'usuaris amb `password_hash()` (pots crear-te'l amb un script auxiliar, no cal que l'escrigues a mà), `password_verify()`, missatge d'error genèric i `session_regenerate_id(true)` just després d'autenticar.

**La casella "Recorda'm":** si l'usuari la marca, guarda en una cookie (30 dies) **només el nom d'usuari**, mai la contrasenya. La pròxima vegada que es visite `login.php`, si la cookie existix, guardarà l'usuari a la sessió, farà un `session_regenerate_id(true)` i redirigirà a `dashboard/leads.php`. En tancar sessió (`logout.php`), la cookie de "recorda'm" **s'ha d'esborrar**.

## 5. Panell de leads (`dashboard/leads.php`)

Parteix de `maquetes/dashboard-leads.html`. Esta pàgina:
- Ha de comprovar que l'usuari té sessió iniciada; si no, redirigix a `login.php`.
- Mostra la taula de leads guardats a la sessió (si no n'hi ha cap, mostra el missatge buit que ja veus a la maqueta).
- Per cada lead: mostra totes les seues dades, i si té un document adjunt, un enllaç per a obrir-lo (`pujades/nom-arxiu`).
- El botó "Avança estat" ha de fer avançar l'estat del lead (`nou` → `contactat` → `tancat`). Fes-ho també amb el patró PRG: processa l'acció i redirigix a la mateixa pàgina, perquè recarregar-la no torne a avançar l'estat.
- Quan un lead ja està `tancat`, el botó ha d'aparéixer desactivat (com en la maqueta).

## Comprovacions finals

Abans de donar-ho per acabat, comprova que:

- [ ] Enviar el formulari amb dades incorrectes mostra els errors i **manté** els valors ja escrits (excepte l'arxiu, que no es pot recuperar).
- [ ] Enviar-lo correctament, amb i sense document adjunt, funciona en els dos casos.
- [ ] El document pujat es guarda amb un nom generat (no el nom original) i es pot obrir des del panell.
- [ ] Intentar accedir a `dashboard/leads.php` sense haver iniciat sessió et redirigix a `login.php`.
- [ ] Un usuari o contrasenya incorrectes mostren sempre el mateix missatge.
- [ ] Marcar "Recorda'm", tancar sessió i tornar a `login.php` precarrega l'usuari (però mai la contrasenya).
- [ ] Avançar l'estat d'un lead funciona i, quan arriba a `tancat`, el botó queda desactivat.
- [ ] Recarregar `leads.php` després d'avançar un estat no el torna a avançar.
