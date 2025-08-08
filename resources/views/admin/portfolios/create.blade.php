@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Breadcrumb -->
        <section class="bg-light border-bottom py-2 mb-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.portfolios.index') }}">Quản lý sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </section>

        <h2 class="mb-4">Thêm sản phẩm Mới</h2>

        <form id="portfolio-form" method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data">
            @include('admin.portfolios._form')
        </form>
    </div>
@endsection
