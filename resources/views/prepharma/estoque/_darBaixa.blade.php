{{--
/**
 * Offcanvas para Dar Baixa de Estoque
 * @author Augusto Kussema
 * @date 03/11/2025 às 16:00 (Luanda)
 * @description Offcanvas moderno para transferir produtos entre áreas
 */
--}}
<style>
    /* ========== Offcanvas Dar Baixa ========== */
    .offcanvas-dar-baixa {
        --bs-offcanvas-width: min(50vw, 600px) !important;
        box-shadow: -4px 0 24px rgba(0,0,0,0.12);
    }

    .offcanvas-dar-baixa .offcanvas-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .offcanvas-dar-baixa .offcanvas-header h5 {
        color: white;
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0;
    }

    .offcanvas-dar-baixa .offcanvas-header small {
        color: rgba(255,255,255,0.90);
        font-size: 0.875rem;
    }

    .offcanvas-dar-baixa .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }

    .offcanvas-dar-baixa .btn-close:hover { opacity: 1; }

    .offcanvas-dar-baixa .offcanvas-body {
        padding: 2rem;
        background: #f8f9fa;
    }

    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-left: 4px solid #667eea;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .info-card-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
        font-size: 0.9375rem;
    }

    .info-card-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #667eea;
    }

    .info-card-label {
        font-size: 0.8125rem;
        color: #718096;
    }
</style>

<div class="offcanvas offcanvas-end offcanvas-dar-baixa" tabindex="-1" id="offcanvasDarBaixa" aria-labelledby="offcanvasDarBaixaLabel">
    <div class="offcanvas-header">
        <div>
            <h5 id="offcanvasDarBaixaLabel">
                <i class="fa fa-arrow-down me-2"></i>Dar Baixa / Transferir
            </h5>
            <small id="offcanvasDarBaixaSubtitle">Transferir produto para outra área</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body">
        <form id="formBaixaEstoque">
            @csrf
            @php
                $area_h_id = $area_id ?? $ah->id ?? null;
                $farmacia_id = @auth()->user()->isFarmacia->farmacia_id
                    ? auth()->user()->isFarmacia->farmacia_id
                    : @auth()->user()->area_hospitalar->area_hospitalar->farmacia_id;
            @endphp

            <input type="hidden" name="user_id" id="baixa_user_id">
            <input type="hidden" name="produto_id" id="baixa_produto_id">
            <input type="hidden" name="quantidade_disponivel" id="baixa_quantidade_disponivel">

            <!-- Info do Produto -->
            <div class="info-card">
                <div class="info-card-title">Produto Selecionado</div>
                <div class="info-card-value" id="baixa_designacao_display">—</div>
                <div class="info-card-label mt-2">
                    Quantidade Disponível: <strong id="baixa_qtd_display">0</strong> unidades
                </div>
            </div>

            <!-- Área de Destino -->
            <div class="form-card mb-3">
                <label class="form-label">
                    <i class="fa fa-hospital me-1"></i>
                    Área de Destino *
                </label>
                <select name="area_hospitalar_id" id="baixa_area_select" class="form-control" required>
                    <option value="">Selecionar área...</option>
                    @foreach (\App\Models\FarmaciaAreaHospitalar::where('farmacia_id', $farmacia_id)->get() as $ahw)
                        @if ($ahw->area_hospitalar->id != $area_h_id)
                            <option value="{{ $ahw->area_hospitalar->id }}">
                                {{ $ahw->area_hospitalar->nome }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Quantidade a Transferir -->
            <div class="form-card mb-3">
                <label class="form-label">
                    <i class="fa fa-exchange-alt me-1"></i>
                    Quantidade a Transferir *
                </label>
                <input type="number" name="quantidade" class="form-control form-control-lg"
                       id="baixa_quantidade" placeholder="Ex: 100" min="1" required>
                <div class="form-hint">
                    <i class="fa fa-info-circle"></i>
                    <span>Informe quantas unidades deseja transferir</span>
                </div>
            </div>

            <!-- Data do Movimento -->
            <div class="form-card">
                <label class="form-label">
                    <i class="fa fa-calendar me-1"></i>
                    Data do Movimento
                </label>
                <input type="datetime-local" name="movement_date" id="baixa_movement_date" class="form-control">
            </div>
        </form>
    </div>

    <div class="action-buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
            <i class="fa fa-times me-2"></i>Cancelar
        </button>
        <button type="submit" class="btn btn-success" id="baixa_submit_btn" form="formBaixaEstoque">
            <span id="baixa_submit_text">
                <i class="fa fa-paper-plane me-2"></i>Enviar
            </span>
            <span id="baixa_submit_spinner" style="display:none;">
                <span class="spinner-custom"></span>
                <span class="ms-2">Processando...</span>
            </span>
        </button>
    </div>
</div>
