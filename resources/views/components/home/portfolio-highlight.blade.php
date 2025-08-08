@php
    use App\Models\PortfolioCategory;

    $categories = PortfolioCategory::where('status', true)
        ->with(['portfolios' => function ($query) {
            $query->where('is_featured', true)
                  ->orderBy('order', 'asc') // Sort by the 'order' field
                  ->latest()
                  ->take(6);
        }])
        ->get();
@endphp

@if($categories->count())
    <section class="py-3" id="featured-products">
        <div class="container">
            @foreach($categories as $category)
                @if($category->portfolios->count())
                    <div class="mb-5">
                        <h3 class="portfolio-category-title text-uppercase">{{ $category->name }}</h3>

                        @if($category->short_description)
                            <p class="portfolio-category-description">{{ $category->short_description }}</p>
                        @endif

                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @foreach($category->portfolios as $portfolio)
                                <div class="col">
                                    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="portfolio-image-card d-block">
                                        <img src="{{ asset($portfolio->image) }}"
                                             alt="{{ $portfolio->title }}">
                                        <div class="portfolio-title-overlay text-uppercase">{{ $portfolio->title }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('portfolio.index', ['category' => $category->slug]) }}" class="btn btn-outline-dark btn-view-all">
                                XEM THÊM <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif

    <style>
        .portfolio-category-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin: 40px 0 10px;
        }

        .portfolio-category-description {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
            font-style: italic;
        }

        .portfolio-image-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease;
        }

        .portfolio-image-card img {
            width: 100%;
            height: 450px;
            max-height: 450px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .portfolio-image-card:hover img {
            transform: scale(1.05);
        }

        .portfolio-title-overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 8px 0;
            font-weight: bold;
            font-size: 1rem;
        }
        .btn-view-all {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-view-all i {
            transition: transform 0.3s ease;
            margin-left: 5px;
        }

        .btn-view-all:hover i {
            transform: translateX(4px);
        }

        @media (max-width: 768px) {
            .portfolio-image-card img {
                height: auto;
            }
        }
    </style>
