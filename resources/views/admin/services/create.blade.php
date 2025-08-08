@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Thêm Dịch vụ</h2>
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form')
            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
