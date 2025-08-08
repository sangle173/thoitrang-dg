@extends('layouts.app')

@section('content')
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thế mạnh</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Danh sách Thế mạnh</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.strengths.create') }}" class="btn btn-success mb-3">+ Thêm Thế mạnh</a>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Icon</th>
                <th>Thứ tự</th>
                <th width="120">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($strengths as $strength)
                <tr>
                    <td>{{ $strength->id }}</td>
                    <td>{{ $strength->title }}</td>
                    <td><i class="{{ $strength->icon }}"></i> <code>{{ $strength->icon }}</code></td>
                    <td>{{ $strength->order }}</td>
                    <td>
                        <a href="{{ route('admin.strengths.edit', $strength) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.strengths.destroy', $strength) }}"
                              class="d-inline" onsubmit="return confirm('Xóa mục này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Chưa có mục nào.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
