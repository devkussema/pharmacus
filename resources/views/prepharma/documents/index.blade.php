@extends('layout.app')

@section('titulo', 'Documentos')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex align-items-center mb-3">
					<h4 class="me-auto">Documentos do Sistema</h4>
					<div class="input-group" style="width:320px">
						<input type="text" id="docSearch" class="form-control" placeholder="Pesquisar documentos...">
						<button class="btn btn-outline-secondary" id="btnSearch">Pesquisar</button>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-hover" id="docsTable">
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
							{{-- Demo rows --}}
							@php
								$demo = [
									['nome' => 'Manual de Procedimentos.pdf','tipo'=>'PDF','tamanho'=>'1.2 MB','data'=>'10.10.2025'],
									['nome' => 'Lista de Preços.xlsx','tipo'=>'XLSX','tamanho'=>'240 KB','data'=>'01.09.2025'],
									['nome' => 'Relatorio_Mensal.docx','tipo'=>'DOCX','tamanho'=>'560 KB','data'=>'15.10.2025'],
								];
							@endphp
							@foreach($demo as $doc)
								<tr>
									<td>{{ $doc['nome'] }}</td>
									<td>{{ $doc['tipo'] }}</td>
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
				<div id="previewContent" style="min-height:200px; border:1px dashed #ddd; padding:1rem; display:flex; align-items:center; justify-content:center;">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
	document.querySelectorAll('.btn-preview').forEach(function(btn){
		btn.addEventListener('click', function(){
			var nome = this.getAttribute('data-nome');
			document.getElementById('previewName').textContent = nome;
			document.getElementById('previewContent').innerHTML = '<div class="text-center"><i class="fa fa-file-pdf fa-3x text-danger"></i><p class="mt-2">Visualização de demo para: '+nome+'</p></div>';
			var modal = new bootstrap.Modal(document.getElementById('previewModal'));
			modal.show();
		});
	});

	document.getElementById('btnSearch').addEventListener('click', function(){
		var q = document.getElementById('docSearch').value.toLowerCase();
		document.querySelectorAll('#docsTable tbody tr').forEach(function(row){
			var nome = row.cells[0].textContent.toLowerCase();
			row.style.display = nome.indexOf(q) !== -1 ? '' : 'none';
		});
	});
});
</script>
@endpush

@endsection