@php
    $strengths = \App\Models\Strength::orderBy('order')->get();
@endphp

@if($strengths->count())
    <section class="py-3" id="why-choose-us">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Tại sao chọn chúng tôi?</h2>
            <div class="row">
                @foreach($strengths as $item)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card border-0 h-100 shadow-sm text-center p-3">
                            @if($item->icon)
                                <div class="mb-3 text-primary fs-1">
                                    <i class="{{ $item->icon }}"></i>
                                </div>
                            @endif
                            <h5 class="fw-bold">{{ $item->title }}</h5>
                            <p class="text-muted small mb-0">{!! $item->description  !!} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
