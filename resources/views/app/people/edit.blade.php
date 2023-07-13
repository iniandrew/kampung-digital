@extends('layouts.app')

@section('content')
   <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('people.index') }}">Data Warga</a></div>
                    <div class="breadcrumb-item">Edit Warga</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <div class="card-header">
                  <h4>Form Edit Warga</h4>
                </div>
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('people.update', $people->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Warga</label>
                                    <input type="text" name="name" value="{{ $people->name }}" class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" name="nik" value="{{ $people->nik }}" class="form-control @error('nik') is-invalid @enderror" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" value="{{ $people->date_of_birth }}" class="form-control @error('date_of_birth') is-invalid @enderror" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ $people->place_of_birth }}" required name="place_of_birth">
                                    @error('place_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $people->address }}" required name="address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $people->phone_number }}" required name="phone_number">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control required @error('gender') is-invalid @enderror" name="gender" required>
                                        <option selected disabled hidden value="">Silahkan Pilih</option>
                                        <option value="Laki-Laki" @if ($people->gender == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                        <option value="Perempuan" @if ($people->gender == 'Perempuan') selected @endif>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control required @error('religion') is-invalid @enderror" name="religion" required>
                                        <option selected disabled hidden value="">Silahkan Pilih</option>
                                        <option value="Islam" @if ($people->religion == 'Islam') selected @endif>Islam</option>
                                        <option value="Kristen Protestan" @if ($people->religion == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                        <option value="Kristen Katolik" @if ($people->religion == 'Kristen Katolik') selected @endif>Kristen Katolik</option>
                                        <option value="Hindu" @if ($people->religion == 'Hindu') selected @endif>Hindu</option>
                                        <option value="Budha" @if ($people->religion == 'Budha') selected @endif>Budha</option>
                                        <option value="Konghucu" @if ($people->religion == 'Konghucu') selected @endif>Konghucu</option>
                                    </select>
                                    @error('religion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control @error('job') is-invalid @enderror" value="{{ $people->job }}" required name="job">
                                    @error('job')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group form-anggota">
                                    <label class="d-block">Status Pernikahan</label>
                                    <div class="form-check">
                                      <input class="form-check-input @error('married_status') is-invalid @enderror" type="radio" value="Menikah" name="married_status" id="status1" required @if ($people->married_status == "Menikah") checked @endif>
                                      <label class="form-check-label" for="status1">
                                        Menikah
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input @error('married_status') is-invalid @enderror" type="radio" value="Lajang" name="married_status" id="status2" required @if ($people->married_status == "Lajang") checked @endif>
                                      <label class="form-check-label" for="status2">
                                        Lajang
                                      </label>
                                    </div>
                                    @error('married_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Kartu Keluarga</label>
                            <input type="number" class="form-control @error('family_card_number') is-invalid @enderror" required value="{{ $people->family_card_number }}" name="family_card_number">
                            @error('family_card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="{{ route('people.index') }}" type="button" class="btn btn-danger">Batal</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection
