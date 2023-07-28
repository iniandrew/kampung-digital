@if ($agendas->status == 'Arsip')
    <div class="badge badge-warning">Arsip</div>
@elseif($agendas->status == 'Segera')
    <div class="badge badge-info">Segera</div>
    @else
    <div class="badge badge-success">Selesai</div>
@endif
