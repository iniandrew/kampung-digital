@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
     <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="javascript:void(0);">Warga</a></div>
                    <div class="breadcrumb-item">List Warga</div>
                </div>
            </div>
            {{-- edit content --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Warga</h4>
                                {{-- @if (Auth::user()->jabatan->nama_jabatan == 'Super Admin' || Auth::user()->jabatan->nama_jabatan == 'Admin') --}}
                                    <a href="{{ route('people.create') }}" class="btn btn-primary btn-add">Tambah Warga</a>
                                {{-- @endif --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tableData">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">No.</th>
                                                <th>Nama Warga</th>
                                                <th>NIK</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($peoples as $key => $people)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $people->name }}</td>
                                                    <td>{{ $people->nik }}</td>
                                                    <td>{{ $people->address }}</td>
                                                    <td>
                                                        @if ($people->akun == 1)
                                                            <div class="badge badge-success">Aktif</div>
                                                        @else
                                                            <div class="badge badge-danger">Mati</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('people.edit', $people->id) }}" class="btn btn-info" title="Edit"><span class="fas fa-solid fa-user-pen"></span></a>
                                                        <a class="btn btn-primary" href="{{ route('people.show', $people->id) }}" title="Detail"><i class="fas fa-solid fa-circle-info"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
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
    <script>
        $(document).ready(function () {
            $('#tableData').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{ route('people.getData') }}",
                columns: [
                    { data: "id", name: "id", visible: false },
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                    { data: "name", name: "name" },
                    { data: "nik", name: "nik" },
                    { data: "address", name: "address" },
                    { data: "actions", name: "actions", orderable: false, searchable: false },
                ],
                order: [[0, "desc"]],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
            });
        });
    </script>
@endpush
