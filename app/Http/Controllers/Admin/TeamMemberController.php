<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('order')->get();
        return view('admin.team_members.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team_members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $timestamp = now()->format('Ymd_His');
            $originalName = $photo->getClientOriginalName();
            $sanitized = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $photo->getClientOriginalExtension();
            $filename = $timestamp . '_' . $sanitized . '.' . $extension;

            $uploadPath = public_path('attachments/uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $photo->move($uploadPath, $filename);
            $data['photo'] = 'attachments/uploads/' . $filename;
        }

        $data['order'] = TeamMember::max('order') + 1;

        TeamMember::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Thêm thành viên thành công.');
    }


    public function edit(TeamMember $teamMember)
    {
        return view('admin.team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($teamMember->photo && file_exists(public_path($teamMember->photo))) {
                unlink(public_path($teamMember->photo));
            }

            // Save new photo
            $photo = $request->file('photo');
            $timestamp = now()->format('Ymd_His');
            $originalName = $photo->getClientOriginalName();
            $sanitized = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $photo->getClientOriginalExtension();
            $filename = $timestamp . '_' . $sanitized . '.' . $extension;

            $uploadPath = public_path('attachments/uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $photo->move($uploadPath, $filename);
            $data['photo'] = 'attachments/uploads/' . $filename;
        }

        $teamMember->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Cập nhật thành viên thành công.');
    }


    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Xóa thành viên thành công.');
    }
}
