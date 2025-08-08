<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderSetting;
use Illuminate\Support\Facades\Storage;

class HeaderSettingController extends Controller
{
    public function edit()
    {
        $setting = HeaderSetting::firstOrCreate([]);
        return view('admin.header_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'zalo_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
        ]);

        $setting = \App\Models\HeaderSetting::first();
        $data = $request->except('logo');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();

            $destinationPath = public_path('attachments/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $logo->move($destinationPath, $logoName);
            $data['logo'] = 'attachments/uploads/' . $logoName;
        }

        $setting->update($data);

        return back()->with('success', 'Cập nhật cấu hình header thành công.');
    }


}

