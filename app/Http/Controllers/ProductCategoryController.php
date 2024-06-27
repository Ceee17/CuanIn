<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * This function is used to retrieve and format data for the product category datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function data()
    {
        // Fetch all product categories ordered by category_id in descending order
        $product_category = ProductCategory::orderBy('category_id', 'desc')->get();

        // Use Laravel Datatables to format the fetched data
        return datatables()
            ->of($product_category)
            ->addIndexColumn() // Add an auto-incrementing index column to the table
            ->addColumn('action', function ($product_category) {
                // Add action buttons for editing and deleting records
                return '
            <div class="btn-group" role="group">
                <button onclick="editForm(`' . route('category.update', $product_category->category_id) . '`)" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></button>
                <button onclick="deleteData(`' . route('category.destroy', $product_category->category_id) . '`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            </div>
            ';
            })
            ->rawColumns(['action']) // Indicate that the 'action' column contains raw HTML
            ->make(true); // Return the formatted data as a JSON response
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
        $product_category = new ProductCategory();
        $product_category->category_name = $request->category_name;
        $product_category->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product_category = ProductCategory::find($id);

        return response()->json($product_category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product_category = ProductCategory::find($id);
        $product_category->category_name = $request->category_name;
        $product_category->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_category = ProductCategory::find($id);
        $product_category->delete();

        return response(null, 204);
    }
}
