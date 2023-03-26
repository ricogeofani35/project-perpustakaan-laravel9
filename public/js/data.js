const app = new Vue({
    el: '#container',
    data: {
        actionUrl: _actionUrl,
        actionUrlApi: _actionUrlApi,
        datas: [],
        data: {},
        editStatus: false,
    },
    mounted: function () {
        this.getData();
    },
    methods: {
        getData() {
            const _this = this
            _this.table = $('#datatables1').DataTable({
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                ajax: {
                    url: _this.actionUrlApi,
                    type: 'get',
                },
                columns: columns
            }).on('xhr', function () {
                _this.datas = _this.table.ajax.json().data;
            });
        },
       addData() {
        this.editStatus = false;
        this.data = {};
        $('#modal-default').modal();
       }, 
       editData(event, row) {
            this.data = this.datas[row];
            this.editStatus = true;
            $('#modal-default').modal();
       },
       deleteData(id) {
            // delete paranet nodenya yaitu tr
            // event.target.parentNode.parentNode.parentNode.remove();

            if(confirm('apakaha anda yakin?')) {
                $(event.target).parents('tr').remove(); //jquery carikan event.target dari ement tersebut jika ditemukan ambil parentnya yaitu tr dan hapus
                axios.post(this.actionUrl+'/'+id, {_method: 'delete'})
                    .then(res => {
                        alert('delete data success');
                    }) 
            }
       },
       submitForm(event, id) {
            event.preventDefault();
            const _this = this;
            let actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
            axios.post(actionUrl, new FormData($(event.target)[0]))
                .then(response => {
                    $('#modal-default').modal('hide');
                    _this.table.ajax.reload();
                })
       },
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
});