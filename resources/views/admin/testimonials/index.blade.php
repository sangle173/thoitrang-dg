@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Đánh giá khách hàng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-success mb-3">+ Thêm đánh giá</a>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Đánh giá</th>
                <th>Thứ tự</th>
                <th width="120">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse($testimonials as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <strong>{{ $item->name }}</strong><br>
                        <small class="text-muted">{{ $item->location }}</small>
                    </td>
                    <td>
                        <span class="text-muted small">★ {{ $item->rating }}</span><br>
                        <em class="small">{{ \Illuminate\Support\Str::limit($item->content, 60) }}</em>
                    </td>
                    <td>{{ $item->order }}</td>
                    <td>
                        <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Xóa đánh giá này?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Chưa có đánh giá nào.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
