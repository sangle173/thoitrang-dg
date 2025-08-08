<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $file = $request->file('image');

        // Create upload directory if not exists
        $uploadPath = public_path('attachments/uploads');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);

        // Save in DB
        $attachment = Attachment::create([
            'file_path'     => 'attachments/uploads/' . $filename,
            'file_name'     => $file->getClientOriginalName(),
            'mime_type'     => $file->getClientMimeType(),
            'user_id'       => auth()->id(),
            'portfolio_id'  => $request->input('portfolio_id'),
        ]);

        return response()->json([
            'url' => asset('attachments/uploads/' . $filename),
            'id'  => $attachment->id,
        ]);
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Delete file from public folder
        if ($attachment->file_path && file_exists(public_path($attachment->file_path))) {
            unlink(public_path($attachment->file_path));
        }

        $attachment->delete();

        return response()->json(['success' => true]);
    }

}
