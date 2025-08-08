<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogAttachmentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'image' => 'required|image|max:4096',
        ]);

        $file = $request->file('image');
        $fileName = now()->format('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = 'attachments/blogs/' . $fileName;

        $file->move(public_path('attachments/blogs'), $fileName);

        $attachment = \App\Models\BlogAttachment::create([
            'blog_id' => $request->blog_id,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
        ]);

        return response()->json([
            'id' => $attachment->id,
            'url' => asset($attachment->file_path),
        ]);
    }

    public function destroy($id)
    {
        $attachment = \App\Models\BlogAttachment::findOrFail($id);

        // Delete the file from public storage
        if ($attachment->file_path && file_exists(public_path($attachment->file_path))) {
            unlink(public_path($attachment->file_path));
        }

        // Delete the record
        $attachment->delete();

        return response()->json(['success' => true]);
    }

}
