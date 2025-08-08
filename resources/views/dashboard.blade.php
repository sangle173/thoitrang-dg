@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light border-bottom py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Dashboard Content -->
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Blog Numbers Today -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card radius-10 border-start border-0 border-4 border-info h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-2 text-secondary">Bài viết hôm nay</p>
                                    <h4 class="mb-0 text-info">{{ $blogCountToday ?? '0' }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class='bx bxs-cart fs-5'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Portfolios -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card radius-10 border-start border-0 border-4 border-danger h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-2 text-secondary">Dự án mới</p>
                                    <h4 class="mb-0 text-danger">{{ $newPortfolioCount ?? '0' }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class='bx bxs-wallet fs-5'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Portfolios -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card radius-10 border-start border-0 border-4 border-success h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-2 text-secondary">Tổng số dự án</p>
                                    <h4 class="mb-0 text-success">{{ $totalPortfolioCount ?? '0' }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class='bx bxs-bar-chart-alt-2 fs-5'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Contact Messages -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="card radius-10 border-start border-0 border-4 border-warning h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-2 text-secondary">Tin nhắn mới</p>
                                    <h4 class="mb-0 text-warning">{{ $newContactMessageCount ?? '0' }}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class='bx bxs-group fs-5'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div>
    </div>
@endsection
