<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutSetting;

class AboutSettingController extends Controller
{
    public function edit()
    {
        $setting = AboutSetting::firstOrCreate([]);
        return view('admin.about_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $setting = AboutSetting::first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $destinationPath = public_path('attachments/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Optional: delete old image
            if ($setting->image && file_exists(public_path($setting->image))) {
                unlink(public_path($setting->image));
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = 'attachments/uploads/' . $imageName;
        }

        $setting->update($data);

        return back()->with('success', 'Cập nhật thành công!');
    }

}

