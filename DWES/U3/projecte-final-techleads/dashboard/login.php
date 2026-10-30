<?php
declare(strict_types=1);
session_start();

//Si esta autenticat, redirigim a panel leads
if (isset($_SESSION['usuari'])) {
    header('Location: leads.php');
    exit;
}

$errorLogin = false;

//Comprova si hi ha cookie de usuari anterior
$usuariPrevi = $_COOKIE['recorda_usuari'] ?? '';

//Captura de dades formualri login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuari = trim($_POST['usuari'] ?? '');
    $contrasenya = $_POST['contrasenya'] ?? '';
    $recordam = isset($_POST['recordam']);

    //Carrega de la llista d'usuaris
    $llistaUsuaris = require __DIR__ . '/../app/lib/usuaris.php';
    //Verifica usuari i contrasenya
    if (isset($llistaUsuaris[$usuari]) && password_verify($contrasenya, $llistaUsuaris[$usuari]['hash'])) {
        session_regenerate_id(true);
        $_SESSION['usuari'] = $usuari;

        //Gestió de cookie recorda 30 dies
        if ($recordam) {
            setcookie('recorda_usuari', $usuari, time() + (30 * 24 * 3600), '/');
        } else {
            setcookie('recorda_usuari', '', time() - 3600, '/');
        }

        header('Location: leads.php');
        exit;
    } else {
        $errorLogin = true;
        $usuariPrevi = $usuari;
    }
}
?>


<!DOCTYPE html>
<html lang="ca" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechLeads - Accés clients</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col justify-center items-center p-6 antialiased selection:bg-indigo-500 selection:text-white">

    <div class="max-w-md w-full space-y-6">

        <!-- Logo i Encapçalament -->
        <div class="text-center space-y-2">
            <a href="../index.php" class="inline-flex items-center gap-2.5 group">
                <div
                    class="h-11 w-11 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-transform">
                    TL
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-slate-900">Tech<span
                        class="text-indigo-600">Leads</span></span>
            </a>
            <h1 class="text-xl font-bold text-slate-900 pt-1">Panell de Gestió</h1>
            <p class="text-xs text-slate-500">Inicia sessió per a gestionar les oportunitats i sol·licituds.</p>
        </div>

        <!-- Exemple d'error de login: només ha d'aparéixer quan les dades no són correctes -->
        <?php if ($errorLogin): ?>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 shadow-sm">
                <div class="p-1 rounded-lg bg-rose-100 text-rose-600 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-rose-800 self-center">Usuari o contrasenya incorrectes.</p>
            </div>
        <?php endif; ?>

        <!-- Targeta de Formulari -->
        <div class="bg-white rounded-2xl p-7 sm:p-8 shadow-xl shadow-slate-200/60 border border-slate-200/80 space-y-5">

            <!-- Banner informatiu d'usuaris de prova -->
            <div
                class="bg-slate-50 rounded-xl p-3 border border-slate-200 flex items-center justify-between text-xs text-slate-600">
                <span class="font-medium text-slate-500">Usuaris de prova:</span>
                <div class="flex gap-2">
                    <span
                        class="px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-mono font-semibold border border-indigo-100">ana</span>
                    <span
                        class="px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-mono font-semibold border border-indigo-100">marc</span>
                </div>
            </div>

            <form method="POST" action="login.php" class="space-y-4">
                <div>
                    <label for="usuari"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Usuari</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input type="text" id="usuari" name="usuari" value="<?= htmlspecialchars($usuariPrevi) ?>"
                            placeholder="Nom d'usuari" required
                            class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl pl-10 pr-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
                    </div>
                </div>

                <div>
                    <label for="contrasenya"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Contrasenya</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </span>
                        <input type="password" id="contrasenya" name="contrasenya" placeholder="••••••••"
                            class="w-full bg-slate-50/70 border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white rounded-xl pl-10 pr-3.5 py-2.5 text-slate-800 text-sm placeholder-slate-400 transition-all outline-none">
                    </div>
                </div>

                <div class="pt-1 pb-1">
                    <label class="flex items-center gap-2.5 text-slate-700 cursor-pointer">
                        <input type="checkbox" name="recordam" <?= !empty($usuariPrevi) ? 'checked' : '' ?>
                            class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                        <span class="text-xs font-medium text-slate-600">Recorda'm <span
                                class="text-slate-400 font-normal">(només l'usuari)</span></span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/35 hover:-translate-y-0.5 transition-all duration-200">
                    <span>Entrar al panell</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Enllaç de tornada -->
        <div class="text-center">
            <a href="../index.php"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Tornar a la pàgina d'inici</span>
            </a>
        </div>

    </div>

</body>

</html>