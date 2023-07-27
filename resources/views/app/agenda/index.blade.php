@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="agenda">Agenda</a></div>
                    <div class="breadcrumb-item">Data Agenda</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Agenda</h4>
                                @if (Auth::user()->role == 'Super Admin')
                                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-add">Tambah Agenda</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tableData">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Judul Agenda</th>
                                                <th>Rentang Tanggal</th>
                                                <th>Tempat</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAgenda as $iteration => $item)
                                                <tr>
                                                    <td>{{$iteration+1}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{ date('d M, Y', strtotime($item->start_date)) }} - {{ date('d M, Y', strtotime($item->end_date)) }}</td>
                                                    <td>{{$item->venue}}</td>
                                                    <td>
                                                        @if ($item->status == 'arsip')
                                                            <div class="badge badge-warning">Arsip</div>
                                                        @elseif($item->status == 'segera')
                                                            <div class="badge badge-info">Segera</div>
                                                         @else
                                                            <div class="badge badge-success">Selesai</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('agenda.destroy', $item->id) }}" method="POST">
                                                            @if (Auth::user()->role == 'Super Admin')
                                                                <a href="{{ route('agenda.edit', $item->id) }}" class="btn btn-info" title="Edit"><span class="fas fa-edit"></span></a>

                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger show_confirm" data-name="{{ $item->Title }}" data-toggle="toolip"><i class="fas fa-trash"></i></button>
                                                                @else
                                                                <a class="btn btn-primary" href="{{ route('agenda.show', $item->id) }}" title="Detail"><i class="fas fa-info"></i></a>
                                                            @endif
                                                        </form>
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
            {{-- end content --}}
        </section>
    </div>
@endsection

@push('js-libraries')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('script')
    <script type="text/javascript">
        $('#tableData').DataTable({});

       $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          var Title = $(this).attr('data-name');
          event.preventDefault();
          swal({
              title: `Apakah anda yakin ingin menghapus agenda `+Title+ ' ?',
              text: "Jika anda hapus, data agenda "+Title+" akan hilang permanen",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  </script>
@endpush
