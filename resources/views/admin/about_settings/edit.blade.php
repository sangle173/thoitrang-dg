@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cấu hình Giới thiệu</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Cấu hình Giới thiệu</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h4 class="mb-0">Thông tin Giới thiệu</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $setting->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $setting->short_description) }}</textarea>
                        @error('short_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả đầy đủ (không bắt buộc)</label>
                        <textarea name="full_description" class="form-control" rows="5">{{ old('full_description', $setting->full_description) }}</textarea>
                        @error('full_description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nút (text)</label>
                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $setting->button_text) }}">
                        @error('button_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nút (link)</label>
                        <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $setting->button_link) }}">
                        @error('button_link')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh minh họa</label><br>
                        @if($setting->image)
                            <img src="{{ asset($setting->image) }}" height="120" class="rounded mb-2 d-block">
                        @endif
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success btn-sm">
                        <i class="bi bi-save me-1"></i> Lưu cấu hình
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
