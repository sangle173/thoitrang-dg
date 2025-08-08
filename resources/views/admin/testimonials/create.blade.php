@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Thêm đánh giá</h2>

        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.testimonials._form')
            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
