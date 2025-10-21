@extends('layout.app')

@section('titulo', 'Documentos')

@section('content')
<div class="content container-fluid">
	<div class="row">
		<div class="col-12">
			<!-- Header -->
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h3 class="mb-0">Documentos</h3>
				<div class="d-flex gap-3 align-items-center">
					<a href="{{ route('documents.create') }}" class="btn btn-success">
						<i class="fa fa-plus me-2"></i>Adicionar
					</a>
					<div class="input-group" style="width: 300px;">
						<span class="input-group-text"><i class="fa fa-search"></i></span>
						<input type="text" id="docSearch" class="form-control" placeholder="Pesquisar documentos...">
					</div>
					<div class="btn-group">
						<button class="btn btn-primary active" id="btnGrid"><i class="fa fa-th"></i></button>
						<button class="btn btn-outline-primary" id="btnList"><i class="fa fa-list"></i></button>
					</div>
				</div>
			</div>

			<!-- Filters -->
			<div class="mb-4">
				<div class="smart-filters d-flex flex-wrap gap-2">
					<span class="filter-chip active" data-type="all">
						<i class="fa fa-sparkles me-1"></i>Todos
						<span class="chip-count">6</span>
					</span>
					<span class="filter-chip" data-type="pdf">
						<i class="fa fa-file-pdf me-1"></i>PDF
						<span class="chip-count">2</span>
					</span>
					<span class="filter-chip" data-type="xlsx">
						<i class="fa fa-file-excel me-1"></i>Excel
						<span class="chip-count">2</span>
					</span>
					<span class="filter-chip" data-type="docx">
						<i class="fa fa-file-word me-1"></i>Word
						<span class="chip-count">1</span>
					</span>
					<span class="filter-chip" data-type="pptx">
						<i class="fa fa-file-powerpoint me-1"></i>PowerPoint
						<span class="chip-count">1</span>
					</span>
				</div>
			</div>

			<!-- Stats -->
			<div class="row mb-4">
				<div class="col-md-3 mb-3">
					<div class="card text-center">
						<div class="card-body">
							<i class="fa fa-file fa-2x text-primary mb-2"></i>
							<h4 class="mb-0" id="statTotal">—</h4>
							<small class="text-muted">Total</small>
						</div>
					</div>
				</div>
				<div class="col-md-3 mb-3">
					<div class="card text-center">
						<div class="card-body">
							<i class="fa fa-file-pdf fa-2x text-danger mb-2"></i>
							<h4 class="mb-0" id="statPDF">—</h4>
							<small class="text-muted">PDF</small>
						</div>
					</div>
				</div>
				<div class="col-md-3 mb-3">
					<div class="card text-center">
						<div class="card-body">
							<i class="fa fa-file-excel fa-2x text-success mb-2"></i>
							<h4 class="mb-0" id="statXLSX">—</h4>
							<small class="text-muted">Excel</small>
						</div>
					</div>
				</div>
				<div class="col-md-3 mb-3">
					<div class="card text-center">
						<div class="card-body">
							<i class="fa fa-file-word fa-2x text-info mb-2"></i>
							<h4 class="mb-0" id="statDOCX">—</h4>
							<small class="text-muted">Word</small>
						</div>
					</div>
				</div>
			</div>

			<!-- Grid View -->
			<div id="viewGrid">
				<div class="row">
					@php
						$demo = [
							['nome' => 'Manual de Procedimentos.pdf','tipo'=>'PDF','tamanho'=>'1.2 MB','data'=>'10.10.2025'],
							['nome' => 'Lista de Preços.xlsx','tipo'=>'XLSX','tamanho'=>'240 KB','data'=>'01.09.2025'],
							['nome' => 'Relatorio_Mensal.docx','tipo'=>'DOCX','tamanho'=>'560 KB','data'=>'15.10.2025'],
							['nome' => 'Política de Segurança.pdf','tipo'=>'PDF','tamanho'=>'890 KB','data'=>'05.10.2025'],
							['nome' => 'Inventário_2025.xlsx','tipo'=>'XLSX','tamanho'=>'1.8 MB','data'=>'20.09.2025'],
							['nome' => 'Apresentação_Farmácia.pptx','tipo'=>'PPTX','tamanho'=>'3.2 MB','data'=>'12.10.2025'],
						];
					@endphp
					@foreach($demo as $doc)
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card h-100 doc-card smart-card" data-type="{{ strtolower($doc['tipo']) }}" data-name="{{ strtolower($doc['nome']) }}">
							<div class="card-body text-center position-relative">
								<div class="ai-glow"></div>
								<div class="mb-3">
									@if($doc['tipo']==='PDF')
										<div class="file-icon-container">
											<i class="fa fa-file-pdf fa-3x text-danger"></i>
											<div class="file-pulse"></div>
										</div>
									@elseif($doc['tipo']==='XLSX')
										<div class="file-icon-container">
											<i class="fa fa-file-excel fa-3x text-success"></i>
											<div class="file-pulse"></div>
										</div>
									@elseif($doc['tipo']==='PPTX')
										<div class="file-icon-container">
											<i class="fa fa-file-powerpoint fa-3x text-warning"></i>
											<div class="file-pulse"></div>
										</div>
									@else
										<div class="file-icon-container">
											<i class="fa fa-file-word fa-3x text-primary"></i>
											<div class="file-pulse"></div>
										</div>
									@endif
								</div>
								<h6 class="card-title smart-title">{{ $doc['nome'] }}</h6>
								<p class="card-text">
									<small class="text-muted ai-meta">{{ $doc['tamanho'] }} • {{ $doc['data'] }}</small>
								</p>
								<div class="btn-group smart-actions" role="group">
									<button class="btn btn-sm btn-primary btn-preview smart-btn" data-nome="{{ $doc['nome'] }}">
										<i class="fa fa-eye"></i>
										<span class="btn-tooltip">Visualizar</span>
									</button>
									<button class="btn btn-sm btn-success smart-btn">
										<i class="fa fa-download"></i>
										<span class="btn-tooltip">Download</span>
									</button>
									<button class="btn btn-sm btn-danger smart-btn">
										<i class="fa fa-trash"></i>
										<span class="btn-tooltip">Eliminar</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>

			<!-- List View -->
			<div id="viewList" class="d-none">
				<div class="card">
					<div class="table-responsive">
						<table class="table table-hover mb-0">
							<thead class="table-light">
								<tr>
									<th>Documento</th>
									<th>Tipo</th>
									<th>Tamanho</th>
									<th>Data</th>
									<th class="text-end">Ações</th>
								</tr>
							</thead>
							<tbody>
								@foreach($demo as $doc)
								<tr data-type="{{ strtolower($doc['tipo']) }}" data-name="{{ strtolower($doc['nome']) }}">
									<td>
										<div class="d-flex align-items-center">
											@if($doc['tipo']==='PDF')
												<i class="fa fa-file-pdf text-danger me-2"></i>
											@elseif($doc['tipo']==='XLSX')
												<i class="fa fa-file-excel text-success me-2"></i>
											@elseif($doc['tipo']==='PPTX')
												<i class="fa fa-file-powerpoint text-warning me-2"></i>
											@else
												<i class="fa fa-file-word text-primary me-2"></i>
											@endif
											{{ $doc['nome'] }}
										</div>
									</td>
									<td><span class="badge bg-light text-dark">{{ $doc['tipo'] }}</span></td>
									<td>{{ $doc['tamanho'] }}</td>
									<td>{{ $doc['data'] }}</td>
									<td class="text-end">
										<div class="btn-group" role="group">
											<button class="btn btn-sm btn-primary btn-preview" data-nome="{{ $doc['nome'] }}">
												<i class="fa fa-eye"></i>
											</button>
											<button class="btn btn-sm btn-success">
												<i class="fa fa-download"></i>
											</button>
											<button class="btn btn-sm btn-danger">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal simples -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="previewName"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body text-center">
				<div id="previewContent" class="py-5">
					<i class="fa fa-file fa-3x text-muted mb-3"></i>
					<p>Pré-visualização do documento</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-success">Download</button>
			</div>
		</div>
	</div>
</div>

@push('styles')
<style>
	/* Smart Filters com IA */
	.smart-filters {
		position: relative;
	}
	
	.filter-chip {
		position: relative;
		display: inline-flex;
		align-items: center;
		padding: 8px 16px;
		background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
		border: 2px solid transparent;
		border-radius: 25px;
		color: #6c757d;
		cursor: pointer;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		font-weight: 500;
		font-size: 14px;
		overflow: hidden;
	}
	
	.filter-chip::before {
		content: '';
		position: absolute;
		top: 0;
		left: -100%;
		width: 100%;
		height: 100%;
		background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
		transition: left 0.5s;
	}
	
	.filter-chip:hover::before {
		left: 100%;
	}
	
	.filter-chip:hover {
		transform: translateY(-2px) scale(1.05);
		box-shadow: 0 8px 25px rgba(0, 123, 255, 0.25);
		border-color: rgba(0, 123, 255, 0.3);
	}
	
	.filter-chip.active {
		background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
		color: white;
		border-color: #0056b3;
		box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
		transform: translateY(-1px);
	}
	
	.filter-chip.active::after {
		content: '';
		position: absolute;
		top: -2px;
		left: -2px;
		right: -2px;
		bottom: -2px;
		background: linear-gradient(45deg, #007bff, #00d4ff, #007bff);
		border-radius: 25px;
		z-index: -1;
		animation: ai-glow 2s ease-in-out infinite;
	}
	
	.chip-count {
		margin-left: 8px;
		background: rgba(255,255,255,0.2);
		padding: 2px 8px;
		border-radius: 12px;
		font-size: 12px;
		font-weight: 600;
	}
	
	.filter-chip.active .chip-count {
		background: rgba(255,255,255,0.3);
	}
	
	/* Smart Cards com IA */
	.smart-card {
		position: relative;
		border: none;
		border-radius: 15px;
		background: white;
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		overflow: hidden;
	}
	
	.smart-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: linear-gradient(135deg, rgba(0,123,255,0.05) 0%, rgba(0,212,255,0.05) 100%);
		opacity: 0;
		transition: opacity 0.3s ease;
		z-index: 1;
	}
	
	.smart-card:hover::before {
		opacity: 1;
	}
	
	.smart-card:hover {
		transform: translateY(-8px) scale(1.02);
		box-shadow: 0 20px 40px rgba(0,123,255,0.15);
	}
	
	.ai-glow {
		position: absolute;
		top: -50%;
		left: -50%;
		width: 200%;
		height: 200%;
		background: conic-gradient(from 0deg, transparent, rgba(0,123,255,0.1), transparent);
		animation: ai-rotate 8s linear infinite;
		opacity: 0;
		transition: opacity 0.3s ease;
		z-index: 0;
	}
	
	.smart-card:hover .ai-glow {
		opacity: 1;
	}
	
	.file-icon-container {
		position: relative;
		display: inline-block;
	}
	
	.file-pulse {
		position: absolute;
		top: 50%;
		left: 50%;
		width: 60px;
		height: 60px;
		border: 2px solid currentColor;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		opacity: 0;
		animation: ai-pulse 2s ease-in-out infinite;
	}
	
	.smart-card:hover .file-pulse {
		opacity: 0.3;
	}
	
	.smart-title {
		position: relative;
		z-index: 2;
		font-weight: 600;
		transition: color 0.3s ease;
	}
	
	.smart-card:hover .smart-title {
		color: #007bff;
	}
	
	.ai-meta {
		position: relative;
		z-index: 2;
	}
	
	/* Smart Actions */
	.smart-actions {
		position: relative;
		z-index: 2;
	}
	
	.smart-btn {
		position: relative;
		overflow: hidden;
		transition: all 0.3s ease;
	}
	
	.smart-btn:hover {
		transform: translateY(-2px);
	}
	
	.btn-tooltip {
		position: absolute;
		bottom: 100%;
		left: 50%;
		transform: translateX(-50%);
		background: rgba(0,0,0,0.8);
		color: white;
		padding: 4px 8px;
		border-radius: 4px;
		font-size: 11px;
		white-space: nowrap;
		opacity: 0;
		pointer-events: none;
		transition: opacity 0.3s ease;
		z-index: 10;
	}
	
	.smart-btn:hover .btn-tooltip {
		opacity: 1;
	}
	
	/* Animações IA */
	@keyframes ai-glow {
		0%, 100% { transform: scale(1); opacity: 0.4; }
		50% { transform: scale(1.05); opacity: 0.8; }
	}
	
	@keyframes ai-rotate {
		from { transform: rotate(0deg); }
		to { transform: rotate(360deg); }
	}
	
	@keyframes ai-pulse {
		0% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
		50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.1; }
		100% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
	}
	
	@keyframes ai-entrance {
		0% {
			opacity: 0;
			transform: translateY(20px) scale(0.9);
		}
		100% {
			opacity: 1;
			transform: translateY(0) scale(1);
		}
	}
	
	/* Stats Cards */
	.stats-card {
		border: none;
		border-radius: 10px;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
		transition: transform 0.2s ease;
	}
	.stats-card:hover {
		transform: translateY(-2px);
	}
	.doc-card {
		transition: transform 0.2s ease;
	}
	.doc-card:hover {
		transform: translateY(-2px);
	}
</style>
@endpush

<!-- Modal de Preview -->
<div class="modal fade" id="previewModal" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="previewName">Preview</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body text-center" id="previewContent">
				<!-- Conteúdo será inserido via JavaScript -->
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
	// View Toggle
	const btnList = document.getElementById('btnList');
	const btnGrid = document.getElementById('btnGrid');
	const viewList = document.getElementById('viewList');
	const viewGrid = document.getElementById('viewGrid');

	function setViewMode(mode) {
		[btnList, btnGrid].forEach(btn => btn.classList.remove('active'));
		
		if (mode === 'grid') {
			viewList.classList.add('d-none');
			viewGrid.classList.remove('d-none');
			btnGrid.classList.add('active');
		} else {
			viewGrid.classList.add('d-none');
			viewList.classList.remove('d-none');
			btnList.classList.add('active');
		}
		
		try { localStorage.setItem('docsViewMode', mode); } catch(e) {}
	}

	btnList.addEventListener('click', () => setViewMode('list'));
	btnGrid.addEventListener('click', () => setViewMode('grid'));
	setViewMode(localStorage.getItem('docsViewMode') || 'grid');

	// Search and Filter com IA
	const searchInput = document.getElementById('docSearch');
	const filterChips = document.querySelectorAll('.filter-chip');
	let currentFilter = 'all';

	function filterDocs() {
		const query = searchInput.value.toLowerCase().trim();
		const gridItems = document.querySelectorAll('#viewGrid .col-lg-3, #viewGrid .col-md-4, #viewGrid .col-sm-6');
		const listRows = document.querySelectorAll('#viewList tbody tr');
		
		// AI transition effect
		document.querySelector('.smart-filters').style.transform = 'scale(0.98)';
		setTimeout(() => {
			document.querySelector('.smart-filters').style.transform = 'scale(1)';
		}, 100);
		
		// Filter grid com animação IA
		gridItems.forEach((item, index) => {
			const docCard = item.querySelector('.doc-card');
			const name = docCard.dataset.name;
			const type = docCard.dataset.type;
			const matchesSearch = !query || name.includes(query);
			const matchesFilter = currentFilter === 'all' || type === currentFilter;
			
			if (matchesSearch && matchesFilter) {
				item.style.display = '';
				// AI entrance animation
				setTimeout(() => {
					docCard.style.animation = 'ai-entrance 0.5s ease-out';
				}, index * 50);
			} else {
				item.style.display = 'none';
			}
		});

		// Filter list
		listRows.forEach(row => {
			const name = row.dataset.name;
			const type = row.dataset.type;
			const matchesSearch = !query || name.includes(query);
			const matchesFilter = currentFilter === 'all' || type === currentFilter;
			
			row.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
		});

		updateStats();
		updateFilterCounts();
	}
	
	// Update filter counts com efeito IA
	function updateFilterCounts() {
		const allItems = document.querySelectorAll('#viewGrid .doc-card');
		const counts = {
			all: 6, pdf: 2, xlsx: 2, docx: 1, pptx: 1
		};
		
		filterChips.forEach(chip => {
			const type = chip.dataset.type;
			const countEl = chip.querySelector('.chip-count');
			const newCount = counts[type] || 0;
			
			// Animate count change
			countEl.style.transform = 'scale(1.2)';
			setTimeout(() => {
				countEl.textContent = newCount;
				countEl.style.transform = 'scale(1)';
			}, 150);
		});
	}

	searchInput.addEventListener('input', filterDocs);

	filterChips.forEach(chip => {
		chip.addEventListener('click', function() {
			// Remove active from all chips com efeito IA
			filterChips.forEach(c => {
				c.classList.remove('active');
				c.style.transform = 'scale(0.95)';
				setTimeout(() => {
					c.style.transform = 'scale(1)';
				}, 100);
			});
			
			// Add active to clicked chip com efeito IA
			this.classList.add('active');
			this.style.transform = 'scale(1.05)';
			setTimeout(() => {
				this.style.transform = 'scale(1)';
			}, 200);
			
			currentFilter = this.dataset.type;
			filterDocs();
		});
	});
			currentFilter = this.dataset.type;
			filterDocs();
		});
	});

	// Preview Modal
	document.addEventListener('click', function(e) {
		if (e.target.matches('.btn-preview') || e.target.closest('.btn-preview')) {
			const btn = e.target.matches('.btn-preview') ? e.target : e.target.closest('.btn-preview');
			const nome = btn.getAttribute('data-nome');
			
			document.getElementById('previewName').textContent = nome;
			
			const fileExt = nome.split('.').pop().toUpperCase();
			let iconClass = 'fa-file';
			let iconColor = '#6c757d';
			
			switch(fileExt) {
				case 'PDF': iconClass = 'fa-file-pdf'; iconColor = '#dc3545'; break;
				case 'XLSX': iconClass = 'fa-file-excel'; iconColor = '#198754'; break;
				case 'DOCX': iconClass = 'fa-file-word'; iconColor = '#0d6efd'; break;
				case 'PPTX': iconClass = 'fa-file-powerpoint'; iconColor = '#fd7e14'; break;
			}
			
			document.getElementById('previewContent').innerHTML = `
				<i class="fa ${iconClass} fa-3x mb-3" style="color: ${iconColor}"></i>
				<p>Pré-visualização de ${nome}</p>
			`;
			
			new bootstrap.Modal(document.getElementById('previewModal')).show();
		}
	});

	// Update Stats
	function updateStats() {
		const visibleGridItems = Array.from(document.querySelectorAll('#viewGrid .doc-card')).filter(item => 
			item.parentElement.style.display !== 'none'
		);
		
		const total = visibleGridItems.length;
		const countByType = type => visibleGridItems.filter(item => 
			item.dataset.type === type.toLowerCase()
		).length;

		const statTotal = document.getElementById('statTotal');
		const statPDF = document.getElementById('statPDF');
		const statXLSX = document.getElementById('statXLSX');
		const statDOCX = document.getElementById('statDOCX');
		
		if (statTotal) statTotal.textContent = total;
		if (statPDF) statPDF.textContent = countByType('PDF');
		if (statXLSX) statXLSX.textContent = countByType('XLSX');  
		if (statDOCX) statDOCX.textContent = countByType('DOCX');
		
		console.log('Stats updated:', { total, pdf: countByType('PDF'), xlsx: countByType('XLSX'), docx: countByType('DOCX') });
	}

	updateStats();
});
</script>
@endpush

@endsection