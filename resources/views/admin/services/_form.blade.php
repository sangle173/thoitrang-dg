<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Mô tả ngắn</label>
    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $service->short_description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea id="editor" name="description" class="form-control" rows="3">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Thứ tự</label>
    <input type="number" name="order" class="form-control" value="{{ old('order', $service->order ?? 0) }}">
</div>

<!-- Thumbnail -->
<div class="mb-3">
    <label class="form-label">Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
    @error('thumbnail')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($service) && $service->thumbnail)
        <img id="thumbnail-preview" src="{{ asset($service->thumbnail) }}" class="img-fluid rounded mt-2" style="max-height: 150px;" alt="Thumbnail Preview">
    @else
        <img id="thumbnail-preview" class="img-fluid rounded mt-2" style="max-height: 150px; display: none;" alt="Thumbnail Preview">
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnailInput = document.querySelector('input[name="thumbnail"]');
        const thumbnailPreview = document.getElementById('thumbnail-preview');

        thumbnailInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
