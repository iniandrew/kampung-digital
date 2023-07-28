@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('complaint.index') }}">Aduan</a></div>
                    <div class="breadcrumb-item">Review Aduan</div>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h4>@if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW) Form Review Aduan @else Detail Aduan @endif</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('complaint.review.store', $complaint->id) }}">
                            @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Judul Aduan</label>
                                    <input type="text" class="form-control" name="title" value="{{ $complaint->title }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Isi Aduan</label>
                                    <textarea name="content" id="" cols="30" rows="10" style="min-height: 150px" class="form-control" required readonly>{{ $complaint->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Bukti Aduan</label>
                                    <div class="input-group mb-3">
                                        <img src="{{ $complaint->proof }}" alt="Bukti Aduan">
                                    </div>
                                </div>
                            </div>
                            @if($complaint->status === \App\Models\Complaint::STATUS_NEED_REVIEW)
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="d-block">Apakah Aduan ini layak untuk ditampilkan?</label>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input review" type="radio" name="review" value="approve" id="review1" required>
                                            <label class="form-check-label mr-2" for="review1">Terima</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input review" type="radio" name="review" value="reject" id="review2">
                                            <label class="form-check-label mr-2" for="review2">Tolak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-danger mr-2">Batal</button>
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            @endif
                        </div>
                        </form>
                    </div>
            </div>
            @if($complaint->status === \App\Models\Complaint::STATUS_IN_PROGRESS)
            <div class="card">
                <form action="{{ route('complaint.respond', $complaint->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="card-header">
                        <h4>Form Tanggapan Aduan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Isi Tanggapan</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control" style="min-height: 150px">{{ old('content') }}</textarea>
                            <div class="invalid-feedback">Mohon isi tanggapannya!</div>
                        </div>
                        <div class="form-group">
                            <label>Bukti Tanggapan</label>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" value="" accept=".png, .jpg, .jpeg" aria-describedby="photoHelp" required>
                            <small id="photoHelp" class="form-text text-muted">
                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                            </small>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('complaint.index') }}" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            @endif
        </section>
    </div>
@endsection
