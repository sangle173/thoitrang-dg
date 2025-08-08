@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Chỉnh sửa đánh giá</h2>

        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.testimonials._form')
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
