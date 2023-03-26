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

@section('header', 'create transaction')

@section('content')

<component id="container">
<div class="container">
    <div class="card card-default shadow">
      <div class="card-header">
        <h3 class="card-title">Create Transaction</h3>
        <div class="card-body mt-5">
        <form action="{{ url('/transaction') }}" method="post">
            @csrf

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Anggota</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2" name='member_id' style="width: 100%;">
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal</label>
                    </div>
                    <div class="col-md-4">
                       <input type="date" name="date_start" class="form-control">
                    </div>
                    <div class="col-md-4">
                       <input type="date" name="date_end" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Buku</label>
                    </div>
                    <div class="col-md-8">
                        <div class="select2-purple">
                          <select class="select2" name='book_id[]' multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            @foreach ($books as $book)
                                 <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Status</label>
                    </div>
                    {{-- <div class="col-md-8 d-flex flex-column" v-if='editStatus'>
                        <div>
                            <input type="radio" name="status" value="1" readonly>
                            <label >Sudah Dikembalikan</label>
                        </div>
                        <div>
                            <input type="radio" name="status" value="0">
                            <label >Belum Dikembalikan</label>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="btn btn-primary mt-3">Transaction</button>
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

