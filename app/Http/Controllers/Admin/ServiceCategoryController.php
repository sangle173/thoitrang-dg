<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\ServiceCategory::latest()->paginate(10);
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
        ]);

        \App\Models\ServiceCategory::create($data);

        return redirect()->route('admin.service-categories.index')->with('success', 'Đã tạo danh mục dịch vụ.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.portfolio-categories.edit', [
            'item' => $serviceCategory
        ]);
    }

    public function update(Request $request, \App\Models\ServiceCategory $serviceCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
        ]);

        $serviceCategory->update($data);

        return redirect()->route('admin.service-categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(\App\Models\ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')->with('success', 'Đã xóa danh mục.');
    }

    public function toggleStatus($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        return redirect()->route('admin.service-categories.index')->with('success', 'Trạng thái danh mục đã được cập nhật.');
    }
}
