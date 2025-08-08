@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý Người dùng</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Search + Filter -->
    <div class="row g-2 mt-3">
        <form method="GET" action="{{ route('users.index') }}" class="d-flex flex-wrap align-items-end gap-2">
            <!-- Search -->
            <div class="col-auto">
                <div class="input-group shadow-sm rounded">
                <span class="input-group-text bg-white border-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                    <input type="text" name="search" class="form-control border-0 shadow-none"
                           placeholder="Tìm kiếm tên hoặc email..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <!-- Filter status -->
            <div class="col-auto">
                <select name="status" class="form-select">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="col-auto">
                <button class="btn btn-outline-primary">
                    <i class="bi bi-funnel"></i> Lọc
                </button>
            </div>

            @if(request('search') || request('status'))
                <div class="col-auto">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Đặt lại
                    </a>
                </div>
            @endif
        </form>
    </div>

    <div class="container py-4">
        <h2 class="mb-4">Quản lý người dùng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <!-- Create Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                + Tạo người dùng
            </a>
        </div>

        <!-- User Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo / cập nhật</th>
                    <th width="120">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $index => $user)
                    <tr class="{{ !$user->status ? 'table-secondary' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->status)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Không hoạt động</span>
                            @endif
                        </td>
                        <td class="small text-muted">
                            <div><strong>Tạo:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</div>
                            <div><strong>Cập nhật:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                @if($user->status)
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Vô hiệu hóa người dùng này?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Vô hiệu hóa">
                                            <i class="bi bi-person-x"></i>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.users.activate', $user->id) }}">
                                        @csrf @method('PUT')
                                        <button class="btn btn-sm btn-success" title="Kích hoạt lại" onclick="return confirm('Kích hoạt lại người dùng này?')">
                                            <i class="bi bi-person-check"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">Không có người dùng nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
