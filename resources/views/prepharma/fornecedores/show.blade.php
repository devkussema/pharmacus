@extends('layout.app')

@section('titulo', 'Lista de Fornecedores')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Fornecedores </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Lista de Fornecedores</li>
                </ul>
            </div>
        </div>
    </div>
        @include('partials.session')

    @include('prepharma.fornecedores._listaModerna')
</div>

@include('prepharma.fornecedores._editFornecedor')

@include('prepharma.fornecedores._detalhesFornecedor')

@include('prepharma.fornecedores._historicoFornecedor')

<!-- Toast Container -->
<div class="toast-container-custom" id="toastContainer"></div>

<style>
    /* Toast Notifications */
    .toast-container-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .toast-custom {
        min-width: 300px;
        max-width: 400px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideInRight 0.3s ease;
        opacity: 0;
    }

    .toast-custom.show {
        opacity: 1;
        animation: slideInRight 0.3s ease forwards;
    }

    .toast-custom.hiding {
        animation: slideOutRight 0.3s ease forwards;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    .toast-custom .toast-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .toast-custom.toast-success .toast-icon {
        background: #28a745;
        color: #fff;
    }

    .toast-custom.toast-error .toast-icon {
        background: #dc3545;
        color: #fff;
    }

    .toast-custom.toast-info .toast-icon {
        background: #17a2b8;
        color: #fff;
    }

    .toast-custom.toast-warning .toast-icon {
        background: #ffc107;
        color: #333;
    }

    .toast-custom .toast-content {
        flex: 1;
    }

    .toast-custom .toast-title {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .toast-custom.toast-success .toast-title {
        color: #28a745;
    }

    .toast-custom.toast-error .toast-title {
        color: #dc3545;
    }

    .toast-custom.toast-info .toast-title {
        color: #17a2b8;
    }

    .toast-custom.toast-warning .toast-title {
        color: #856404;
    }

    .toast-custom .toast-message {
        font-size: 0.9rem;
        color: #666;
    }

    .toast-custom .toast-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #999;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .toast-custom .toast-close:hover {
        background: #f0f0f0;
        color: #333;
    }
</style>

<script>
    /**
     * Sistema de Toast Notifications
     * @param {string} message - Mensagem a exibir
     * @param {string} type - Tipo: success, error, info, warning
     * @param {string} title - Título opcional
     * @param {number} duration - Duração em ms (padrão: 4000)
     */
    window.showToast = function(message, type = 'info', title = '', duration = 4000) {
        const icons = {
            success: '✓',
            error: '✕',
            info: 'ℹ',
            warning: '⚠'
        };

        const titles = {
            success: title || 'Sucesso',
            error: title || 'Erro',
            info: title || 'Informação',
            warning: title || 'Atenção'
        };

        const toast = $(`
            <div class="toast-custom toast-${type}">
                <div class="toast-icon">${icons[type]}</div>
                <div class="toast-content">
                    <div class="toast-title">${titles[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close">&times;</button>
            </div>
        `);

        $('#toastContainer').append(toast);

        // Mostra o toast
        setTimeout(() => toast.addClass('show'), 10);

        // Remove ao clicar no botão fechar
        toast.find('.toast-close').on('click', function() {
            removeToast(toast);
        });

        // Remove automaticamente após a duração
        setTimeout(() => {
            removeToast(toast);
        }, duration);

        function removeToast(element) {
            element.addClass('hiding');
            setTimeout(() => element.remove(), 300);
        }
    };
</script>
@endsection
