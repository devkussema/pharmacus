@extends('layout.app')

@section('titulo', 'Documentos')

@section('content')
<div class="docs-container">
	<!-- Header Hero -->
	<div class="docs-hero">
		<div class="hero-content">
			<div class="hero-text">
				<h1 class="hero-title">Centro de Documentos</h1>
				<p class="hero-subtitle">Gerencie, organize e acesse todos os seus documentos em um só lugar</p>
			</div>
			<div class="hero-actions">
				<div class="search-container">
					<div class="search-wrapper">
						<i class="fa fa-search search-icon"></i>
						<input type="text" id="docSearch" class="smart-search" placeholder="Pesquisar por nome, tipo ou conteúdo...">
						<div class="search-filters" id="searchFilters">
							<span class="filter-tag active" data-type="all">Todos</span>
							<span class="filter-tag" data-type="pdf">PDF</span>
							<span class="filter-tag" data-type="xlsx">Excel</span>
							<span class="filter-tag" data-type="docx">Word</span>
						</div>
					</div>
				</div>
				<div class="view-controls">
					<button class="view-btn active" id="btnGrid" data-view="grid">
						<i class="fa fa-th-large"></i>
					</button>
					<button class="view-btn" id="btnList" data-view="list">
						<i class="fa fa-list"></i>
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Analytics Cards -->
	<div class="analytics-grid">
		<div class="analytics-card primary">
			<div class="card-icon">
				<i class="fa fa-file-text"></i>
			</div>
			<div class="card-content">
				<span class="card-value" id="statTotal">—</span>
				<span class="card-label">Total de Documentos</span>
				<div class="card-trend">
					<i class="fa fa-arrow-up"></i>
					<span>+12% este mês</span>
				</div>
			</div>
		</div>
		<div class="analytics-card success">
			<div class="card-icon">
				<i class="fa fa-file-pdf"></i>
			</div>
			<div class="card-content">
				<span class="card-value" id="statPDF">—</span>
				<span class="card-label">Arquivos PDF</span>
				<div class="card-trend">
					<i class="fa fa-arrow-up"></i>
					<span>+5% esta semana</span>
				</div>
			</div>
		</div>
		<div class="analytics-card warning">
			<div class="card-icon">
				<i class="fa fa-file-excel"></i>
			</div>
			<div class="card-content">
				<span class="card-value" id="statXLSX">—</span>
				<span class="card-label">Planilhas Excel</span>
				<div class="card-trend">
					<i class="fa fa-minus"></i>
					<span>Estável</span>
				</div>
			</div>
		</div>
		<div class="analytics-card info">
			<div class="card-icon">
				<i class="fa fa-file-word"></i>
			</div>
			<div class="card-content">
				<span class="card-value" id="statDOCX">—</span>
				<span class="card-label">Documentos Word</span>
				<div class="card-trend">
					<i class="fa fa-arrow-down"></i>
					<span>-2% este mês</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Documents Grid View -->
	<div class="docs-content" id="viewGrid">
		<div class="docs-grid">
			@php
				$demo = [
					['nome' => 'Manual de Procedimentos.pdf','tipo'=>'PDF','tamanho'=>'1.2 MB','data'=>'10.10.2025','color'=>'#e74c3c'],
					['nome' => 'Lista de Preços.xlsx','tipo'=>'XLSX','tamanho'=>'240 KB','data'=>'01.09.2025','color'=>'#27ae60'],
					['nome' => 'Relatorio_Mensal.docx','tipo'=>'DOCX','tamanho'=>'560 KB','data'=>'15.10.2025','color'=>'#3498db'],
					['nome' => 'Política de Segurança.pdf','tipo'=>'PDF','tamanho'=>'890 KB','data'=>'05.10.2025','color'=>'#e74c3c'],
					['nome' => 'Inventário_2025.xlsx','tipo'=>'XLSX','tamanho'=>'1.8 MB','data'=>'20.09.2025','color'=>'#27ae60'],
					['nome' => 'Apresentação_Farmácia.pptx','tipo'=>'PPTX','tamanho'=>'3.2 MB','data'=>'12.10.2025','color'=>'#f39c12'],
				];
			@endphp
			@foreach($demo as $doc)
			<div class="doc-item" data-type="{{ strtolower($doc['tipo']) }}" data-name="{{ strtolower($doc['nome']) }}">
				<div class="doc-preview">
					<div class="doc-type-indicator" style="background: {{ $doc['color'] }}">
						@if($doc['tipo']==='PDF')<i class="fa fa-file-pdf"></i>
						@elseif($doc['tipo']==='XLSX')<i class="fa fa-file-excel"></i>
						@elseif($doc['tipo']==='PPTX')<i class="fa fa-file-powerpoint"></i>
						@else<i class="fa fa-file-word"></i>@endif
					</div>
					<div class="doc-actions">
						<button class="action-btn primary btn-preview" data-nome="{{ $doc['nome'] }}" title="Visualizar">
							<i class="fa fa-eye"></i>
						</button>
						<button class="action-btn success" title="Download">
							<i class="fa fa-download"></i>
						</button>
						<button class="action-btn danger btn-delete" title="Remover">
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
				<div class="doc-info">
					<h3 class="doc-title" title="{{ $doc['nome'] }}">{{ $doc['nome'] }}</h3>
					<div class="doc-meta">
						<span class="doc-size">{{ $doc['tamanho'] }}</span>
						<span class="doc-date">{{ $doc['data'] }}</span>
					</div>
					<div class="doc-type-badge" style="background: {{ $doc['color'] }}20; color: {{ $doc['color'] }}">
						{{ $doc['tipo'] }}
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<!-- Documents List View -->
	<div class="docs-content d-none" id="viewList">
		<div class="docs-table">
			<div class="table-header">
				<div class="header-cell">Documento</div>
				<div class="header-cell">Tipo</div>
				<div class="header-cell">Tamanho</div>
				<div class="header-cell">Data</div>
				<div class="header-cell">Ações</div>
			</div>
			@foreach($demo as $doc)
			<div class="table-row" data-type="{{ strtolower($doc['tipo']) }}" data-name="{{ strtolower($doc['nome']) }}">
				<div class="table-cell main-cell">
					<div class="file-info">
						<div class="file-icon" style="background: {{ $doc['color'] }}">
							@if($doc['tipo']==='PDF')<i class="fa fa-file-pdf"></i>
							@elseif($doc['tipo']==='XLSX')<i class="fa fa-file-excel"></i>
							@elseif($doc['tipo']==='PPTX')<i class="fa fa-file-powerpoint"></i>
							@else<i class="fa fa-file-word"></i>@endif
						</div>
						<div class="file-details">
							<span class="file-name">{{ $doc['nome'] }}</span>
							<span class="file-path">/documentos/{{ strtolower($doc['tipo']) }}/</span>
						</div>
					</div>
				</div>
				<div class="table-cell">
					<span class="type-badge" style="background: {{ $doc['color'] }}20; color: {{ $doc['color'] }}">{{ $doc['tipo'] }}</span>
				</div>
				<div class="table-cell">{{ $doc['tamanho'] }}</div>
				<div class="table-cell">{{ $doc['data'] }}</div>
				<div class="table-cell actions-cell">
					<div class="action-group">
						<button class="action-btn-sm primary btn-preview" data-nome="{{ $doc['nome'] }}" title="Visualizar">
							<i class="fa fa-eye"></i>
						</button>
						<button class="action-btn-sm success" title="Download">
							<i class="fa fa-download"></i>
						</button>
						<button class="action-btn-sm danger btn-delete" title="Remover">
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<!-- Modal de Pré-visualização Premium -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<div class="modal-content premium-modal">
			<div class="modal-header border-0">
				<div class="modal-title-section">
					<h4 class="modal-title" id="previewName"></h4>
					<p class="modal-subtitle">Pré-visualização do documento</p>
				</div>
				<button type="button" class="btn-close-custom" data-bs-dismiss="modal">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body p-0">
				<div class="preview-container">
					<div class="preview-sidebar">
						<div class="doc-details">
							<div class="detail-item">
								<span class="detail-label">Tipo</span>
								<span class="detail-value" id="previewType">PDF</span>
							</div>
							<div class="detail-item">
								<span class="detail-label">Tamanho</span>
								<span class="detail-value" id="previewSize">1.2 MB</span>
							</div>
							<div class="detail-item">
								<span class="detail-label">Modificado</span>
								<span class="detail-value" id="previewDate">10.10.2025</span>
							</div>
						</div>
						<div class="preview-actions">
							<button class="action-btn-full primary">
								<i class="fa fa-download"></i>
								Download
							</button>
							<button class="action-btn-full secondary">
								<i class="fa fa-share"></i>
								Partilhar
							</button>
							<button class="action-btn-full danger">
								<i class="fa fa-trash"></i>
								Remover
							</button>
						</div>
					</div>
					<div class="preview-main">
						<div id="previewContent" class="preview-content">
							<div class="preview-placeholder">
								<i class="fa fa-file-text fa-4x"></i>
								<h5>Visualização do Documento</h5>
								<p>Esta é uma demonstração da pré-visualização</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('styles')
<style>
	/* Reset e Base */
	* { box-sizing: border-box; }
	
	.docs-container {
		padding: 0;
		margin: 0;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		min-height: 100vh;
		position: relative;
	}

	/* Hero Section */
	.docs-hero {
		background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
		padding: 4rem 2rem;
		color: white;
		position: relative;
		overflow: hidden;
	}

	.docs-hero::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="60" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
		opacity: 0.3;
	}

	.hero-content {
		max-width: 1200px;
		margin: 0 auto;
		position: relative;
		z-index: 2;
	}

	.hero-title {
		font-size: 3.5rem;
		font-weight: 700;
		margin-bottom: 1rem;
		background: linear-gradient(45deg, #fff, #f0f8ff);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}

	.hero-subtitle {
		font-size: 1.25rem;
		opacity: 0.9;
		margin-bottom: 3rem;
		font-weight: 300;
	}

	.hero-actions {
		display: flex;
		gap: 2rem;
		align-items: center;
		flex-wrap: wrap;
	}

	/* Search Container */
	.search-container {
		flex: 1;
		max-width: 600px;
	}

	.search-wrapper {
		background: rgba(255, 255, 255, 0.15);
		backdrop-filter: blur(20px);
		border: 1px solid rgba(255, 255, 255, 0.2);
		border-radius: 20px;
		padding: 1rem;
		transition: all 0.3s ease;
	}

	.search-wrapper:focus-within {
		background: rgba(255, 255, 255, 0.25);
		transform: translateY(-2px);
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
	}

	.smart-search {
		background: transparent;
		border: none;
		color: white;
		font-size: 1.1rem;
		width: 100%;
		padding: 0.5rem 0;
		outline: none;
	}

	.smart-search::placeholder {
		color: rgba(255, 255, 255, 0.7);
	}

	.search-icon {
		color: rgba(255, 255, 255, 0.8);
		margin-right: 1rem;
	}

	.search-filters {
		display: flex;
		gap: 0.5rem;
		margin-top: 1rem;
		flex-wrap: wrap;
	}

	.filter-tag {
		padding: 0.4rem 1rem;
		background: rgba(255, 255, 255, 0.15);
		border: 1px solid rgba(255, 255, 255, 0.2);
		border-radius: 50px;
		color: white;
		cursor: pointer;
		transition: all 0.3s ease;
		font-size: 0.9rem;
	}

	.filter-tag:hover,
	.filter-tag.active {
		background: rgba(255, 255, 255, 0.3);
		transform: translateY(-1px);
	}

	/* View Controls */
	.view-controls {
		display: flex;
		gap: 0.5rem;
	}

	.view-btn {
		width: 50px;
		height: 50px;
		border: 2px solid rgba(255, 255, 255, 0.3);
		background: rgba(255, 255, 255, 0.1);
		color: white;
		border-radius: 12px;
		cursor: pointer;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2rem;
	}

	.view-btn:hover,
	.view-btn.active {
		background: rgba(255, 255, 255, 0.3);
		transform: translateY(-2px);
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
	}

	/* Analytics Grid */
	.analytics-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
		gap: 2rem;
		padding: 2rem;
		margin: -3rem 2rem 2rem;
		position: relative;
		z-index: 3;
	}

	.analytics-card {
		background: white;
		border-radius: 20px;
		padding: 2rem;
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
		transition: all 0.3s ease;
		position: relative;
		overflow: hidden;
	}

	.analytics-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		height: 4px;
		background: var(--card-color, #667eea);
	}

	.analytics-card.primary { --card-color: #667eea; }
	.analytics-card.success { --card-color: #27ae60; }
	.analytics-card.warning { --card-color: #f39c12; }
	.analytics-card.info { --card-color: #3498db; }

	.analytics-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
	}

	.card-icon {
		width: 60px;
		height: 60px;
		border-radius: 15px;
		background: var(--card-color);
		color: white;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.5rem;
		margin-bottom: 1.5rem;
	}

	.card-value {
		display: block;
		font-size: 2.5rem;
		font-weight: 700;
		color: #2c3e50;
		margin-bottom: 0.5rem;
	}

	.card-label {
		display: block;
		color: #7f8c8d;
		font-weight: 500;
		margin-bottom: 1rem;
	}

	.card-trend {
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.9rem;
		color: var(--card-color);
	}

	/* Documents Content */
	.docs-content {
		padding: 2rem;
		background: #f8f9fa;
		min-height: 60vh;
	}

	/* Grid View */
	.docs-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
		gap: 2rem;
	}

	.doc-item {
		background: white;
		border-radius: 16px;
		overflow: hidden;
		transition: all 0.3s ease;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		position: relative;
	}

	.doc-item:hover {
		transform: translateY(-8px);
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
	}

	.doc-preview {
		height: 180px;
		background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
		position: relative;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.doc-type-indicator {
		width: 80px;
		height: 80px;
		border-radius: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		font-size: 2rem;
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
	}

	.doc-actions {
		position: absolute;
		top: 1rem;
		right: 1rem;
		display: flex;
		gap: 0.5rem;
		opacity: 0;
		transition: all 0.3s ease;
	}

	.doc-item:hover .doc-actions {
		opacity: 1;
	}

	.action-btn {
		width: 40px;
		height: 40px;
		border: none;
		border-radius: 10px;
		color: white;
		cursor: pointer;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.action-btn.primary { background: #3498db; }
	.action-btn.success { background: #27ae60; }
	.action-btn.danger { background: #e74c3c; }

	.action-btn:hover {
		transform: scale(1.1);
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
	}

	.doc-info {
		padding: 1.5rem;
	}

	.doc-title {
		font-size: 1.1rem;
		font-weight: 600;
		color: #2c3e50;
		margin-bottom: 0.5rem;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.doc-meta {
		display: flex;
		justify-content: space-between;
		color: #7f8c8d;
		font-size: 0.9rem;
		margin-bottom: 1rem;
	}

	.doc-type-badge {
		display: inline-block;
		padding: 0.3rem 0.8rem;
		border-radius: 50px;
		font-size: 0.8rem;
		font-weight: 600;
	}

	/* List View */
	.docs-table {
		background: white;
		border-radius: 16px;
		overflow: hidden;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
	}

	.table-header {
		display: grid;
		grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
		gap: 1rem;
		padding: 1.5rem 2rem;
		background: #f8f9fa;
		font-weight: 600;
		color: #495057;
		border-bottom: 1px solid #dee2e6;
	}

	.table-row {
		display: grid;
		grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
		gap: 1rem;
		padding: 1.5rem 2rem;
		border-bottom: 1px solid #f1f3f4;
		transition: all 0.3s ease;
		align-items: center;
	}

	.table-row:hover {
		background: #f8f9fb;
		transform: translateX(8px);
	}

	.file-info {
		display: flex;
		align-items: center;
		gap: 1rem;
	}

	.file-icon {
		width: 50px;
		height: 50px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		font-size: 1.2rem;
	}

	.file-name {
		display: block;
		font-weight: 600;
		color: #2c3e50;
		margin-bottom: 0.2rem;
	}

	.file-path {
		display: block;
		font-size: 0.8rem;
		color: #7f8c8d;
	}

	.type-badge {
		padding: 0.3rem 0.8rem;
		border-radius: 50px;
		font-size: 0.8rem;
		font-weight: 600;
	}

	.action-group {
		display: flex;
		gap: 0.5rem;
	}

	.action-btn-sm {
		width: 35px;
		height: 35px;
		border: none;
		border-radius: 8px;
		color: white;
		cursor: pointer;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.action-btn-sm.primary { background: #3498db; }
	.action-btn-sm.success { background: #27ae60; }
	.action-btn-sm.danger { background: #e74c3c; }

	.action-btn-sm:hover {
		transform: scale(1.1);
	}

	/* Premium Modal */
	.premium-modal {
		border: none;
		border-radius: 20px;
		overflow: hidden;
		box-shadow: 0 50px 100px rgba(0, 0, 0, 0.3);
	}

	.modal-title-section {
		flex: 1;
	}

	.modal-title {
		font-size: 1.5rem;
		font-weight: 600;
		margin-bottom: 0.5rem;
	}

	.modal-subtitle {
		color: #6c757d;
		margin: 0;
	}

	.btn-close-custom {
		width: 40px;
		height: 40px;
		border: none;
		background: #f8f9fa;
		border-radius: 10px;
		cursor: pointer;
		transition: all 0.3s ease;
	}

	.btn-close-custom:hover {
		background: #e9ecef;
		transform: scale(1.1);
	}

	.preview-container {
		display: grid;
		grid-template-columns: 300px 1fr;
		height: 70vh;
	}

	.preview-sidebar {
		background: #f8f9fa;
		padding: 2rem;
		border-right: 1px solid #dee2e6;
	}

	.doc-details {
		margin-bottom: 2rem;
	}

	.detail-item {
		display: flex;
		justify-content: space-between;
		margin-bottom: 1rem;
		padding-bottom: 1rem;
		border-bottom: 1px solid #dee2e6;
	}

	.detail-label {
		color: #6c757d;
		font-weight: 500;
	}

	.detail-value {
		font-weight: 600;
	}

	.action-btn-full {
		width: 100%;
		padding: 1rem;
		border: none;
		border-radius: 12px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s ease;
		margin-bottom: 1rem;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
	}

	.action-btn-full.primary {
		background: #3498db;
		color: white;
	}

	.action-btn-full.secondary {
		background: #6c757d;
		color: white;
	}

	.action-btn-full.danger {
		background: #e74c3c;
		color: white;
	}

	.action-btn-full:hover {
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
	}

	.preview-main {
		display: flex;
		align-items: center;
		justify-content: center;
		background: #fff;
	}

	.preview-content {
		text-align: center;
		color: #6c757d;
	}

	.preview-placeholder i {
		margin-bottom: 1rem;
		opacity: 0.5;
	}

	/* Responsive */
	@media (max-width: 768px) {
		.hero-title { font-size: 2.5rem; }
		.analytics-grid { grid-template-columns: 1fr; margin: -2rem 1rem 2rem; }
		.docs-grid { grid-template-columns: 1fr; }
		.table-header, .table-row { grid-template-columns: 1fr; }
		.preview-container { grid-template-columns: 1fr; }
		.preview-sidebar { display: none; }
		.hero-actions { flex-direction: column; align-items: stretch; }
	}

	/* Animations */
	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(30px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.doc-item, .analytics-card {
		animation: fadeInUp 0.6s ease forwards;
	}

	.doc-item:nth-child(2) { animation-delay: 0.1s; }
	.doc-item:nth-child(3) { animation-delay: 0.2s; }
	.doc-item:nth-child(4) { animation-delay: 0.3s; }
	.doc-item:nth-child(5) { animation-delay: 0.4s; }
	.doc-item:nth-child(6) { animation-delay: 0.5s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
	// Smart View Toggle with Animation
	const btnList = document.getElementById('btnList');
	const btnGrid = document.getElementById('btnGrid');
	const viewList = document.getElementById('viewList');
	const viewGrid = document.getElementById('viewGrid');

	function setViewMode(mode, animate = true) {
		// Remove active states
		[btnList, btnGrid].forEach(btn => btn.classList.remove('active'));
		
		if (mode === 'grid') {
			if (animate) {
				viewList.style.opacity = '0';
				setTimeout(() => {
					viewList.classList.add('d-none');
					viewGrid.classList.remove('d-none');
					viewGrid.style.opacity = '0';
					setTimeout(() => viewGrid.style.opacity = '1', 50);
				}, 300);
			} else {
				viewList.classList.add('d-none');
				viewGrid.classList.remove('d-none');
			}
			btnGrid.classList.add('active');
		} else {
			if (animate) {
				viewGrid.style.opacity = '0';
				setTimeout(() => {
					viewGrid.classList.add('d-none');
					viewList.classList.remove('d-none');
					viewList.style.opacity = '0';
					setTimeout(() => viewList.style.opacity = '1', 50);
				}, 300);
			} else {
				viewGrid.classList.add('d-none');
				viewList.classList.remove('d-none');
			}
			btnList.classList.add('active');
		}
		
		// Save preference
		try { localStorage.setItem('docsViewMode', mode); } catch(e) {}
	}

	// Event listeners
	btnList.addEventListener('click', () => setViewMode('list'));
	btnGrid.addEventListener('click', () => setViewMode('grid'));
	
	// Initialize view
	const savedMode = localStorage.getItem('docsViewMode') || 'grid';
	setViewMode(savedMode, false);

	// Smart Search with Real-time Filtering
	const searchInput = document.getElementById('docSearch');
	const filterTags = document.querySelectorAll('.filter-tag');
	let currentFilter = 'all';

	function performSmartSearch() {
		const query = searchInput.value.toLowerCase().trim();
		const gridItems = document.querySelectorAll('#viewGrid .doc-item');
		const listItems = document.querySelectorAll('#viewList .table-row');
		
		// Filter grid items
		gridItems.forEach(item => {
			const name = item.dataset.name;
			const type = item.dataset.type;
			const matchesSearch = !query || name.includes(query);
			const matchesFilter = currentFilter === 'all' || type === currentFilter;
			
			if (matchesSearch && matchesFilter) {
				item.style.display = '';
				item.style.opacity = '1';
				item.style.transform = 'translateY(0)';
			} else {
				item.style.opacity = '0';
				item.style.transform = 'translateY(20px)';
				setTimeout(() => item.style.display = 'none', 300);
			}
		});

		// Filter list items
		listItems.forEach(item => {
			const name = item.dataset.name;
			const type = item.dataset.type;
			const matchesSearch = !query || name.includes(query);
			const matchesFilter = currentFilter === 'all' || type === currentFilter;
			
			item.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
		});

		// Update stats
		updateStats();
	}

	// Real-time search
	searchInput.addEventListener('input', performSmartSearch);

	// Filter tags
	filterTags.forEach(tag => {
		tag.addEventListener('click', function() {
			filterTags.forEach(t => t.classList.remove('active'));
			this.classList.add('active');
			currentFilter = this.dataset.type;
			performSmartSearch();
		});
	});

	// Smart Preview Modal
	document.addEventListener('click', function(e) {
		if (e.target.matches('.btn-preview') || e.target.closest('.btn-preview')) {
			const btn = e.target.matches('.btn-preview') ? e.target : e.target.closest('.btn-preview');
			const nome = btn.getAttribute('data-nome');
			
			// Animate modal appearance
			const modal = document.getElementById('previewModal');
			const modalInstance = new bootstrap.Modal(modal);
			
			// Set content with animation
			document.getElementById('previewName').textContent = nome;
			
			// Simulate file type detection
			const fileExt = nome.split('.').pop().toUpperCase();
			document.getElementById('previewType').textContent = fileExt;
			
			// Enhanced preview content based on file type
			const previewContent = document.getElementById('previewContent');
			let content = '';
			
			switch(fileExt) {
				case 'PDF':
					content = `
						<div class="preview-placeholder">
							<i class="fa fa-file-pdf fa-4x" style="color: #e74c3c;"></i>
							<h5>Documento PDF</h5>
							<p>Visualização de ${nome}</p>
							<div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
								<small>📄 Documento com texto formatado<br>
								🔍 Pesquisável e indexado<br>
								💾 Otimizado para impressão</small>
							</div>
						</div>
					`;
					break;
				case 'XLSX':
					content = `
						<div class="preview-placeholder">
							<i class="fa fa-file-excel fa-4x" style="color: #27ae60;"></i>
							<h5>Planilha Excel</h5>
							<p>Visualização de ${nome}</p>
							<div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
								<small>📊 Dados em tabelas<br>
								🧮 Fórmulas e cálculos<br>
								📈 Gráficos e análises</small>
							</div>
						</div>
					`;
					break;
				case 'DOCX':
					content = `
						<div class="preview-placeholder">
							<i class="fa fa-file-word fa-4x" style="color: #3498db;"></i>
							<h5>Documento Word</h5>
							<p>Visualização de ${nome}</p>
							<div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
								<small>📝 Texto formatado<br>
								🖼️ Imagens e tabelas<br>
								✏️ Editável e colaborativo</small>
							</div>
						</div>
					`;
					break;
				case 'PPTX':
					content = `
						<div class="preview-placeholder">
							<i class="fa fa-file-powerpoint fa-4x" style="color: #f39c12;"></i>
							<h5>Apresentação PowerPoint</h5>
							<p>Visualização de ${nome}</p>
							<div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
								<small>🎯 Slides interativos<br>
								🎨 Design profissional<br>
								📽️ Pronto para apresentar</small>
							</div>
						</div>
					`;
					break;
				default:
					content = `
						<div class="preview-placeholder">
							<i class="fa fa-file fa-4x" style="color: #6c757d;"></i>
							<h5>Documento</h5>
							<p>Visualização de ${nome}</p>
						</div>
					`;
			}
			
			previewContent.innerHTML = content;
			modalInstance.show();
		}
	});

	// Update Statistics
	function updateStats() {
		const visibleGridItems = Array.from(document.querySelectorAll('#viewGrid .doc-item')).filter(item => 
			item.style.display !== 'none'
		);
		
		const total = visibleGridItems.length;
		const countByType = type => visibleGridItems.filter(item => 
			item.dataset.type === type.toLowerCase()
		).length;

		// Animate counter updates
		animateCounter('statTotal', total);
		animateCounter('statPDF', countByType('PDF'));
		animateCounter('statXLSX', countByType('XLSX'));
		animateCounter('statDOCX', countByType('DOCX'));
	}

	function animateCounter(elementId, targetValue) {
		const element = document.getElementById(elementId);
		const currentValue = parseInt(element.textContent) || 0;
		const increment = targetValue > currentValue ? 1 : -1;
		
		if (currentValue !== targetValue) {
			element.textContent = currentValue + increment;
			setTimeout(() => animateCounter(elementId, targetValue), 50);
		}
	}

	// Initialize stats
	updateStats();

	// Drag and Drop Enhancement (Demo)
	const docsContainer = document.querySelector('.docs-grid');
	if (docsContainer) {
		docsContainer.addEventListener('dragover', function(e) {
			e.preventDefault();
			this.style.background = 'rgba(102, 126, 234, 0.1)';
			this.style.borderRadius = '20px';
		});

		docsContainer.addEventListener('dragleave', function(e) {
			e.preventDefault();
			this.style.background = '';
		});

		docsContainer.addEventListener('drop', function(e) {
			e.preventDefault();
			this.style.background = '';
			
			// Demo notification
			const notification = document.createElement('div');
			notification.innerHTML = `
				<div style="position: fixed; top: 20px; right: 20px; background: #27ae60; color: white; padding: 1rem 2rem; border-radius: 10px; z-index: 9999; animation: slideInRight 0.5s ease;">
					<i class="fa fa-check"></i> Arquivo carregado com sucesso!
				</div>
			`;
			document.body.appendChild(notification);
			
			setTimeout(() => notification.remove(), 3000);
		});
	}

	// Keyboard Shortcuts
	document.addEventListener('keydown', function(e) {
		// Ctrl/Cmd + F for search focus
		if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
			e.preventDefault();
			searchInput.focus();
		}
		
		// Ctrl/Cmd + G for grid view
		if ((e.ctrlKey || e.metaKey) && e.key === 'g') {
			e.preventDefault();
			setViewMode('grid');
		}
		
		// Ctrl/Cmd + L for list view
		if ((e.ctrlKey || e.metaKey) && e.key === 'l') {
			e.preventDefault();
			setViewMode('list');
		}
	});

	// Add keyboard shortcuts info
	const shortcutsInfo = document.createElement('div');
	shortcutsInfo.innerHTML = `
		<div style="position: fixed; bottom: 20px; left: 20px; background: rgba(0,0,0,0.8); color: white; padding: 0.5rem 1rem; border-radius: 10px; font-size: 0.8rem; z-index: 1000;">
			⌨️ Ctrl+F: Pesquisar | Ctrl+G: Grelha | Ctrl+L: Lista
		</div>
	`;
	document.body.appendChild(shortcutsInfo);
	
	// Hide shortcuts info after 5 seconds
	setTimeout(() => shortcutsInfo.style.opacity = '0', 5000);
	setTimeout(() => shortcutsInfo.remove(), 6000);
});
</script>
@endpush

@endsection