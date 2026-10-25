<!DOCTYPE html>
<html lang="ca" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechLeads - Sol·licita informació</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Capçalera Principal -->
    <header class="sticky top-0 z-30 bg-white/85 backdrop-blur-md border-b border-slate-200/80 transition-all">
        <div class="max-w-4xl mx-auto flex items-center justify-between px-6 py-3.5">
            <a href="index.php" class="flex items-center gap-2.5 group">
                <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                    TL
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-900">Tech<span class="text-indigo-600">Leads</span></span>
            </a>

            <nav class="flex items-center gap-2">
                <a href="index.php" class="px-3.5 py-1.5 rounded-lg text-sm font-semibold text-indigo-600 bg-indigo-50/80 hover:bg-indigo-100 transition-colors">
                    Inici
                </a>
                <a href="dashboard/login.php" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors">
                    <span>Accés clients</span>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </nav>
        </div>
    </header>