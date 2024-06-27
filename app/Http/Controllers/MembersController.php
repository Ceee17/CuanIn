<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;




class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index');
    }

    /**
     * This function is used to retrieve and format member data for a datatable.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function data()
    {
        // Fetch all members ordered by member_code
        $member = Members::orderBy('member_code')->get();

        // Use the datatables library to format the member data
        return datatables()
            ->of($member)
            ->addIndexColumn() // Add an index column to the table
            ->addColumn('select_all', function ($products) {
                // Add a checkbox column for selection
                return '
                <input type="checkbox" name="member_id[]" value="' . $products->member_id . '">
            ';
            })
            ->addColumn('member_code', function ($member) {
                // Add a formatted member_code column
                return '<span class="label label-success">' . $member->member_code . '<span>';
            })
            ->addColumn('action', function ($member) {
                // Add an action column with edit and delete buttons
                return '
            <div class="btn-group">
                <button type="button" onclick="editForm(`' . route('member.update', $member->member_id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-pen"></i></button>
                <button type="button" onclick="deleteData(`' . route('member.destroy', $member->member_id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
            </div>
            ';
            })
            ->rawColumns(['action', 'select_all', 'member_code']) // Specify columns that should not be escaped
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
        // Get the latest member
        $latestMember = Members::latest()->first();

        // Initialize member_code based on the latest member_code found
        $latestCode = $latestMember ? (int) filter_var($latestMember->member_code, FILTER_SANITIZE_NUMBER_INT) : 0;
        $member_code = $latestCode + 1;

        // Create a new member instance
        $member = new Members();
        $member->member_code = 'M' . str_pad($member_code, 5, '0', STR_PAD_LEFT); // Ensure the code is 5 digits long
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
    /**
 * This function is used to generate a PDF report of selected members.
 *
 * @param Request $request The request object containing the selected member IDs.
 * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
 * @throws \Exception
 */
public function cetakMember(Request $request)
{
    // Initialize an empty collection to store the selected member data
    $member_data = collect(array());

    // Loop through the selected member IDs and fetch the corresponding member data
    foreach ($request->member_id as $id) {
        $member = Members::find($id);
        if ($member) {
            $member_data[] = $member;
        }
    }

    // Check if any member data was found
    if ($member_data->isEmpty()) {
        // Return a JSON response with a 404 status code if no members were found
        return response()->json('No members found', 404);
    }

    // Chunk the member data into groups of 2 for printing on the PDF
    $member_data = $member_data->chunk(2);

    // Fetch the application settings
    $setting = Setting::first();

    // Check if any settings were found
    if (!$setting) {
        // Return a JSON response with a 500 status code if no settings were found
        return response()->json('Settings not found', 500);
    }

    // Initialize a counter for the member number
    $no  = 1;

    // Generate the PDF using the 'member.cetak' view, passing the member data, counter, and settings
    $pdf = PDF::loadView('member.cetak', compact('member_data', 'no', 'setting'));

    // Set the paper size and orientation for the PDF
    $pdf->setPaper(array(0, 0, 566.93, 850.39), 'portrait');

    // Return the generated PDF as a downloadable file
    return $pdf->stream('member.pdf');
}
}
