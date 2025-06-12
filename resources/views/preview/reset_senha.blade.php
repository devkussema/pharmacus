<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth" x-data="resetPasswordPageData()" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Pharmatina</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function resetPasswordPageData() {
            return {
                darkMode: false, // Será atualizado no init
                isLoading: false,
                feedback: { type: '', text: '' },
                email: 'usuario@exemplo.com', // Simulação: viria da URL/token
                token: 'simulacao_reset_token', // Simulação: viria da URL
                password: '',
                password_confirmation: '',
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
                },
                async handlePasswordReset(event) {
                    this.isLoading = true;
                    this.feedback = { type: '', text: '' };

                    if (this.password !== this.password_confirmation) {
                        this.feedback = { type: 'error', text: 'As senhas não coincidem.' };
                        this.isLoading = false;
                        return;
                    }
                    if (this.password.length < 8) {
                        this.feedback = { type: 'error', text: 'A senha deve ter pelo menos 8 caracteres.' };
                        this.isLoading = false;
                        return;
                    }

                    // Simulação de chamada de API para redefinição de senha
                    // TODO: Substitua pela sua lógica de redefinição de senha real
                    try {
                        await new Promise(resolve => setTimeout(resolve, 1500)); // Simula atraso da rede

                        // Exemplo de lógica de sucesso (substitua pela sua chamada real)
                        this.feedback = { type: 'success', text: 'Senha redefinida com sucesso! Pode agora fazer login.' };
                        this.password = '';
                        this.password_confirmation = '';
                        // setTimeout(() => window.location.href = '{{ route("preview.login") }}', 2000);

                    } catch (error) {
                        console.error('Erro na redefinição de senha:', error);
                        this.feedback = { type: 'error', text: 'Ocorreu um erro ao tentar redefinir a senha. Tente novamente.' };
                    } finally {
                        this.isLoading = false;
                    }
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mt-6 text-slate-800 dark:text-white">Pharmatina</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Defina uma nova senha para sua conta.</p>
            </div>
        </div>

        <!-- Painel Direito (Formulário) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="absolute top-6 right-6">
                <button @click="toggleTheme" class="p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950 transition-colors">
                    <svg x-show="!darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
            </div>

            <div class="w-full max-w-sm">
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Pharmatina</h1>
                </div>

                <h2 class="text-2xl font-semibold text-slate-800 dark:text-white">Redefinir Senha</h2>
                <p class="mt-1 text-slate-500 dark:text-slate-400">Crie uma nova senha para a sua conta.</p>

                <form @submit.prevent="handlePasswordReset" class="mt-8 space-y-5">
                    <input type="hidden" name="email" x-model="email">
                    <input type="hidden" name="token" x-model="token">

                    <div>
                        <label for="password" class="text-sm font-medium text-slate-700 dark:text-slate-300">Nova Senha</label>
                        <div class="mt-1">
                            <input x-model="password" id="password" name="password" type="password" autocomplete="new-password" required placeholder="••••••••" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-sm font-medium text-slate-700 dark:text-slate-300">Confirmar Nova Senha</label>
                        <div class="mt-1">
                            <input x-model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="••••••••" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                        </div>
                    </div>

                    <div x-show="feedback.text" x-cloak
                         :class="feedback.type === 'success' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300'"
                         class="p-3 rounded-md text-sm"
                         role="alert"
                         x-text="feedback.text">
                    </div>

                    <div>
                        <button type="submit" :disabled="isLoading" class="w-full flex justify-center items-center text-center py-3 px-4 font-semibold rounded-lg text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-slate-950 transition-all transform hover:scale-105 disabled:opacity-75 disabled:cursor-not-allowed">
                            <span x-show="!isLoading" x-cloak>Redefinir Senha</span>
                            <span x-show="isLoading" x-cloak class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Salvando...
                            </span>
                        </button>
                    </div>
                </form>

                 <div class="text-center mt-8">
                     <p class="text-sm text-slate-500 dark:text-slate-400">
                        Voltar para o
                        <a href="{{ route('preview.login') }}" class="font-medium text-teal-600 hover:text-teal-500 dark:text-teal-400 dark:hover:text-teal-300">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
