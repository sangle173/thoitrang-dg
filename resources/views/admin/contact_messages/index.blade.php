@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container py-4">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                </ol>
            </nav>

            <h2 class="mb-4">Liên hệ khách hàng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th>Họ tên</th>
                    <th>Liên hệ</th>
                    <th>Thời gian</th>
                    <th width="120">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->contact }}</td>
                        <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.contact-messages.show', $msg) }}" class="btn btn-sm btn-info" title="Xem">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa liên hệ này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted text-center">Chưa có liên hệ nào.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $messages->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
