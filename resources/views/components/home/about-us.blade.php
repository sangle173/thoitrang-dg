@php
    $about = \App\Models\AboutSetting::first();
@endphp

@if($about && ($about->title || $about->short_description || $about->full_description))
    <section id="about" class="py-3">
        <div class="container">
            <div class="row align-items-center">
                @if($about->image)
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="{{ asset($about->image) }}" class="img-fluid rounded shadow-sm" alt="About image">
                    </div>
                @endif
                <div class="{{ $about->image ? 'col-md-6' : 'col-12' }}">
                    <h2 class="fw-bold mb-3">{{ $about->title }}</h2>
                    <p class="lead">{{ $about->short_description }}</p>

                    @if($about->full_description)
                        <div class="text-secondary">
                            {{$about->full_description }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
