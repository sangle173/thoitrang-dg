@extends('layouts.app_public')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h1 class="section__title text-white">Bài viết mới nhất</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <h1 class="mb-4">Bài viết mới nhất</h1>

        {{-- Search & Filter Form --}}
        <form method="GET" action="{{ route('blogs.index') }}" class="row g-2 align-items-end mb-4">
            <div class="col-md-8">
                <div class="input-group shadow-sm rounded overflow-hidden">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search"
                           class="form-control border-0 shadow-none"
                           placeholder="Tìm kiếm tiêu đề hoặc nội dung..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
            </div>
            @if(request('search') || request('tag'))
                <div class="col-md-2">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                </div>
            @endif
        </form>

        {{-- Active Tag Filter Display --}}
        @if(request('tag'))
            <div class="alert alert-info">
                Đang lọc theo hashtag: <strong>#{{ request('tag') }}</strong>
                <a href="{{ route('blogs.index') }}" class="ms-3 text-danger">Xóa lọc</a>
            </div>
        @endif

        {{-- Blog Cards --}}
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-4 mb-4 d-flex align-items-stretch">
                    <div class="card shadow-sm border-0 d-flex flex-column h-100 w-100">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark d-flex flex-column h-100">
                            {{-- Square image using Bootstrap ratio --}}
                            @if($blog->thumbnail)
                                <div class="ratio ratio-1x1">
                                    <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}"
                                         class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                            @else
                                <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">Không có ảnh</span>
                                </div>
                            @endif

                            {{-- Card body --}}
                            <div class="card-body d-flex flex-column flex-grow-1">
                                <h5 class="card-title">{{ $blog->title }}</h5>
{{--                                <p class="text-muted flex-grow-1">{!! \Illuminate\Support\Str::limit($blog->content, 100) !!}</p>--}}

                                @if($blog->hashtags)
                                    <div class="mb-2">
                                        @foreach(explode(',', $blog->hashtags) as $tag)
                                            <a href="{{ route('blogs.index', ['tag' => trim($tag)]) }}"
                                               class="badge bg-secondary text-decoration-none me-1">
                                                #{{ trim($tag) }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-muted">{{ $blog->created_at->format('d/m/Y') }}</span>
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-light btn-sm shadow-sm">
                                Xem chi tiết <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Không có bài viết nào được tìm thấy.</div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                {{ $blogs->withQueryString()->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Ensure consistent height --}}
    <style>
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection
