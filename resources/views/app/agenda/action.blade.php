<form action="{{ route('agenda.destroy', $agendas->id) }}" class="formDelete" method="POST">
    @if (Auth::user()->role == 'Super Admin')
        <a href="{{ route('agenda.edit', $agendas->id) }}" class="btn btn-info" title="Edit"><span class="fas fa-edit"></span></a>

        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-delete" data-name="{{ $agendas->title }}"><i class="fas fa-trash"></i></button>
        @else
        <a class="btn btn-primary" href="{{ route('agenda.show', $agendas->id) }}" title="Detail"><i class="fas fa-info"></i></a>
    @endif
</form>
