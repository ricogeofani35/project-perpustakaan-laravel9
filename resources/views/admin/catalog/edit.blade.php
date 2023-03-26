@extends('layouts.app')

@section('content')
<div class="register-box mx-auto mt-5">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Edit</b>Data Catalog</a>
    </div>
    <div class="card-body">

      <form action="/catalog/update/{{ $catalog->id }}" method="post">
        @csrf
        @method('PUT')

        <div class="input-group mb-3">
           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $catalog->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

@endsection
