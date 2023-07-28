@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('complaint.index') }}">Aduan</a></div>
                    <div class="breadcrumb-item">Edit Aduan</div>
                </div>
            </div>

            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data" action="{{ route('complaint.update', $complaint->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-header">
                        <h4>Form Edit Aduan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Aduan</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $complaint->title }}" required>
                            <div class="invalid-feedback">Mohon isi judul aduan!</div>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Isi Aduan</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" style="min-height: 100px" required>{{ $complaint->content }}</textarea>
                            <div class="invalid-feedback">Mohon isi aduannya!</div>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bukti Aduan</label>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" value="" accept=".png, .jpg, .jpeg" aria-describedby="photoHelp">
                            <small id="photoHelp" class="form-text text-muted">
                                <li>Ekstensi file harus : PNG, JPG, JPEG</li>
                            </small>

                            @error('attachment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @if($complaint->attachment)
                            <div class="input-group-append">
                                <a href="{{ $complaint->proof }}" class="btn btn-primary" target="_blank">Lihat Bukti</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('complaint.index') }}" type="button" class="btn btn-danger mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
