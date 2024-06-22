@extends('layouts.admin-main')

@section('title')
    Admin Dashboard
@endsection

@section('breadcrumb')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $kategori }}</h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <a href="{{ route('category.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $produk }}</h3>
                        <p>Total Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $member }}</h3>
                        <p>Total Member</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('member.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $supplier }}</h3>
                        <p>Total Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-handshake"></i>
                    </div>
                    <a href="{{ route('supplier.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Grafik Pendapatan {{ convertDateFormat($tanggal_awal, false) }} s/d
                            {{ convertDateFormat($tanggal_akhir, false) }}</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" height="100" style="height: 100px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        {{ 'Rp ' . convertCurrencyFormat($dashboard_penjualan) }}
                                    </h5>
                                    <span class="description-text">TOTAL PENJUALAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        {{ 'Rp ' . convertCurrencyFormat($dashboard_pembelian) }}</h5>
                                    <span class="description-text">TOTAL PEMBELIAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        {{ 'Rp ' . convertCurrencyFormat($dashboard_pengeluaran) }}</h5>
                                    <span class="description-text">TOTAL PENGELUARAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        {{ 'Rp ' . convertCurrencyFormat($dashboard_pendapatan) }}</h5>
                                    <span class="description-text">TOTAL PENDAPATAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- TABLE: LATEST ORDERS -->
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive table-striped">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Sales ID</th>
                                <th>Member</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->sales_id ?? $order->order_id }}
                                    </td>
                                    <td>{{ $order->member->name ?? 'N/A' }}</td>
                                    <td>{{ $order->total_item }}</span>
                                    </td>
                                    <td>{{ 'Rp. ' . convertCurrencyFormat($order->total_price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="{{ route('transaksi.baru') }}" class="btn btn-sm btn-info float-left">Buat Transaksi Baru</a>
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-secondary float-right">Lihat Semua</a>
            </div>
        </div>

        <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach ($recentlyAddedProducts as $product)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{ asset('/AdminLTE-3.2.0/dist/img/default-150x150.png') }}"
                                    alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{ $product->product_name }}
                                    <span
                                        class="badge badge-warning float-right">{{ 'Rp ' . convertCurrencyFormat($product->selling_price) }}</span>
                                </a>
                                <span class="product-description">
                                    {{ 'Stock : ' . $product->stock }}
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                    @endforeach
                </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <a href="{{ route('products.index') }}" class="uppercase">Lihat Semua Produk</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>

    </section>
    <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection

@push('scripts')
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        $(function() {
            // Get the context using jQuery
            var salesChartCanvas = $('#salesChart');
            var ctx = salesChartCanvas[0].getContext('2d');

            // Chart.js 3.x syntax for creating a chart
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {{ json_encode($data_tanggal) }}, // Ensure $data_tanggal is correctly populated in your PHP controller
                    datasets: [{
                        label: 'Pendapatan',
                        data: {{ json_encode($data_pendapatan) }},
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointBackgroundColor: '#3b8bba',
                        pointBorderColor: 'rgba(60,141,188,1)',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(60,141,188,1)',
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Pendapatan'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
