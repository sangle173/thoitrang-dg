@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container py-4">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contact-messages.index') }}">Liên hệ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                </ol>
            </nav>

            <h2 class="mb-4">Chi tiết liên hệ</h2>


            <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Họ tên:</strong> {{ $contactMessage->name }}</p>
                <p><strong>Liên hệ:</strong> {{ $contactMessage->contact }}</p>
                <p><strong>Gửi lúc:</strong> {{ $contactMessage->created_at->format('d/m/Y H:i') }}</p>

                <hr>
                <p><strong>Nội dung:</strong></p>
                <p>{{ $contactMessage->message ?? 'Không có nội dung.' }}</p>
            </div>
        </div>

        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
    </div>
@endsection
