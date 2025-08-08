@extends('layouts.app_public')

@section('content')
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
{{--                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">--}}
{{--                    <li><a href="{{ route('home') }}">Trang chủ</a></li>--}}
{{--                    <li>Giới thiệu</li>--}}
{{--                </ul>--}}
                <div class="section-heading">
                    <h1 class="section__title text-white">Giới thiệu</h1>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section>

    <section class="py-5">
        <div class="container">
            <h1 class="mb-4 fw-bold">{{ $about->title ?? 'Giới thiệu' }}</h1>

            @if($about->image)
                <img src="{{ asset($about->image) }}"
                     alt="Giới thiệu"
                     class="img-fluid rounded mb-4 shadow-sm">
            @endif

            <p class="lead">{{ $about->short_description }}</p>

            @if($about->full_description)
                <div class="text-secondary mt-3" style="line-height: 1.8;">
                    {!! nl2br(e($about->full_description)) !!}
                </div>
            @endif
        </div>
    </section>

    @if($teamMembers->count())
        <section class="pt-5">
            <div class="container">
                <h2 class="fw-bold text-center mb-4">Đội ngũ của chúng tôi</h2>
                <div class="row g-4">
                    @foreach($teamMembers as $member)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                @if($member->photo)
                                    <div style="position: relative; width: 100%; padding-top: 100%; overflow: hidden;">
                                        <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}"
                                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="fw-bold">{{ $member->name }}</h5>
                                    <p class="mb-1 text-muted">{{ $member->position }}</p>
                                    @if($member->bio)
                                        <p class="text-secondary mt-2" style="line-height: 1.6;">{{ $member->bio }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif




@endsection
<style>
    .card img {
        transition: transform 0.3s ease;
    }
    .card img:hover {
        transform: scale(1.02);
    }
</style>
