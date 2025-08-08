@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Danh sách thành viên</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.team-members.create') }}" class="btn btn-success mb-3">+ Thêm thành viên</a>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                <tr>
                    <th width="80">Ảnh</th>
                    <th>Họ tên</th>
                    <th>Chức vụ</th>
                    <th>Giới thiệu</th>
                    <th width="120">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @forelse($team as $member)
                    <tr>
                        <td>
                            @if($member->photo)
                                <img src="{{ asset($member->photo) }}" class="rounded-circle border" style="height: 48px; width: 48px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->position }}</td>
                        <td class="small text-muted">{{ $member->bio }}</td>
                        <td>
                            <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa thành viên này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Chưa có thành viên.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
