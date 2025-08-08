@php
    $header = \App\Models\HeaderSetting::first(); // reuse phone/email/logo
@endphp

<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">

            {{-- Logo & Tagline --}}
            <div class="col-md-4 mb-4">
                @if($header && $header->logo)
                    <img src="{{ asset($header->logo) }}"
                         alt="Logo"
                         class="mb-3"
                         style="height: 50px; object-fit: contain;">
                @endif
                <p>{{ $header->slogan ?? 'Giải pháp thiết kế biệt thự đẳng cấp, chuyên nghiệp và sáng tạo.' }}</p>
            </div>

            {{-- Quick Links --}}
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold mb-3">Liên kết nhanh</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ url('/gioi-thieu') }}"
                       class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-chevron-right small"></i> Giới thiệu
                    </a>
                    <a href="{{ url('/du-an') }}"
                       class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-chevron-right small"></i> Sản phẩm
                    </a>
                    <a href="{{ url('/dich-vu') }}"
                       class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-chevron-right small"></i> Dịch vụ
                    </a>
                    <a href="{{ route('blogs.index') }}"
                       class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-chevron-right small"></i> Tin tức
                    </a>
                    <a href="{{ route('contact') }}"
                       class="text-white text-decoration-none d-flex align-items-center gap-2">
                        <i class="bi bi-chevron-right small"></i> Liên hệ
                    </a>
                </div>
            </div>


            {{-- Contact Info --}}
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase">Liên hệ</h5>
                <ul class="list-unstyled small">
                    @if($header->phone)
                        <li><i class="bi bi-telephone"></i> {{ $header->phone }}</li>
                    @endif
                    @if($header->email)
                        <li><i class="bi bi-envelope"></i> {{ $header->email }}</li>
                    @endif
                    @if($header->address)
                        <li><i class="bi bi-geo-alt"></i> {{ $header->address }}</li>
                    @endif
                    @if($header->working_hours)
                        <li><i class="bi bi-clock"></i> {{ $header->working_hours }}</li>
                    @endif
                </ul>

                {{-- Social Icons --}}
                <div class="mt-3 d-flex align-items-center gap-3">
                    @if($header->facebook_url)
                        <a href="{{ $header->facebook_url }}" target="_blank" class="text-white social-icon"
                           title="Facebook">
                            <img src="{{ asset('icons/facebook_icon.png') }}"
                                 alt="Facebook"
                                 height="26">
                        </a>
                    @endif
                    @if($header->youtube_url)
                        <a href="{{ $header->youtube_url }}" target="_blank" class="text-white social-icon"
                           title="YouTube">
                            <img src="{{ asset('icons/youtube.webp') }}"
                                 alt="Youtube"
                                 height="26">
                        </a>
                    @endif

                    @if($header->tiktok_url)
                        <a href="{{ $header->tiktok_url }}" target="_blank" class="text-white social-icon"
                           title="Tiktok">
                            <img src="{{ asset('icons/tiktok.png') }}"
                                 alt="Tiktok"
                                 height="26">
                        </a>
                    @endif

                    @if($header->zalo_url)
                        <a href="{{ $header->zalo_url }}" target="_blank" class="text-white social-icon"
                           title="ZaloIcon">
                            <img src="{{ asset('icons/zalo_icon.png') }}"
                                 alt="Zalo"
                                 height="26">
                        </a>
                    @endif
                </div>


            </div>
        </div>

        <hr class="bg-secondary">

        <div class="text-center text-white small">
            {{ $header->footer_copyright ?? ('© ' . now()->year . ' Thời Trang - Dương Gia. All rights reserved.') }}
        </div>
    </div>
</footer>

<style>
    footer .text-decoration-none:hover {
        color: #ffc107 !important; /* soft yellow on hover */
        text-decoration: underline;
    }

    .social-icon:hover {
        color: #ffc107 !important; /* soft yellow */
        transition: all 0.3s ease;
    }

    .social-icon img:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }
</style>
