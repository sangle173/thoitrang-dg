@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Left: Avatar -->
                            <div class="col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center">
                                <div style="width: 140px; height: 140px; overflow: hidden; border-radius: 50%; border: 2px solid #ddd;">
                                    @if($user->avatar)
                                        <img src="{{ asset($user->avatar) }}"
                                             alt="Ảnh đại diện"
                                             class="w-100 h-100"
                                             style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=140"
                                             alt="Avatar tự động"
                                             class="w-100 h-100"
                                             style="object-fit: cover;">
                                    @endif
                                </div>

                                <p class="mt-3 text-muted mb-0"><strong>Tham gia:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                                <p class="text-muted"><strong>Vai trò:</strong> Quản trị viên</p>
                            </div>

                            <!-- Right: Profile Form -->
                            <div class="col-md-8">
                                <h4 class="mb-4">Thông tin cá nhân</h4>

                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label class="form-label">Tên người dùng</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Ảnh đại diện mới</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-success mt-2">Cập nhật thông tin</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
