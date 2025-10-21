@extends('layout.app')

@section('titulo', 'Documentos')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<!-- Header -->
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h3 class="mb-0">Documentos</h3>
				<div class="d-flex gap-3 align-items-center">
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
				<span class="badge bg-primary me-2 filter-tag active" data-type="all">Todos</span>
				<span class="badge bg-outline-primary me-2 filter-tag" data-type="pdf">PDF</span>
				<span class="badge bg-outline-primary me-2 filter-tag" data-type="xlsx">Excel</span>
				<span class="badge bg-outline-primary filter-tag" data-type="docx">Word</span>
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
						<div class="card h-100 doc-card" data-type="{{ strtolower($doc['tipo']) }}" data-name="{{ strtolower($doc['nome']) }}">
							<div class="card-body text-center">
								<div class="mb-3">
									@if($doc['tipo']==='PDF')
										<i class="fa fa-file-pdf fa-3x text-danger"></i>
									@elseif($doc['tipo']==='XLSX')
										<i class="fa fa-file-excel fa-3x text-success"></i>
									@elseif($doc['tipo']==='PPTX')
										<i class="fa fa-file-powerpoint fa-3x text-warning"></i>
									@else
										<i class="fa fa-file-word fa-3x text-primary"></i>
									@endif
								</div>
								<h6 class="card-title">{{ $doc['nome'] }}</h6>
								<p class="card-text">
									<small class="text-muted">{{ $doc['tamanho'] }} • {{ $doc['data'] }}</small>
								</p>
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

	// Search and Filter
	const searchInput = document.getElementById('docSearch');
	const filterTags = document.querySelectorAll('.filter-tag');
	let currentFilter = 'all';

	function filterDocs() {
		const query = searchInput.value.toLowerCase().trim();
		const gridItems = document.querySelectorAll('#viewGrid .col-lg-3, #viewGrid .col-md-4, #viewGrid .col-sm-6');
		const listRows = document.querySelectorAll('#viewList tbody tr');
		
		// Filter grid
		gridItems.forEach(item => {
			const docCard = item.querySelector('.doc-card');
			const name = docCard.dataset.name;
			const type = docCard.dataset.type;
			const matchesSearch = !query || name.includes(query);
			const matchesFilter = currentFilter === 'all' || type === currentFilter;
			
			item.style.display = (matchesSearch && matchesFilter) ? '' : 'none';
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
	}

	searchInput.addEventListener('input', filterDocs);

	filterTags.forEach(tag => {
		tag.addEventListener('click', function() {
			filterTags.forEach(t => t.classList.remove('active'));
			this.classList.add('active');
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

		document.getElementById('statTotal').textContent = total;
		document.getElementById('statPDF').textContent = countByType('PDF');
		document.getElementById('statXLSX').textContent = countByType('XLSX');
		document.getElementById('statDOCX').textContent = countByType('DOCX');
	}

	updateStats();
});
</script>
@endpush

@endsection