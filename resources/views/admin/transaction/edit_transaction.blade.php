@extends('layouts.admin')

@section('multiple_select_css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endsection

@section('header', 'Edit Transaction')

@section('content')

<component id="container">
<div class="container">
    <div class="card card-default shadow">
      <div class="card-header">
        <h3 class="card-title">Edit Transaction</h3>
        <div class="card-body mt-5">
        <form action="{{ url('/transaction').'/'.$transaction[0]->id }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Anggota</label>
                    </div>
                    <div class="col-md-8">
                       <input type="text" name="member_id" value="{{ $transaction[0]->member->name }}"  class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal</label>
                    </div>
                    <div class="col-md-4">
                       <input type="date" name="date_start" class="form-control" value="{{ $transaction[0]->date_start }}"  readonly>
                    </div>
                    <div class="col-md-4">
                       <input type="date" name="date_end" class="form-control" value="{{ $transaction[0]->date_end }}"   readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Buku</label>
                    </div>
                    <div class="col-md-8 d-flex overflow-scroll">
                        @foreach ($transaction[0]->book as $book)
                            <div class="card shadow bg-warning" style="width: 9rem;margin-left: 8px">
                                <div class="card-body">
                                <h3 class="card-title">{{ $book->title }}</h3>
                                <p class="card-text">Rp.{{ money_format($book->price) }}</p>
                                <p>Qty : {{ $book->qty }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Status</label>
                    </div>
                    <div class="col-md-8 d-flex flex-column" v-if='editStatus'>
                        <div>
                            <input type="radio" name="status" value="1" @checked($transaction[0]->status == '1')>
                            <label >Sudah Dikembalikan</label>
                        </div>
                        <div>
                            <input type="radio" name="status" value="0" @checked($transaction[0]->status == '0')>
                            <label >Belum Dikembalikan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </form>
        </div>
      </div>
    </div>
</div>
</component>
@endsection

@section('multiple_select_js')
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>
@endsection

