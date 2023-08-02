@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-wallet icon-card"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Dana</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{number_format($fund,2,',','.')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-file-alt icon-card"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Aduan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalComplaints }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-users icon-card"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Warga</h4>
                            </div>
                            <div class="card-body">
                                {{ $villages }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aduan Terbaru</h4>
                            <div class="card-header-action">
                                <a href="{{ route('complaint.index') }}" class="btn btn-primary">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul Aduan</th>
                                        <th scope="col">Isi Aduan</th>
                                        <th scope="col">Pengadu</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @forelse ($complaints as $complaint)
                                        <tr>
                                            <td>{{ $complaint->title }}</td>
                                            <td class="p-2">{{ $complaint->content }}</td>
                                            <td>{{ $complaint->user->name }}</td>
                                            <td>
                                                <span
                                                    class="badge @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW) badge-warning
                                                                     @elseif($complaint->status === \App\Models\Complaint::STATUS_IN_PROGRESS) badge-info
                                                                     @elseif($complaint->status === \App\Models\Complaint::STATUS_CLOSED) badge-success
                                                                     @else badge-danger
                                                               @endif"
                                                >{{ $complaint->statusLabel }}</span>
                                            </td>
                                        </tr>
                                     @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data aduan.</td>
                                        </tr>
                                     @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Agenda Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($schedules as $schedule)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="float-right text-primary">{{ date('d M, Y', strtotime($schedule->created_at)) }}</div>
                                            <div class="media-title">{{ $schedule->title }}</div>
                                            <span class="text-small text-muted">
                                                {!! Str::words($schedule->content, 30, '...') !!}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-center pt-1 pb-1">
                                <a href="{{ route('agenda.index') }}" class="btn btn-primary btn-lg btn-round">
                                Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
