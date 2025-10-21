@extends('layout.app')

@section('titulo', 'Documentos')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card shadow-sm border-0">
			<div class="card-body">
				<div class="d-flex align-items-center mb-3 gap-2 flex-wrap">
					<h4 class="me-auto mb-0">Documentos do Sistema</h4>
					<div class="input-group" style="max-width:360px">
						<span class="input-group-text bg-white"><i class="fa fa-search text-muted"></i></span>
						<input type="text" id="docSearch" class="form-control" placeholder="Pesquisar documentos...">
						<button class="btn btn-outline-secondary" id="btnSearch">Pesquisar</button>
					</div>
					<div class="btn-group" role="group" aria-label="Modo de visualização">
						<button class="btn btn-outline-primary" id="btnList" title="Vista em Lista"><i class="fa fa-list"></i></button>
						<button class="btn btn-outline-primary" id="btnGrid" title="Vista em Grelha"><i class="fa fa-th-large"></i></button>
					</div>
				</div>

				{{-- Estatísticas rápidas (demo) --}}
				<div class="row g-3 mb-3">
					<div class="col-6 col-md-3">
						<div class="mini-stat">
							<span class="mini-label">Total</span>
							<span class="mini-value" id="statTotal">—</span>
						</div>
					</div>
					<div class="col-6 col-md-3">
						<div class="mini-stat">
							<span class="mini-label">PDF</span>
							<span class="mini-value" id="statPDF">—</span>
						</div>
					</div>
					<div class="col-6 col-md-3">
						<div class="mini-stat">
							<span class="mini-label">Excel</span>
							<span class="mini-value" id="statXLSX">—</span>
						</div>
					</div>
					<div class="col-6 col-md-3">
						<div class="mini-stat">
							<span class="mini-label">Word</span>
							<span class="mini-value" id="statDOCX">—</span>
						</div>
					</div>
				</div>

				{{-- Lista (tabela) --}}
				<div class="table-responsive view-list" id="viewList">
					<table class="table table-hover align-middle">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Tipo</th>
								<th>Tamanho</th>
								<th>Data</th>
								<th class="text-end">Ações</th>
							</tr>
						</thead>
						<tbody>
							@php
								$demo = [
									['nome' => 'Manual de Procedimentos.pdf','tipo'=>'PDF','tamanho'=>'1.2 MB','data'=>'10.10.2025'],
									['nome' => 'Lista de Preços.xlsx','tipo'=>'XLSX','tamanho'=>'240 KB','data'=>'01.09.2025'],
									['nome' => 'Relatorio_Mensal.docx','tipo'=>'DOCX','tamanho'=>'560 KB','data'=>'15.10.2025'],
								];
							@endphp
							@foreach($demo as $doc)
								<tr>
									<td>
										<div class="d-flex align-items-center gap-2">
											<span class="file-chip file-{{ strtolower($doc['tipo']) }}">
												@if($doc['tipo']==='PDF')<i class="fa fa-file-pdf"></i>
												@elseif($doc['tipo']==='XLSX')<i class="fa fa-file-excel"></i>
												@else<i class="fa fa-file-word"></i>@endif
											</span>
											<span class="fw-medium">{{ $doc['nome'] }}</span>
										</div>
									</td>
									<td><span class="badge bg-light text-dark">{{ $doc['tipo'] }}</span></td>
									<td>{{ $doc['tamanho'] }}</td>
									<td>{{ $doc['data'] }}</td>
									<td class="text-end">
										<div class="btn-group" role="group">
											<button class="btn btn-sm btn-primary btn-preview" data-nome="{{ $doc['nome'] }}">Visualizar</button>
											<a href="#" class="btn btn-sm btn-success">Download</a>
											<button class="btn btn-sm btn-danger btn-delete">Remover</button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{-- Grelha (cards) --}}
				<div class="view-grid d-none" id="viewGrid">
					<div class="row g-3">
						@foreach($demo as $doc)
						<div class="col-12 col-md-6 col-xl-4">
							<div class="doc-card h-100">
								<div class="d-flex align-items-start gap-3">
									<div class="doc-icon file-{{ strtolower($doc['tipo']) }}">
										@if($doc['tipo']==='PDF')<i class="fa fa-file-pdf"></i>
										@elseif($doc['tipo']==='XLSX')<i class="fa fa-file-excel"></i>
										@else<i class="fa fa-file-word"></i>@endif
									</div>
									<div class="flex-grow-1">
										<div class="d-flex align-items-start justify-content-between gap-2">
											<h6 class="mb-1 doc-title" title="{{ $doc['nome'] }}">{{ $doc['nome'] }}</h6>
											<span class="badge rounded-pill bg-light text-dark">{{ $doc['tipo'] }}</span>
										</div>
										<div class="text-muted small mb-2">{{ $doc['tamanho'] }} • {{ $doc['data'] }}</div>
										<div class="d-flex gap-2">
											<button class="btn btn-sm btn-outline-primary btn-preview" data-nome="{{ $doc['nome'] }}">Visualizar</button>
											<a href="#" class="btn btn-sm btn-outline-success">Download</a>
											<button class="btn btn-sm btn-outline-danger btn-delete">Remover</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Modal de Pré-visualização -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pré-visualizar documento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
			</div>
			<div class="modal-body">
				<p id="previewName" class="fw-bold"></p>
				<div id="previewContent" class="preview-box">
					<small class="text-muted">Conteúdo de demonstração</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
				<a id="downloadLink" href="#" class="btn btn-success">Download</a>
			</div>
		</div>
	</div>
	</div>

@push('styles')
<style>
	.mini-stat{background:#f8f9fb;border:1px solid #eef1f5;border-radius:10px;padding:.75rem 1rem;display:flex;justify-content:space-between;align-items:center}
	.mini-stat .mini-label{color:#6b7785;font-size:.85rem}
	.mini-stat .mini-value{font-weight:600}
	.file-chip{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:6px;color:#fff}
	.file-pdf{background:#e74c3c}
	.file-xlsx{background:#27ae60}
	.file-docx{background:#2980b9}
	.file-chip i{font-size:.9rem}
	.doc-card{border:1px solid #eef1f5;border-radius:12px;padding:1rem;transition:transform .15s ease, box-shadow .15s ease}
	.doc-card:hover{transform:translateY(-2px);box-shadow:0 .25rem 1rem rgba(0,0,0,.08)}
	.doc-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem}
	.preview-box{min-height:220px;border:1px dashed #ddd;padding:1rem;display:flex;align-items:center;justify-content:center;border-radius:10px}
	.view-grid .doc-title{max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
	.btn-outline-primary,.btn-outline-success,.btn-outline-danger{background:#fff}
	.view-toggle .btn{min-width:40px}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
	// Toggle List/Grid
	const btnList = document.getElementById('btnList');
	const btnGrid = document.getElementById('btnGrid');
	const viewList = document.getElementById('viewList');
	const viewGrid = document.getElementById('viewGrid');

	function setMode(mode){
		if(mode === 'grid'){
			viewList.classList.add('d-none');
			viewGrid.classList.remove('d-none');
			btnGrid.classList.add('active');
			btnList.classList.remove('active');
		} else {
			viewGrid.classList.add('d-none');
			viewList.classList.remove('d-none');
			btnList.classList.add('active');
			btnGrid.classList.remove('active');
		}
		try{ localStorage.setItem('docsViewMode', mode); }catch(e){}
	}

	btnList.addEventListener('click', ()=> setMode('list'));
	btnGrid.addEventListener('click', ()=> setMode('grid'));
	setMode(localStorage.getItem('docsViewMode') || 'list');

	// Preview Modal
	document.querySelectorAll('.btn-preview').forEach(function(btn){
		btn.addEventListener('click', function(){
			var nome = this.getAttribute('data-nome');
			document.getElementById('previewName').textContent = nome;
			document.getElementById('previewContent').innerHTML = '<div class="text-center"><i class="fa fa-file fa-3x text-primary"></i><p class="mt-2">Visualização de demo para: '+nome+'</p></div>';
			var modal = new bootstrap.Modal(document.getElementById('previewModal'));
			modal.show();
		});
	});

	// Pesquisa
	function filterDocs(){
		var q = (document.getElementById('docSearch').value || '').toLowerCase();
		// Tabela (Lista)
		document.querySelectorAll('#viewList tbody tr').forEach(function(row){
			var nome = row.cells[0].textContent.toLowerCase();
			row.style.display = nome.indexOf(q) !== -1 ? '' : 'none';
		});
		// Cards (Grelha)
		document.querySelectorAll('#viewGrid .doc-card').forEach(function(card){
			var nome = card.querySelector('.doc-title').textContent.toLowerCase();
			card.parentElement.style.display = nome.indexOf(q) !== -1 ? '' : 'none';
		});
	}
	document.getElementById('btnSearch').addEventListener('click', filterDocs);
	document.getElementById('docSearch').addEventListener('input', filterDocs);

	// Estatísticas (demo)
	const rows = Array.from(document.querySelectorAll('#viewList tbody tr'));
	const total = rows.length;
	const countBy = type => rows.filter(r => r.cells[1].innerText.trim() === type).length;
	document.getElementById('statTotal').innerText = total;
	document.getElementById('statPDF').innerText = countBy('PDF');
	document.getElementById('statXLSX').innerText = countBy('XLSX');
	document.getElementById('statDOCX').innerText = countBy('DOCX');
});
</script>
@endpush

@endsection