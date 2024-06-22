<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Members::orderBy('member_code')->get();

        return datatables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('select_all', function ($products) {
                return '
                    <input type="checkbox" name="id_member[]" value="' . $products->member_id . '">
                ';
            })
            ->addColumn('member_code', function ($member) {
                return '<span class="label label-success">' . $member->member_code . '<span>';
            })
            ->addColumn('action', function ($member) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`' . route('member.update', $member->member_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`' . route('member.destroy', $member->member_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'select_all', 'member_code'])
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
        $member = Members::latest()->first() ?? new Members();
        $member_code = (int) $member->member_code + 1;

        $member = new Members();
        $member->member_code = generate_product_code($member_code, 5);
        $member->name = $request->name;
        $member->phone_number = $request->phone_number;
        $member->address = $request->address;
        $member->save();

        return response()->json('Data berhasil disimpan', 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Members::find($id);

        return response()->json($member);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Members $members)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Members::find($id)->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Members::find($id);
        $member->delete();

        return response(null, 204);
    }

    public function cetakMember(Request $request)
    {
        $member_data = collect(array());
        foreach ($request->member_id as $id) {
            $member = Members::find($id);
            $member_data[] = $member;
        }

        $member_data = $member_data->chunk(2);
        // $setting    = Setting::first();

        $no  = 1;
        $pdf = PDF::loadView('member.cetak', compact('member_data', 'no', 'setting'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}
