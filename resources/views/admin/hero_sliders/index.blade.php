@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Quản lý Hero Slider</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.hero-sliders.create') }}" class="btn btn-success mb-3">+ Thêm Slider mới</a>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Phụ đề</th>
                    <th>Thứ tự</th>
                    <th width="130">Hành động</th>
                </tr>
                </thead>
                <tbody id="slider-list">
                @forelse($sliders as $slider)
                    <tr data-id="{{ $slider->id }}">
                        <td>
                            <img src="{{ asset($slider->image) }}" height="80" class="rounded">
                        </td>
                        <td>{{ $slider->headline }}</td>
                        <td>{{ $slider->subheadline }}</td>
                        <td>{{ $slider->order }}</td>
                        <td>
                            <a href="{{ route('admin.hero-sliders.edit', $slider) }}" class="btn btn-sm btn-warning" title="Sửa">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.hero-sliders.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa slider này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Chưa có slider nào.</td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            const el = document.getElementById('slider-list');
            new Sortable(el, {
                animation: 150,
                onEnd: function () {
                    const order = [];
                    el.querySelectorAll('tr').forEach((row, index) => {
                        order.push({ id: row.dataset.id, order: index });
                    });

                    fetch('{{ route('admin.hero-sliders.update-order') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ order })
                    });
                }
            });
        </script>
    @endpush

@endsection
