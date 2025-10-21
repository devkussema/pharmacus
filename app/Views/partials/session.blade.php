{{-- 
    Partial de mensagens flash
    Autor: Augusto Kussema
    Data de criação: 2025-10-21

    Exibe várias chaves de flash comuns do Laravel.
--}}

@php
        /**
         * Lista de chaves de flash e as classes CSS correspondentes.
         * Ajuste as classes conforme o framework CSS do projeto (Bootstrap/Tailwind).
         */
        $flashMap = [
                'success'   => 'alert-success',
                'status'    => 'alert-info',
                'message'   => 'alert-secondary',
                'info'      => 'alert-info',
                'warning'   => 'alert-warning',
                'error'     => 'alert-danger',
                'danger'    => 'alert-danger',
                'alert'     => 'alert-warning',
                'primary'   => 'alert-primary',
                'secondary' => 'alert-secondary',
                'toast'     => 'alert-info',
        ];
@endphp

{{-- Mensagens de validação --}}
@if (isset($errors) && $errors->any())
        <div class="alert alert-danger" role="alert">
                <strong>Ocorreram erros na validação:</strong>
                <button type="button" aria-label="Fechar" onclick="this.parentElement.remove()">×</button>
                <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                        @endforeach
                </ul>
        </div>
@endif

{{-- Flash messages padrões --}}
@foreach ($flashMap as $key => $class)
        @if (session()->has($key))
                @php
                        $payload = session()->get($key);
                        // Normaliza para array para exibir múltiplas mensagens se necessário
                        $items = is_array($payload) ? $payload : [$payload];
                @endphp

                <div class="alert {{ $class }}" role="alert">
                        <button type="button" aria-label="Fechar" onclick="this.parentElement.remove()">×</button>

                        @if (count($items) === 1)
                                {{ $items[0] }}
                        @else
                                <ul class="mb-0">
                                        @foreach ($items as $item)
                                                <li>{{ $item }}</li>
                                        @endforeach
                                </ul>
                        @endif
                </div>
        @endif
@endforeach

{{-- Chave genérica 'flash' ou 'flash_message' --}}
@foreach (['flash', 'flash_message', 'notice', 'notices'] as $generic)
        @if (session()->has($generic))
                @php
                        $payload = session()->get($generic);
                        $items = is_array($payload) ? $payload : [$payload];
                @endphp

                <div class="alert alert-info" role="alert">
                        <button type="button" aria-label="Fechar" onclick="this.parentElement.remove()">×</button>

                        @if (count($items) === 1)
                                {{ $items[0] }}
                        @else
                                <ul class="mb-0">
                                        @foreach ($items as $item)
                                                <li>{{ $item }}</li>
                                        @endforeach
                                </ul>
                        @endif
                </div>
        @endif
@endforeach

{{-- Sugestões de melhoria:
        1. Integrar com componentes Blade (ex: <x-alert>) para reuso.
        2. Adicionar transições JS/CSS e tempo de autoclose para toasts.
        3. Mapear classes para Tailwind se o projeto usar Tailwind.
--}}