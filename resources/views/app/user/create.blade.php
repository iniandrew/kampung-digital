@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <style>
        body{
            overflow-x: hidden
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Pengguna</a></div>
                    <div class="breadcrumb-item">Tambah Pengguna</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="card-header">
                      <h4>Form Tambah Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Warga</label>
                            <select class="form-control select2 @error('people_id') is-invalid @enderror" name="people_id" required>
                                <option selected disabled hidden value="">Silahkan Pilih Warga</option>
                                @foreach ($peoples as $people)
                                    <option value="{{ $people->id }}" @if (old('people_id') == $people->id) selected @endif>{{ $people->name }}</option>
                                @endforeach
                            </select>
                            @error('people_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control required" name="role" required>
                                <option selected disabled hidden value="">Silahkan Pilih</option>
                                <option value="Super Admin" @if (old('role') == 'Super Admin') selected @endif>Super Admin</option>
                                <option value="Admin" @if (old('role') == 'Admin') selected @endif>Admin</option>
                                <option value="Bendahara" @if (old('role') == 'Bendahara') selected @endif>Bendahara</option>
                                <option value="Warga" @if (old('role') == 'Warga') selected @endif>Warga</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" required name="password" placeholder="Masukkan Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="{{ route('user.index') }}" type="button" class="btn btn-danger">Batal</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection

@push('js-libraries')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush
