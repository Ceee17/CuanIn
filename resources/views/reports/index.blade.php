@extends('layouts.admin-main')

@section('title')
    Laporan Pendapatan {{ convertDateFormat($tanggalAwal, false) }} s/d {{ convertDateFormat($tanggalAkhir, false) }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <button onclick="updatePeriode()" class="btn btn-info btn-xs btn-flat"><i class="fa fa-plus-circle"></i>
                        Ubah Periode</button>
                    <a href="{{ route('reports.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                        class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a>
                </div>
                <div class="box-body table-striped table-responsive">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('reports.form', ['tanggal_awal' => $tanggalAwal, 'tanggal_akhir' => $tanggalAkhir])
@endsection

@push('scripts')
    <script src="{{ asset('/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        let table;
        let tanggalAwal = "{{ $tanggalAwal }}";
        let tanggalAkhir = "{{ $tanggalAkhir }}";

        $(function() {
            // Initialize the date range picker
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment(tanggalAwal, 'YYYY-MM-DD'),
                endDate: moment(tanggalAkhir, 'YYYY-MM-DD')
            });

            // Handle the apply event
            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $('#tanggal_awal').val(picker.startDate.format('YYYY-MM-DD'));
                $('#tanggal_akhir').val(picker.endDate.format('YYYY-MM-DD'));
            });

            // Set the initial values for the hidden fields
            $('#tanggal_awal').val(moment(tanggalAwal, 'YYYY-MM-DD').format('YYYY-MM-DD'));
            $('#tanggal_akhir').val(moment(tanggalAkhir, 'YYYY-MM-DD').format('YYYY-MM-DD'));

            // Initialize DataTable
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('reports.data', [$tanggalAwal, $tanggalAkhir]) }}',
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
                        data: 'penjualan'
                    },
                    {
                        data: 'pembelian'
                    },
                    {
                        data: 'pengeluaran'
                    },
                    {
                        data: 'pendapatan'
                    }
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');
        }
    </script>
@endpush
