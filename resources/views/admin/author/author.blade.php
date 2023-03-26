@extends('layouts.admin')

@section('header', 'Author')
@section('content')

 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title">Data Author</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="/author/create" class="btn btn-success mb-3">Add Data Author</a>
              <table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                    <th style="width: 10px">No</th>
                    <th>Name Author</th>
                    <th>Email</th>
                    <th>Phone Numbert</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($authors as $key => $author)
                    <tr class="text-center">
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $author->name }}</td>
                      <td>{{ $author->email }}</td>
                      <td>{{ $author->phone_number }}</td>
                      <td>{{ $author->address }}</td>
                      <td class="d-flex gap-3">
                        <a class="btn btn-sm btn-warning" href="/author/edit/{{ $author->id }}">Edit</a>
                        <form action="/author/delete/{{ $author->id }}" method="post">
                            <input type="submit" class="btn btn-sm btn-danger" value="delete" onclick="return confirm('apakah anda yakin??')">

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