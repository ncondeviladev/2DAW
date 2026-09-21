<style>
  @media print {
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
  }
</style>

# DWEC — Unitat 2: Activitat Puntuable
## Problema dels Graons (Implementació Iterativa i Recursiva en JavaScript)

| | |
|---|---|
| **Alumne** | Noé Conde Vila |
| **Curs** | 2n DAW (Semipresencial) — IES Maria Enríquez |
| **Assignatura** | DWEC — Desenvolupament Web en Entorn Client |
| **Data** | Setembre 2026 |

---

## 1. Enunciat de l'Activitat

**Imagina que una persona està a la planta de lloguers d’un edifici i vol arribar a la teulada. L’edifici té $n$ graons numerats de 1 a $n$. A cada pas, la persona pot fer un salt de 1 graó o un salt de 2 graons.**

**Escriu una funció amb una implementació iterativa i una altra implementació recursiva en JavaScript que, donat un nombre enter positiu $n$, retorne el nombre de maneres diferents de pujar des del sòl al graó $n$.**

### **Recomanacions i Exemples:**
* **Gestionar correctament $n = 1$ i $n = 2$.**
* **Exemple per a $n = 3$:** Les maneres són $(1+1+1), (1+2), (2+1) \implies$ **3 maneres**.
* **Exemple per a $n = 4$:** Les maneres són $(1+1+1+1), (1+1+2), (1+2+1), (2+1+1), (2+2) \implies$ **5 maneres**.
* **Exemples d'execució esperats:**
  * `comptaManeres(1)` $\to 1$
  * `comptaManeres(2)` $\to 2$
  * `comptaManeres(3)` $\to 3$
  * `comptaManeres(4)` $\to 5$

---

## 2. Implementació en JavaScript (Codi)

### **2.1. Implementació Iterativa (`comptaManeresIteratiu`)**

```javascript
function comptaManeresIteratiu(n) {
    // TODO: Implementar la solució iterativa
}

// Proves
console.log("Iteratiu n=1 ->", comptaManeresIteratiu(1));
console.log("Iteratiu n=2 ->", comptaManeresIteratiu(2));
console.log("Iteratiu n=3 ->", comptaManeresIteratiu(3));
console.log("Iteratiu n=4 ->", comptaManeresIteratiu(4));
console.log("Iteratiu n=5 ->", comptaManeresIteratiu(5));
```

### **2.2. Implementació Recursiva (`comptaManeresRecursiu`)**

```javascript
function comptaManeresRecursiu(n) {
    // TODO: Implementar la solució recursiva
}

// Proves
console.log("Recursiu n=1 ->", comptaManeresRecursiu(1));
console.log("Recursiu n=2 ->", comptaManeresRecursiu(2));
console.log("Recursiu n=3 ->", comptaManeresRecursiu(3));
console.log("Recursiu n=4 ->", comptaManeresRecursiu(4));
console.log("Recursiu n=5 ->", comptaManeresRecursiu(5));
```

---

## 3. Preguntes de Comprensió i Justificació

**1. Explica, pas a pas, com arriba la solució iterativa al resultat per a $n$ qualsevol. Detalla quines són les dues últimes quantitats que es mantenen i com es van actualitzant en el bucle.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta de l'alumne]
</p>

---

**2. Per al cas recursiu, descriu la relació de recurrència que s’està utilitzant i identifica els casos base. Explica per què la solució és correcta.**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta de l'alumne]
</p>

---

**3. Què faries per gestionar casos extremadament grans de $n$ (p. ex., $n$ en milions) mantenint l’eficiència?**

<p style="color: #1a73e8; font-family: Georgia, serif;">
[Espai per a la resposta de l'alumne]
</p>
