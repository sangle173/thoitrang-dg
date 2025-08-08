{{-- create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Thêm danh mục @yield('title')</h2>
        <form action="{{ route('admin.service-categories.store') }}" method="POST">
            @csrf
            @include('admin.' . explode('.', Route::currentRouteName())[1] . '._form', ['item' => null])
        </form>
    </div>
@endsection
