@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm Slider mới</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Thêm Slider mới</h2>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h4 class="mb-0">Thông tin Slider</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.hero-sliders.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="headline" class="form-control" value="{{ old('headline') }}">
                        @error('headline')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phụ đề</label>
                        <textarea name="subheadline" class="form-control">{{ old('subheadline') }}</textarea>
                        @error('subheadline')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nút (text)</label>
                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text') }}">
                        @error('button_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nút (link)</label>
                        <input type="text" name="button_link" class="form-control" value="{{ old('button_link') }}">
                        @error('button_link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh nền (1920x800 đề xuất)</label>
                        <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                        <img id="preview" class="mt-3 rounded" style="max-height: 150px; display: none;">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success btn-sm">
                        <i class="bi bi-save me-1"></i> Lưu slider
                    </button>
                    <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary btn-sm ms-2">
                        <i class="bi bi-arrow-left me-1"></i> Quay lại
                    </a>
                </form>
            </div>
        </div>
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
