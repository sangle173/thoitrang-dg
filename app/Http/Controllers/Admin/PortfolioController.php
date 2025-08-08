<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PortfolioCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::with('portfolioCategory');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('portfolio_category_id', $request->category);
        }

        $portfolios = $query->latest()->paginate(10);
        $categories = PortfolioCategory::all();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    public function create()
    {
        $latestOrder = Portfolio::max('order') ?? 0;
        $defaultOrder = $latestOrder + 1;
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.create', compact('categories', 'defaultOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        $uploadPath = public_path('attachments/uploads');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            $data['image'] = 'attachments/uploads/' . $filename;
        }

        $portfolio = Portfolio::create($data);

        return redirect()->route('admin.portfolios.updateAlbum', $portfolio->id)
            ->with('success', 'Sản phẩm đã được tạo. Bây giờ bạn có thể thêm hình ảnh album.');
    }


    public function updateAlbum($id)
    {
        $portfolio = Portfolio::with('attachments')->findOrFail($id);
        return view('admin.portfolios.edit-album', compact('portfolio'));
    }


    public function edit(Portfolio $portfolio)
    {
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }


    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured'); // ✅ Ensure it’s always set

        $uploadPath = public_path('attachments/uploads');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        if ($request->hasFile('image')) {
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }

            $image = $request->file('image');
            $filename = now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            $data['image'] = 'attachments/uploads/' . $filename;
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }


    public function updateDescription(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);

        $portfolio->update([
            'description' => $request->input('description')
        ]);

        return redirect()->back()->with('success', 'Mô tả đã được lưu.');
    }


    public function destroy(Portfolio $portfolio)
    {
        // Delete main image
        if ($portfolio->image && file_exists(public_path($portfolio->image))) {
            unlink(public_path($portfolio->image));
        }

        // Delete all attachments
        foreach ($portfolio->attachments as $attachment) {
            if ($attachment->file_path && file_exists(public_path($attachment->file_path))) {
                unlink(public_path($attachment->file_path));
            }
            $attachment->delete();
        }

        // Optionally: delete album images if you use another relation
        foreach ($portfolio->images ?? [] as $albumImage) {
            if ($albumImage->image && file_exists(public_path($albumImage->image))) {
                unlink(public_path($albumImage->image));
            }
            $albumImage->delete();
        }

        // Finally delete the portfolio
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Sản phẩm đã được xoá!');
    }

}
