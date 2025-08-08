{{-- _form.blade.php --}}
<div class="mb-3">
    <label for="name" class="form-label">Tên danh mục</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $item->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="short_description" class="form-label">Mô tả ngắn</label>
    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $item->short_description ?? '') }}</textarea>
</div>

<button class="btn btn-success">Lưu</button>
