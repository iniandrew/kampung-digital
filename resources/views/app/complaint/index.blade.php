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
                    <div class="breadcrumb-item">Data Aduan</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Aduan</h4>
                                @if(auth()->user()->role === \App\Models\User::ROLE_WARGA)
                                    <a href="{{ route('complaint.create') }}" class="btn btn-primary btn-add">Tambah Aduan</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="complaintsTable">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            @if(auth()->user()->role !== \App\Models\User::ROLE_WARGA)
                                                <th>Pelapor</th>
                                            @endif
                                            <th>Judul Aduan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($complaints as $key => $complaint)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                @if(auth()->user()->role !== \App\Models\User::ROLE_WARGA)
                                                    <td>{{ $complaint->user->name }}</td>
                                                @endif
                                                <td>{{ $complaint->title }}</td>
                                                <td>
                                                    <span
                                                        class="badge @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW) badge-warning
                                                                     @elseif($complaint->status === \App\Models\Complaint::STATUS_IN_PROGRESS) badge-info
                                                                     @elseif($complaint->status === \App\Models\Complaint::STATUS_CLOSED) badge-success
                                                                     @else badge-danger
                                                               @endif"
                                                    >{{ $complaint->statusLabel }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW && $complaint->user_id === auth()->user()->id)
                                                            <a href="{{ route('complaint.edit', $complaint->id) }}" class="btn btn-icon btn-sm btn-warning mr-2" data-toggle="tooltip" title="Edit Aduan"><i class="fas fa-pencil"></i></a>
                                                        @endif
                                                        @if((auth()->user()->isAdministrator()))
                                                            @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW)
                                                                    <a href="{{ route('complaint.review', $complaint->id) }}" class="btn btn-icon btn-sm btn-warning mr-2" data-toggle="tooltip" title="Review Aduan"><i class="fas fa-file-signature"></i></a>
                                                            @endif
                                                            @if($complaint->status === \App\Models\Complaint::STATUS_IN_PROGRESS)
                                                                    <a href="{{ route('complaint.review', $complaint->id) }}" class="btn btn-icon btn-sm btn-primary mr-2" data-toggle="tooltip" title="Tanggapi Aduan"><i class="fas fa-check"></i></a>
                                                            @endif
                                                        @endif
                                                            <a href="{{ route('complaint.show', $complaint->id) }}" class="btn btn-icon btn-sm btn-success" data-toggle="tooltip" title="Lihat Aduan"><i class="fas fa-eye"></i></a>
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
