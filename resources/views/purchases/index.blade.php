@extends('layouts.admin-main')

@section('title')
    Daftar Pembelian
@endsection

@section('breadcrumb')
    Purchases
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border mb-2">
                    <button onclick="addForm()" class="btn btn-success btn-s"><i class="fa fa-plus-circle"></i>
                        Transaksi Baru</button>
                    @empty(!session('purchase_id'))
                        <a href="{{ route('purchases_detail.index') }}" class="btn btn-info btn-s"><i class="fa fa-pencil"></i>
                            Transaksi Aktif</a>
                    @endempty
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-stiped table-bordered table-pembelian">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('purchases.supplier')
    @includeIf('purchases.detail')
@endsection

@push('scripts')
    <script>
        let table, table1;

        $(function() {
            table = $('.table-pembelian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('purchases.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'supplier'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'discount'
                    },
                    {
                        data: 'payment'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            $('.table-supplier').DataTable();
            table1 = $('.table-detail').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'product_code'
                    },
                    {
                        data: 'product_name'
                    },
                    {
                        data: 'buying_price'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                ]
            })
        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush
