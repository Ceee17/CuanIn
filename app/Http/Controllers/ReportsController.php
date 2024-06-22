<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Spending;
use App\Models\Purchases;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $tanggalAwal = $request->tanggal_awal;
            $tanggalAkhir = $request->tanggal_akhir;
        }

        return view('reports.index', compact('tanggalAwal', 'tanggalAkhir'));
    }


    public function getData($awal, $akhir)
    {
        $no = 1;
        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $total_penjualan = Sales::where('created_at', 'LIKE', "%$tanggal%")->sum('payment');
            $total_pembelian = Purchases::where('created_at', 'LIKE', "%$tanggal%")->sum('payment');
            $total_pengeluaran = Spending::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['tanggal'] = convertDateFormat($tanggal, false);
            $row['penjualan'] = convertCurrencyFormat($total_penjualan);
            $row['pembelian'] = convertCurrencyFormat($total_pembelian);
            $row['pengeluaran'] = convertCurrencyFormat($total_pengeluaran);
            $row['pendapatan'] = convertCurrencyFormat($pendapatan);

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Pendapatan',
            'pendapatan' => convertCurrencyFormat($total_pendapatan),
        ];

        return $data;
    }

    public function data($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);

        return datatables()
            ->of($data)
            ->make(true);
    }

    public function exportPDF($awal, $akhir)
    {
        $data = $this->getData($awal, $akhir);
        $pdf  = PDF::loadView('reports.pdf', compact('awal', 'akhir', 'data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-pendapatan-' . date('Y-m-d-his') . '.pdf');
    }
}
