@php
    $setting = \App\Models\ContactSetting::first();
@endphp

@if($setting && ($setting->headline || $setting->subheadline))
    <section class="py-3" id="contact-cta">
        <div class="container text-center">
            <h3 class="fw-bold mb-2 text-dark">{{ $setting->headline }}</h3>
            @if($setting->subheadline)
                <p class="mb-4 text-dark">{{ $setting->subheadline }}</p>
            @endif
            <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-view-all">
                {{ $setting->button_text ?? 'Liên hệ ngay' }} <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </section>

@endif
