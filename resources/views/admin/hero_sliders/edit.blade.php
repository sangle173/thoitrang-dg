@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Chỉnh sửa Slider</h2>

        <form method="POST" action="{{ route('admin.hero-sliders.update', $heroSlider) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="headline" class="form-control" value="{{ old('headline', $heroSlider->headline) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phụ đề</label>
                <textarea name="subheadline" class="form-control">{{ old('subheadline', $heroSlider->subheadline) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nút (text)</label>
                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $heroSlider->button_text) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nút (link)</label>
                <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $heroSlider->button_link) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Thứ tự hiển thị</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $heroSlider->order) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh nền hiện tại</label><br>
                <img src="{{ asset($heroSlider->image) }}" height="120" class="rounded mb-2">
                <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                <img id="preview" class="mt-3 rounded" style="max-height: 150px; display: none;">
            </div>

            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
        </form>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function () {
                    const output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @endpush

@endsection
