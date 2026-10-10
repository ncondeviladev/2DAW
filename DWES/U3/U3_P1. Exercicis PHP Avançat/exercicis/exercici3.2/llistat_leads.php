<?php
// TODO 2: Carrega 'dades_leads.php' amb require_once
// i una ruta construïda amb __DIR__
require_once __DIR__ . "/dades_leads.php";
//require __DIR__ . "/dades_leads.php";
// TODO 3: Guarda en $leads el resultat de cridar a obtenirLeads()
$leads = obtenirLeads();
// TODO 4: Guarda en $total el resultat de cridar a calcularPressupostTotal($leads)
$total = calcularPressupostTotal($leads);
?>


<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercici 3.2 - Llistat de leads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <!-- VISTA: no cal tocar res d'ací en avall -->
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Llistat de leads</h1>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b text-gray-600">
                    <th class="py-2">Nom</th>
                    <th class="py-2">Empresa</th>
                    <th class="py-2 text-right">Pressupost</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead): ?>
                    <tr class="border-b text-gray-700">
                        <td class="py-2"><?= htmlspecialchars($lead['nom']) ?></td>
                        <td class="py-2"><?= htmlspecialchars($lead['empresa']) ?></td>
                        <td class="py-2 text-right"><?= number_format($lead['pressupost'], 2, ',', '.') ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="font-bold text-gray-800">
                    <td colspan="2" class="py-3">Total</td>
                    <td class="py-3 text-right"><?= number_format($total, 2, ',', '.') ?> €</td>
                </tr>
            </tfoot>
        </table>
    </div>

</body>

</html>