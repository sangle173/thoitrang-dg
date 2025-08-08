<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $strength->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea id="editor" name="description" class="form-control" rows="3">{{ old('description', $strength->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">
        Icon <small class="text-muted">(Bootstrap Icon class)</small>
        <a href="https://icons.getbootstrap.com/" target="_blank" class="ms-2 small text-decoration-none">
            <i class="bi bi-box-arrow-up-right"></i> Xem danh sách icon
        </a>
    </label>
    <input type="text" name="icon" class="form-control"
           placeholder="Ví dụ: bi bi-award"
           value="{{ old('icon', $strength->icon ?? '') }}">
</div>


<div class="mb-3">
    <label class="form-label">Thứ tự</label>
    <input type="number" name="order" class="form-control" value="{{ old('order', $strength->order ?? 0) }}">
</div>
