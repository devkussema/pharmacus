@foreach($users as $user)
    <tr>
        <td>
            <div class="form-check check-tables">
                <input class="form-check-input" type="checkbox" value="{{ $user->id }}">
            </div>
        </td>
        <td class="profile-image"><a href="{{ route('cp.users.index', $user->id) }}">
                <img width="28" height="28" src="{{ $user->foto_perfil ? asset('storage/'.$user->foto_perfil) : assetr('assets/img/profiles/avatar-01.jpg') }}" class="rounded-circle m-r-5" alt>
                {{ $user->nome }}</a>
        </td>
        <td>{{ $user->grupo?->nome ?? '-' }}</td>
        <td>-</td>
        <td>-</td>
        <td><a href="javascript:;">{{ $user->telefone ?? '-' }}</a></td>
        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
        <td>{{ $user->created_at?->format('d.m.Y') ?? '-' }}</td>
        <td class="text-end">
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('cp.users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_patient"><i class="fa fa-trash-alt m-r-5"></i> Delete</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
