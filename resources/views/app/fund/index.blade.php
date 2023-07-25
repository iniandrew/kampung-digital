@extends('layouts.app')

@push('css-libraries')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="javascript:void(0);">Dana</a></div>
                    <div class="breadcrumb-item">List Dana</div>
                </div>
            </div>
            {{-- edit content --}}
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Dana</h4>
                                @if (Auth::user()->role == 'Bendahara')
                                    <a href="{{ route('fund.create') }}" class="btn btn-primary btn-add">Tambah Dana</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataDana as $iteration => $item)
                                                <tr>
                                                    <td>{{$iteration+1}}</td>
                                                    <td>{{$item->category}}</td>
                                                    <td>{{ date('d M, Y', strtotime($item->transaction_date)) }}</td>
                                                    <td>Rp. {{number_format($item->amount,2,',','.')}}</td>
                                                    <td>
                                                        <form action="{{ route('fund.destroy', $item->id) }}" method="POST">
                                                            @if (Auth::user()->role == 'Bendahara')
                                                                <a href="{{ route('fund.edit', $item->id) }}" class="btn btn-info" title="Edit"><span class="fas fa-edit"></span></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger show_confirm" data-name=" {{ date('d M, Y', strtotime($item->tanggal_transaksi)) }} " data-toggle="toolip"><i class="fas fa-trash"></i></button>
                                                            @else
                                                                <a class="btn btn-primary" href="{{ route('fund.show', $item->id) }}" title="Detail"><i class="ion-ios-information-outline"></i></a>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <h4>Informasi Saldo saat ini</h4>
                                    <p>Total Pemasukan : Rp. {{number_format($inflow,2,',','.')}}</p>
                                    <p>Total Pengeluaran : Rp. {{number_format($outlay,2,',','.')}}</p>
                                    <h4>Total Sisa Saldo : Rp. {{number_format($inflow - $outlay,2,',','.')}}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end content --}}
        </section>
    </div>

@endsection
@push('titlePages')
    {{$titlePage}}
@endpush
@push('js-libraries')
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>
@endpush

@push('script')
    <script type="text/javascript">

       $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          var judul = $(this).attr('data-name');
          event.preventDefault();
          swal({
              title: `Apakah anda yakin ingin menghapus dana pada tanggal `+judul+ ' ?',
              text: "Jika anda hapus, data dana akan hilang permanen",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  </script>
@endpush
