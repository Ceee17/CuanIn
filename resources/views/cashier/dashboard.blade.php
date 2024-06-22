@extends('layouts.admin-main')

@section('title')
    Cashier Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="ml-2">Welcome {{ auth()->user()->name }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today's Transactions</span>
                        <span class="info-box-number">
                            {{ $totalNewTransactions }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Product Stock</span>
                        <span class="info-box-number">{{ $totalProductStock }}</span>
                    </div>
                </div>
            </div>

            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Average Sales / Transaction</span>
                        <span
                            class="info-box-number">{{ 'Rp ' . convertCurrencyFormat($averageTotalPricePerTransaction, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cash-register"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today's Sales</span>
                        <span
                            class="info-box-number">{{ 'Rp ' . convertCurrencyFormat($sumTotalPriceSalesToday, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Member?</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->sales_id ?? $order->order_id }}
                                    </td>
                                    <td>{{ $order->created_at->format('H:i:s | Y-m-d') }}</td>
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
                {{-- <a href="{{ route('sales.index') }}" class="btn btn-sm btn-secondary float-right">Tampilkan Semua</a> --}}
            </div>
        </div>
    </div>
@endsection
