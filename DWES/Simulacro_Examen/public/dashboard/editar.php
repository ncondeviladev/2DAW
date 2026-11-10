<?php

use App\Model\Lead;

require_once __DIR__ . '/../../config/bootstrap.php';

requereixLogin();

if (!isset($_GET['id']) || !ctype_digit($_GET['id']) || (int) $_GET['id'] <= 0) {
    header('Location: leads.php');
    exit;
}

$id = (int) $_GET['id'];

$errorBD = null;
$errors = [];
$lead = null;

try {
    $lead = $leadDAO->findById($id);
} catch (PDOException $e) {
    error_log($e->getMessage());
    $errorBD = 'No s\'ha pogut accedir a la base de dades.';
}

if ($lead === null && $errorBD === null) {
    http_response_code(404);
}

if ($lead !== null) {
    // Valors inicials del formulari: les dades actuals del lead
    $valors = [
        'nom'        => $lead->getNom(),
        'email'      => $lead->getEmail(),
        'telefon'    => $lead->getTelefon() ?? '',
        'empresa'    => $lead->getEmpresa() ?? '',
        'serveis'    => $lead->getServeis(),
        'pressupost' => $lead->getPressupost(),
        'missatge'   => $lead->getMissatge() ?? '',
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Si s'ha enviat el formulari, els valors són els enviats
        $valors = [
            'nom'        => trim($_POST['contacte']['nom'] ?? ''),
            'email'      => trim($_POST['contacte']['email'] ?? ''),
            'telefon'    => trim($_POST['contacte']['telefon'] ?? ''),
            'empresa'    => trim($_POST['contacte']['empresa'] ?? ''),
            'serveis'    => filtrarServeis($_POST['serveis'] ?? []),
            'pressupost' => $_POST['pressupost'] ?? '',
            'missatge'   => trim($_POST['missatge'] ?? ''),
        ];

        $errors = validarDadesLead($valors['nom'], $valors['email'], $valors['pressupost']);
        $nouDocument = null;

        // Si s'ha triat un document nou, el pugem (només si no hi ha errors)
        if (empty($errors)) {
            try {
                $nouDocument = pujarArxiu($_FILES['document'] ?? [], CARPETA_PUJADES);
            } catch (RuntimeException $e) {
                $errors['document'] = $e->getMessage();
            }
        }

        if (empty($errors)) {
            // L'id i l'estat es conserven; el document, si no se'n puja un de nou
            $leadActualitzat = new Lead(
                nom: $valors['nom'],
                email: $valors['email'],
                telefon: nullSiBuit($valors['telefon']),
                empresa: nullSiBuit($valors['empresa']),
                serveis: $valors['serveis'],
                pressupost: (float) $valors['pressupost'],
                missatge: nullSiBuit($valors['missatge']),
                document: $nouDocument ?? $lead->getDocument(),
                id: $lead->getId(),
                estat: $lead->getEstat()
            );

            try {
                $leadDAO->update($leadActualitzat);

                // Si s'ha substituït el document, eliminem l'anterior
                if ($nouDocument !== null) {
                    eliminarArxiu(CARPETA_PUJADES, $lead->getDocument());
                }

                header('Location: lead.php?id=' . $lead->getId() . '&desat=1');
                exit;
            } catch (PDOException $e) {
                // No s'ha guardat: el document nou quedaria orfe
                eliminarArxiu(CARPETA_PUJADES, $nouDocument);
                error_log($e->getMessage());
                $errors['bd'] = 'No s\'han pogut desar els canvis. Torna-ho a provar més tard.';
            }
        }
    }
}

$classeLabel = 'block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5';
$classeInput = 'w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl px-3.5 py-2.5 text-slate-800 text-sm';

$titol = 'TechLeads - Editar lead';
require_once __DIR__ . '/../../vistes/dashboard_capcalera.php';
?>
<main class="max-w-3xl mx-auto px-6 py-8 flex-1 w-full space-y-6">

    <a href="<?= $lead !== null ? 'lead.php?id=' . $lead->getId() : 'leads.php' ?>"
       class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
        &larr; Tornar
    </a>

    <?php if ($errorBD !== null): ?>
        <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
            <?= e($errorBD) ?>
        </div>

    <?php elseif ($lead === null): ?>
        <div class="bg-white p-12 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/80 text-center space-y-2">
            <h1 class="text-xl font-extrabold text-slate-900">Lead no trobat</h1>
            <p class="text-sm text-slate-500">No existeix cap lead amb l'identificador indicat.</p>
        </div>

    <?php else: ?>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar lead #<?= $lead->getId() ?></h1>

        <?php if (!empty($errors)): ?>
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <p class="font-semibold">Cal que revises les dades del formulari:</p>
                <ul class="list-disc list-inside mt-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="editar.php?id=<?= $lead->getId() ?>" enctype="multipart/form-data"
              class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 p-6 space-y-5">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="nom" class="<?= $classeLabel ?>">Nom *</label>
                    <input type="text" id="nom" name="contacte[nom]" value="<?= e($valors['nom']) ?>" class="<?= $classeInput ?>">
                </div>
                <div>
                    <label for="email" class="<?= $classeLabel ?>">Correu electrònic *</label>
                    <input type="email" id="email" name="contacte[email]" value="<?= e($valors['email']) ?>" class="<?= $classeInput ?>">
                </div>
                <div>
                    <label for="telefon" class="<?= $classeLabel ?>">Telèfon</label>
                    <input type="text" id="telefon" name="contacte[telefon]" value="<?= e($valors['telefon']) ?>" class="<?= $classeInput ?>">
                </div>
                <div>
                    <label for="empresa" class="<?= $classeLabel ?>">Empresa</label>
                    <input type="text" id="empresa" name="contacte[empresa]" value="<?= e($valors['empresa']) ?>" class="<?= $classeInput ?>">
                </div>
            </div>

            <fieldset>
                <legend class="<?= $classeLabel ?>">Serveis</legend>
                <div class="flex flex-wrap gap-4 text-sm text-slate-700">
                    <?php foreach (Lead::SERVEIS as $servei): ?>
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="serveis[]" value="<?= e($servei) ?>"
                                   <?= in_array($servei, $valors['serveis'], true) ? 'checked' : '' ?>
                                   class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                            <?= e($servei) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div>
                <label for="pressupost" class="<?= $classeLabel ?>">Pressupost (€) *</label>
                <input type="text" id="pressupost" name="pressupost" value="<?= e((string) $valors['pressupost']) ?>" class="<?= $classeInput ?>">
            </div>

            <div>
                <label for="missatge" class="<?= $classeLabel ?>">Missatge</label>
                <textarea id="missatge" name="missatge" rows="4" class="<?= $classeInput ?>"><?= e($valors['missatge']) ?></textarea>
            </div>

            <div>
                <label for="document" class="<?= $classeLabel ?>">Document</label>
                <?php if (!empty($lead->getDocument())): ?>
                    <p class="text-sm text-slate-600 mb-2">
                        Document actual:
                        <a href="../pujades/<?= e($lead->getDocument()) ?>" class="text-indigo-600 hover:underline"><?= e($lead->getDocument()) ?></a>
                    </p>
                <?php endif; ?>
                <input type="file" id="document" name="document" class="text-sm text-slate-600">
                <p class="text-xs text-slate-400 mt-1">Opcional. Si en tries un, substituirà l'actual (JPG, PNG o PDF, màxim 2 MB).</p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="lead.php?id=<?= $lead->getId() ?>" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                    Cancel·lar
                </a>
                <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold shadow-md shadow-indigo-500/20 transition-all">
                    Desar canvis
                </button>
            </div>
        </form>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../../vistes/dashboard_peu.php';