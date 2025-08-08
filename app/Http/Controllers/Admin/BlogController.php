<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogAttachment;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Blog::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
        }

        if ($tag = $request->input('tag')) {
            $query->where('hashtags', 'like', "%$tag%");
        }

        $blogs = $query->latest()->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'thumbnail.image' => 'Tệp tải lên phải là hình ảnh.',
            'thumbnail.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->title);
        $blog->hashtags = $request->input('hashtags');
        $blog->content = ''; // ✅ Empty content, will be filled later in edit-album

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();

            $destinationPath = public_path('attachments/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $thumbnail->move($destinationPath, $thumbnailName);
            $blog->thumbnail = 'attachments/uploads/' . $thumbnailName;
        }

        $blog->save();

        // ✅ Redirect directly to edit album step
        return redirect()->route('admin.blogs.editAlbum', $blog->id)
            ->with('success', 'Đã tạo blog. Bây giờ bạn có thể thêm nội dung và hình ảnh.');
    }



    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'edit' => true, // ✅ Add this line
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'thumbnail.image' => 'Tệp tải lên phải là hình ảnh.',
            'thumbnail.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
        ]);

        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->title);
        $blog->hashtags = $request->input('hashtags');

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail && file_exists(public_path($blog->thumbnail))) {
                unlink(public_path($blog->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();

            $destinationPath = public_path('attachments/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $thumbnail->move($destinationPath, $thumbnailName);
            $blog->thumbnail = 'attachments/uploads/' . $thumbnailName;
        }

        $blog->save();

        return redirect()->route('admin.blogs.editAlbum', $blog->id)
            ->with('success', 'Đã cập nhật thông tin blog. Bây giờ bạn có thể chỉnh sửa nội dung và hình ảnh.');
    }


    public function editAlbum($id)
    {
        $blog = Blog::with('attachments')->findOrFail($id);
        return view('admin.blogs.edit-album', compact('blog'));
    }

    public function updateDescription(Request $request, $id)
    {
        $request->validate([
            'content' => 'nullable|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->content = $request->content;
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật nội dung blog thành công!');
    }



    public function destroy(Blog $blog)
    {
        // Delete attachments (files + db records)
        foreach ($blog->attachments as $attachment) {
            $filePath = public_path($attachment->file_path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $attachment->delete();
        }

        // Delete the blog record
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted!');
    }

}
