<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'note_type' => 'required|in:1,2',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'card_member_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $setting->company_name = $request->company_name;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->discount = $request->discount;
        $setting->note_type = $request->note_type;

        if ($request->hasFile('logo_path')) {
            // Delete old logo if exists
            if ($setting->logo_path && Storage::exists('public/' . $setting->logo_path)) {
                Storage::delete('public/' . $setting->logo_path);
            }

            $file = $request->file('logo_path');
            $path = $file->store('logos', 'public'); // Store in storage/app/public/logos

            $setting->logo_path = $path;
        }

        if ($request->hasFile('card_member_path')) {
            // Delete old card member image if exists
            if ($setting->card_member_path && Storage::exists('public/' . $setting->card_member_path)) {
                Storage::delete('public/' . $setting->card_member_path);
            }

            $file = $request->file('card_member_path');
            $path = $file->store('card_members', 'public'); // Store in storage/app/public/card_members

            $setting->card_member_path = $path;
        }

        $setting->save();

        return response()->json('Data berhasil disimpan', 200);
    }
}
