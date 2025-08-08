@php
    use App\Models\ServiceCategory;
    use App\Models\PortfolioCategory;

    $header = \App\Models\HeaderSetting::first();
    $serviceCategories = ServiceCategory::where('status', true)->get();
    $portfolioCategories = PortfolioCategory::where('status', true)->get();
@endphp

<!-- Top bar -->
<div class="bg-dark text-white small py-1">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-start align-items-lg-center gap-2 text-nowrap">
            <!-- Phone Numbers on 1st Row (always shown first) -->
            @if($header && $header->phone)
                <div>
                    <i class="bi bi-telephone"></i>
                    {{ $header->phone }}
                    @if($header->phone_2)
                        - {{ $header->phone_2 }}
                    @endif
                </div>
            @endif

        <!-- Email on 2nd Row (on mobile) -->
            @if($header && $header->email)
                <div>
                    <i class="bi bi-envelope"></i>
                    {{ $header->email }}
                </div>
            @endif
        </div>
    </div>
</div>


<!-- Main navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #000;">
    <div class="container">

        <!-- Brand & Toggle -->
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
                <span class="text-white fw-semibold brand-text">Thời Trang - Dương Gia</span>
            </div>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Menu + CTA -->
        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="mainNavbar">
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between w-100">

                <!-- Menu Items -->
                <ul class="navbar-nav fw-bold text-uppercase d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-1 gap-lg-2 mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('gioi-thieu') ? 'active' : '' }}" href="{{ url('/gioi-thieu') }}">Giới thiệu</a>
                    </li>

                    <!-- Dự án -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('du-an*') ? 'active' : '' }}"
                           href="#" data-bs-toggle="dropdown">Sản phẩm</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('portfolio.index') }}">Tất cả Sản phẩm</a></li>
                            @foreach($portfolioCategories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('portfolio.index', ['category' => $cat->slug]) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Dịch vụ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Tin tức</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('dashboard') }}">Quản trị</a>
                    </li>
                    @endauth
                </ul>
            <!-- CTA -->
                <a href="{{ route('contact') }}"
                   class="btn btn-outline-light text-uppercase fw-bold ms-0 ms-lg-3 px-4 py-2 w-100 w-lg-auto text-nowrap">
                    Liên hệ
                </a>

            </div>
        </div>


    </div>
</nav>


<style>
    .navbar-nav .nav-link {
        color: #bbb !important;
        transition: color 0.2s ease;
        white-space: nowrap;
    }
    .navbar .btn {
        min-height: 42px;
        font-size: 0.95rem;
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
        text-transform: capitalize;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #222;
        color: #fff;
    }

    .navbar .btn-outline-light:hover {
        background-color: #fff;
        color: #000 !important;
    }

    nav.navbar {
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .brand-text {
        font-size: 1.1rem;
        white-space: nowrap;
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

        .brand-text {
            font-size: 0.85rem;
        }

        .navbar-brand img {
            height: 40px;
        }
    }
</style>
