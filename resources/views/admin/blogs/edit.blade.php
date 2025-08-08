@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Bài Viết: {{ $blog->title }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container">
        <h2 class="mt-4">Chỉnh Sửa Bài Viết: {{ $blog->title }}</h2>
        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.blogs._form', ['blogs' => $blog])
        </form>
    </div>
@endsection
