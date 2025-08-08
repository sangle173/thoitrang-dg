<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $setting = ContactSetting::firstOrCreate([]);
        return view('admin.contact.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
        ]);

        $setting = ContactSetting::first();
        $setting->update($request->all());

        return redirect()->route('admin.contact.edit')->with('success', 'Cập nhật nội dung liên hệ thành công.');
    }
}

