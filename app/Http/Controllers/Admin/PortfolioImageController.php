<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PortfolioImageController extends Controller
{
    public function destroy($id)
    {
        $image = \App\Models\PortfolioImage::findOrFail($id);

        // Check and delete from public folder
        if ($image->image && file_exists(public_path($image->image))) {
            unlink(public_path($image->image));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }


    public function updateNote(Request $request, $id)
    {
        $image = PortfolioImage::findOrFail($id);

        $request->validate([
            'note' => 'nullable|string|max:255'
        ]);

        $image->note = $request->note;
        $image->save();

        return back()->with('success', 'Ghi chú ảnh đã được cập nhật.');
    }

    public function updateOrder(Request $request)
    {
        $orderData = $request->input('order');

        foreach ($orderData as $data) {
            PortfolioImage::where('id', $data['id'])->update(['order' => $data['order']]);
        }

        return response()->json(['status' => 'success']);
    }

}
