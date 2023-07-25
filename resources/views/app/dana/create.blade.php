@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="javascript:void(0);">Dana</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('dana.index') }}">List Dana</a></div>
                    <div class="breadcrumb-item">Tambah Dana</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="{{ route('dana.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                      <h4>Form Tambah Dana</h4>
                    </div>
                    <div class="container">
                        @error('bukti_nota')
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
                            <label>Kategori Dana</label>
                            <select class="form-control required" name="kategori" required>
                                <option selected disabled hidden value="">Silahkan Pilih</option>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                            <div class="invalid-feedback">Kategori dananya apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Rincian Dana</label>
                            <textarea name="rincian" id="" cols="30" rows="10" class="form-control" required></textarea>
                            <div class="invalid-feedback">Rincian dananya untuk apa?</div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                </div>
                                <input type="date" name="tanggal_transaksi" required class="form-control">
                                <div class="invalid-feedback">Tanggal transaksinya kapan?</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="text" name="total" id="total" class="form-control" required>
                            <div class="invalid-feedback">Totalnya berapa?</div>
                        </div>
                        <div class="form-group">
                            <label>Bukti Nota</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input image" id="customFile" name="bukti_nota" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <span class="infoFile">File extensi : JPG, PNG, JPEG</span><br>
                            <span class="infoFile">Ukuran Max File: 1MB</span>
                            <div class="invalid-feedback">Buktinya mana?</div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <img id="preview-image-before-upload" src="{{ Vite::asset('resources/images/no_image.png') }}"
                                alt="preview image" style="max-height: 250px;">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <button a href="{{ route('dana.index') }}" type="button" class="btn btn-danger">Batal</button>
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
    <style>
        .infoFile{
        color: red;
        font-size: 13px;
    }
    </style>
@endpush
@push('script')
<script src="{{ asset('js/timepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#start').timepicker();
            $('#finish').timepicker();
        });

        $(document).ready(function (e) {
            $('.image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            var total = document.getElementById('total');
            total.addEventListener('keyup', function(e){
                total.value = formatRupiah(this.value, '');
            });

            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
            }

        });

    </script>
@endpush
