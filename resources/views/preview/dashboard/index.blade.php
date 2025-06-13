<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pharmatina</title>

    <!-- Tailwind CSS config: force dark mode to use class strategy -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Defina dashboardSetup ANTES do Alpine.js -->
    <script>
        function dashboardSetup() {
            return {
                isSidebarOpen: true,
                theme: 'light',
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    if (savedTheme) {
                        this.theme = savedTheme;
                    } else {
                        this.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    }

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        // Only update if no theme is explicitly set in localStorage
                        if (!localStorage.getItem('theme')) {
                            this.theme = e.matches ? 'dark' : 'light';
                        }
                    });

                    if (window.innerWidth < 1024) {
                        this.isSidebarOpen = false;
                    }
                },
                toggleTheme() {
                    if (this.theme === 'light') {
                        this.theme = 'dark';
                        localStorage.setItem('theme', 'dark');
                    } else {
                        this.theme = 'light';
                        localStorage.setItem('theme', 'light');
                    }
                }
            };
        }
    </script>
    <!-- Alpine.js for interactions -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        [x-cloak] { display: none !important; }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s, color 0.2s;
            position: relative;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 100%;
            width: 4px;
            background-color: #14b8a6; /* teal-500 */
            border-radius: 0 4px 4px 0;
        }
        .sidebar-link.active {
            color: #0d9488; /* teal-600 */
            font-weight: 600;
            background-color: #f0fdfa; /* teal-50 */
        }
        .dark .sidebar-link.active {
             color: #5eead4; /* teal-300 */
             background-color: #134e4a66; /* teal-900/40 */
        }
        .sidebar-link:not(.active):hover {
            background-color: #f3f4f6; /* gray-100 */
        }
        .dark .sidebar-link:not(.active):hover {
            background-color: #374151; /* gray-700 */
        }
    </style>
</head>
<body
    x-data="dashboardSetup()"
    x-init="init()"
    :class="{ 'dark': theme === 'dark' }"
    class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 transition-colors duration-300"
>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside
            class="flex flex-col bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 shadow-lg"
            :class="isSidebarOpen ? 'w-64' : 'w-20'">

            <div class="flex items-center justify-center h-16 shrink-0 border-b border-gray-200 dark:border-gray-700">
                <a href="#" class="flex items-center justify-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-teal-500 text-white font-bold text-lg">P</div>
                    <span x-show="isSidebarOpen" class="ml-3 text-xl font-bold text-gray-800 dark:text-white transition-opacity duration-300">Pharmatina</span>
                </a>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-2">
                <a href="#" class="sidebar-link active">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="isSidebarOpen" class="ml-4">Início</span>
                </a>
                <a href="#" class="sidebar-link text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    <span x-show="isSidebarOpen" class="ml-4">Atividades</span>
                </a>
                <a href="#" class="sidebar-link text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span x-show="isSidebarOpen" class="ml-4">G. Fármacos</span>
                </a>
                <a href="#" class="sidebar-link text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    <span x-show="isSidebarOpen" class="ml-4">Prateleiras</span>
                </a>
                <a href="#" class="sidebar-link text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span x-show="isSidebarOpen" class="ml-4">Relatórios</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 shadow-sm">
                <div class="flex items-center">
                    <button @click="isSidebarOpen = !isSidebarOpen" class="text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-white">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    </button>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Dashboard > <span class="text-gray-700 dark:text-gray-200 font-semibold">Página Inicial</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button @click="toggleTheme" class="p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg x-show="theme === 'light'" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="theme === 'dark'" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    <div class="flex items-center">
                        <img src="https://placehold.co/40x40/14b8a6/FFFFFF?text=A" alt="Avatar do usuário" class="w-10 h-10 rounded-full">
                        <div class="ml-3 text-left">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">Adriano Lata</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main column -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="p-6 rounded-xl bg-white dark:bg-gray-800 shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Olá Dr(a) Adriano, Boa noite!</h2>
                            <p class="mt-1 text-gray-500 dark:text-gray-400">Tenha um bom dia no trabalho. Aqui está um resumo da sua operação.</p>
                        </div>

                        <!-- KPI Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                           <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-lg"><p class="text-sm text-gray-500 dark:text-gray-400">Mínimo</p><p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">31</p><p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Até 6 meses</p></div>
                           <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-lg border-l-4 border-red-500"><p class="text-sm text-gray-500 dark:text-gray-400">Crítico</p><p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">49</p><p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Até 3 meses</p></div>
                           <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-lg"><p class="text-sm text-gray-500 dark:text-gray-400">Médio</p><p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">75</p><p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Até 10 meses</p></div>
                           <div class="p-5 bg-white dark:bg-gray-800 rounded-xl shadow-lg"><p class="text-sm text-gray-500 dark:text-gray-400">Máximo</p><p class="text-3xl font-bold text-gray-800 dark:text-white mt-1">46</p><p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Até 12 meses</p></div>
                        </div>

                        <!-- Departamentos Principais -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                             <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Departamentos Principais</h3>
                             <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"><div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3"><svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.368-.662a1 1 0 01-.527-1.118l.894-2.894a1 1 0 00-.239-1.242l-1.636-1.636a1 1 0 00-1.242-.239l-2.894.894a1 1 0 01-1.118-.527l-.662-2.368a2 2 0 00-.547-1.022A2 2 0 0012 3v0a2 2 0 00-1.428.572 2 2 0 00-.547 1.022l-.662 2.368a1 1 0 01-1.118.527l-2.894-.894a1 1 0 00-1.242.239l-1.636 1.636a1 1 0 00-.239 1.242l.894 2.894a1 1 0 01.527 1.118l-.662 2.368a2 2 0 00.547 1.022A2 2 0 003 12v0a2 2 0 001.428.572 2 2 0 001.022.547l2.368.662a1 1 0 011.118.527l-.894 2.894a1 1 0 00.239 1.242l1.636 1.636a1 1 0 001.242.239l2.894-.894a1 1 0 011.118-.527l.662-2.368a2 2 0 00.547-1.022A2 2 0 0021 12v0a2 2 0 00-1.572-.428z"></path></svg></div>Armazém I</div>
                                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"><div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3"><svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.368-.662a1 1 0 01-.527-1.118l.894-2.894a1 1 0 00-.239-1.242l-1.636-1.636a1 1 0 00-1.242-.239l-2.894.894a1 1 0 01-1.118-.527l-.662-2.368a2 2 0 00-.547-1.022A2 2 0 0012 3v0a2 2 0 00-1.428.572 2 2 0 00-.547 1.022l-.662 2.368a1 1 0 01-1.118.527l-2.894-.894a1 1 0 00-1.242.239l-1.636 1.636a1 1 0 00-.239 1.242l.894 2.894a1 1 0 01.527 1.118l-.662 2.368a2 2 0 00.547 1.022A2 2 0 003 12v0a2 2 0 001.428.572 2 2 0 001.022.547l2.368.662a1 1 0 011.118.527l-.894 2.894a1 1 0 00.239 1.242l1.636 1.636a1 1 0 001.242.239l2.894-.894a1 1 0 011.118-.527l.662-2.368a2 2 0 00.547-1.022A2 2 0 0021 12v0a2 2 0 00-1.572-.428z"></path></svg></div>Armazém II</div>
                                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"><div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3"><svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.368-.662a1 1 0 01-.527-1.118l.894-2.894a1 1 0 00-.239-1.242l-1.636-1.636a1 1 0 00-1.242-.239l-2.894.894a1 1 0 01-1.118-.527l-.662-2.368a2 2 0 00-.547-1.022A2 2 0 0012 3v0a2 2 0 00-1.428.572 2 2 0 00-.547 1.022l-.662 2.368a1 1 0 01-1.118.527l-2.894-.894a1 1 0 00-1.242.239l-1.636 1.636a1 1 0 00-.239 1.242l.894 2.894a1 1 0 01.527 1.118l-.662 2.368a2 2 0 00.547 1.022A2 2 0 003 12v0a2 2 0 001.428.572 2 2 0 001.022.547l2.368.662a1 1 0 011.118.527l-.894 2.894a1 1 0 00.239 1.242l1.636 1.636a1 1 0 001.242.239l2.894-.894a1 1 0 011.118-.527l.662-2.368a2 2 0 00.547-1.022A2 2 0 0021 12v0a2 2 0 00-1.572-.428z"></path></svg></div>Farmácia</div>
                                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"><div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-3"><svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.368-.662a1 1 0 01-.527-1.118l.894-2.894a1 1 0 00-.239-1.242l-1.636-1.636a1 1 0 00-1.242-.239l-2.894.894a1 1 0 01-1.118-.527l-.662-2.368a2 2 0 00-.547-1.022A2 2 0 0012 3v0a2 2 0 00-1.428.572 2 2 0 00-.547 1.022l-.662 2.368a1 1 0 01-1.118.527l-2.894-.894a1 1 0 00-1.242.239l-1.636 1.636a1 1 0 00-.239 1.242l.894 2.894a1 1 0 01.527 1.118l-.662 2.368a2 2 0 00.547 1.022A2 2 0 003 12v0a2 2 0 001.428.572 2 2 0 001.022.547l2.368.662a1 1 0 011.118.527l-.894 2.894a1 1 0 00.239 1.242l1.636 1.636a1 1 0 001.242.239l2.894-.894a1 1 0 011.118-.527l.662-2.368a2 2 0 00.547-1.022A2 2 0 0021 12v0a2 2 0 00-1.572-.428z"></path></svg></div>Direcção Clínica</div>
                             </div>
                        </div>
                        <!-- Acessos Recentes -->
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Acessos Recentes</h3>
                                <table class="w-full text-sm text-left">
                                    <thead>
                                        <tr><th class="p-2 font-semibold">Nome</th><th class="p-2 font-semibold">Email</th><th class="p-2 font-semibold">Status</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-100 dark:border-gray-700">
                                            <td class="p-2">Adriano Lata</td><td class="p-2">adrianopeligangalata@gmail.com</td><td class="p-2"><span class="px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100 dark:text-green-300 dark:bg-green-700/30 rounded-full">Online</span></td>
                                        </tr>
                                        <tr class="border-b border-gray-100 dark:border-gray-700">
                                            <td class="p-2">Rosa André</td><td class="p-2">rosamariacamiloandre@gmail.com</td><td class="p-2 text-gray-500 dark:text-gray-400">há 1 dia</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Augusto Kussema</td><td class="p-2">dev.kussema@gmail.com</td><td class="p-2 text-gray-500 dark:text-gray-400">há 8 meses</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>

                    <!-- Right sidebar (Activities) -->
                    <div class="lg:col-span-1 p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                         <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Atividades Recentes</h3>
                         <div class="space-y-6">
                            <div class="flex">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 flex items-center justify-center font-bold text-gray-500 dark:text-gray-400">AL</div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><b class="text-gray-800 dark:text-white">Adriano Lata</b> deu baixa de 1 caixas, o equivalente a 400 unidades de Ceftriaxona.</p>
                                </div>
                            </div>
                             <div class="flex">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 flex items-center justify-center font-bold text-gray-500 dark:text-gray-400">AL</div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><b class="text-gray-800 dark:text-white">Adriano Lata</b> deu baixa de 2 caixas, o equivalente a 1200 unidades de Cefotaxima.</p>
                                </div>
                            </div>
                             <div class="flex">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 flex items-center justify-center font-bold text-gray-500 dark:text-gray-400">AL</div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><b class="text-gray-800 dark:text-white">Adriano Lata</b> adicionou cerca de 5 caixas, equivalente a 1000 unidades de Ibuprofeno.</p>
                                </div>
                            </div>
                              <div class="flex">
                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex-shrink-0 flex items-center justify-center font-bold text-gray-500 dark:text-gray-400">AL</div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-300"><b class="text-gray-800 dark:text-white">Adriano Lata</b> adicionou cerca de 10 caixas, equivalente a 1000 unidades de Eritromicina.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
