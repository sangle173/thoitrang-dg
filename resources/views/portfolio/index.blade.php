@extends('layouts.app_public')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h1 class="section__title text-white">Dự án</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Project List -->
    <div class="container py-5">
        <h1 class="mb-4 fw-bold text-center">
            @if(!empty($category))
                {{ $category->name }}
            @else
                Tất cả dự án
            @endif
        </h1>

        <div class="row">
            @forelse($portfolios as $project)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                        <a href="{{ route('portfolio.show', $project->id) }}" class="text-decoration-none text-dark d-flex flex-column h-100">

                            {{-- Image box --}}
                            @if($project->image)
                                <div style="height: 400px; overflow: hidden;">
                                    <img src="{{ asset($project->image) }}"
                                         alt="{{ $project->title }}"
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover;">
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                                    <span class="text-muted">Không có ảnh</span>
                                </div>
                            @endif

                            {{-- Card Body --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-uppercase text-primary" style="letter-spacing: 0.5px;">
                                    {{ $project->title }}
                                </h5>

                                {{-- Category and Location --}}
                                <p class="small text-muted mb-1">
                                    @if($project->category)
                                        <i class="bi bi-folder me-1 text-primary"></i>{{ $project->category->name }}
                                    @endif
                                    @if($project->location)
                                        <span class="ms-3"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $project->location }}</span>
                                    @endif
                                </p>

                                {{-- Short Description --}}
                                <p class="text-muted mt-1 mb-0" style="font-size: 0.95rem;">
                                    {{ \Illuminate\Support\Str::limit($project->short_description, 100) }}
                                </p>
                            </div>
                        </a>

                        {{-- Footer with Date and Button --}}
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                {{ $project->created_at->format('d/m/Y') }}
                            </span>
                            <a href="{{ route('portfolio.show', $project->id) }}" class="btn btn-light btn-sm shadow-sm">
                                Xem chi tiết <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Không có dự án nào được tìm thấy.</div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($portfolios->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                {{ $portfolios->withQueryString()->links('vendor.pagination.bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
