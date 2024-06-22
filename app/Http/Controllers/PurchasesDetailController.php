<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Models\PurchasesDetail;

class PurchasesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase_id = session('purchase_id');
        $products = Products::orderBy('product_name')->get();
        $supplier = Supplier::find(session('supplier_id'));
        $discount = Purchases::find($purchase_id)->discount ?? 0;

        if (!$supplier) {
            abort(404);
        }

        return view('purchases_detail.index', compact('purchase_id', 'products', 'supplier', 'discount'));
    }

    public function data($id)
    {
        $detail = PurchasesDetail::with('products')
            ->where('purchase_id', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['product_code'] = '<span class="label label-success">' . $item->products['product_code'] . '</span>';
            $row['product_name'] = $item->products['product_name'];
            $row['buying_price']  = 'Rp. ' . convertCurrencyFormat($item->buying_price);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->purchases_detail_id . '" value="' . $item->jumlah . '">';
            $row['subtotal']    = 'Rp. ' . convertCurrencyFormat($item->subtotal);
            $row['action']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('purchases_detail.destroy', $item->purchases_detail_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->buying_price * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'product_code' => '
                <div class="total hide">' . $total . '</div>
                <div class="total_item hide">' . $total_item . '</div>',
            'product_name' => '',
            'buying_price'  => '',
            'jumlah' => '',
            'subtotal' => '',
            'action' => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'product_code', 'jumlah'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = Products::where('product_id', $request->product_id)->first();
        if (!$products) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PurchasesDetail();
        $detail->purchase_id = $request->purchase_id;
        $detail->product_id = $products->product_id;
        $detail->buying_price = $products->buying_price;
        $detail->jumlah = 1;
        $detail->subtotal = $products->buying_price;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchasesDetail $purchasesDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchasesDetail $purchasesDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detail = PurchasesDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->buying_price * $request->jumlah;
        $detail->update();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = PurchasesDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($discount, $total)
    {
        $payment = $total - ($discount / 100 * $total);
        $data  = [
            'total_rupiah' => convertCurrencyFormat($total),
            'payment' => $payment,
            'payment_rupiah' => convertCurrencyFormat($payment),
        ];

        return response()->json($data);
    }
}
