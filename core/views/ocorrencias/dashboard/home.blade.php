<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Pharmatina Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Fira+Code:wght@500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-fira { font-family: 'Fira Code', monospace; }
        [x-cloak] { display: none !important; }
        .sidebar-gradient-dark {
            background: linear-gradient(180deg, #23263a 0%, #1e2233 100%);
        }
        .sidebar-gradient-light {
            background: linear-gradient(180deg, #e3e8f0 0%, #f8fafc 100%);
        }
        .header-gradient-dark {
            background: linear-gradient(90deg, #23263a 0%, #2d3250 100%);
        }
        .header-gradient-light {
            background: linear-gradient(90deg, #e3e8f0 0%, #f8fafc 100%);
        }
        .card-border-dark {
            border-left: 4px solid #38bdf8; /* sky-500 */
        }
        .card-border-light {
            border-left: 4px solid #0ea5e9; /* sky-600 */
        }
    </style>
</head>
<body x-data="homeApp" :class="theme === 'dark' ? 'bg-[#181a26] text-slate-200' : 'bg-slate-100 text-slate-900'" class="antialiased min-h-screen">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside :class="theme === 'dark' ? 'sidebar-gradient-dark' : 'sidebar-gradient-light'" class="w-20 flex flex-col items-center py-6 space-y-8 shadow-lg">
        <div :class="theme === 'dark' ? 'bg-sky-500 text-white' : 'bg-sky-100 text-sky-600'" class="w-12 h-12 flex items-center justify-center rounded-xl font-bold text-2xl mb-4 shadow-lg">P</div>
        <nav class="flex flex-col space-y-6">
            <a href="{{ route('ocorrencia.dashboard.page', ['page' => 'home']) }}" class="group flex flex-col items-center" :class="theme === 'dark' ? 'text-sky-400' : 'text-sky-600'" > <!-- Active Link -->
                <svg class="w-7 h-7 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                <span class="text-xs font-fira">Início</span>
            </a>
            <a href="{{ route('ocorrencia.dashboard.page', ['page' => 'index']) }}" class="group flex flex-col items-center" :class="theme === 'dark' ? 'text-slate-400 hover:text-sky-400' : 'text-slate-500 hover:text-sky-600'">
                <svg class="w-7 h-7 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6"></path></svg>
                <span class="text-xs font-fira">Ocorrências</span>
            </a>
            <button class="group flex flex-col items-center" :class="theme === 'dark' ? 'text-slate-400 hover:text-sky-400' : 'text-slate-500 hover:text-sky-600'">
                <svg class="w-7 h-7 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="10"></circle></svg>
                <span class="text-xs font-fira">Histórico</span>
            </button>
        </nav>
        <div class="flex-1"></div>
        <img src="https://placehold.co/40x40/38bdf8/FFFFFF?text=A" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-sky-500 shadow-lg">
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header -->
        <header :class="theme === 'dark' ? 'header-gradient-dark' : 'header-gradient-light'" class="flex justify-between items-center px-8 py-5 border-b" :class="theme === 'dark' ? 'border-slate-700 shadow-md' : 'border-slate-200 shadow-sm'">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-fira font-bold tracking-wide" :class="theme === 'dark' ? 'text-sky-400' : 'text-sky-600'">Bem-vindo(a) ao Pharmatina</h1>
                <span :class="theme === 'dark' ? 'bg-green-600/20 text-green-400' : 'bg-green-100 text-green-700'" class="px-2 py-1 rounded font-mono text-xs ml-2">Dashboard</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="font-fira text-sm" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Olá, Usuário</span>
                <img src="https://placehold.co/40x40/38bdf8/FFFFFF?text=A" alt="Avatar do usuário" class="w-9 h-9 rounded-full border-2 border-sky-500">
                <!-- Botão de alternância de tema -->
                <button @click="toggleTheme" class="ml-4 p-2 rounded-full transition" :class="theme === 'dark' ? 'bg-slate-800 hover:bg-slate-700 text-yellow-300' : 'bg-slate-200 hover:bg-slate-300 text-sky-600'">
                    <template x-if="theme === 'dark'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m8.66-13.66l-.71.71M4.05 19.07l-.71.71M21 12h-1M4 12H3m16.66 5.66l-.71-.71M4.05 4.93l-.71-.71M12 7a5 5 0 000 10 5 5 0 000-10z"></path></svg>
                    </template>
                    <template x-if="theme === 'light'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"></path></svg>
                    </template>
                </button>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main :class="theme === 'dark' ? 'bg-[#181a26]' : 'bg-slate-100'" class="flex-1 px-8 py-10">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    <!-- Card Ocorrências do Dia -->
                    <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-xl p-6 flex flex-col items-start">
                        <div class="flex items-center mb-3">
                            <svg class="w-7 h-7 mr-2" :class="theme === 'dark' ? 'text-sky-400' : 'text-sky-600'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3M16 7V3M4 11h16M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="font-fira font-semibold text-lg" :class="theme === 'dark' ? 'text-sky-300' : 'text-sky-600'">Ocorrências do Dia</span>
                        </div>
                        <div class="text-4xl font-bold mb-2" :class="theme === 'dark' ? 'text-sky-200' : 'text-sky-700'">3</div>
                        <a href="{{ route('ocorrencia.dashboard.page') }}" class="mt-2 text-sm font-fira underline" :class="theme === 'dark' ? 'text-sky-400 hover:text-sky-300' : 'text-sky-600 hover:text-sky-800'">Ver detalhes</a>
                    </div>
                    <!-- Card Pacientes Ativos -->
                    <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-xl p-6 flex flex-col items-start">
                        <div class="flex items-center mb-3">
                            <svg class="w-7 h-7 mr-2" :class="theme === 'dark' ? 'text-green-400' : 'text-green-600'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75M12 17a4 4 0 01-4-4V7a4 4 0 018 0v6a4 4 0 01-4 4z"></path></svg>
                            <span class="font-fira font-semibold text-lg" :class="theme === 'dark' ? 'text-green-300' : 'text-green-600'">Pacientes Ativos</span>
                        </div>
                        <div class="text-4xl font-bold mb-2" :class="theme === 'dark' ? 'text-green-200' : 'text-green-700'">12</div>
                        <a href="#" class="mt-2 text-sm font-fira underline" :class="theme === 'dark' ? 'text-green-400 hover:text-green-300' : 'text-green-600 hover:text-green-800'">Ver pacientes</a>
                    </div>
                    <!-- Card Estoque Crítico -->
                    <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-xl p-6 flex flex-col items-start">
                        <div class="flex items-center mb-3">
                            <svg class="w-7 h-7 mr-2" :class="theme === 'dark' ? 'text-red-400' : 'text-red-600'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3M12 2a10 10 0 100 20 10 10 0 000-20z"></path></svg>
                            <span class="font-fira font-semibold text-lg" :class="theme === 'dark' ? 'text-red-300' : 'text-red-600'">Estoque Crítico</span>
                        </div>
                        <div class="text-4xl font-bold mb-2" :class="theme === 'dark' ? 'text-red-200' : 'text-red-700'">2</div>
                        <a href="#" class="mt-2 text-sm font-fira underline" :class="theme === 'dark' ? 'text-red-400 hover:text-red-300' : 'text-red-600 hover:text-red-800'">Ver estoque</a>
                    </div>
                </div>

                <!-- Seção de boas-vindas e atalhos -->
                <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1">
                        <h2 class="text-2xl font-fira font-bold mb-2" :class="theme === 'dark' ? 'text-sky-300' : 'text-sky-600'">Olá, seja bem-vindo(a)!</h2>
                        <p :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-600'" class="mb-4">
                            Este é o seu painel principal. Aqui você pode acompanhar as ocorrências do dia, gerenciar pacientes, monitorar o estoque e acessar rapidamente as principais funcionalidades do sistema.
                        </p>
                        <div class="flex flex-wrap gap-4 mt-4">
                            <a href="{{ route('ocorrencia.dashboard.page') }}" class="bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 text-white font-fira font-semibold px-5 py-2 rounded-md shadow transition-all">Ir para Ocorrências</a>
                            <a href="#" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-fira font-semibold px-5 py-2 rounded-md shadow transition-all">Pacientes</a>
                            <a href="#" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-fira font-semibold px-5 py-2 rounded-md shadow transition-all">Estoque</a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <img src="https://placehold.co/200x200/23263a/38bdf8?text=Pharma" alt="Ilustração" class="rounded-xl shadow-lg border-4" :class="theme === 'dark' ? 'border-sky-500/30' : 'border-sky-600/20'">
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('homeApp', () => ({
            // Theme
            theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', this.theme);
            }
        }));
    });
</script>
</body>
</html>
