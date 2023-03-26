@extends('layouts.admin')

@section('header', 'Catalog')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <div class="col-md-10">
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Data Catalogs</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <a href="/catalog/create" class="btn btn-success mb-2">Add Data Catalog</a>
                  <table class="table table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th style="width: 10px">No</th>
                        <th>Name Catalogs</th>
                        <th>Total Books</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($catalogs as $key => $catalog)
                        <tr class="text-center">
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $catalog->name }}</td>
                          <td>
                            {{ count($catalog->books) }} items
                          </td>
                          {{-- format tanggal di php (date-mon-year) --}}
                          {{-- strtotime = merubah date menjadi string --}}
                          <td>{{ date('d-m-y', strtotime($catalog->created_at)) }}</td> 
                          <td class="d-flex gap-3">
                              <a href="/catalog/edit/{{ $catalog->id }}" class="btn btn-warning btn-sm">Edit</a>

                              <form action="/catalog/delete/{{ $catalog->id }}" method="post">
                                <input class="btn btn-sm btn-danger" type="submit" value="Delete" onclick="return confirm('apakah anda yakin???')">

                                @method('delete')
                                @csrf
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->

@endsection