<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Ocorrências - Pharmatina</title>
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
            border-left: 4px solid #38bdf8;
        }
        .card-border-light {
            border-left: 4px solid #0ea5e9;
        }
        .filter-panel-dark {
            background: linear-gradient(90deg, #23263a 0%, #2d3250 100%);
        }
        .filter-panel-light {
            background: linear-gradient(90deg, #e3e8f0 0%, #f8fafc 100%);
        }
    </style>
</head>
<body x-data="occurrencesApp" :class="theme === 'dark' ? 'bg-[#181a26] text-slate-200' : 'bg-slate-100 text-slate-900'" class="antialiased min-h-screen">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside :class="theme === 'dark' ? 'sidebar-gradient-dark' : 'sidebar-gradient-light'" class="w-20 flex flex-col items-center py-6 space-y-8 shadow-lg">
        <div :class="theme === 'dark' ? 'bg-sky-500 text-white' : 'bg-sky-100 text-sky-600'" class="w-12 h-12 flex items-center justify-center rounded-xl font-bold text-2xl mb-4 shadow-lg">P</div>
        <nav class="flex flex-col space-y-6">
            <a href="{{ route('ocorrencia.dashboard.page', ['page' => 'home']) }}" class="group flex flex-col items-center" :class="theme === 'dark' ? 'text-slate-400 hover:text-sky-400' : 'text-slate-500 hover:text-sky-600'" >
                <svg class="w-7 h-7 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                <span class="text-xs font-fira">Início</span>
            </a>
            <a href="{{ route('ocorrencia.dashboard.page') }}" class="group flex flex-col items-center" :class="theme === 'dark' ? 'text-sky-400' : 'text-sky-600'">
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
                <h1 class="text-2xl font-fira font-bold tracking-wide" :class="theme === 'dark' ? 'text-sky-400' : 'text-sky-600'">Painel de Ocorrências</h1>
                <span :class="theme === 'dark' ? 'bg-green-600/20 text-green-400' : 'bg-green-100 text-green-700'" class="px-2 py-1 rounded font-mono text-xs ml-2">Pharmatina</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="font-fira text-sm" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Bem-vindo(a)</span>
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

        <!-- Painel de Cadastro Simples -->
        <main :class="theme === 'dark' ? 'bg-[#181a26]' : 'bg-slate-100'" class="flex-1 px-8 py-8">
            <div class="max-w-3xl mx-auto">
                <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-2xl p-8 mb-8">
                    <h2 class="text-xl font-bold font-fira mb-6" :class="theme === 'dark' ? 'text-sky-300' : 'text-sky-600'">
                        Cadastro Diário de Dispensação
                    </h2>
                    <form @submit.prevent="addDispense" class="flex flex-col md:flex-row md:items-end gap-4">
                        <div>
                            <label class="text-xs font-fira" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Ano</label>
                            <select x-model="formYear" required :class="theme === 'dark' ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-900'" class="w-24 p-2 rounded-md text-sm font-fira">
                                <template x-for="year in availableYears" :key="year">
                                    <option :value="year" x-text="year"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-fira" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Mês</label>
                            <select x-model="formMonth" required :class="theme === 'dark' ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-900'" class="w-28 p-2 rounded-md text-sm font-fira">
                                <template x-for="(month, idx) in months" :key="idx">
                                    <option :value="idx+1" x-text="month"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-fira" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Dia</label>
                            <input type="number" min="1" max="31" x-model="formDay" required :placeholder="nextDaySuggestion" :class="theme === 'dark' ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-900'" class="w-20 p-2 rounded-md text-sm font-fira">
                        </div>
                        <div>
                            <label class="text-xs font-fira" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Medicamento</label>
                            <input type="text" x-model="formMedication" required placeholder="Nome" :class="theme === 'dark' ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-900'" class="w-40 p-2 rounded-md text-sm font-fira">
                        </div>
                        <div>
                            <label class="text-xs font-fira" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">Quantidade</label>
                            <input type="number" min="1" x-model="formQuantity" required placeholder="Qtd." :class="theme === 'dark' ? 'bg-slate-800 text-slate-200' : 'bg-white text-slate-900'" class="w-20 p-2 rounded-md text-sm font-fira">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-sky-500 to-indigo-500 hover:from-sky-600 hover:to-indigo-600 text-white font-fira font-semibold px-5 py-2 rounded-md shadow transition-all mt-4 md:mt-0">
                            Adicionar
                        </button>
                    </form>
                </div>

                <!-- Tabela de Registros -->
                <div :class="theme === 'dark' ? 'bg-slate-900/80 card-border-dark' : 'bg-white card-border-light'" class="rounded-xl shadow-2xl p-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold font-fira text-lg" :class="theme === 'dark' ? 'text-sky-300' : 'text-sky-600'">
                            Registros do mês <span x-text="months[formMonth-1]"></span> de <span x-text="formYear"></span>
                        </h3>
                        <span class="font-fira text-sm" :class="theme === 'dark' ? 'text-slate-400' : 'text-slate-500'">
                            Média diária: <span x-text="averageDispensed"></span>
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left font-fira">
                            <thead :class="theme === 'dark' ? 'bg-slate-800 text-sky-300' : 'bg-slate-100 text-sky-600'" class="text-xs uppercase">
                                <tr>
                                    <th class="p-3">Data</th>
                                    <th class="p-3">Medicamento</th>
                                    <th class="p-3 text-center">Qtd.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="filteredDispenses.length === 0">
                                    <tr>
                                        <td colspan="3" class="p-4 text-center italic" :class="theme === 'dark' ? 'text-slate-500' : 'text-slate-400'">Nenhum registro para o mês selecionado.</td>
                                    </tr>
                                </template>
                                <template x-for="item in filteredDispenses" :key="item.id">
                                    <tr :class="theme === 'dark' ? 'border-b border-slate-800 hover:bg-sky-900/30' : 'border-b border-slate-200 hover:bg-sky-100/40'" class="transition-colors duration-150">
                                        <td class="p-3 font-medium" :class="theme === 'dark' ? 'text-sky-200' : 'text-sky-700'" x-text="item.day + '/' + (formMonth < 10 ? '0'+formMonth : formMonth) + '/' + formYear"></td>
                                        <td class="p-3" :class="theme === 'dark' ? 'text-slate-200' : 'text-slate-900'" x-text="item.medication"></td>
                                        <td class="p-3 text-center" :class="theme === 'dark' ? 'text-slate-300' : 'text-slate-700'" x-text="item.quantity"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('occurrencesApp', () => ({
            // Theme
            theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', this.theme);
            },

            // Form fields
            formYear: new Date().getFullYear(),
            formMonth: new Date().getMonth() + 1,
            formDay: '',
            formMedication: '',
            formQuantity: '',

            // Data
            availableYears: [],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            dispenses: [
                // Exemplo inicial
                { id: 1, year: 2024, month: 7, day: 1, medication: 'Dipirona', quantity: 10 },
                { id: 2, year: 2024, month: 7, day: 2, medication: 'Paracetamol', quantity: 8 },
                { id: 3, year: 2024, month: 7, day: 3, medication: 'Amoxicilina', quantity: 5 },
            ],

            init() {
                const currentYear = new Date().getFullYear();
                for (let i = -2; i < 3; i++) {
                    this.availableYears.push(currentYear + i);
                }
                this.formYear = currentYear;
                this.formMonth = new Date().getMonth() + 1;
                this.suggestNextDay();
            },

            get filteredDispenses() {
                return this.dispenses
                    .filter(d => d.year === Number(this.formYear) && d.month === Number(this.formMonth))
                    .sort((a, b) => a.day - b.day);
            },

            get averageDispensed() {
                const items = this.filteredDispenses;
                if (items.length === 0) return '0';
                const total = items.reduce((sum, d) => sum + Number(d.quantity), 0);
                return (total / items.length).toFixed(2);
            },

            get nextDaySuggestion() {
                const days = this.filteredDispenses.map(d => d.day);
                if (days.length === 0) return 1;
                return Math.max(...days) + 1;
            },

            addDispense() {
                if (!this.formDay || !this.formMedication || !this.formQuantity) return;
                this.dispenses.push({
                    id: Date.now(),
                    year: Number(this.formYear),
                    month: Number(this.formMonth),
                    day: Number(this.formDay),
                    medication: this.formMedication,
                    quantity: Number(this.formQuantity)
                });
                this.formDay = this.nextDaySuggestion;
                this.formMedication = '';
                this.formQuantity = '';
            },

            suggestNextDay() {
                this.formDay = this.nextDaySuggestion;
            },

            $watch: {
                formYear() { this.suggestNextDay(); },
                formMonth() { this.suggestNextDay(); }
            }
        }));
    });
</script>
</body>
</html>
