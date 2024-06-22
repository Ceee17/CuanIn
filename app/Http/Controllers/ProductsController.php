<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_category = ProductCategory::all()->pluck('category_name', 'category_id');

        return view('products.index', compact('product_category'));
    }

    public function data()
    {
        $products = Products::leftJoin('product_category', 'product_category.category_id', 'products.category_id')
            ->select('products.*', 'category_name')
            ->orderBy('product_code', 'asc')
            ->get();

        return datatables()
            ->of($products)
            ->addIndexColumn()
            ->addColumn('select_all', function ($products) {
                return '
                    <input type="checkbox" name="product_id[]" value="' . $products->product_id . '">
                ';
            })
            ->addColumn('product_code', function ($products) {
                return '<span class="label label-success">' . $products->product_code . '</span>';
            })
            ->addColumn('buying_price', function ($products) {
                return convertCurrencyFormat($products->buying_price);
            })
            ->addColumn('selling_price', function ($products) {
                return convertCurrencyFormat($products->selling_price);
            })
            ->addColumn('stock', function ($products) {
                return convertCurrencyFormat($products->stock);
            })
            ->addColumn('action', function ($products) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('products.update', $products->product_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`' . route('products.destroy', $products->product_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'product_code', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = Products::latest()->first() ?? new Products();
        $request['product_code'] = 'SS' . generate_product_code((int)$products->product_id + 1, 6);

        $products = Products::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::find($id);

        return response()->json($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Products::find($id);
        $products->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->product_id as $id) {
            $products = Products::find($id);
            $products->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $product_data = array();
        foreach ($request->product_id as $id) {
            $products = Products::find($id);
            $product_data[] = $products;
        }

        $no  = 1;
        $pdf = PDF::loadView('products.barcode', compact('product_data', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('products.pdf');
    }
}
