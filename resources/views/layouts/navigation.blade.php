@php
    $header = \App\Models\HeaderSetting::first();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #000;">
    <div class="container">

        <!-- Logo + Brand -->
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center flex-shrink-0">
                @if($header && $header->logo)
                    <a class="navbar-brand me-2" href="{{ route('home') }}">
                        <img src="{{ asset($header->logo) }}"
                             alt="Logo"
                             class="rounded"
                             style="height: 56px; object-fit: contain;">
                    </a>
                @endif
                <span class="text-white fw-semibold brand-text">Admin Panel</span>
            </div>

            <!-- Toggler -->
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Menu -->
        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="mainNavbar">
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between w-100">
                <ul class="navbar-nav fw-bold text-uppercase d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-1 gap-lg-2 mb-3 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Người dùng</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">Quản lý dịch vụ</a></li>

                    <!-- Dự án -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.portfolios.*') || request()->routeIs('admin.portfolio-categories.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Dự án</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.portfolios.index') }}">Quản lý dự án</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.portfolio-categories.index') }}">Danh mục dự án</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">Bài viết</a></li>

                    <!-- Cấu hình -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('admin/header*') || request()->is('admin/hero-sliders*') || request()->is('admin/about*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Cấu hình</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.header.edit') }}">Cấu hình Header</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.hero-sliders.index') }}">Hero Slider</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.about.edit') }}">Giới thiệu</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.strengths.index') }}">Thế mạnh</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.testimonials.index') }}">Đánh giá khách hàng</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.contact.edit') }}">Cấu hình Liên hệ</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.contact-messages.index') }}">Quản lý liên hệ</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.team-members.index') }}">Đội ngũ</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Auth Info -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff&size=32' }}"
                                     alt="Avatar" width="32" height="32"
                                     class="rounded-circle border"
                                     style="object-fit: cover;">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Hồ sơ</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">@csrf
                                        <button class="dropdown-item" type="submit">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Styling -->
<style>
    .navbar-nav .nav-link {
        color: #bbb !important;
        white-space: nowrap;
        transition: color 0.2s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: #fff !important;
        font-weight: bold;
    }

    .dropdown-menu {
        background-color: #000;
        border: none;
        padding: 0.5rem 0;
    }

    .dropdown-menu .dropdown-item {
        color: #ccc;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: background-color 0.2s ease, color 0.2s ease;
        text-transform: capitalize;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #222;
        color: #fff;
    }

    nav.navbar {
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .brand-text {
        font-size: 1.1rem;
        white-space: nowrap;
        color: #fff;
    }

    @media (max-width: 991.98px) {
        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            width: 100%;
        }

        .navbar-nav {
            width: 100%;
        }

        .dropdown-menu {
            position: static !important;
            float: none;
        }

        .navbar .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            width: 100%;
        }

        .navbar-brand img {
            height: 40px;
        }

        .brand-text {
            font-size: 0.85rem;
        }
    }
</style>

