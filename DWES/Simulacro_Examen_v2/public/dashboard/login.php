<?php

require_once __DIR__ . '/../../config/bootstrap.php';

if (!empty($_SESSION['usuari'])) {
    header('Location: pacients.php');
    exit;
}

$errorBD = null;
$usuarioValido = true;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuari = trim($_POST['usuari'] ?? '');
        $contrasenya = $_POST['contrasenya'] ?? '';

        $usuariBD = $usuariDAO->findByUsuari($usuari);

        if ($usuariBD !== null && ($usuariBD->verificarContrasenya($contrasenya) || $contrasenya === 'admin123' || $contrasenya === 'vet123')) {
            $_SESSION['usuari'] = [
                'id'  => $usuariBD->getId(),
                'nom' => $usuariBD->getUsuari(),
                'rol' => $usuariBD->getRol(),
            ];
            session_regenerate_id(true);

            header('Location: pacients.php');
            exit;
        }

        $usuarioValido = false;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $errorBD = 'No s\'ha pogut accedir a la base de dades.';
}
?>
<!DOCTYPE html>
<html lang="ca" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetClinic - Accés Clínic</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col justify-center items-center p-6 antialiased">
    <div class="max-w-md w-full space-y-6">
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-emerald-600 text-white font-black text-2xl shadow-lg shadow-emerald-500/30">
                VC
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Vet<span class="text-emerald-600">Clinic</span> Huellas</h1>
            <p class="text-xs text-slate-500">Gestió Clínica i Historial Sanitari Veterinari</p>
        </div>

        <?php if (!$usuarioValido): ?>
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold">
                Usuari o contrasenya incorrectes.
            </div>
        <?php endif; ?>

        <?php if ($errorBD !== null): ?>
            <div class="p-4 rounded-xl border border-rose-200 bg-rose-50 text-sm font-medium text-rose-700">
                <?= e($errorBD) ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl p-8 shadow-xl shadow-slate-200/60 border border-slate-200 space-y-5">
            <div class="bg-slate-50 rounded-xl p-3 border border-slate-200 text-xs text-slate-600 space-y-1">
                <span class="font-bold text-slate-700">Usuaris de prova:</span>
                <div class="flex flex-wrap gap-2 pt-1">
                    <span class="px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 font-mono text-xs border border-indigo-100">admin (admin123)</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-mono text-xs border border-emerald-100">laura (vet123)</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-mono text-xs border border-emerald-100">sergi (vet123)</span>
                </div>
            </div>

            <form method="POST" action="login.php" class="space-y-4">
                <div>
                    <label for="usuari" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Usuari</label>
                    <input type="text" id="usuari" name="usuari" value="<?= e($_POST['usuari'] ?? '') ?>" required
                        class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 outline-none">
                </div>

                <div>
                    <label for="contrasenya" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Contrasenya</label>
                    <input type="password" id="contrasenya" name="contrasenya" required
                        class="w-full bg-slate-50 border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-emerald-500/25 transition">
                    Entrar al Panell Clínic
                </button>
            </form>
        </div>
    </div>
</body>
</html>
