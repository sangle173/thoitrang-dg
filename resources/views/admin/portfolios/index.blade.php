@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý Dự án</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Danh sách Dự án</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <!-- Search + Add Button Row -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('admin.portfolios.index') }}" class="row g-2 align-items-end flex-grow-1 me-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Tìm theo tiêu đề hoặc vị trí..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary w-100">Tìm kiếm</button>
                </div>
                @if(request('search') || request('category'))
                    <div class="col-md-2">
                        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                @endif
            </form>

            <a href="{{ route('admin.portfolios.create') }}" class="btn btn-success mt-3 mt-md-0">
                + Thêm Dự án
            </a>
        </div>


        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Vị trí</th>
                    <th>Danh mục</th>
                    <th>Nổi bật</th>
                    <th>Thứ tự</th>
                    <th>Ngày tạo</th>
                    <th>Người tạo</th>
                    <th width="120">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($portfolios as $index => $project)
                    <tr>
                        <td>{{ $portfolios->firstItem() + $index }}</td>
                        <td>
                            @if($project->image)
                                <img src="{{ asset($project->image) }}"
                                     class="rounded border"
                                     style="height: 48px; width: 48px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->location }}</td>
                        <td>{{ $project->portfolioCategory->name ?? 'N/A' }}</td>
                        <td>
                            @if($project->is_featured)
                                <span class="badge bg-success">Có</span>
                            @else
                                <span class="badge bg-secondary">Không</span>
                            @endif
                        </td>
                        <td>{{ $project->order }}</td>
                        <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{ $project->creator->name ?? 'Không xác định' }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <a href="{{ route('admin.portfolios.edit', $project) }}"
                                   class="btn btn-sm btn-warning" title="Sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="{{ route('portfolio.show', $project->id) }}"
                                   class="btn btn-sm btn-info" title="Xem trước" target="_blank">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('admin.portfolios.destroy', $project) }}"
                                      method="POST"
                                      onsubmit="return confirm('Xóa dự án này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted text-center">Chưa có dự án nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $portfolios->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
