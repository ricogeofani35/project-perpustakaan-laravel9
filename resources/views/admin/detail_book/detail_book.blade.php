
@extends('layouts.admin')

@section('header', 'Detail Book')
@section('content')
<component id="container">
    <div class="input-group mb-3 mx-auto mb-4" style="width: 60%">
        <input type="text" v-model='search' class="form-control" placeholder="Search Book" aria-label="Recipient's username" aria-describedby="basic-addon2">
    </div>

    <div class="row">
        <div class="col-4 card shadow mt-3" v-for='book in filterList'>
            <div class="card-body">
              <h5 class="card-title">@{{ book.title }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">(@{{ book.qty }})</h6>
              <p class="card-text">Rp.@{{ formatPrice(book.price) }}</p>
              <a href="#" @click='detailBook(book.id)' class="card-link">Detail Book</a>
            </div>
          </div>
    </div>
     {{-- modal start --}}
     <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Isbn</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ data_book.isbn }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Title</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ data_book.title }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                       <h3>Publisher</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ publisher.name }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Author</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ author.name }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Catalog</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ catalog.name }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Qty</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ data_book.qty }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Price</h3>
                    </div>
                    <div class="col-md-8">
                        <h4>@{{ data_book.price }}</h4>
                    </div>
                </div>            
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal end -->
</component>
@endsection
@section('js')
<script>
    let actionUrlApi = '{{ url('/api/detail_book') }}';
    let app = new Vue({
        el: '#container',
        data: {
            actiiomUrl: actionUrlApi,
            data: {},
            datas: [],
            search: '',
            data_book: {},
            publisher: {},
            author: {},
            catalog: {}
        },
        mounted: function () {
            this.getData();
        },
        methods: {
            getData() {
                const _this = this;
                $.ajax({
                    url: actionUrlApi,
                    method: 'GET',
                    success: function(data_book) {
                        _this.datas = JSON.parse(data_book);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace(".", ",");
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            detailBook(id) {
                this.datas.map((book) => {
                    if(book.id === id) {
                        this.data_book = book;
                        this.publisher = book.publisher;
                        this.author = book.author;
                        this.catalog = book.catalog;
                    }
                });
                $('#modal-default').modal();
            }
        },
        computed: {
            filterList() {
                return this.datas.filter((book) => {
                    return book.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    })
</script>

@endsection
