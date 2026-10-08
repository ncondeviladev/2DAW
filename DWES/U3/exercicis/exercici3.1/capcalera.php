<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titolPagina ?? 'TechLeads') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-700 text-white">
        <nav class="max-w-3xl mx-auto flex items-center gap-6 px-6 py-4">
            <span class="font-bold text-lg mr-auto">TechLeads</span>
            <a href="index.php" class="hover:underline">Inici</a>
            <a href="contacte.php" class="hover:underline">Contacte</a>
        </nav>
    </header>