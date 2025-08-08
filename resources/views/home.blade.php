@extends('layouts.app_public')

@section('content')
    @include('components.home.hero-slider')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.about-us')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.portfolio-highlight')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.strengths')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.services')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.testimonials')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.blogs')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.teams')
    <div class="text-center">
        <div class="section-divider mx-auto"></div>
    </div>
    @include('components.home.contact-cta')
@endsection
