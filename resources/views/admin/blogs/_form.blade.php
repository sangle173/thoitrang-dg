<div class="card shadow-sm border-0 mb-4">
    <div class="card-header">
        <h4 class="mb-0">Thông tin bài viết</h4>
    </div>
    <div class="card-body">

        <!-- Tiêu đề -->
        <div class="mb-3">
            <label class="form-label">Tiêu đề *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Thumbnail -->
        <div class="mb-3 row">
            <label class="form-label col-12">Ảnh Thumbnail</label>
            <div class="col-md-6">
                <input type="file" name="thumbnail" class="form-control mt-2" accept="image/*" onchange="previewThumbnail(this)">
                @error('thumbnail')
                <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <img id="thumbnail-preview"
                     src="{{ isset($edit) && $edit && $blog->thumbnail ? asset($blog->thumbnail) : '' }}"
                     class="img-fluid rounded border"
                     style="max-height: 150px; {{ isset($edit) && $edit && $blog->thumbnail ? '' : 'display: none;' }}">
            </div>
        </div>

        <!-- Hashtags -->
        <div class="mb-3">
            <label class="form-label">Hashtags</label>
            <input type="text" name="hashtags" class="form-control"
                   placeholder="vd: villa, thiết kế, hiện đại"
                   value="{{ old('hashtags', $blog->hashtags ?? '') }}">
            <small class="text-muted">Ngăn cách các hashtag bằng dấu phẩy (,)</small>
            @error('hashtags')
            <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Bottom button group -->
    <div class="d-flex justify-content-between align-items-center mt-4 px-4 pb-4">
        <div>
            <button type="submit" class="btn btn-primary">
                {{ isset($edit) && $edit ? 'Cập nhật' : 'Lưu bài viết' }}
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Hủy</a>
        </div>

        @if(isset($edit) && $edit)
            <a href="{{ route('admin.blogs.editAlbum', $blog->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-images me-1"></i> Chỉnh sửa nội dung / hình ảnh
            </a>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        function previewThumbnail(input) {
            const preview = document.getElementById('thumbnail-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endpush
