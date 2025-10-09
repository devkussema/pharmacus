@forelse ($usuarios as $usuario)
    <tr>
        <td>
            <div class="form-check check-tables">
                <input class="form-check-input" type="checkbox" value="{{ $usuario->id }}">
            </div>
        </td>
        <td class="profile-image">
            <a href="{{ route('gerente.funcionarios', $usuario->id) }}">
                {{ $usuario->nome }}
            </a>
        </td>
        <td>{{ $usuario->cargo->nome ?? 'N/A' }}</td>
        <td>{{ $usuario->userAreaHospitalar->areaHospitalar->nome ?? 'N/A' }}</td>
        <td>{{ $usuario->userAreaHospitalar->contato ?? 'N/A' }}</td>
        <td>
            @php
                $estadoRaw = strtolower($usuario->estado ?? $usuario->status ?? 'inativo');
                $badgeClass = match($estadoRaw) {
                    'true', 'active', '1', 'ativo' => 'status-green',
                    'pendente', 'pending' => 'status-orange',
                    default => 'status-red'
                };
                $estadoLabel = match($estadoRaw) {
                    'true', 'active', '1', 'ativo' => 'Ativo',
                    'pendente', 'pending' => 'Pendente',
                    default => 'Inativo'
                };
            @endphp
            <div class="dropdown action-label">
                <a class="custom-badge {{ $badgeClass }} dropdown-toggle" href="#"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $estadoLabel }}
                </a>
                <div class="dropdown-menu dropdown-menu-end status-staff">
                    <a class="dropdown-item change-status" href="#" data-user="{{ $usuario->id }}" data-status="ativo">Ativo</a>
                    <a class="dropdown-item change-status" href="#" data-user="{{ $usuario->id }}" data-status="pendente">Pendente</a>
                    <a class="dropdown-item change-status" href="#" data-user="{{ $usuario->id }}" data-status="inativo">Inativo</a>
                </div>
            </div>
        </td>
        <td class="text-end">
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square m-r-5"></i> Editar</a>
                    
                    {{-- Nova lógica simplificada --}}
                    @if($usuario->pode_cadastrar_produtos)
                        <a class="dropdown-item toggle-permission" href="#" 
                           data-user="{{ $usuario->id }}" 
                           data-permission="false">
                            <i class="fa fa-times-circle m-r-5 text-danger"></i> Remover permissão de cadastro
                        </a>
                    @else
                        <a class="dropdown-item toggle-permission" href="#" 
                           data-user="{{ $usuario->id }}" 
                           data-permission="true">
                            <i class="fa fa-check-circle m-r-5 text-success"></i> Dar permissão de cadastro
                        </a>
                    @endif
                    
                    <a class="dropdown-item delete-user" href="#" data-user="{{ $usuario->id }}" data-nome="{{ $usuario->nome }}">
                        <i class="fa fa-trash-alt m-r-5"></i> Eliminar
                    </a>
                </div>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-4">
            <i class="fa fa-users fa-2x text-muted mb-2"></i>
            <p class="text-muted">Nenhum funcionário encontrado</p>
        </td>
    </tr>
@endforelse
