<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Members;
use App\Models\Setting;
use App\Models\Products;
use App\Models\SalesDetail;
use Illuminate\Http\Request;

class SalesDetailController extends Controller
{
    public function index()
    {
        $products = Products::orderBy('product_name')->get();
        $members = Members::orderBy('name')->get();
        $discount = Setting::first()->discount ?? 0;
        // Cek apakah ada transaksi yang sedang berjalan
        if ($sales_id = session('sales_id')) {
            $sales = Sales::find($sales_id);
            $memberSelected = $sales->members ?? new Members();

            return view('sales_detail.index', compact('products', 'members', 'discount', 'sales_id', 'sales', 'memberSelected'));
        } else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaksi.baru');
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function data($id)
    {
        $detail = SalesDetail::with('products')
            ->where('sales_id', $id)
            ->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['product_code'] = '<span class="label label-success">' . $item->products['product_code'] . '</span';
            $row['product_name'] = $item->products['product_name'];
            $row['selling_price']  = 'Rp. ' . convertCurrencyFormat($item->selling_price);
            $row['amount']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->sales_detail_id . '" value="' . $item->amount . '">';
            $row['discount']      = $item->discount . '%';
            $row['subtotal']    = 'Rp. ' . convertCurrencyFormat($item->subtotal);
            $row['action']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('transaksi.destroy', $item->sales_detail_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->selling_price * $item->amount - (($item->discount * $item->amount) / 100 * $item->selling_price);;
            $total_item += $item->amount;
        }
        $data[] = [
            'product_code' => '
                <div class="total hide">' . $total . '</div>
                <div class="total_item hide">' . $total_item . '</div>',
            'product_name' => '',
            'selling_price'  => '',
            'amount'      => '',
            'discount'      => '',
            'subtotal'    => '',
            'action'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'product_code', 'amount'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $products = Products::where('product_id', $request->product_id)->first();
        if (!$products) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new SalesDetail();
        $detail->sales_id = $request->sales_id;
        $detail->product_id = $products->product_id;
        $detail->selling_price = $products->selling_price;
        $detail->amount = 1;
        $detail->discount = $products->discount;
        $detail->subtotal = $products->selling_price - ($products->discount / 100 * $products->selling_price);;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = SalesDetail::find($id);
        $detail->amount = $request->amount;
        $detail->subtotal = $detail->selling_price * $request->amount - (($detail->discount * $request->amount) / 100 * $detail->selling_price);;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = SalesDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($discount = 0, $total = 0, $received = 0)
    {
        $payment   = $total - ($discount / 100 * $total);
        $kembali = ($received != 0) ? $received - $payment : 0;
        $data    = [
            'total_rupiah' => convertCurrencyFormat($total),
            'payment' => $payment,
            'payment_rupiah' => convertCurrencyFormat($payment),
            'kembali_rupiah' => convertCurrencyFormat($kembali),
        ];

        return response()->json($data);
    }
}
