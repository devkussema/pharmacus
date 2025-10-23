@forelse($users as $user)
    <tr>
        <td>
            <div class="form-check check-tables">
                <input class="form-check-input" type="checkbox" value="{{ $user->id }}">
            </div>
        </td>
        <td class="profile-image"><a href="{{ route('cp.users.show', $user->id) }}">
                <img width="28" height="28" src="{{ $user->foto_perfil ? asset('storage/'.$user->foto_perfil) : asset('prepharma/img/profiles/avatar-01.jpg') }}" class="rounded-circle m-r-5" alt>
                {{ $user->nome }}</a>
        </td>
        <td>{{ $user->grupo?->nome ?? '-' }}</td>
        <td>{{ $user->telefone ?? '-' }}</td>
        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
        <td>{{ $user->created_at?->format('d.m.Y') ?? '-' }}</td>
        <td class="text-end">
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('cp.users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square m-r-5"></i> Editar</a>
                    <form action="{{ route('cp.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Tem a certeza que deseja remover este utilizador?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger"><i class="fa fa-trash-alt m-r-5"></i> Remover</button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center">Nenhum utilizador encontrado.</td>
    </tr>
@endforelse
