<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::latest()->paginate(10);
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
        ]);

        PortfolioCategory::create($data);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Đã tạo danh mục sản phẩm.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio-categories.edit', [
            'item' => $portfolioCategory
        ]);
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
        ]);

        $portfolioCategory->update($data);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->delete();

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Đã xóa danh mục.');
    }

    public function toggleStatus($id)
    {
        $category = \App\Models\PortfolioCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Trạng thái danh mục đã được cập nhật.');
    }

}
