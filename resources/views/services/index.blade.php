@extends('layouts.app_public')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h1 class="section__title text-white">Dịch vụ của chúng tôi</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <h1 class="mb-4 text-center">Dịch vụ của chúng tôi</h1>

        <div class="row">
            @forelse($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                        <a href="#" class="text-decoration-none text-dark">
                            {{-- Thumbnail --}}
                            @if($service->thumbnail)
                                <div style="height: 300px; overflow: hidden;">
                                    <img src="{{ asset($service->thumbnail) }}" alt="{{ $service->title }}"
                                         class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 300px;">
                                    <span class="text-muted">Không có ảnh</span>
                                </div>
                            @endif

                            {{-- Card Body --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-uppercase">{{ $service->title }}</h5>

                                {{-- Short description --}}
                                <p class="text-muted mb-2">
                                    <b>{{ \Illuminate\Support\Str::limit($service->short_description, 100) }}</b>
                                </p>

                                {{-- Full description (optional: limit or show HTML) --}}
                                <div class="text-secondary" style="font-size: 0.9rem;">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($service->description), 200) !!}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Chưa có dịch vụ nào được thêm.</div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
