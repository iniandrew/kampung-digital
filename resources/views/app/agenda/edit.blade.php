@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="sha512-E4kKreeYBpruCG4YNe4A/jIj3ZoPdpWhWgj9qwrr19ui84pU5gvNafQZKyghqpFIHHE4ELK7L9bqAv7wfIXULQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bootstrap-timepicker-widget table td input {
            width: 50px;
            margin: 0;
            text-align: center;
        }
        .bootstrap-timepicker-widget table td a {
            border: 1px #0b0b0b solid;
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
                    <div class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Data Agenda</a></div>
                    <div class="breadcrumb-item">Edit Agenda</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('agenda.update', $agenda->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                      <h4>Form Edit Agenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Agenda</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $agenda->title }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Isi Agenda</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" style="height: 100px">{{ $agenda->content }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tempat Agenda</label>
                            <input type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ $agenda->venue }}">
                            @error('venue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $agenda->start_date }}">
                                    @error('start_date)')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $agenda->end_date }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu Mulai</label>
                                    <input type="text" name="start_time" class="form-control timepicker @error('start_time') is-invalid @enderror" id="start" value="{{ $agenda->start_time }}">
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <input type="text" name="end_time" class="form-control timepicker @error('end_time') is-invalid @enderror" id="finish" value="{{ $agenda->end_time }}">
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Agenda</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" style="height: 45px">
                                <option selected disabled hidden value="">Silahkan Pilih</option>
                                <option value="arsip" @if ($agenda->status == "arsip") selected @endif>Arsip</option>
                                <option value="segera" @if ($agenda->status == "segera") selected @endif>Segera</option>
                                <option value="selesai" @if ($agenda->status == "selesai") selected @endif>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

@push('js-libraries')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.timepicker').timepicker();
        });
    </script>
@endpush
