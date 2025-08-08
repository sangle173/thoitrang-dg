<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments/thumbnails'), $filename);
            $data['thumbnail'] = 'attachments/thumbnails/' . $filename;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được thêm.');
    }



    public function edit(Service $service)
    {
        $categories = ServiceCategory::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if it exists
            if ($service->thumbnail && file_exists(public_path($service->thumbnail))) {
                unlink(public_path($service->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachments/thumbnails'), $filename);
            $data['thumbnail'] = 'attachments/thumbnails/' . $filename;
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được cập nhật.');
    }


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được xóa.');
    }

}
