<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Setting;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SalesDetail;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('sales.index');
    }

    /**
     * This function is used to retrieve sales data and format it for a datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function data()
    {
        // Fetch all sales data with related member data, ordered by sales_id in descending order
        $sales = Sales::with('member')->orderBy('sales_id', 'desc')->get();

        // Use Laravel Datatables to format the sales data for the datatable
        return datatables()
            ->of($sales)
            ->addIndexColumn() // Add an index column to the table
            ->addColumn('total_item', function ($sales) {
                // Format the total_item column to a readable format
                return convertCurrencyFormat($sales->total_item);
            })
            ->addColumn('total_price', function ($sales) {
                // Format the total_price column to a readable format with currency symbol
                return 'Rp. ' . convertCurrencyFormat($sales->total_price);
            })
            ->addColumn('payment', function ($sales) {
                // Format the payment column to a readable format with currency symbol
                return 'Rp. ' . convertCurrencyFormat($sales->payment);
            })
            ->addColumn('date', function ($sales) {
                // Format the created_at column to a readable date format
                return convertDateFormat($sales->created_at, false);
            })
            ->addColumn('member_code', function ($sales) {
                // Add a member_code column with a label and member code
                $member = $sales->member->member_code ?? '';
                return '<span class="label label-success">' . $member . '</span>';
            })
            ->editColumn('discount', function ($sales) {
                // Format the discount column to a readable percentage format
                return $sales->discount . '%';
            })
            ->editColumn('cashier', function ($sales) {
                // Add a cashier column with the user name
                return $sales->user->name ?? '';
            })
            ->addColumn('action', function ($sales) {
                // Add an action column with buttons to show and delete sales data
                return '
            <div class="btn-group">
                <button onclick="showDetail(`' . route('sales.show', $sales->sales_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                <button onclick="deleteData(`' . route('sales.destroy', $sales->sales_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
            })
            ->rawColumns(['action', 'member_code']) // Specify columns that should not be escaped
            ->make(true); // Return the formatted data as a JSON response
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = new Sales();
        $sales->member_id = null;
        $sales->total_item = 0;
        $sales->total_price = 0;
        $sales->discount = 0;
        $sales->payment = 0;
        $sales->received = 0;
        $sales->user_id = auth()->id();
        $sales->save();

        session(['sales_id' => $sales->sales_id]);
        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sales = Sales::findOrFail($request->sales_id);
        $sales->member_id = $request->member_id;
        $sales->total_item = $request->total_item;
        $sales->total_price = $request->total;
        $sales->discount = $request->discount;
        $sales->payment = $request->payment;
        $sales->received = $request->received;
        $sales->update();

        $detail = SalesDetail::where('sales_id', $sales->sales_id)->get();
        foreach ($detail as $item) {
            $item->discount = $request->discount;
            $item->update();

            $products = Products::find($item->product_id);
            $products->stock -= $item->amount;
            $products->update();
        }

        return redirect()->route('transaksi.selesai');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = SalesDetail::with('products')->where('sales_id', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('product_code', function ($detail) {
                return '<span class="label label-success">' . $detail->products->product_code . '</span>';
            })
            ->addColumn('product_name', function ($detail) {
                return $detail->products->product_name;
            })
            ->addColumn('selling_price', function ($detail) {
                return 'Rp. ' . convertCurrencyFormat($detail->selling_price);
            })
            ->addColumn('amount', function ($detail) {
                return convertCurrencyFormat($detail->amount);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . convertCurrencyFormat($detail->subtotal);
            })
            ->rawColumns(['product_code'])
            ->make(true);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sales = Sales::find($id);
        $detail    = SalesDetail::where('sales_id', $sales->sales_id)->get();
        foreach ($detail as $item) {
            $products = Products::find($item->product_id);
            if ($products) {
                $products->stock += $item->amount;
                $products->update();
            }

            $item->delete();
        }

        $sales->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('sales.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $sales = Sales::find(session('sales_id'));
        if (!$sales) {
            abort(404);
        }
        $detail = SalesDetail::with('products')
            ->where('sales_id', session('sales_id'))
            ->get();

        return view('sales.nota_kecil', compact('setting', 'sales', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $sales = Sales::find(session('sales_id'));
        if (!$sales) {
            abort(404);
        }
        $detail = SalesDetail::with('products')
            ->where('sales_id', session('sales_id'))
            ->get();

        $pdf = PDF::loadView('sales.nota_besar', compact('setting', 'sales', 'detail'));
        $pdf->setPaper(0, 0, 609, 440, 'potrait');
        return $pdf->stream('Transaksi-' . date('Y-m-d-his') . '.pdf');
    }
}
