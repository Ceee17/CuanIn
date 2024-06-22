<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Members;
use App\Models\Products;
use App\Models\Spending;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts of various entities
        $kategori = $this->getEntityCount(ProductCategory::class);
        $produk = $this->getEntityCount(Products::class);
        $supplier = $this->getEntityCount(Supplier::class);
        $member = $this->getEntityCount(Members::class);

        // Get the date range
        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        // Get daily revenue data
        list($data_tanggal, $data_pendapatan) = $this->getDailyRevenueData($tanggal_awal, $tanggal_akhir);

        // Get dashboard metrics
        $dashboardMetrics = $this->getDashboardMetrics($tanggal_awal, $tanggal_akhir);

        // Get recent orders
        $orders = $this->getRecentOrders();

        $recentlyAddedProducts = $this->getRecentlyAddedProducts();

        // Render the appropriate view based on user level
        if (auth()->user()->level == 1) {
            return view('admin.dashboard', array_merge([
                'kategori' => $kategori,
                'produk' => $produk,
                'supplier' => $supplier,
                'member' => $member,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir,
                'data_tanggal' => $data_tanggal,
                'data_pendapatan' => $data_pendapatan,
                'orders' => $orders,
                'recentlyAddedProducts' => $recentlyAddedProducts,
            ], $dashboardMetrics));
        } else {
            return view('cashier.dashboard');
        }
    }

    // Get count of an entity
    private function getEntityCount($model)
    {
        return $model::count();
    }

    // Get daily revenue data
    private function getDailyRevenueData($startDate, $endDate)
    {
        $data_tanggal = [];
        $data_pendapatan = [];

        while (strtotime($startDate) <= strtotime($endDate)) {
            $data_tanggal[] = (int) substr($startDate, 8, 2);

            $total_penjualan = Sales::where('created_at', 'LIKE', "%$startDate%")->sum('payment');
            $total_pembelian = Purchases::where('created_at', 'LIKE', "%$startDate%")->sum('payment');
            $total_pengeluaran = Spending::where('created_at', 'LIKE', "%$startDate%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $data_pendapatan[] = $pendapatan;

            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));
        }

        return [$data_tanggal, $data_pendapatan];
    }

    // Get dashboard metrics
    private function getDashboardMetrics($startDate, $endDate)
    {
        $dashboard_penjualan = Sales::whereBetween('created_at', [$startDate, $endDate])->sum('payment');
        $dashboard_pembelian = Purchases::whereBetween('created_at', [$startDate, $endDate])->sum('payment');
        $dashboard_pengeluaran = Spending::whereBetween('created_at', [$startDate, $endDate])->sum('nominal');

        $dashboard_pendapatan = $dashboard_penjualan - $dashboard_pembelian - $dashboard_pengeluaran;

        return [
            'dashboard_penjualan' => $dashboard_penjualan,
            'dashboard_pembelian' => $dashboard_pembelian,
            'dashboard_pengeluaran' => $dashboard_pengeluaran,
            'dashboard_pendapatan' => $dashboard_pendapatan
        ];
    }

    // Get recent orders
    private function getRecentOrders()
    {

        return Sales::with('member')->latest()->take(5)->get();
    }

    private function getRecentlyAddedProducts()
    {
        return Products::latest()->take(5)->get();
    }
}
