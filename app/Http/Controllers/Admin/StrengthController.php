<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Strength;
use Illuminate\Http\Request;

class StrengthController extends Controller
{
    public function index()
    {
        $strengths = Strength::orderBy('order')->get();
        return view('admin.strengths.index', compact('strengths'));
    }

    public function create()
    {
        return view('admin.strengths.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        Strength::create($request->all());

        return redirect()->route('admin.strengths.index')->with('success', 'Đã thêm thế mạnh thành công.');
    }

    public function edit(Strength $strength)
    {
        return view('admin.strengths.edit', compact('strength'));
    }

    public function update(Request $request, Strength $strength)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $strength->update($request->all());

        return redirect()->route('admin.strengths.index')->with('success', 'Đã cập nhật thành công.');
    }

    public function destroy(Strength $strength)
    {
        $strength->delete();
        return redirect()->route('admin.strengths.index')->with('success', 'Đã xóa thế mạnh.');
    }
}
