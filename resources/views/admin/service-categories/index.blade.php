@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Danh mục Dịch vụ</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.service-categories.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên</th>
                <th>Slug</th>
                <th>Mô tả ngắn</th>
                <th>Trạng thái</th>
                <th width="150">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $item)
                <tr class="{{ !$item->status ? 'table-secondary' : '' }}">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ Str::limit($item->short_description, 100) }}</td>
                    <td>
                        @if($item->status)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.service-categories.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.service-categories.toggle', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm {{ $item->status ? 'btn-danger' : 'btn-success' }}">
                                {{ $item->status ? 'Ẩn' : 'Hiện' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $categories->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
