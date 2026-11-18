<?php
require_once __DIR__ . '/../config/bootstrap.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuariInput = trim($_POST['usuari'] ?? '');
    $contrasenya = $_POST['contrasenya'] ?? '';

    $usuari = $usuariDAO->findByUsuari($usuariInput);

    if ($usuari && password_verify($contrasenya, $usuari->getContrasenya())) {
        $_SESSION['usuari_id'] = $usuari->getId();
        $_SESSION['usuari']    = $usuari->getUsuari();
        $_SESSION['rol']       = $usuari->getRol();
        header('Location: /dashboard/clients.php');
        exit;
    }
    $error = 'Usuari o contrasenya incorrectes.';
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FitLife Studio — Accés</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 to-slate-100 flex items-center justify-center">
<div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-8 space-y-6">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-slate-900">FitLife Studio</h1>
        <p class="text-sm text-slate-500 mt-1">Panel de gestió interna</p>
    </div>
    <?php if ($error): ?>
        <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm"><?= e($error) ?></div>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Usuari</label>
            <input type="text" name="usuari" required class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm outline-none focus:border-emerald-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Contrasenya</label>
            <input type="password" name="contrasenya" required class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm outline-none focus:border-emerald-500">
        </div>
        <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition">
            Iniciar Sessió
        </button>
    </form>
    <p class="text-xs text-center text-slate-400">admin/admin123 &bull; marina/vet123 &bull; jordi/vet123</p>
</div>
</body>
</html>
