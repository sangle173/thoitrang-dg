<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::orderBy('order')->get();
        return view('admin.hero_sliders.index', compact('sliders'));
    }

    public function create()
    {
        if (HeroSlider::count() >= 5) {
            return redirect()->route('admin.hero-sliders.index')->with('error', 'Chỉ được tối đa 5 slider.');
        }

        return view('admin.hero_sliders.create');
    }

    public function store(Request $request)
    {
        if (HeroSlider::count() >= 5) {
            return back()->with('error', 'Chỉ được tối đa 5 slider.');
        }

        $data = $request->validate([
            'image' => 'required|image|max:2048',
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        // Store image in public/attachments/uploads
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();

        $destinationPath = public_path('attachments/uploads');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);
        $data['image'] = 'attachments/uploads/' . $imageName; // relative path saved to DB

        HeroSlider::create($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Đã thêm slider mới!');
    }


    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero_sliders.edit', compact('heroSlider'));
    }

    public function update(Request $request, HeroSlider $heroSlider)
    {
        $data = $request->validate([
            'image' => 'nullable|image|max:2048',
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from public folder
            if ($heroSlider->image && file_exists(public_path($heroSlider->image))) {
                unlink(public_path($heroSlider->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $destinationPath = public_path('attachments/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = 'attachments/uploads/' . $imageName;
        }

        $heroSlider->update($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Cập nhật thành công!');
    }


    public function destroy(HeroSlider $heroSlider)
    {
        if ($heroSlider->image && Storage::disk('public')->exists($heroSlider->image)) {
            Storage::disk('public')->delete($heroSlider->image);
        }

        $heroSlider->delete();

        return back()->with('success', 'Xóa slider thành công!');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item) {
            HeroSlider::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['status' => 'ok']);
    }
}
