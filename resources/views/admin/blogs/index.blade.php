@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý Bài viết</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Quản lý bài viết</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <!-- Search + Create -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('admin.blogs.index') }}" class="row g-2 align-items-end flex-grow-1 me-3">
                <div class="col-md-6">
                    <div class="input-group shadow-sm rounded">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 shadow-none"
                               placeholder="Tìm kiếm tiêu đề hoặc nội dung..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">Tìm kiếm</button>
                </div>
                @if(request('search') || request('tag'))
                    <div class="col-md-2">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
                    </div>
                @endif
            </form>

            <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">
                + Tạo bài viết
            </a>
        </div>

        <!-- Tag Filter Alert -->
        @if(request('tag'))
            <div class="alert alert-info">
                Đang lọc theo hashtag: <strong>#{{ request('tag') }}</strong>
                <a href="{{ route('admin.blogs.index') }}" class="ms-2 text-danger">Xóa lọc</a>
            </div>
    @endif

    <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th width="50">#</th>
                    <th width="100">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Hashtags</th>
                    <th>Ngày tạo / cập nhật</th>
                    <th width="120">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($blogs as $index => $blog)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($blog->thumbnail)
                                <img src="{{ asset($blog->thumbnail) }}"
                                     class="img-fluid rounded border"
                                     style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @foreach(explode(',', $blog->hashtags ?? '') as $tag)
                                <a href="{{ route('admin.blogs.index', ['tag' => trim($tag)]) }}"
                                   class="badge bg-secondary text-decoration-none me-1">
                                    #{{ trim($tag) }}
                                </a>
                            @endforeach
                        </td>
                        <td class="small text-muted">
                            <div><strong>Tạo:</strong> {{ $blog->created_at->format('d/m/Y H:i') }}</div>
                            <div><strong>Cập nhật:</strong> {{ $blog->updated_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                {{-- View button --}}
                                <a href="{{ route('blogs.show', $blog->slug) }}"
                                   class="btn btn-sm btn-info" title="Xem bài viết" target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Edit button --}}
                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                   class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- Delete form --}}
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Xóa bài viết này?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">Không có bài viết nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $blogs->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
