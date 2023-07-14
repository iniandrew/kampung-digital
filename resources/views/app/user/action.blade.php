<form action="{{ route('user.destroy', $users->id) }}" method="POST">
    <a href="{{ route('user.edit', $users->id) }}" class="btn btn-info" title="Edit"><i class=" fas fa-solid fa-user-pen"></i></a>
    {{-- @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin') --}}

        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-delete" data-name="{{ $users->name }}" data-toggle="toolip"><i class=" fas fa-solid fa-trash"></i></button>
        {{-- @endif --}}
</form>
