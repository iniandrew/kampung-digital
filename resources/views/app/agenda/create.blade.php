@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="javascript:void(0);">Agenda</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('agenda.index') }}">List Agenda</a></div>
                    <div class="breadcrumb-item">Tambah Agenda</div>
                </div>
            </div>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('agenda.store') }}">
                    @csrf
                    <div class="card-header">
                      <h4>Form Tambah Agenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" hidden name="user_id" value="{{ Auth::user()->id }}">
                            <label>Judul Agenda</label>
                            <input type="text" class="form-control" required="" name="title">
                            <div class="invalid-feedback">Judul agendanya apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Isi Agenda</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control" required></textarea>
                            <div class="invalid-feedback">Rincian agendanya?</div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Agenda</label>
                            <input type="text" class="form-control" required name="venue">
                            <div class="invalid-feedback">Tempatnya dimana?</div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-calendar"></i>
                                        </div>
                                      </div>
                                      <input type="date" name="start_date" required class="form-control">
                                      <div class="invalid-feedback">Tanggal mulainya kapan?</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-calendar"></i>
                                        </div>
                                      </div>
                                      <input type="date" name="end_date" required class="form-control">
                                      <div class="invalid-feedback">Tanggal selesainya kapan?</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu Mulai</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-calendar"></i>
                                        </div>
                                      </div>
                                      <input type="text" name="start_time" required class="form-control" id="start">
                                      <div class="invalid-feedback">Waktu mulainya kapan?</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-calendar"></i>
                                        </div>
                                      </div>
                                      <input type="text" name="end_time" required class="form-control" id="finish">
                                      <div class="invalid-feedback">Waktu selesainya kapan?</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Agenda</label>
                            <select class="form-control required" name="status" required>
                                <option selected disabled hidden value="">Silahkan Pilih</option>
                                <option value="arsip">Arsip</option>
                                <option value="segera">Segera</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <div class="invalid-feedback">Status Agendanya gimana?</div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="{{ route('agenda.index') }}" type="button" class="btn btn-danger">Batal</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection
@push('titlePages')
    {{$titlePage}}
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('css/timepicker.min.css') }}">
@endpush
@push('js')
<script src="{{ asset('js/timepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#start').timepicker();
            $('#finish').timepicker();
        });
    </script>
@endpush
