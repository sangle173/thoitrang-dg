<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-4">
        <h2 class="h4">Đăng nhập</h2>
    </div>

    <form method="POST" action="{{ route('login') }}" class="p-4 border rounded shadow-sm bg-white">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">
                Ghi nhớ đăng nhập
            </label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                Đăng nhập
            </button>
        </div>
    </form>
</x-guest-layout>
