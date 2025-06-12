<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmatina - Sistema de Gestão Farmacêutica</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter & Fira Code (for code-like text) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Fira+Code:wght@500&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #020617; /* slate-950 */
            color: #e2e8f0; /* slate-200 */
        }
        .font-fira {
            font-family: 'Fira Code', monospace;
        }
        .glass-pane {
            background-color: rgba(15, 23, 42, 0.5); /* slate-900/50 */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(51, 65, 85, 0.5); /* slate-700/50 */
        }
        .hero-gradient-text {
            background: linear-gradient(to right, #f0fdfa, #ccfbf1, #99f6e4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .teal-glow {
            box-shadow: 0 0 15px rgba(20, 184, 166, 0.2), 0 0 30px rgba(45, 212, 191, 0.1);
        }
    </style>
</head>
<body x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.scrollY > 10)">

    <!-- Header -->
    <header :class="scrolled ? 'glass-pane' : ''" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white">
                Pharmatina
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-slate-300 hover:text-white transition-colors">Recursos</a>
                <a href="#" class="text-slate-300 hover:text-white transition-colors">Preços</a>
                <a href="#login" class="text-slate-300 hover:text-white transition-colors">Entrar</a>
            </div>
            <a href="{{ route('preview.login') }}" class="hidden md:block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-5 py-2 rounded-lg transition-all transform hover:scale-105">
                Começar Agora
            </a>
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-300 hover:text-white hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-teal-500" :aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-menu">
                    <span class="sr-only">Abrir menu principal</span>
                    <!-- Icon when menu is closed. -->
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <svg x-show="mobileMenuOpen" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="mobileMenuOpen" x-cloak
             id="mobile-menu"
             class="md:hidden bg-slate-800 border-t border-slate-700"
             @click.away="mobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2">
            <div class="px-2 pt-2 pb-4 space-y-1 sm:px-3">
                <a href="#features" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700 transition-colors">Recursos</a>
                <a href="#" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700 transition-colors">Preços</a>
                <a href="#login" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-slate-200 hover:text-white hover:bg-slate-700 transition-colors">Entrar</a>
                <a href="{{ route('preview.login') }}" @click="mobileMenuOpen = false" class="block w-full mt-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold text-center px-5 py-2.5 rounded-lg transition-all transform hover:scale-105">
                    Começar Agora
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="absolute inset-0 bg-grid-slate-700/[0.05] bg-[bottom_1px_center] dark:bg-grid-slate-400/[0.05] dark:bg-bottom_1px_center" style="mask-image: linear-gradient(to bottom, transparent, black, transparent)"></div>
            <div class="absolute inset-0 z-[-1]" style="background: radial-gradient(circle at 50% 30%, rgba(20, 184, 166, 0.15) 0%, rgba(2, 6, 23, 0) 40%);"></div>

            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tighter hero-gradient-text">
                    A gestão da sua farmácia, elevada a um novo patamar.
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                    Pharmatina é o sistema completo que integra estoque, vendas e relatórios em uma plataforma inteligente, rápida e segura. Foque no que importa: a saúde dos seus clientes.
                </p>
                <div class="mt-10 flex justify-center items-center gap-4">
                    <a href="#" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-8 py-3 rounded-lg transition-all transform hover:scale-105">
                        Experimente Agora
                    </a>
                    <a href="#features" class="border border-slate-700 hover:bg-slate-800 text-slate-300 font-semibold px-8 py-3 rounded-lg transition-colors">
                        Saber Mais
                    </a>
                </div>
            </div>
        </section>

        <!-- Login Section Highlight -->
        <section id="login" class="py-20 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                     <h2 class="text-3xl lg:text-4xl font-bold text-white tracking-tight">Acesso Rápido e Seguro</h2>
                     <p class="mt-4 max-w-xl mx-auto text-slate-400">Entre no seu sistema com a interface que você já conhece e confia.</p>
                </div>

                <!-- Embedded Login Component -->
                <div class="max-w-4xl mx-auto flex flex-col lg:flex-row items-center justify-center gap-0 bg-slate-900 rounded-2xl shadow-2xl teal-glow overflow-hidden">
                    <!-- Visual Side -->
                    <div class="w-full lg:w-5/12 p-10 flex-shrink-0 bg-slate-950/50">
                        <div class="text-center">
                            <div class="w-32 h-32 mx-auto flex items-center justify-center rounded-2xl bg-black/30 border border-white/10">
                                <svg class="w-16 h-16 text-teal-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v2.5"/><path d="M12 19.5V22"/><path d="m4.93 4.93 1.77 1.77"/><path d="m17.3 17.3 1.77 1.77"/><path d="M2 12h2.5"/><path d="M19.5 12H22"/><path d="m4.93 19.07 1.77-1.77"/><path d="m17.3 6.7 1.77-1.77"/><circle cx="12" cy="12" r="2"/><path d="M12 14c-2.39 1.38-3 3-3 3"/><path d="M12 14c2.39 1.38 3 3 3 3"/><path d="m14.7 9.35 4.3 2.5"/><path d="M5 11.85 9.3 9.35"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mt-6 text-white">Pharmatina</h3>
                            <p class="mt-1 text-slate-400">Acesso ao Sistema</p>
                        </div>
                    </div>
                    <!-- Form Side -->
                    <div class="w-full lg:w-7/12 p-8 md:p-12">
                        <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-xl border border-slate-700/50">
                            <h4 class="text-xl font-bold text-white text-center">Acesse sua conta</h4>
                            <form class="mt-6 space-y-4">
                                <div>
                                    <label for="email-login" class="sr-only">E-mail</label>
                                    <input id="email-login" type="email" required placeholder="seu.email@exemplo.com" class="w-full px-4 py-2 border border-slate-600 rounded-md bg-slate-700/50 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                                </div>
                                <div>
                                    <label for="password-login" class="sr-only">Senha</label>
                                    <input id="password-login" type="password" required placeholder="••••••••" class="w-full px-4 py-2 border border-slate-600 rounded-md bg-slate-700/50 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                                </div>
                                <button type="submit" class="w-full text-center py-3 px-4 text-sm font-semibold rounded-md text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-slate-900 transition-all transform hover:scale-105">
                                    Entrar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 lg:py-24 bg-slate-900/50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <p class="font-fira text-teal-400">// Recursos Principais</p>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mt-2 tracking-tight">Tudo que você precisa em um só lugar</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-slate-400">Ferramentas projetadas para otimizar cada aspecto da sua operação farmacêutica.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="p-8 rounded-xl glass-pane transition-all duration-300 hover:-translate-y-2 hover:border-teal-500/50">
                        <div class="w-12 h-12 bg-slate-800 text-teal-400 flex items-center justify-center rounded-lg mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v6h18Z"/><path d="M20 18a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10h16v8Z"/><path d="M6 14h.01"/><path d="M10 14h.01"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Gestão de Estoque</h3>
                        <p class="mt-2 text-slate-400">Controle de lotes, validades e alertas de reposição automáticos. Nunca perca uma venda por falta de produto.</p>
                    </div>
                    <!-- Feature Card 2 -->
                    <div class="p-8 rounded-xl glass-pane transition-all duration-300 hover:-translate-y-2 hover:border-teal-500/50">
                         <div class="w-12 h-12 bg-slate-800 text-teal-400 flex items-center justify-center rounded-lg mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Vendas e PDV</h3>
                        <p class="mt-2 text-slate-400">Ponto de Venda ágil, com integração a leitores de código de barras, emissão de cupons e controle de caixa.</p>
                    </div>
                    <!-- Feature Card 3 -->
                    <div class="p-8 rounded-xl glass-pane transition-all duration-300 hover:-translate-y-2 hover:border-teal-500/50">
                         <div class="w-12 h-12 bg-slate-800 text-teal-400 flex items-center justify-center rounded-lg mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Relatórios Inteligentes</h3>
                        <p class="mt-2 text-slate-400">Dashboards visuais com insights sobre seus produtos mais vendidos, margens de lucro e performance geral.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800">
        <div class="container mx-auto px-6 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400">&copy; 2024 Pharmatina. Todos os direitos reservados.</p>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">Termos de Serviço</a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">Política de Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
