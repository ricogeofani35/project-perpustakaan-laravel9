@extends('layouts.admin')

@section('datatables_css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('header', 'transaction')
@section('content')
<component id="container">
    <div class="d-flex justify-content-between mb-3 mt-3">
        <a class="btn btn-primary" href="{{ url('/transaction/create') }}" @click='addData()'>Tambah Transaksi</a>
        <div class="right d-flex gap-2">
            <select class="form-control" name="status">
                <option value="0">Semua Data Status</option>
                <option value="sudah">Sudah Dikembalikan</option>
                <option value="belum">Belum Dikembalikan</option>
            </select>
            <input type="date" value="tanggal_pinjam" name="tanggal_pinjam">
        </div>
    </div>
    <table id="datatables1" class="table" class="mt-3">
        <thead>
          <tr>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Lama Pinjam</th>
            <th scope="col">Total Buku</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
      </table>
</component>

@endsection

@section('datatables_js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
      $("#datatables1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

@section('js')
  <script>
    const _actionUrl = '{{ url('/transaction') }}';
    const _actionUrlApi = '{{ url('/api/transaction') }}';

    const columns = [
        {data: 'date_start', class: 'text-center', orderable: true},
        {data: 'date_end', class: 'text-center', orderable: true},
        {data: 'member.name', class: 'text-center', orderable: true},
        {data: 'lama_pinjam', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return data.book.length
        },class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            const price =  data.book.reduce((acc, crr) => acc + crr.price, 0);

            const rupiah = (price)=>{
                    return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                    }).format(price);
                }
            return rupiah(price);
        },class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return data.status == 0 ? 'belum dikembalikan' : 'sudah dikembalikan'
        },class: 'text-center', orderable: true},
        {render: function(index, row, data, meta) {
            // tidak bisa kita define object ke parameter
            return `
                <div class='d-flex'>
                        <a class='btn btn-sm btn-warning' href='{{ url('/transaction/${data.id}/edit') }}'>Edit</a>
                        <form action="{{ url('/transaction/${data.id}') }}" method="post">
                            <input class="btn btn-sm btn-danger" ${data.status == 0 && 'disabled'} type="submit" value="Delete" onclick="return confirm('apakah anda yakin???')">

                            @method('delete')
                            @csrf
                        </form>
                </div>
            `;

        }, orderable: false, class: 'text-center'},
    ];
  </script>
  <script src="{{ asset('js/data.js') }}"></script>
  <script>
    $('select[name=status]').on('change', function() {
            status = $('select[name=status]').val();
            tanggal_pinjam = $('input[name=tanggal_pinjam]').val();
            if(status == 0) {
                app.table.ajax.url(_actionUrlApi).load();
            }else {
                app.table.ajax.url(_actionUrlApi + '?status=' + status).load();
            }
      })
    // //jquery carikan property select dengan namenya status jika ada maka beri event change dan jalankan fungsi berikut
    // $('select[name=status]').on('change' function() {
    //   alert('test');
    //   const _this = this;
    //   // ambil value dari select dengan jquery
    //   status = $('select[name=status]').val();
    //   // cek jika status string kosong
    //   if(status == '') {
    //     // maka reload semua status halamannya
    //     _this.table.ajax.url(_actionUrlApi).reload();
    //   } else {
    //      // jika ada value statusnya maka reload halamannya sesuai dengan status di urlnya
    //      _this.table.ajax.url(_actionUrlApi + '?status=' + 'status').reload();
    //   }

    // })
  </script>
@endsection