<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')->with('success', 'Đã gửi liên hệ thành công! Chúng tôi sẽ sớm phản hồi.');
    }
}
