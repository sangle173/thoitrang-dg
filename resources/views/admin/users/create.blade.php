@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Quản lý Người dùng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tạo người dùng</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Tạo người dùng</h2>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            @include('admin.users._form')
        </form>
    </div>
@endsection
