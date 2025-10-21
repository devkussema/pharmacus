@extends('layout.app')

@section('titulo', 'Adicionar Documento')

@section('content')
<div class="content container-fluid">
	<div class="row justify-content-center">
		<div class="col-xl-8 col-lg-10">
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
						<input type="file" id="fileInput" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" hidden>
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
<div class="modal fade" id="documentModal" tabindex="-1" data-bs-backdrop="static">
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
				<form id="documentForm" class="smart-form">
					<div class="row">
						<!-- File Info Section -->
						<div class="col-md-6">
							<div class="form-section">
								<h6 class="section-title"><i class="fa fa-file-alt me-2"></i>Informações do Ficheiro</h6>
								
								<div class="mb-3">
									<label class="form-label">Nome do Documento</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-signature"></i></span>
										<input type="text" id="fileName" class="form-control" placeholder="Nome do documento..." required>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Tipo de Documento</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-tags"></i></span>
										<select id="fileType" class="form-select" required>
											<option value="">Selecionar tipo...</option>
											<option value="manual">Manual de Procedimentos</option>
											<option value="politica">Política</option>
											<option value="relatorio">Relatório</option>
											<option value="lista">Lista de Preços</option>
											<option value="inventario">Inventário</option>
											<option value="apresentacao">Apresentação</option>
											<option value="contrato">Contrato</option>
											<option value="outro">Outro</option>
										</select>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Descrição</label>
									<textarea id="fileDescription" class="form-control" rows="3" placeholder="Descrição do documento..."></textarea>
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
										<input type="date" id="fileDate" class="form-control" required>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Fornecedor/Autor</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
										<input type="text" id="fileAuthor" class="form-control" placeholder="Nome do fornecedor ou autor...">
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Departamento</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-building"></i></span>
										<select id="fileDepartment" class="form-select">
											<option value="">Selecionar departamento...</option>
											<option value="farmacia">Farmácia</option>
											<option value="administracao">Administração</option>
											<option value="financeiro">Financeiro</option>
											<option value="recursos_humanos">Recursos Humanos</option>
											<option value="ti">Tecnologia da Informação</option>
											<option value="qualidade">Qualidade</option>
											<option value="outro">Outro</option>
										</select>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Nível de Acesso</label>
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-lock"></i></span>
										<select id="fileAccess" class="form-select" required>
											<option value="publico">Público</option>
											<option value="restrito">Restrito</option>
											<option value="confidencial">Confidencial</option>
										</select>
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
								<input type="text" id="fileTags" class="form-control" placeholder="Adicionar etiquetas (separadas por vírgula)...">
							</div>
							<div class="form-text">Exemplo: urgente, revisão, 2025, farmácia</div>
						</div>
						<div id="tagPreview" class="tag-preview"></div>
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

@push('styles')
<style>
	/* Smart Upload Zone */
	.smart-upload-card {
		border: none;
		border-radius: 20px;
		box-shadow: 0 10px 30px rgba(0,0,0,0.1);
		overflow: hidden;
	}

	.smart-drop-zone {
		position: relative;
		padding: 60px 40px;
		text-align: center;
		background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
		border: 3px dashed #dee2e6;
		border-radius: 20px;
		cursor: pointer;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		min-height: 300px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.smart-drop-zone:hover {
		border-color: #007bff;
		background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
		transform: translateY(-2px);
	}

	.smart-drop-zone.drag-over {
		border-color: #28a745;
		background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
		transform: scale(1.02);
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
		0% { transform: translate(-50%, -50%) scale(1); opacity: 0.7; }
		70% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
		100% { transform: translate(-50%, -50%) scale(1.6); opacity: 0; }
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
		box-shadow: 0 20px 60px rgba(0,0,0,0.3);
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
		background: rgba(255,255,255,0.2);
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

	.form-control, .form-select {
		border-color: #dee2e6;
		transition: all 0.3s ease;
	}

	.form-control:focus, .form-select:focus {
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
document.addEventListener('DOMContentLoaded', function() {
	const dropZone = document.getElementById('dropZone');
	const fileInput = document.getElementById('fileInput');
	const documentModal = new bootstrap.Modal(document.getElementById('documentModal'));
	const uploadProgress = document.getElementById('uploadProgress');
	const progressList = document.getElementById('progressList');
	
	let currentFiles = [];

	// Drag & Drop Events
	dropZone.addEventListener('click', () => fileInput.click());
	
	dropZone.addEventListener('dragover', (e) => {
		e.preventDefault();
		dropZone.classList.add('drag-over');
	});
	
	dropZone.addEventListener('dragleave', (e) => {
		e.preventDefault();
		if (!dropZone.contains(e.relatedTarget)) {
			dropZone.classList.remove('drag-over');
		}
	});
	
	dropZone.addEventListener('drop', (e) => {
		e.preventDefault();
		dropZone.classList.remove('drag-over');
		handleFiles(e.dataTransfer.files);
	});
	
	fileInput.addEventListener('change', (e) => {
		handleFiles(e.target.files);
	});

	// Handle Files
	function handleFiles(files) {
		if (files.length === 0) return;
		
		currentFiles = Array.from(files);
		
		if (files.length === 1) {
			// Open modal for single file
			openDocumentModal(files[0]);
		} else {
			// Show upload progress for multiple files
			showUploadProgress(files);
		}
	}

	// Open Document Modal
	function openDocumentModal(file) {
		const fileName = document.getElementById('fileName');
		const fileType = document.getElementById('fileType');
		const fileDate = document.getElementById('fileDate');
		const modalIcon = document.getElementById('modalFileIcon');
		
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
		
		documentModal.show();
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
	
	tagsInput.addEventListener('input', function() {
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

	window.removeTag = function(tagToRemove) {
		const currentTags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);
		const filteredTags = currentTags.filter(tag => tag !== tagToRemove);
		tagsInput.value = filteredTags.join(', ');
		updateTagPreview(filteredTags);
	};

	// Save document
	document.getElementById('saveDocument').addEventListener('click', function() {
		const formData = {
			name: document.getElementById('fileName').value,
			type: document.getElementById('fileType').value,
			description: document.getElementById('fileDescription').value,
			date: document.getElementById('fileDate').value,
			author: document.getElementById('fileAuthor').value,
			department: document.getElementById('fileDepartment').value,
			access: document.getElementById('fileAccess').value,
			tags: document.getElementById('fileTags').value
		};
		
		// Validate required fields
		if (!formData.name || !formData.type || !formData.date || !formData.access) {
			alert('Por favor, preencha todos os campos obrigatórios.');
			return;
		}
		
		// Simulate save
		console.log('Saving document:', formData);
		
		// Show success animation
		this.innerHTML = '<i class="fa fa-check me-2"></i>Guardado!';
		this.classList.add('btn-success');
		
		setTimeout(() => {
			documentModal.hide();
			// Redirect or show success message
			window.location.href = '{{ route("documents.index") }}';
		}, 1500);
	});
});
</script>
@endpush

@endsection