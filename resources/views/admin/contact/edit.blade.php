@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Cấu hình trang Liên hệ</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.contact.update') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tiêu đề chính</label>
                <input type="text" name="headline" class="form-control"
                       value="{{ old('headline', $setting->headline) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phụ đề</label>
                <input type="text" name="subheadline" class="form-control"
                       value="{{ old('subheadline', $setting->subheadline) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung ghi chú</label>
                <textarea id="editor" name="note" class="form-control" rows="4">{{ old('note', $setting->note) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nút gọi hành động</label>
                <input type="text" name="button_text" class="form-control"
                       value="{{ old('button_text', $setting->button_text) }}">
            </div>

            <button class="btn btn-primary">Lưu cấu hình</button>
        </form>
    </div>
@endsection
