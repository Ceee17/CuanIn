<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function show()
    {
        return Setting::first();
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->company_name = $request->company_name;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->discount = $request->discount;
        $setting->note_type = $request->note_type;

        if ($request->hasFile('logo_path')) {
            $file = $request->file('logo_path');
            $name = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets'), $name);

            $setting->logo_path = "/assets/$name";
        }

        if ($request->hasFile('card_member_path')) {
            $file = $request->file('card_member_path');
            $name = 'logo-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/assets'), $name);

            $setting->card_member_path = "/assets/$name";
        }

        $setting->update();

        return response()->json('Data berhasil disimpan', 200);
    }
}
