@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cấu hình Header</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Cấu hình Header</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h4 class="mb-0">Thông tin Header</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.header.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Slogan (hiển thị dưới logo ở footer)</label>
                        <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $setting->slogan) }}">
                        @error('slogan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if($setting->logo)
                            <img src="{{ asset($setting->logo) }}" class="mt-2 border rounded" style="height: 60px;">
                        @endif
                        @error('logo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $setting->address) }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giờ làm việc</label>
                        <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $setting->working_hours) }}">
                        @error('working_hours')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <h5 class="mt-4">Mạng xã hội</h5>
                    <div class="mb-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="text" name="facebook_url" class="form-control" value="{{ old('facebook_url', $setting->facebook_url) }}">
                        @error('facebook_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">YouTube URL</label>
                        <input type="text" name="youtube_url" class="form-control" value="{{ old('youtube_url', $setting->youtube_url) }}">
                        @error('youtube_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Zalo URL</label>
                        <input type="text" name="zalo_url" class="form-control" value="{{ old('zalo_url', $setting->zalo_url) }}">
                        @error('zalo_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">TikTok URL</label>
                        <input type="text" name="tiktok_url" class="form-control" value="{{ old('tiktok_url', $setting->tiktok_url) }}">
                        @error('tiktok_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Footer Copyright</label>
                        <input type="text" name="footer_copyright" class="form-control" value="{{ old('footer_copyright', $setting->footer_copyright) }}">
                        @error('footer_copyright')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save me-1"></i> Lưu thay đổi
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
