@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Chỉnh sửa Dịch vụ</h2>
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.services._form')
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
