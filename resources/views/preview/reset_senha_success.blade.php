<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth" x-data="resetSuccessPageData()" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senha Redefinida - Pharmatina</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function resetSuccessPageData() {
            return {
                darkMode: false, // Será atualizado no init
                init() {
                    const savedDarkMode = localStorage.getItem('darkMode');
                    if (savedDarkMode !== null) {
                        this.darkMode = savedDarkMode === 'true';
                    } else {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                    this.$watch('darkMode', val => localStorage.setItem('darkMode', val.toString()));
                },
                toggleTheme() {
                    this.darkMode = !this.darkMode;
                }
            };
        }
        // Aplica tema inicial ao <html> antes do Alpine para evitar FOUC
        (function() {
            const savedDarkMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedDarkMode === 'true' || (savedDarkMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white dark:bg-slate-950 transition-colors duration-300">

    <div class="flex min-h-screen">
        <!-- Painel Esquerdo (Visual) -->
        <div class="hidden lg:flex w-1/2 items-center justify-center p-12 bg-slate-100 dark:bg-slate-900 relative">
            <div class="absolute inset-0 z-0 bg-gradient-to-br from-white via-slate-50 to-slate-200 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800"></div>
            <div class="text-center z-10">
                <div class="w-28 h-28 mx-auto flex items-center justify-center rounded-full bg-teal-500">
                     <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mt-6 text-slate-800 dark:text-white">Pharmatina</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Sua senha foi redefinida com sucesso.</p>
            </div>
        </div>

        <!-- Painel Direito (Conteúdo) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="absolute top-6 right-6">
                <button @click="toggleTheme" class="p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950 transition-colors">
                    <svg x-show="!darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
            </div>

            <div class="w-full max-w-sm text-center">
                <div class="lg:hidden mb-8">
                    <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Pharmatina</h1>
                </div>

                <div class="mb-6">
                    <svg class="w-16 h-16 text-green-500 dark:text-green-400 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold text-slate-800 dark:text-white">Senha Redefinida!</h2>
                <p class="mt-2 text-slate-500 dark:text-slate-400">Sua senha foi alterada com sucesso. Agora você pode fazer login com sua nova senha.</p>

                <div class="mt-8">
                    <a href="{{ route('preview.login') }}" class="w-full inline-flex justify-center items-center text-center py-3 px-4 font-semibold rounded-lg text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-slate-950 transition-all transform hover:scale-105">
                        Ir para o Login
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
