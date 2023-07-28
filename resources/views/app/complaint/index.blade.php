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
                    <div class="breadcrumb-item"><a href="#">Aduan</a></div>
                    <div class="breadcrumb-item">Daftar Aduan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Aduan</h4>
                                <a href="{{ route('complaint.create') }}" class="btn btn-primary btn-add">Tambah Aduan</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="complaintsTable">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul Agenda</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($complaints as $key => $complaint)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $complaint->title }}</td>
                                                <td>{{ $complaint->status }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW && $complaint->user_id === auth()->user()->id)
                                                            <a href="{{ route('complaint.edit', $complaint->id) }}" class="btn btn-icon btn-sm btn-warning "><i class="fas fa-pencil"></i></a>
                                                        @endif
                                                        @if((auth()->user()->role === \App\Models\User::ROLE_SUPER_ADMIN || auth()->user()->role === \App\Models\User::ROLE_ADMIN) && ($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW || $complaint->status === \App\Models\Complaint::STATUS_IN_PROGRESS))
                                                            <a href="{{ route('complaint.review', $complaint->id) }}" class="btn btn-icon btn-sm btn-dark mr-2"><i class="fas fa-file"></i></a>
                                                        @endif
                                                            <a href="{{ route('complaint.show', $complaint->id) }}" class="btn btn-icon btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                    </div>
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
            $('#complaintsTable').DataTable();
        });
    </script>
@endpush
