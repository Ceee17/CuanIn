@extends('layouts.admin-main')

@section('title')
    <h1>Daftar Produk</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group">
                            <button onclick="addForm('{{ route('products.store') }}')"
                                class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
                            <button onclick="deleteSelected('{{ route('products.delete_selected') }}')"
                                class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                            <button onclick="cetakBarcode('{{ route('products.cetak_barcode') }}')"
                                class="btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i> Cetak Barcode</button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <form action="" method="post" class="form-produk">
                            @csrf
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <th width="5%">
                                        <input type="checkbox" name="select_all" id="select_all">
                                    </th>
                                    <th width="5%">No</th>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Merk</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th width="15%"><i class="fa fa-cog"></i></th>
                                </thead>
                            </table>
                        </form>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    </div>

    </section>
    <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    @includeIf('products.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('products.data') }}",
                },
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false
                    },
                    {
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
                        data: 'category_name'
                    },
                    {
                        data: 'product_brand'
                    },
                    {
                        data: 'buying_price'
                    },
                    {
                        data: 'selling_price'
                    },
                    {
                        data: 'discount'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            $('#modal-form').modal('hide');
                            return;
                        });
                }
            });
            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=product_name]').focus();
        }


        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=product_name]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=product_name]').val(response.product_name);
                    $('#modal-form [name=category_id]').val(response.category_id);
                    $('#modal-form [name=product_brand]').val(response.product_brand);
                    $('#modal-form [name=buying_price]').val(response.buying_price);
                    $('#modal-form [name=selling_price]').val(response.selling_price);
                    $('#modal-form [name=discount]').val(response.discount);
                    $('#modal-form [name=stock]').val(response.stock);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
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

        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
                if (confirm('Yakin ingin menghapus data terpilih?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menghapus data');
                            return;
                        });
                }
            } else {
                alert('Pilih data yang akan dihapus');
                return;
            }
        }

        function cetakBarcode(url) {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak');
                return;
            } else if ($('input:checked').length < 3) {
                alert('Pilih minimal 3 data untuk dicetak');
                return;
            } else {
                $('.form-produk')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }
    </script>
@endpush
