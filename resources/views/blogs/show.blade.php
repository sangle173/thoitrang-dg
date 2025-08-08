@extends('layouts.app_public')

@section('content')
    <!-- Breadcrumb with Thumbnail as Background -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"
             style="background-image: url('{{ asset($blog->thumbnail) }}'); background-size: cover; background-position: center;"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="section__title text-white fw-bold" style="position: relative; z-index: 1;">
                    {{ $blog->title }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Blog Details -->
    <section class="py-5">
        <div class="container">
            <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>

            <div class="mb-3 text-muted small">
                <span><i class="bi bi-calendar"></i> {{ $blog->created_at->format('d/m/Y') }}</span>
            </div>

            @if($blog->thumbnail)
                <img src="{{ asset($blog->thumbnail) }}"
                     alt="{{ $blog->title }}"
                     class="img-fluid rounded shadow-sm mb-4 w-100"
                     style="object-fit: cover;">
            @endif

        <!-- Hashtags -->
            @if($blog->hashtags)
                <div class="mb-4">
                    @foreach(explode(',', $blog->hashtags) as $tag)
                        <span class="badge bg-primary me-1">#{{ trim($tag) }}</span>
                    @endforeach
                </div>
        @endif

        <!-- Blog Content -->
            <div class="portfolio-description-wrapper">
                <div class="portfolio-description text-body fs-6" style="line-height: 1.8;">
                    {!! $blog->content !!}
                </div>
            </div>

            <!-- Back to List -->
            <div class="mt-5">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Quay lại danh sách bài viết
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
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

        .portfolio-description * {
            max-width: 100% !important;
            box-sizing: border-box !important;
        }

        .portfolio-description img {
            max-width: 100% !important;
            height: auto !important;
            display: block;
            margin: 1rem auto;
            object-fit: contain;
        }

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

        .portfolio-description p {
            width: 100% !important;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

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
            // Apply a comprehensive fix to all content in the blog description
            document.querySelectorAll('.portfolio-description img').forEach(img => {
                img.removeAttribute('style');
                img.removeAttribute('width');
                img.removeAttribute('height');
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
            });

            document.querySelectorAll('.portfolio-description table').forEach(table => {
                table.removeAttribute('width');
                table.removeAttribute('style');
                table.style.width = '100%';
                table.style.maxWidth = '100%';
            });

            document.querySelectorAll('.portfolio-description div').forEach(div => {
                if (div.hasAttribute('width')) div.removeAttribute('width');

                const style = div.getAttribute('style');
                if (style && (style.includes('width:') || style.includes('width='))) {
                    const newStyle = style
                        .split(';')
                        .filter(s => !s.includes('width'))
                        .join(';');
                    if (newStyle.trim()) {
                        div.setAttribute('style', newStyle);
                    } else {
                        div.removeAttribute('style');
                    }
                    div.style.maxWidth = '100%';
                }
            });

            document.querySelectorAll('.portfolio-description > *').forEach(el => {
                el.style.maxWidth = '100%';
                el.style.boxSizing = 'border-box';
                if (el.hasAttribute('width') && parseInt(el.getAttribute('width')) > 100) {
                    el.removeAttribute('width');
                }
            });
        });
    </script>
@endpush
