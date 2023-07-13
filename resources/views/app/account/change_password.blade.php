@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="javascript:void(0);">Akun</a></div>
                    <div class="breadcrumb-item">Ubah Password</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="#">
                    @csrf
                    <div class="card-header">
                      <h4>Form Ubah Password</h4>
                    </div>
                    <div class="container">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ $message }}
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" required="" name="old_password" value="{{ old('old_password') }}">
                            <div class="invalid-feedback">Password Lamanya apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" required="" name="password" value="{{ old('password') }}">
                            <div class="invalid-feedback">Password Barunya apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" required="" name="password_confirmation">
                            <div class="invalid-feedback">Ulangi Password Baru anda?</div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection
