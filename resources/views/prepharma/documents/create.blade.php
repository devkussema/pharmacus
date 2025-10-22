@extends('layout.app')

@section('titulo', 'Adicionar Documento')

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-0">Adicionar Documento</h3>
                        <p class="text-muted mb-0">Arraste e solte ficheiros ou clique para selecionar</p>
                    </div>
                    <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-2"></i>Voltar
                    </a>
                </div>

                <!-- Drag & Drop Zone -->
                <div class="card smart-upload-card">
                    <div class="card-body p-0">
                        <div id="dropZone" class="smart-drop-zone">
                            <div class="drop-content">
                                <div class="upload-icon">
                                    <i class="fa fa-cloud-upload-alt"></i>
                                    <div class="upload-pulse"></div>
                                </div>
                                <h4 class="drop-title">Arraste e solte os seus ficheiros aqui</h4>
                                <p class="drop-subtitle text-muted">ou clique para selecionar ficheiros</p>
                                <div class="supported-formats">
                                    <span class="format-badge">PDF</span>
                                    <span class="format-badge">DOC/DOCX</span>
                                    <span class="format-badge">XLS/XLSX</span>
                                    <span class="format-badge">PPT/PPTX</span>
                                </div>
                            </div>
                            <input type="file" id="fileInput" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                                hidden>
                            <div class="drop-overlay">
                                <div class="overlay-content">
                                    <i class="fa fa-download fa-3x text-white"></i>
                                    <h3 class="text-white mt-3">Solte os ficheiros aqui</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Progress -->
                <div id="uploadProgress" class="card mt-4 d-none">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fa fa-upload me-2"></i>A carregar ficheiros...</h6>
                    </div>
                    <div class="card-body">
                        <div id="progressList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sofisticado -->
    <div class="modal fade" id="documentModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content smart-modal">
                <div class="modal-header gradient-header">
                    <div class="d-flex align-items-center">
                        <div class="file-preview-icon me-3">
                            <i id="modalFileIcon" class="fa fa-file fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0">Adicionar Documento</h5>
                            <small class="text-muted">Preencha os detalhes do documento</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="documentForm" class="smart-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- File Info Section -->
                            <div class="col-md-6">
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fa fa-file-alt me-2"></i>Informações do Ficheiro
                                    </h6>

                                    <div class="mb-3">
                                        <label class="form-label">Nome do Documento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-signature"></i></span>
                                            <input type="text" name="name" id="fileName" class="form-control"
                                                placeholder="Nome do documento..." required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tipo de Documento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-tags"></i></span>
                                            <select name="document_type" id="fileType" class="form-select" required>
                                                <option value="">Selecionar tipo...</option>
                                                @foreach(\App\Models\Document::DOCUMENT_TYPES as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descrição</label>
                                        <textarea name="description" id="fileDescription" class="form-control" rows="3"
                                            placeholder="Descrição do documento..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Metadata Section -->
                            <div class="col-md-6">
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fa fa-info-circle me-2"></i>Metadados</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Data do Documento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="date" name="document_date" id="fileDate" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Fornecedor/Autor</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            <input type="text" name="author" id="fileAuthor" class="form-control"
                                                placeholder="Nome do fornecedor ou autor...">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Departamento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                            <select name="department" id="fileDepartment" class="form-select">
                                                <option value="">Selecionar departamento...</option>
                                                @foreach(\App\Models\Document::DEPARTMENTS as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nível de Acesso</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            <select name="access_level" id="fileAccess" class="form-select" required>
                                                @foreach(\App\Models\Document::ACCESS_LEVELS as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-folder"></i></span>
                                            <input type="text" name="category" id="fileCategory" class="form-control"
                                                placeholder="Categoria do documento...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tags Section -->
                        <div class="form-section">
                            <h6 class="section-title"><i class="fa fa-tags me-2"></i>Etiquetas</h6>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                    <input type="text" name="tags" id="fileTags" class="form-control"
                                        placeholder="Adicionar etiquetas (separadas por vírgula)...">
                                </div>
                                <div class="form-text">Exemplo: urgente, revisão, 2025, farmácia</div>
                            </div>
                            <div id="tagPreview" class="tag-preview"></div>
                        </div>

                        <!-- Notas adicionais -->
                        <div class="form-section">
                            <h6 class="section-title"><i class="fa fa-sticky-note me-2"></i>Notas Adicionais</h6>
                            <div class="mb-3">
                                <textarea name="notes" id="fileNotes" class="form-control" rows="2"
                                    placeholder="Notas ou observações adicionais..."></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer gradient-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" id="saveDocument" class="btn btn-primary btn-gradient">
                        <i class="fa fa-save me-2"></i>Guardar Documento
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Container de Notificações Personalizadas -->
    <div id="notificationContainer" class="notification-container"></div>

    @push('styles')
        <style>
            /* Sistema de Notificações Personalizadas */
            .notification-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
            }

            .custom-notification {
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
                margin-bottom: 15px;
                padding: 16px 20px;
                border-left: 4px solid #007bff;
                transform: translateX(100%);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                overflow: hidden;
                position: relative;
            }

            .custom-notification.show {
                transform: translateX(0);
                opacity: 1;
            }

            .custom-notification.success {
                border-left-color: #28a745;
            }

            .custom-notification.error {
                border-left-color: #dc3545;
            }

            .custom-notification.warning {
                border-left-color: #ffc107;
            }

            .custom-notification.info {
                border-left-color: #17a2b8;
            }

            .notification-content {
                display: flex;
                align-items: flex-start;
                gap: 12px;
            }

            .notification-icon {
                font-size: 20px;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .notification-icon.success {
                color: #28a745;
            }

            .notification-icon.error {
                color: #dc3545;
            }

            .notification-icon.warning {
                color: #ffc107;
            }

            .notification-icon.info {
                color: #17a2b8;
            }

            .notification-text {
                flex: 1;
            }

            .notification-title {
                font-weight: 600;
                font-size: 14px;
                margin-bottom: 4px;
                color: #333;
            }

            .notification-message {
                font-size: 13px;
                color: #666;
                line-height: 1.4;
            }

            .notification-close {
                background: none;
                border: none;
                font-size: 18px;
                color: #999;
                cursor: pointer;
                padding: 0;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                transition: all 0.2s;
                flex-shrink: 0;
            }

            .notification-close:hover {
                background: #f8f9fa;
                color: #666;
            }

            .notification-progress {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 3px;
                background: linear-gradient(90deg, #007bff, #0056b3);
                transition: width 0.1s linear;
            }

            .notification-progress.success {
                background: linear-gradient(90deg, #28a745, #1e7e34);
            }

            .notification-progress.error {
                background: linear-gradient(90deg, #dc3545, #c82333);
            }

            .notification-progress.warning {
                background: linear-gradient(90deg, #ffc107, #e0a800);
            }

            .notification-progress.info {
                background: linear-gradient(90deg, #17a2b8, #138496);
            }

            /* Smart Upload Zone */
            .smart-upload-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .smart-drop-zone {
                position: relative;
                padding: 80px 40px;
                text-align: center;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border: 3px dashed #dee2e6;
                border-radius: 20px;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                min-height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
            }

            .smart-drop-zone:hover {
                border-color: #007bff;
                background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
                transform: translateY(-2px);
            }

            .smart-drop-zone.drag-over {
                border-color: #28a745;
                background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
                transform: scale(1.01);
            }

            .upload-icon {
                position: relative;
                display: inline-block;
                font-size: 4rem;
                color: #007bff;
                margin-bottom: 20px;
            }

            .upload-pulse {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 80px;
                height: 80px;
                border: 2px solid #007bff;
                border-radius: 50%;
                transform: translate(-50%, -50%);
                opacity: 0;
                animation: upload-pulse 2s ease-in-out infinite;
            }

            @keyframes upload-pulse {
                0% {
                    transform: translate(-50%, -50%) scale(1);
                    opacity: 0.7;
                }

                70% {
                    transform: translate(-50%, -50%) scale(1.4);
                    opacity: 0;
                }

                100% {
                    transform: translate(-50%, -50%) scale(1.6);
                    opacity: 0;
                }
            }

            .drop-title {
                color: #495057;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .drop-subtitle {
                font-size: 1.1rem;
                margin-bottom: 30px;
            }

            .supported-formats {
                display: flex;
                justify-content: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .format-badge {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                color: white;
                padding: 5px 12px;
                border-radius: 15px;
                font-size: 0.85rem;
                font-weight: 500;
            }

            .drop-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(40, 167, 69, 0.9) 0%, rgba(25, 135, 84, 0.9) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                border-radius: 20px;
            }

            .smart-drop-zone.drag-over .drop-overlay {
                opacity: 1;
                visibility: visible;
            }

            /* Smart Modal */
            .smart-modal {
                border: none;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            }

            .gradient-header {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                color: white;
                border: none;
                padding: 25px 30px;
            }

            .gradient-footer {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border: none;
                padding: 20px 30px;
            }

            .file-preview-icon {
                width: 60px;
                height: 60px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .smart-form {
                padding: 20px 0;
            }

            .form-section {
                margin-bottom: 30px;
            }

            .section-title {
                color: #495057;
                font-weight: 600;
                border-bottom: 2px solid #e9ecef;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .form-label {
                font-weight: 500;
                color: #495057;
                margin-bottom: 8px;
            }

            .input-group-text {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-color: #dee2e6;
                color: #6c757d;
            }

            .form-control,
            .form-select {
                border-color: #dee2e6;
                transition: all 0.3s ease;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .btn-gradient {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                border: none;
                transition: all 0.3s ease;
            }

            .btn-gradient:hover {
                background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
                transform: translateY(-1px);
                box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            }

            /* Tag Preview */
            .tag-preview {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 10px;
            }

            .tag-item {
                background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
                color: #495057;
                padding: 5px 12px;
                border-radius: 15px;
                font-size: 0.85rem;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .tag-remove {
                cursor: pointer;
                color: #dc3545;
                font-weight: bold;
            }

            .tag-remove:hover {
                color: #a71e2a;
            }

            /* Progress */
            .progress-item {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 15px;
                background: #f8f9fa;
                border-radius: 10px;
                margin-bottom: 10px;
            }

            .progress-icon {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }

            .progress-info {
                flex: 1;
            }

            .progress-bar-container {
                width: 200px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // === SISTEMA DE NOTIFICAÇÕES PERSONALIZADAS ===
                class NotificationSystem {
                    constructor() {
                        this.container = document.getElementById('notificationContainer');
                        this.notifications = [];
                    }

                    show(message, type = 'info', title = null, duration = 5000) {
                        const notification = this.create(message, type, title, duration);
                        this.container.appendChild(notification);

                        // Trigger animation
                        requestAnimationFrame(() => {
                            notification.classList.add('show');
                            this.startProgress(notification, duration);
                        });

                        // Auto remove
                        setTimeout(() => {
                            this.remove(notification);
                        }, duration);

                        return notification;
                    }

                    create(message, type, title, duration) {
                        const id = 'notification-' + Date.now() + Math.random();
                        const iconMap = {
                            success: 'fa-check-circle',
                            error: 'fa-exclamation-circle',
                            warning: 'fa-exclamation-triangle',
                            info: 'fa-info-circle'
                        };

                        const titleMap = {
                            success: title || 'Sucesso!',
                            error: title || 'Erro!',
                            warning: title || 'Atenção!',
                            info: title || 'Informação'
                        };

                        const notification = document.createElement('div');
                        notification.className = `custom-notification ${type}`;
                        notification.id = id;
                        notification.innerHTML = `
                        <div class="notification-content">
                            <i class="fa ${iconMap[type]} notification-icon ${type}"></i>
                            <div class="notification-text">
                                <div class="notification-title">${titleMap[type]}</div>
                                <div class="notification-message">${message}</div>
                            </div>
                            <button class="notification-close" onclick="notificationSystem.remove(document.getElementById('${id}'))">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <div class="notification-progress ${type}" style="width: 100%"></div>
                    `;

                        return notification;
                    }

                    startProgress(notification, duration) {
                        const progressBar = notification.querySelector('.notification-progress');
                        let width = 100;
                        const decrement = 100 / (duration / 50);

                        const timer = setInterval(() => {
                            width -= decrement;
                            if (width <= 0) {
                                clearInterval(timer);
                                progressBar.style.width = '0%';
                            } else {
                                progressBar.style.width = width + '%';
                            }
                        }, 50);
                    }

                    remove(notification) {
                        if (notification && notification.parentNode) {
                            notification.style.transform = 'translateX(100%)';
                            notification.style.opacity = '0';
                            setTimeout(() => {
                                if (notification.parentNode) {
                                    notification.parentNode.removeChild(notification);
                                }
                            }, 400);
                        }
                    }

                    success(message, title = null) {
                        return this.show(message, 'success', title);
                    }

                    error(message, title = null) {
                        return this.show(message, 'error', title);
                    }

                    warning(message, title = null) {
                        return this.show(message, 'warning', title);
                    }

                    info(message, title = null) {
                        return this.show(message, 'info', title);
                    }
                }

                // Instância global do sistema de notificações
                window.notificationSystem = new NotificationSystem();

                // === ELEMENTOS PRINCIPAIS ===
                const dropZone = document.getElementById('dropZone');
                const fileInput = document.getElementById('fileInput');
                const documentModalElement = document.getElementById('documentModal');
                const uploadProgress = document.getElementById('uploadProgress');
                const progressList = document.getElementById('progressList');

                // Verificar se elementos essenciais existem
                if (!dropZone || !fileInput || !documentModalElement) {
                    console.error('Elementos DOM essenciais não encontrados');
                    notificationSystem.error('Erro de inicialização da página', 'Elementos não encontrados');
                    return;
                }

                const documentModal = new bootstrap.Modal(documentModalElement);

                // Tornar variáveis acessíveis a funções fora deste escopo
                window.currentFiles = [];
                window.isHandlingFiles = false;

                // === EVENTOS DRAG & DROP ===
                dropZone.addEventListener('click', (e) => {
                    e.preventDefault();
                    fileInput.click();
                });

                dropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    if (dropZone) {
                        dropZone.classList.add('drag-over');
                    }
                });

                dropZone.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    if (dropZone && !dropZone.contains(e.relatedTarget)) {
                        dropZone.classList.remove('drag-over');
                    }
                });

                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    if (dropZone) {
                        dropZone.classList.remove('drag-over');
                    }
                    if (!window.isHandlingFiles) {
                        handleFiles(e.dataTransfer.files);
                    }
                });

                fileInput.addEventListener('change', (e) => {
                    if (!window.isHandlingFiles) {
                        handleFiles(e.target.files);
                    }
                    // Reset file input
                    e.target.value = '';
                });

                // === INICIALIZAÇÃO ===
                notificationSystem.info('Sistema de upload carregado e pronto para uso!', 'Sistema iniciado');

                // === EVENTOS DO MODAL ===
                documentModalElement.addEventListener('hidden.bs.modal', function () {
                    // Reset quando o modal fecha
                    window.isHandlingFiles = false;
                    if (dropZone) {
                        dropZone.classList.remove('drag-over');
                    }
                    resetForm();
                });
            });

            // Handle Files
            function handleFiles(files) {
                if (files.length === 0 || window.isHandlingFiles) return;

                window.isHandlingFiles = true;
                window.currentFiles = Array.from(files);

                console.log('Handling files:', files.length);

                if (files.length === 1) {
                    // Armazenar o ficheiro atual
                    currentFile = files[0];
                    // Open modal for single file
                    openDocumentModal(files[0]);
                } else {
                    // Show upload progress for multiple files
                    showUploadProgress(files);
                }
            }

            // Open Document Modal
            function openDocumentModal(file) {
                console.log('Opening modal for file:', file.name);

                const fileName = document.getElementById('fileName');
                const fileType = document.getElementById('fileType');
                const fileDate = document.getElementById('fileDate');
                const modalIcon = document.getElementById('modalFileIcon');
                // Garantir instância do modal disponível neste escopo
                const dmEl = document.getElementById('documentModal');
                const dmInstance = bootstrap.Modal.getOrCreateInstance(dmEl);

                // Reset form first
                resetForm();

                // Auto-fill file name
                const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
                fileName.value = nameWithoutExt;

                // Auto-detect file type
                const ext = file.name.split('.').pop().toLowerCase();
                autoDetectFileType(ext, fileType);

                // Set current date
                fileDate.value = new Date().toISOString().split('T')[0];

                // Update icon
                updateModalIcon(ext, modalIcon);

                // Show modal
                setTimeout(() => {
                    dmInstance.show();
                }, 100);
            }

            // Reset form
            function resetForm() {
                const form = document.getElementById('documentForm');
                if (form) {
                    form.reset();
                }
                document.getElementById('tagPreview').innerHTML = '';
            }

            // Auto-detect file type
            function autoDetectFileType(extension, selectElement) {
                const typeMap = {
                    'pdf': 'manual',
                    'doc': 'relatorio',
                    'docx': 'relatorio',
                    'xls': 'lista',
                    'xlsx': 'lista',
                    'ppt': 'apresentacao',
                    'pptx': 'apresentacao'
                };

                const detectedType = typeMap[extension];
                if (detectedType) {
                    selectElement.value = detectedType;
                }
            }

            // Update modal icon
            function updateModalIcon(extension, iconElement) {
                const iconMap = {
                    'pdf': { class: 'fa-file-pdf', color: '#dc3545' },
                    'doc': { class: 'fa-file-word', color: '#0d6efd' },
                    'docx': { class: 'fa-file-word', color: '#0d6efd' },
                    'xls': { class: 'fa-file-excel', color: '#198754' },
                    'xlsx': { class: 'fa-file-excel', color: '#198754' },
                    'ppt': { class: 'fa-file-powerpoint', color: '#fd7e14' },
                    'pptx': { class: 'fa-file-powerpoint', color: '#fd7e14' }
                };

                const iconInfo = iconMap[extension] || { class: 'fa-file', color: '#6c757d' };
                iconElement.className = `fa ${iconInfo.class} fa-2x`;
                iconElement.style.color = iconInfo.color;
            }

            // Show upload progress
            function showUploadProgress(files) {
                progressList.innerHTML = '';
                uploadProgress.classList.remove('d-none');

                Array.from(files).forEach((file, index) => {
                    const progressItem = createProgressItem(file, index);
                    progressList.appendChild(progressItem);

                    // Simulate upload
                    simulateUpload(progressItem, index);
                });
            }

            // Create progress item
            function createProgressItem(file, index) {
                const ext = file.name.split('.').pop().toLowerCase();
                const iconInfo = getFileIcon(ext);

                const item = document.createElement('div');
                item.className = 'progress-item';
                item.innerHTML = `
                    <div class="progress-icon" style="background: ${iconInfo.color}">
                        <i class="fa ${iconInfo.class}"></i>
                    </div>
                    <div class="progress-info">
                        <div class="fw-bold">${file.name}</div>
                        <small class="text-muted">${formatFileSize(file.size)}</small>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                `;

                return item;
            }

            // Get file icon
            function getFileIcon(extension) {
                const iconMap = {
                    'pdf': { class: 'fa-file-pdf', color: '#dc3545' },
                    'doc': { class: 'fa-file-word', color: '#0d6efd' },
                    'docx': { class: 'fa-file-word', color: '#0d6efd' },
                    'xls': { class: 'fa-file-excel', color: '#198754' },
                    'xlsx': { class: 'fa-file-excel', color: '#198754' },
                    'ppt': { class: 'fa-file-powerpoint', color: '#fd7e14' },
                    'pptx': { class: 'fa-file-powerpoint', color: '#fd7e14' }
                };

                return iconMap[extension] || { class: 'fa-file', color: '#6c757d' };
            }

            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Simulate upload
            function simulateUpload(item, index) {
                const progressBar = item.querySelector('.progress-bar');
                let progress = 0;

                const interval = setInterval(() => {
                    progress += Math.random() * 15;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        progressBar.classList.remove('progress-bar-animated');
                        progressBar.classList.add('bg-success');
                    }
                    progressBar.style.width = progress + '%';
                }, 200);
            }

            // Tag functionality
            const tagsInput = document.getElementById('fileTags');
            const tagPreview = document.getElementById('tagPreview');

            tagsInput.addEventListener('input', function () {
                const tags = this.value.split(',').map(tag => tag.trim()).filter(tag => tag);
                updateTagPreview(tags);
            });

            function updateTagPreview(tags) {
                tagPreview.innerHTML = '';
                tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.className = 'tag-item';
                    tagElement.innerHTML = `
                        ${tag}
                        <span class="tag-remove" onclick="removeTag('${tag}')">&times;</span>
                    `;
                    tagPreview.appendChild(tagElement);
                });
            }

            window.removeTag = function (tagToRemove) {
                const currentTags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);
                const filteredTags = currentTags.filter(tag => tag !== tagToRemove);
                tagsInput.value = filteredTags.join(', ');
                updateTagPreview(filteredTags);
            };

            // Save document
            document.getElementById('saveDocument').addEventListener('click', function () {
                const form = document.getElementById('documentForm');
                const formData = new FormData(form);

                // Adicionar o ficheiro se existir
                if (currentFile) {
                    formData.append('file', currentFile);
                }

                // Validate required fields
                const name = formData.get('name');
                const documentType = formData.get('document_type');
                const documentDate = formData.get('document_date');
                const accessLevel = formData.get('access_level');

                if (!name || !documentType || !documentDate || !accessLevel) {
                    notificationSystem.error(
                        'Por favor, preencha todos os campos obrigatórios: Nome, Tipo, Data e Nível de Acesso.',
                        'Campos obrigatórios'
                    );
                    return;
                }

                if (!currentFile) {
                    notificationSystem.warning(
                        'Por favor, selecione um ficheiro para fazer upload.',
                        'Ficheiro necessário'
                    );
                    return;
                }

                // Desabilitar botão e mostrar loading
                const saveBtn = this;
                const originalText = saveBtn.innerHTML;
                saveBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>A guardar...';
                saveBtn.disabled = true;

                // Enviar dados para o servidor
                fetch('{{ route("documents.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mostrar sucesso
                            saveBtn.innerHTML = '<i class="fa fa-check me-2"></i>Guardado!';
                            saveBtn.classList.remove('btn-primary');
                            saveBtn.classList.add('btn-success');

                            notificationSystem.success(
                                'Documento carregado e guardado com sucesso! Redirecionando...',
                                'Upload concluído'
                            );

                            setTimeout(() => {
                                documentModal.hide();
                                // Redirecionar para a listagem
                                window.location.href = '{{ route("documents.index") }}';
                            }, 1500);
                        } else {
                            // Mostrar erro
                            notificationSystem.error(
                                data.message || 'Erro desconhecido ao guardar documento.',
                                'Erro no servidor'
                            );
                            saveBtn.innerHTML = originalText;
                            saveBtn.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao guardar documento:', error);
                        notificationSystem.error(
                            `Erro de conexão: ${error.message}. Verifique sua conexão e tente novamente.`,
                            'Erro de comunicação'
                        );
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    });
            });

            // Variável para armazenar o ficheiro atual
            let currentFile = null;

            // Cancel button event (fora do DOMContentLoaded, referenciar elementos dinamicamente)
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                btn.addEventListener('click', function () {
                    window.isHandlingFiles = false;
                    const dz = document.getElementById('dropZone');
                    if (dz) {
                        dz.classList.remove('drag-over');
                    }
                });
            });
        </script>
    @endpush

@endsection
