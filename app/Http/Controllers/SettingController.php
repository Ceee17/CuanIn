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

    /**
     * Update the specified setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // Fetch the first setting record
        $setting = Setting::first();

        // Validate the incoming request data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'note_type' => 'required|in:1,2',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'card_member_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the setting attributes
        $setting->company_name = $request->company_name;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->discount = $request->discount;
        $setting->note_type = $request->note_type;

        // Handle logo image upload
        if ($request->hasFile('logo_path')) {
            // Delete old logo if exists
            if ($setting->logo_path && Storage::exists('public/' . $setting->logo_path)) {
                Storage::delete('public/' . $setting->logo_path);
            }

            // Store new logo
            $file = $request->file('logo_path');
            $path = $file->store('logos', 'public'); // Store in storage/app/public/logos
            $setting->logo_path = $path;
        }

        // Handle card member image upload
        if ($request->hasFile('card_member_path')) {
            // Delete old card member image if exists
            if ($setting->card_member_path && Storage::exists('public/' . $setting->card_member_path)) {
                Storage::delete('public/' . $setting->card_member_path);
            }

            // Store new card member image
            $file = $request->file('card_member_path');
            $path = $file->store('card_members', 'public'); // Store in storage/app/public/card_members
            $setting->card_member_path = $path;
        }

        // Save the updated setting
        $setting->save();

        // Return success response
        return response()->json('Data berhasil disimpan', 200);
    }
}
