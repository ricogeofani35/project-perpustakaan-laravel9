@extends('layouts.admin')

@section('datatables_css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('header', 'Publisher')

@section('content')
 <!-- Main content -->
 <component id="container">
    <section class="content">
        <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                <h3 class="card-title">Data Publisher</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button type="button" class="btn btn-success mb-3" @click="addData()">
                        Add Data Publisher
                    </button>
                    <table class="table table-bordered" id="datatables1">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10px">No</th>
                                <th>Name Publisher</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card -->

            {{-- modal start --}}
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                <div class="modal-content">
                    {{-- action dibanding dengan vue dan mendapatkan actionUrl dari property vue --}}
                    <form :action="actionUrl" method="post" @submit='submitForm($event, data.id)'>

                    <div class="modal-header">
                        {{-- logic vue jika editStatus = false tampilkan add data dan sebaliknya  --}}
                    <h4 class="modal-title" v-if='!editStatus'>Add Data Publisher</h4>
                    <h4 class="modal-title" v-if='editStatus'>Edit Data Publisher</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                            @csrf

                            {{-- kirimkan input type hidden untuk post method put untuk edit data --}}
                            <input type="hidden" name="_method" value="put" v-if='editStatus' >
                            <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" :value="data.name" name="name" required autocomplete="name" autofocus placeholder="name">
                    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" :value="data.email" required autocomplete="email" autofocus placeholder="email">
                    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" :value="data.phone_number" required autocomplete="phone_number" autofocus placeholder="phone_number">
                    
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" :value="data.address" required autocomplete="address" autofocus placeholder="address">
                    
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" v-if='!editStatus'>Save changes</button>
                            <button type="submit" class="btn btn-primary" v-if='editStatus'>Update changes</button>
                        </div>
                        
                    </form>

                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal end -->
            </div>
        </div>
        </div>
    </section>
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
    const _actionUrl = '{{ url('/publisher') }}';
    const _actionUrlApi = '{{ url('/api/publisher') }}';

    const columns = [
        {data: 'DT_RowIndex', orderable: true},
        {data: 'name', orderable: true},
        {data: 'email', orderable: true},
        {data: 'phone_number', orderable: true},
        {data: 'address', orderable: true},
        {render: function(index, row, data, meta) {
            return ` <div class='d-flex'>
                        <a class='btn btn-sm btn-warning' onclick="app.editData(event, ${meta.row})">Edit</a>
                        <a class='btn btn-sm btn-danger' onclick="app.deleteData(${data.id})">Delete</a>
                    </div>`;
        }, orderable: false}
    ];

</script>
<script src="{{ asset('js/data.js') }}"></script>
@endsection