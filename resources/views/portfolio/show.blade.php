@extends('layouts.app_public')
@section('content')
    <!-- Breadcrumb with Thumbnail as Background -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"
             style="background-image: url('{{ asset($portfolio->image) }}'); background-size: cover; background-position: center;"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="section__title text-white fw-bold" style="position: relative; z-index: 1;">
                    {{ $portfolio->title }}
                </h1>
            </div>
        </div>
    </section>
    <!-- Portfolio Details -->
    <section class="py-5">
        <div class="container">
            <h1 class="fw-bold mb-3">{{ $portfolio->title }}</h1>
            <div class="mb-3 text-muted small">
                @if($portfolio->category && $portfolio->category->name)
                    <span class="me-3"><i class="bi bi-tags"></i> {{ $portfolio->category->name }}</span>
                @endif
                @if($portfolio->location)
                    <span class="me-3"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $portfolio->location }}</span>
                @endif
                <span><i class="bi bi-calendar"></i> {{ $portfolio->created_at->format('d/m/Y') }}</span>
            </div>
            @if($portfolio->image)
                <img src="{{ asset($portfolio->image) }}"
                     alt="{{ $portfolio->title }}"
                     class="img-fluid rounded shadow-sm mb-4 w-100"
                     style="object-fit: cover;">
            @endif
            @if($portfolio->short_description)
                <p class="lead text-muted">{{ $portfolio->short_description }}</p>
        @endif
        <!-- Portfolio Description -->
            <div class="portfolio-description-wrapper">
                <div class="portfolio-description text-body fs-6" style="line-height: 1.8;">
                    {!! $portfolio->description !!}
                </div>
            </div>
            <!-- Back to List -->
            <div class="mt-5">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách dự án
                </a>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        /* Wrapper with clear constraints */
        .portfolio-description-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            position: relative;
        }

        .portfolio-description {
            width: 100%;
            max-width: 100%;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        /* Force ALL content within the portfolio description to be responsive */
        .portfolio-description * {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        /* Specific handling for images */
        .portfolio-description img {
            max-width: 100% !important;
            width: auto !important;
            height: auto !important;
            display: block;
            margin: 1rem auto;
            object-fit: contain;
        }

        /* Handle tables which can often break layouts */
        .portfolio-description table {
            display: block;
            overflow-x: auto;
            width: 100% !important;
            max-width: 100% !important;
            margin-bottom: 1rem;
        }

        .portfolio-description iframe,
        .portfolio-description video {
            max-width: 100% !important;
            width: 100% !important;
            height: auto !important;
        }

        /* Force paragraphs to wrap */
        .portfolio-description p {
            width: 100% !important;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        /* Handle divs that might contain fixed-width content */
        .portfolio-description div {
            max-width: 100% !important;
            width: auto !important;
            overflow-x: hidden;
        }

        .breadcrumb-area {
            position: relative;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: none !important;
        }

        .breadcrumb-area .overlay {
            z-index: 0;
        }

        .breadcrumb-area .section__title {
            font-size: 2rem;
        }

        .album-image img:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Apply a comprehensive fix to all content in the portfolio description

            // First, handle images
            document.querySelectorAll('.portfolio-description img').forEach(img => {
                // Remove all attributes that might affect width
                img.removeAttribute('style');
                img.removeAttribute('width');
                img.removeAttribute('height');
                // Apply inline max-width as a fallback
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
            });

            // Handle tables
            document.querySelectorAll('.portfolio-description table').forEach(table => {
                table.removeAttribute('width');
                table.removeAttribute('style');
                table.style.width = '100%';
                table.style.maxWidth = '100%';
            });

            // Handle divs that might contain problematic content
            document.querySelectorAll('.portfolio-description div').forEach(div => {
                // Remove attributes that might cause overflow
                if (div.hasAttribute('width')) {
                    div.removeAttribute('width');
                }

                // Check for inline styles that set width
                const style = div.getAttribute('style');
                if (style) {
                    // Only remove width-related styles, keep other styles
                    if (style.includes('width:') || style.includes('width=')) {
                        // Try to preserve other style properties
                        const newStyle = style
                            .split(';')
                            .filter(s => !s.includes('width'))
                            .join(';');

                        if (newStyle.trim()) {
                            div.setAttribute('style', newStyle);
                        } else {
                            div.removeAttribute('style');
                        }

                        // Add responsive width
                        div.style.maxWidth = '100%';
                    }
                }
            });

            // Fix any direct children of the description div
            document.querySelectorAll('.portfolio-description > *').forEach(el => {
                el.style.maxWidth = '100%';
                el.style.boxSizing = 'border-box';

                // If the element has a width attribute that's too large
                if (el.hasAttribute('width') && parseInt(el.getAttribute('width')) > 100) {
                    el.removeAttribute('width');
                }
            });
        });
    </script>
@endpush
