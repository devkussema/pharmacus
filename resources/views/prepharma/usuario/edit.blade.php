@extends('prepharma.layout.app')

@section('titulo', 'Editar Usuário')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('usuario') }}">Usuários</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Editar Usuário</li>
                    </ul>
                </div>
            </div>
        </div>

        @include('partials.session')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="feather-edit-3 me-2"></i>
                            Editar Informações do Usuário
                        </h4>
                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('usuario.enviar.email.boas.vindas', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="feather-send me-1"></i> Enviar boas-vindas
                                </button>
                            </form>
                            <form method="POST" action="{{ route('usuario.enviar.email.redefinicao', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    <i class="feather-refresh-ccw me-1"></i> Reenviar redefinição
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuario.update', $user->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')

                            <!-- Seção: Foto de Perfil -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="form-title border-bottom pb-2 mb-4">
                                        <i class="feather-camera me-2"></i>
                                        Foto de Perfil
                                    </h5>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="profile-upload-section text-center">
                                        <div class="profile-img-wrapper mb-3">
                                            <img id="profile-preview"
                                                 src="{{ $user->foto_perfil_url }}"
                                                 alt="Foto de Perfil"
                                                 class="profile-img-large rounded-circle border shadow-sm">
                                            <div class="camera-icon">
                                                <i class="feather-camera"></i>
                                            </div>
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <input type="file"
                                                   class="form-control d-none"
                                                   id="foto_perfil"
                                                   name="foto_perfil"
                                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                                            <label for="foto_perfil" class="btn btn-outline-primary btn-upload">
                                                <i class="feather-upload me-2"></i>
                                                Alterar Foto
                                            </label>
                                            <small class="text-muted d-block mt-2">
                                                Formatos aceitos: JPG, PNG, GIF (máx. 2MB)
                                            </small>
                                        </div>
                                        @error('foto_perfil')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Seção: Informações Pessoais -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="form-title border-bottom pb-2 mb-4">
                                        <i class="feather-user me-2"></i>
                                        Informações Pessoais
                                    </h5>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                               class="form-control @error('nome') is-invalid @enderror"
                                               id="nome"
                                               name="nome"
                                               value="{{ old('nome', $user->nome) }}"
                                               placeholder="Nome Completo"
                                               required>
                                        <label for="nome">
                                            <i class="feather-user me-2"></i>
                                            Nome Completo <span class="text-danger">*</span>
                                        </label>
                                        @error('nome')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{ old('email', $user->email) }}"
                                               placeholder="Email"
                                               required>
                                        <label for="email">
                                            <i class="feather-mail me-2"></i>
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel"
                                               class="form-control @error('telefone') is-invalid @enderror"
                                               id="telefone"
                                               name="telefone"
                                               value="{{ old('telefone', $user->telefone) }}"
                                               placeholder="+244 900 000 000">
                                        <label for="telefone">
                                            <i class="feather-phone me-2"></i>
                                            Telefone
                                        </label>
                                        <div class="form-text">
                                            Formato: +244 900 000 000
                                        </div>
                                        @error('telefone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                               class="form-control"
                                               id="username"
                                               value="{{ $user->username ?? 'Não definido' }}"
                                               readonly>
                                        <label for="username">
                                            <i class="feather-at-sign me-2"></i>
                                            Nome de Usuário
                                        </label>
                                        <div class="form-text">
                                            Gerado automaticamente baseado no nome
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Seção: Configurações do Sistema -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="form-title border-bottom pb-2 mb-4">
                                        <i class="feather-settings me-2"></i>
                                        Configurações do Sistema
                                    </h5>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('grupo_id') is-invalid @enderror"
                                                id="grupo_id"
                                                name="grupo_id">
                                            <option value="">Selecionar Grupo</option>
                                            @foreach($grupos as $grupo)
                                                <option value="{{ $grupo->id }}"
                                                        {{ old('grupo_id', $user->grupo_id) == $grupo->id ? 'selected' : '' }}>
                                                    {{ $grupo->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="grupo_id">
                                            <i class="feather-users me-2"></i>
                                            Grupo
                                        </label>
                                        @error('grupo_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('isFarmacia') is-invalid @enderror"
                                                id="isFarmacia"
                                                name="isFarmacia">
                                            <option value="0" {{ old('isFarmacia', $user->isFarmacia) == '0' ? 'selected' : '' }}>
                                                Usuário
                                            </option>
                                            <option value="1" {{ old('isFarmacia', $user->isFarmacia) == '1' ? 'selected' : '' }}>
                                                Gerente
                                            </option>
                                        </select>
                                        <label for="isFarmacia">
                                            <i class="feather-shield me-2"></i>
                                            Tipo de Usuário
                                        </label>
                                        @error('isFarmacia')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-3 position-relative">
                                        <div class="status-switch-container">
                                            <div class="form-check form-switch form-switch-lg d-flex align-items-center h-100">
                                                <input class="form-check-input me-3"
                                                       type="checkbox"
                                                       role="switch"
                                                       id="status"
                                                       name="status"
                                                       value="1"
                                                       {{ old('status', $user->status) ? 'checked' : '' }}>
                                                <div class="switch-label-content">
                                                    <label class="form-check-label mb-0" for="status">
                                                        <i class="feather-power me-2"></i>
                                                        <strong>Conta Ativa</strong>
                                                    </label>
                                                    <small class="d-block text-muted status-text">
                                                        {{ old('status', $user->status) ? 'Usuário pode acessar o sistema' : 'Usuário bloqueado' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="floating-label-hidden">Status</label>
                                        @error('status')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-actions bg-light rounded p-4 text-end">
                                        <button type="button"
                                                class="btn btn-outline-secondary btn-lg me-3"
                                                onclick="window.history.back()">
                                            <i class="feather-arrow-left me-2"></i>
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="feather-save me-2"></i>
                                            Atualizar Usuário
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
        .profile-upload-section {
            max-width: 300px;
            margin: 0 auto;
        }

        .profile-img-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-img-large {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .camera-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--bs-primary);
            color: white;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .btn-upload {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .form-title {
            color: var(--bs-primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-floating > label {
            font-weight: 500;
        }

        .form-actions {
            border: 1px solid #e9ecef;
            margin-top: 2rem;
        }

        .status-switch-container {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            height: calc(3.5rem + 2px);
            display: flex;
            align-items: center;
        }

        .floating-label-hidden {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .switch-label-content {
            flex: 1;
        }

        .form-switch-lg .form-check-input {
            width: 3rem;
            height: 1.5rem;
            margin-top: 0;
        }

        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #06b6d4 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .card-header .card-title {
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
            font-weight: 600;
        }

        .invalid-feedback {
            font-weight: 500;
        }

        .form-text {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>

    <!-- Scripts -->
    <script>
        // Preview da imagem
        document.getElementById('foto_perfil').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validar tamanho do arquivo (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('O arquivo deve ter no máximo 2MB');
                    this.value = '';
                    return;
                }

                // Validar tipo do arquivo
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Apenas arquivos JPG, PNG e GIF são permitidos');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Atualizar texto do status dinamicamente
        document.getElementById('status').addEventListener('change', function() {
            const statusText = document.querySelector('.status-text');
            statusText.textContent = this.checked ?
                'Usuário pode acessar o sistema' :
                'Usuário bloqueado';
        });

        // Formatação do telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('244')) {
                value = value.substring(3);
            }
            if (value.length > 0) {
                value = '+244 ' + value.replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3');
            }
            e.target.value = value;
        });

        // Validação do formulário
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    
@endsection
