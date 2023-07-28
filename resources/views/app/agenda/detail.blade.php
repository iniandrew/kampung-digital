@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Data Agenda</a></div>
                    <div class="breadcrumb-item">Detail Agenda</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="#">
                    @csrf
                    <div class="card-header">
                      <h4>Form Detail Agenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Agenda</label>
                            <input type="text" class="form-control" required="" value="{{ $agenda->title }}" name="title" readonly>
                            <div class="invalid-feedback">Judul agendanya apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Isi Agenda</label>
                            <textarea name="content" id="" cols="30" rows="10" style="height: 100px" class="form-control" required readonly>{{ $agenda->content }}</textarea>
                            <div class="invalid-feedback">Rincian agendanya?</div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Agenda</label>
                            <input type="text" class="form-control" required name="venue" value="{{ $agenda->venue }}" readonly>
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
                                      <input type="date" name="start_date" required readonly class="form-control" value="{{ $agenda->start_date }}">
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
                                      <input type="date" name="end_date" required readonly class="form-control" value="{{ $agenda->end_date }}">
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
                                      <input type="text" name="start_time" required readonly class="form-control" id="start" value="{{ $agenda->start_time }}">
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
                                      <input type="text" name="end_time" readonly required class="form-control" id="finish" value="{{ $agenda->end_time }}">
                                      <div class="invalid-feedback">Waktu selesainya kapan?</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Agenda</label>
                            <input type="text" class="form-control" value="{{ $agenda->status }}" readonly>
                            <div class="invalid-feedback">Status Agendanya gimana?</div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a type="button" href="{{ route('agenda.index') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection

