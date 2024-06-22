@extends('layouts.admin-main')

@section('title')
    Transaksi Penjualan
@endsection

@section('breadcrumb')
    Transaction
@endsection

@push('css')
    <style>
        .tampil-payment {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }



        .table-penjualan tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px) {
            .tampil-payment {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">

                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="product_code" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="sales_id" id="sales_id" value="{{ $sales_id }}">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="text" class="form-control" name="product_code" id="product_code">
                                    <span class="input-group-btn">
                                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i
                                                class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-stiped table-bordered table-penjualan">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th width="15%">Jumlah</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-payment bg-primary"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                @csrf
                                <input type="hidden" name="sales_id" value="{{ $sales_id }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="payment" id="payment">
                                <input type="hidden" name="member_id" id="member_id"
                                    value="{{ $memberSelected->member_id }}">

                                <div class="form-group row">
                                    <label for="total_rupiah" class="col-lg-2 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="total_rupiah" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="member_code" class="col-lg-2 control-label">Member</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="member_code"
                                                value="{{ $memberSelected->member_code }}">
                                            <span class="input-group-btn">
                                                <button onclick="tampilMember()" class="btn btn-info btn-flat"
                                                    type="button"><i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="discount" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="discount" id="discount" class="form-control"
                                            value="{{ !empty($memberSelected->member_id) ? $discount : 0 }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="payment" class="col-lg-2 control-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="payment_rupiah" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="received" class="col-lg-2 control-label">Diterima</label>
                                    <div class="col-lg-8">
                                        <input type="number" id="received" class="form-control" name="received"
                                            value="{{ $sales->received ?? 0 }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="kembali" name="kembali" class="form-control"
                                            value="0" readonly>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-s pull-right btn-simpan"><i
                            class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                </div>
            </div>
        </div>
    </div>
    @includeIf('sales_detail.produk')
    @includeIf('sales_detail.member')
@endsection

@push('scripts')
    <script>
        let table, table2;

        $(function() {
            $('body').addClass('sidebar-collapse');

            table = $('.table-penjualan').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('transaksi.data', $sales_id) }}',
                    },
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
                            data: 'selling_price'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'discount'
                        },
                        {
                            data: 'subtotal'
                        },
                        {
                            data: 'action',
                            searchable: false,
                            sortable: false
                        },
                    ],
                    dom: 'Brt',
                    bSort: false,
                    paginate: false
                })
                .on('draw.dt', function() {
                    loadForm($('#discount').val());
                    setTimeout(() => {
                        $('#received').trigger('input');
                    }, 300);
                });
            table2 = $('.table-produk').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let amount = parseInt($(this).val());

                if (amount < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (amount > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('/transaksi') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'amount': amount
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#discount').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });

            $(document).on('input', '#discount', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            });

            $('#received').on('input', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($('#discount').val(), $(this).val());
            }).focus(function() {
                $(this).select();
            });

            $('.btn-simpan').on('click', function() {
                $('.form-penjualan').submit();
            });
        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#product_id').val(id);
            $('#product_code').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#product_code').focus();
                    table.ajax.reload(() => loadForm($('#discount').val()));
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function tampilMember() {
            $('#modal-member').modal('show');
        }

        function pilihMember(id, kode) {
            $('#member_id').val(id);
            $('#member_code').val(kode);
            $('#discount').val('{{ $discount }}');
            loadForm($('#discount').val());
            $('#received').val(0).focus().select();
            hideMember();
        }

        function hideMember() {
            $('#modal-member').modal('hide');
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload(() => loadForm($('#discount').val()));
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadForm(discount = 0, received = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/transaksi/loadform') }}/${discount}/${$('.total').text()}/${received}`)
                .done(response => {
                    $('#total_rupiah').val('Rp. ' + response.total_rupiah);
                    $('#payment_rupiah').val('Rp. ' + response.payment_rupiah);
                    $('#payment').val(response.payment);
                    $('.tampil-payment').text('Bayar: Rp. ' + response.payment_rupiah);

                    $('#kembali').val('Rp.' + response.kembali_rupiah);
                    if ($('#received').val() != 0) {
                        $('.tampil-payment').text('Kembali: Rp. ' + response.kembali_rupiah);
                    }
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
    </script>
@endpush
