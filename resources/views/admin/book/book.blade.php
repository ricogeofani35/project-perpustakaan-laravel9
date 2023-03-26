
@extends('layouts.admin')

@section('datatables_css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('header', 'Book')
@section('content')
<component id="container">
<div class="card">
    <div class="btn-add mt-2">
        <a class="btn btn-success shadow" @click='addData()'>Add Data Book</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="datatables1" class="table table-bordered table-striped">
        <thead>
            <tr>
                    <th>Isbn</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Publisher</th>
                    <th>Author</th>
                    <th>Catalog</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Action</th>
            </tr>
        </thead>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  
            {{-- modal start --}}
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                <div class="modal-content">
                    {{-- action dibanding dengan vue dan mendapatkan actionUrl dari property vue --}}
                    <form :action="actionUrl" method="post" @submit="submitForm($event, data.id)">

                    <div class="modal-header">
                        {{-- logic vue jika editStatus = false tampilkan add data dan sebaliknya  --}}
                    <h4 class="modal-title" v-if='!editStatus'>Add Data Book</h4>
                    <h4 class="modal-title" v-if='editStatus'>Edit Data Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                            @csrf

                            {{-- kirimkan input type hidden untuk post method put untuk edit data --}}
                            <input type="hidden" name="_method" value="put" v-if='editStatus' >
                            <div class="input-group mb-3">
                            <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" :value="data.isbn" name="isbn" required autocomplete="isbn" autofocus placeholder="isbn">
                    
                                @error('isbn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" :value="data.title" required autocomplete="title" autofocus placeholder="title">
                    
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" :value="data.year" required autocomplete="year" autofocus placeholder="year">
                    
                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <select name="publisher_id" class="form-select" aria-label="Default select example">
                                    <option :selected='data.publisher_id == null'>null</option>
                                    @foreach ($publishers as $publisher)
                                        <option :selected='{{ $publisher->id }} == data.publisher_id' value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                  </select>
                    
                                @error('publisher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <select name="author_id" class="form-select" aria-label="Default select example">
                                    <option :selected='data.publisher_id == null'>null</option>
                                    @foreach ($authors as $author)
                                        <option :selected='{{ $author->id }} == data.author_id' value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                  </select>
                    
                                @error('author_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <select name="catalog_id" class="form-select" aria-label="Default select example">
                                     <option :selected='data.publisher_id == null'>null</option>
                                    @foreach ($catalogs as $catalog)
                                        <option :selected='{{ $catalog->id }} == data.catalog_id' value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                  </select>
                    
                                @error('catalog_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" :value="data.qty" required autocomplete="qty" autofocus placeholder="qty">
                    
                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" :value="data.price" required autocomplete="price" autofocus placeholder="price">
                    
                                @error('price')
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
    const _actionUrl = '{{ url('/book') }}';
    const _actionUrlApi = '{{ url('/api/book') }}';

    const columns = [
        {data: 'isbn', orderable: true},
        {data: 'title', orderable: true},
        {data: 'year', orderable: true},

        // index, row, data, meta harus ada
        {render: function(index, row, data, meta) {
            return (data.publisher_id !== null) ? data.publisher.name : '';
        },  orderable: true, class: 'text-center'},
        {render: function(index, row, data, meta) {
            return (data.author_id !== null) ? data.author.name : '';
        },  orderable: true, class: 'text-center'},
        {render: function(index, row, data, meta) {
            return (data.catalog_id !== null) ? data.catalog.name : '';
        },  orderable: true, class: 'text-center'},

        {data: 'qty', orderable: true},
        {data: 'price', orderable: true},

        {render: function(index, row, data, meta) {
            // tidak bisa kita define object ke parameter
            return `
                <div class='d-flex'>
                        <a class='btn btn-sm btn-warning' onclick="app.editData(event, ${meta.row})">Edit</a>
                        <a class='btn btn-sm btn-danger' onclick="app.deleteData(${data.id})">Delete</a>
                </div>
            `;
        }, orderable: false, class: 'text-center'},
    ];
    </script>
    <script src='{{ asset('js/data.js') }}'></script>
@endsection