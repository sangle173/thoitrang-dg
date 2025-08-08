@extends('layouts.app')

@section('content')
    <section class="bg-light border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Dịch vụ</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container py-4">
        <h2 class="mb-4">Danh sách Dịch vụ</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.services.create') }}" class="btn btn-success mb-3">+ Thêm Dịch vụ</a>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Thumbnail</th>
                <th>Thứ tự</th>
                <th width="120">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->title }}</td>
                    <td>
                        @if($service->thumbnail)
                            <img src="{{ asset($service->thumbnail) }}" alt="Thumbnail" style="height: 50px; width: auto;">
                        @else
                            <span class="text-muted">No Thumbnail</span>
                        @endif
                    </td>
                    <td>{{ $service->order }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                              class="d-inline" onsubmit="return confirm('Xóa dịch vụ này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Chưa có dịch vụ nào.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
