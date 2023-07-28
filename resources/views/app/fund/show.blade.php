@extends('layouts.app')

@push('css-libraries')
    <style>
        .infoFile{
        color: red;
        font-size: 13px;
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
                    <div class="breadcrumb-item"><a href="{{ route('fund.index') }}">Data Dana</a></div>
                    <div class="breadcrumb-item">Detail Dana</div>
                </div>
            </div>

            {{-- edit content --}}
            <div class="card">
                <form class="needs-validation" novalidate="" method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                      <h4>Form Detail Dana</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kategori Dana</label>
                            <select class="form-control @error('category') is-invalid @enderror" name="category" disabled>
                                <option selected disabled hidden value="">Silahkan Pilih</option>
                                <option value="Pemasukan" {{$dana->category == 'Pemasukan'?'selected':''}}>Pemasukan</option>
                                <option value="Pengeluaran" {{$dana->category == 'Pengeluaran'?'selected':''}}>Pengeluaran</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Rincian Dana</label>
                            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" style="height: 100px" disabled>{{ $dana->body }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="date" name="transaction_date" disabled class="form-control @error('transaction_date') is-invalid @enderror" value="{{ $dana->transaction_date }}">
                                @error('transaction_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Total</label>
                            <input type="text" name="amount" id="total" class="form-control @error('amount') is-invalid @enderror" disabled value="{{ number_format($dana->amount,0,',','.') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bukti Nota</label>
                            <div class="mt-2">
                                <a href="{{ asset('storage/dana/'. $dana->attachment) }}" target="_blank"><img id="preview-image-before-upload" src="{{ asset('storage/dana/'. $dana->attachment) }}"
                                alt="preview image" style="max-height: 250px;"></a>
                            </div>
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="{{ route('fund.index') }}" type="button" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
            {{-- end content --}}
        </section>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
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

            var bilangan = $('#total').attr('data-name');

            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            $('#total').attr('value', rupiah);
        });

    </script>
@endpush
