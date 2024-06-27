<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Models\PurchasesDetail;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy('name')->get();

        return view('purchases.index', compact('supplier'));
    }

    /**
     * This function is used to retrieve and format purchase data for the datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function data()
    {
        // Fetch all purchases ordered by purchase_id in descending order
        $purchases = Purchases::orderBy('purchase_id', 'desc')->get();

        // Use Laravel Datatables to format the purchase data
        return datatables()
            ->of($purchases)
            ->addIndexColumn() // Add an auto-incrementing index column
            ->addColumn('total_item', function ($purchases) {
                // Format total_item to currency format
                return convertCurrencyFormat($purchases->total_item);
            })
            ->addColumn('total_price', function ($purchases) {
                // Format total_price to currency format with Rp. prefix
                return 'Rp. ' . convertCurrencyFormat($purchases->total_price);
            })
            ->addColumn('payment', function ($purchases) {
                // Format payment to currency format with Rp. prefix
                return 'Rp. ' . convertCurrencyFormat($purchases->payment);
            })
            ->addColumn('tanggal', function ($purchases) {
                // Format created_at date to a readable format
                return convertDateFormat($purchases->created_at, false);
            })
            ->addColumn('supplier', function ($purchases) {
                // Fetch supplier name from related supplier model
                return $purchases->supplier->name;
            })
            ->editColumn('discount', function ($purchases) {
                // Format discount to percentage
                return $purchases->discount . '%';
            })
            ->addColumn('action', function ($purchases) {
                // Add action buttons for show and delete
                return '
               <div class="btn-group">
               <button onclick="showDetail(`' . route('purchases.show', $purchases->purchase_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i> Produk</button>
               <button type="button" onclick="deleteData(`' . route('purchases.destroy', $purchases->purchase_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>
               </div>
               ';
            })
            ->rawColumns(['action']) // Specify columns that should be rendered as raw HTML
            ->make(true); // Return the formatted data as a JSON response
    }

    //    <button type="button" onclick="editForm(`' . route('purchases.update', $purchases->purchase_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-pen"></i></button>
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $purchases = new Purchases();
        $purchases->supplier_id = $id;
        $purchases->total_item = 0;
        $purchases->total_price = 0;
        $purchases->discount = 0;
        $purchases->payment = 0;
        $purchases->save();

        session(['purchase_id' => $purchases->purchase_id]);
        session(['supplier_id' => $purchases->supplier_id]);

        return redirect()->route('purchases_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchases = Purchases::findOrFail($request->purchase_id);
        $purchases->total_item = $request->total_item;
        $purchases->total_price = $request->total;
        $purchases->discount = $request->discount;
        $purchases->payment = $request->payment;
        $purchases->update();

        $detail = PurchasesDetail::where('purchase_id', $purchases->purchase_id)->get();
        foreach ($detail as $item) {
            $products = Products::find($item->product_id);
            $products->stock += $item->jumlah;
            $products->update();
        }

        return redirect()->route('purchases.index');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $detail = PurchasesDetail::with('products')->where('purchase_id', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('product_code', function ($detail) {
                return '<span class="label label-success">' . $detail->products->product_code . '</span>';
            })
            ->addColumn('product_name', function ($detail) {
                return $detail->products->product_name;
            })
            ->addColumn('buying_price', function ($detail) {
                return 'Rp. ' . convertCurrencyFormat($detail->buying_price);
            })
            ->addColumn('jumlah', function ($detail) {
                return convertCurrencyFormat($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . convertCurrencyFormat($detail->subtotal);
            })
            ->rawColumns(['product_code'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchases = Purchases::find($id);
        $detail    = PurchasesDetail::where('purchase_id', $purchases->purchase_id)->get();
        foreach ($detail as $item) {
            $products = Products::find($item->product_id);
            if ($products) {
                $products->stock -= $item->jumlah;
                $products->update();
            }
            $item->delete();
        }

        $purchases->delete();

        return response(null, 204);
    }
}
