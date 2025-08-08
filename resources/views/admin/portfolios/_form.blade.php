@csrf
@if(isset($edit) && $edit)
    @method('PUT')
@endif

<!-- Title -->
<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title ?? '') }}" required>
</div>

<!-- Main Image -->
<div class="mb-3 row">
    <label class="form-label col-12">Hình ảnh</label>
    <div class="col-6">
        <input type="file" name="image" id="image-input" class="form-control mt-2" accept="image/*">
    </div>
    <div class="col-6">
        <img id="thumbnail-preview"
             src="{{ isset($edit) && $edit && isset($portfolio->image) ? asset($portfolio->image) : '' }}"
             class="img-fluid rounded mb-2"
             style="max-height: 150px; {{ isset($edit) && $edit && isset($portfolio->image) ? '' : 'display: none;' }}">
    </div>
</div>

<!-- Location -->
<div class="mb-3">
    <label class="form-label">Vị trí</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $portfolio->location ?? '') }}">
</div>

<!-- Category -->
<div class="mb-3">
    <label class="form-label">Danh mục sản phẩm</label>
    <select name="portfolio_category_id" class="form-select" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (old('portfolio_category_id', $portfolio->portfolio_category_id ?? '') == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Short Description -->
<div class="mb-3">
    <label class="form-label">Mô tả ngắn</label>
    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $portfolio->short_description ?? '') }}</textarea>
</div>

<!-- Featured -->
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1"
        {{ old('is_featured', $portfolio->is_featured ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Hiển thị ở mục "Sản phẩm nổi bật"</label>
</div>

<!-- Order -->
<div class="mb-3">
    <label class="form-label">Thứ tự hiển thị</label>
    <input type="number" name="order" class="form-control" 
           value="{{ old('order', $portfolio->order ?? $defaultOrder ?? 0) }}" min="0">
    <small class="text-muted">Nhập số thứ tự để sắp xếp hiển thị. Số nhỏ hơn sẽ hiển thị trước.</small>
</div>

<!-- Submit Buttons -->
<div class="d-flex justify-content-between align-items-center mt-4">
    <div>
        <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Cập nhật' : 'Lưu sản phẩm' }}</button>
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Hủy</a>
    </div>

    @if(isset($edit) && $edit)
        <a href="{{ route('admin.portfolios.updateAlbum', $portfolio->id) }}" class="btn btn-outline-primary">
            <i class="bi bi-images me-1"></i> Chỉnh sửa mô tả / album
        </a>
    @endif
</div>