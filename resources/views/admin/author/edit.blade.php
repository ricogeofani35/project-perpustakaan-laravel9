@extends('layouts.app')

@section('content')
<div class="register-box mx-auto mt-5">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Edit</b>Data Author</a>
    </div>
    <div class="card-body">

      <form action="/author/update/{{ $authors->id }}" method="post">
        @csrf
        @method('PUT')

        <div class="input-group mb-3">
           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $authors->name }}" required autocomplete="name" autofocus placeholder="name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $authors->email }}" required autocomplete="email" autofocus placeholder="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
           <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $authors->phone_number }}" required autocomplete="phone_number" autofocus placeholder="phone_number">

            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
           <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $authors->address }}" required autocomplete="address" autofocus placeholder="address">

            @error('address')
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
