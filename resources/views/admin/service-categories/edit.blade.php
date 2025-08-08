{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Chỉnh sửa danh mục @yield('title')</h2>
        <form action="{{ route('admin.service-categories.update', $item) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.' . explode('.', Route::currentRouteName())[1] . '._form', ['item' => $item])
        </form>
    </div>
@endsection
