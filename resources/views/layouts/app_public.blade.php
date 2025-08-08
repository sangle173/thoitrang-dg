<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dương Gia Fashion - Thời Trang Đẳng Cấp' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        .breadcrumb-area {
            position: relative;
            padding: 60px 0;
            background-image: url('path/to/your/background-image.jpg'); /* Optional: Add a background image */
            background-size: cover;
            background-position: center;
        }

        .breadcrumb-area .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('overlay/overlay.jpg') }}'); /* Use the image as background */
            background-size: cover; /* Ensure the image covers the entire area */
            background-position: center; /* Center the image */
            opacity: 0.8; /* Adjust opacity as needed */
        }

        .breadcrumb-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-heading {
            order: 2; /* Move the header to the right */
            text-align: right;
        }

        .section__title {
            font-size: 2.5rem; /* Increase font size */
            color: #fff;
        }

        .generic-list-item {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 1.25rem; /* Increase font size */
        }

        .generic-list-item li {
            display: inline;
            margin-right: 10px;
            color: #fff;
        }

        .generic-list-item li a {
            color: #fff; /* Set link color to white */
            font-weight: bold; /* Make links bold */
            text-decoration: none; /* Remove underline */
        }

        .generic-list-item li:after {
            content: '>';
            margin-left: 10px;
            color: #fff;
        }

        .generic-list-item li:last-child:after {
            content: '';
        }

        @media (max-width: 768px) {
            .section__title {
                font-size: 1.5rem; /* Adjust font size for smaller screens */
            }

            .generic-list-item {
                font-size: 1rem; /* Adjust font size for smaller screens */
            }
        }
        body {
            background-color: #faf6f3 !important;
        }

        .scroll-to-top {
            bottom: 80px; /* ← moves the button above bottom contacts */
            right: 20px;
            z-index: 9999;
            display: none;
            position: fixed;
            border-radius: 50%;
            padding: 10px 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }


        /*======== section-divider ========*/
        .section-divider {
            display: inline-block;
            position: relative;
            height: 5px;
            border-radius: 30px;
            background-color: #ec5252;
            width: 90px;
            margin-top: 25px;
            margin-bottom: 25px;
            overflow: hidden;
        }
        .section-divider:after {
            content: '';
            position: absolute;
            left: 0;
            top: -1.1px;
            height: 7px;
            width: 8px;
            background-color: #fff;
            animation: dot-move 3s linear infinite;
        }

        /*======= section--divider (short version) =======*/
        .section--divider {
            width: 50px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .section--divider:after {
            top: -0.1px;
            width: 5px;
            animation: dot-move2 3s linear infinite;
        }

        /*======= section-divider-white =======*/
        .section-divider-white {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /*======= Animations =======*/
        @keyframes dot-move {
            0% {
                left: 0;
            }
            100% {
                left: 100%;
            }
        }

        @keyframes dot-move2 {
            0% {
                left: 0;
            }
            100% {
                left: 100%;
            }
        }

    </style>

</head>
<body>
<div class="min-h-screen">
    @include('layouts.header') {{-- frontend header only --}}

    <main class="p-0 m-0 w-100 mb-2">
        @yield('content')
    </main>
    @include('layouts.footer') {{-- frontend header only --}}
    @include('components.home.mobile-contact-bar')
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="btn btn-primary position-fixed scroll-to-top">
    <i class="bi bi-arrow-up"></i>
</button>
<script>
    const scrollBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        scrollBtn.style.display = window.scrollY > 300 ? 'block' : 'none';
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'alwaysShowNavOnTouchDevices': true
            });
        } else {
            console.error("Lightbox2 is not loaded.");
        }
    });
</script>

@stack('scripts')
</body>
</html>
