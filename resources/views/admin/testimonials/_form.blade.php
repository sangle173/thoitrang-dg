<div class="mb-3">
    <label class="form-label">Họ tên *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Địa điểm</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $testimonial->location ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Hình đại diện</label>
    <input type="file" name="avatar" class="form-control">
    @if(!empty($testimonial->avatar))
        <img src="{{ asset('storage/' . $testimonial->avatar) }}" height="60" class="rounded mt-2">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Số sao (1–5)</label>
    <input type="number" name="rating" min="1" max="5" class="form-control" value="{{ old('rating', $testimonial->rating ?? 5) }}">
</div>

<div class="mb-3">
    <label class="form-label">Nội dung *</label>
    <textarea name="content" rows="4" class="form-control" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Thứ tự hiển thị</label>
    <input type="number" name="order" class="form-control" value="{{ old('order', $testimonial->order ?? 0) }}">
</div>
