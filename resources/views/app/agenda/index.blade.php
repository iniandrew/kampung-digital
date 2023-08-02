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
                                    <table class="table table-striped responsive" id="tableData">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>No.</th>
                                                <th>Judul Agenda</th>
                                                <th width="100px">Tanggal</th>
                                                <th>Tempat</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>
@endpush

@push('script')
    <script type="text/javascript">
        $('#tableData').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: "{{ route('agenda.getData') }}",
            columns: [
                { data: "id", name: "id", visible: false },
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "title", name: "title" },
                { data: "start_date", "render": function (value) {
                              if (value === null) return "";
                              return moment(value).format('DD MMMM YYYY'); }
                },
                { data: "venue", name: "venue" },
                { data: "status", name: "status", orderable: false, searchable: false },
                { data: "actions", name: "actions", orderable: false, searchable: false },
            ],
            order: [[0, "desc"]],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
        });

        $('#tableData').on("click", ".btn-delete", function (e) {
            var form = $(this).closest("form");
            var title = $('.btn-delete').attr('data-name');
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Menghapus Agenda '+ title +'?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
  </script>
@endpush
