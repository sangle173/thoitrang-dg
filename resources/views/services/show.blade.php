@extends('layouts.app_public')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
{{--                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">--}}
{{--                    <li><a href="{{ route('home') }}">Trang chủ</a></li>--}}
{{--                    <li><a href="{{ route('services.index') }}">Dịch vụ</a></li>--}}
{{--                    <li>{{ $service->title }}</li>--}}
{{--                </ul>--}}
                <div class="section-heading">
                    <h1 class="section__title text-white">{{ $service->title }}</h1>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section>

    <div class="container py-5">
        {{-- Service Detail --}}
        <div class="row">
            <div class="col-lg-10 mx-auto">

                {{-- Icon + Title + Short Description --}}
                <div class="text-center mb-4">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        @if($service->icon)
                            <div class="text-danger fs-1 me-3">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                        @endif
                        <h2 class="fw-bold mb-0">{{ $service->title }}</h2>
                    </div>

                    @if($service->short_description)
                        <p class="text-muted fs-6">{{ $service->short_description }}</p>
                    @endif
                </div>

                {{-- Highlight Description --}}
                @if($service->description)
                    <div class="bg-light border rounded p-4 mb-4">
                        {!! $service->description !!}
                    </div>
                @endif

                {{-- Full Content --}}
                @if($service->content)
                    <div class="service-content mb-5">
                        {!! $service->content !!}
                    </div>
                @endif

                {{-- Back to Services --}}
                <div class="text-center mb-5">
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại danh sách dịch vụ
                    </a>
                </div>

                {{-- Related Services --}}
                @php
                    $relatedServices = \App\Models\Service::where('id', '!=', $service->id)
                        ->where('service_category_id', $service->service_category_id)
                        ->orderBy('order')
                        ->take(3)
                        ->get();
                @endphp

                @if($relatedServices->count())
                    <h4 class="fw-bold mb-3 text-center">Dịch vụ liên quan</h4>
                    <div class="row">
                        @foreach($relatedServices as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm text-center">
                                    <div class="text-danger fs-1 mt-3">
                                        <i class="{{ $item->icon ?? 'bi bi-gear' }}"></i>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="fw-bold">{{ $item->title }}</h6>
                                        <p class="text-muted small">
                                            {{ \Illuminate\Support\Str::limit($item->short_description, 100) }}
                                        </p>
                                        <a href="{{ route('services.show', $item->slug) }}" class="btn btn-outline-primary btn-sm">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .service-content p {
            line-height: 1.8;
            margin-bottom: 1rem;
        }
    </style>
@endpush
