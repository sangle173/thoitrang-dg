@php
    $isEdit = isset($user);
@endphp

<!-- Tên -->
<div class="form-floating mb-3 position-relative">
    <input type="text" name="name" id="name"
           value="{{ old('name', $user->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Tên">
    <label for="name"><i class="bi bi-person-fill me-1"></i> Tên</label>
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Email -->
<div class="form-floating mb-3 position-relative">
    <input type="email" name="email" id="email"
           value="{{ old('email', $user->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="Email">
    <label for="email"><i class="bi bi-envelope-fill me-1"></i> Email</label>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mật khẩu -->
<div class="form-floating mb-3 position-relative">
    <input type="password" name="password" id="password"
           class="form-control @error('password') is-invalid @enderror"
           placeholder="Mật khẩu">
    <label for="password">
        <i class="bi bi-lock-fill me-1"></i>
        {{ $isEdit ? 'Mật khẩu mới (nếu đổi)' : 'Mật khẩu' }}
    </label>
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Trạng thái -->
<div class="form-check mb-4">
    <input type="checkbox" name="status" class="form-check-input" id="status"
        {{ old('status', $user->status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="status">
        <i class="bi bi-toggle-on me-1"></i> Hoạt động
    </label>
</div>

<!-- Submit -->
<button class="btn btn-{{ $isEdit ? 'primary' : 'success' }}">
    <i class="bi {{ $isEdit ? 'bi-save' : 'bi-plus-circle' }} me-1"></i>
    {{ $isEdit ? 'Cập nhật' : 'Tạo' }}
</button>
