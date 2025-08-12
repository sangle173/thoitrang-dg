<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Duong Gia Fashion</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{--    <!-- Scripts -->--}}
    {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    {{--    <!-- CSRF Token -->--}}
    <style>
        .breadcrumb-area {
            position: relative;
            padding: 60px 0;
            background-image: url('path/to/your/background-image.jpg');
            background-size: cover;
            background-position: center;
        }

        body {
            background-color: #F4F2EA !important;
        }

        .breadcrumb-area .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('overlay/overlay.jpg') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.8;
        }

        .breadcrumb-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-heading {
            order: 2;
            text-align: right;
        }

        .section__title {
            font-size: 2.5rem;
            color: #fff;
        }

        .generic-list-item {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 1.25rem;
        }

        .generic-list-item li {
            display: inline;
            margin-right: 10px;
            color: #fff;
        }

        .generic-list-item li a {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
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
                font-size: 1.5rem;
            }

            .generic-list-item {
                font-size: 1rem;
            }
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh!important; /* Full viewport height */
            background-color: #F4F2EA !important;
        }

        .content-wrapper {
            flex: 1; /* This allows the main content to grow and take available space */
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }

        footer p {
            margin: 0;
            color: #6c757d; /* Adjust color as needed */
        }
    </style>

    <!-- Additional styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-light">
@include('layouts.navigation')

<!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
@endisset

<!-- Page Content -->
    <main class="container py-4 content-wrapper"> <!-- Added class 'content-wrapper' -->
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // ✅ Global Upload Adapter for CKEditor
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file.then(file => {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                // Try to include portfolio_id if it exists on the page
                const pidField = document.querySelector('[name="portfolio_id"]');
                if (pidField && pidField.value) {
                    formData.append('portfolio_id', pidField.value);
                }

                return fetch("{{ route('admin.attachments.upload') }}", {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                        if (!res.url) throw new Error('Upload failed');
                        return { default: res.url };
                    });
            });
        }

        abort() {
            // You can abort the upload here if needed
        }
    }

    function CustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = loader => new MyUploadAdapter(loader);
    }

    document.addEventListener("DOMContentLoaded", function () {
        const editorElement = document.querySelector("#editor");

        if (editorElement && !window.editorInstance) {
            ClassicEditor
                .create(editorElement, {
                    extraPlugins: [CustomUploadAdapterPlugin]
                })
                .then(editor => {
                    window.editorInstance = editor;
                    console.log("✅ CKEditor initialized globally.");
                })
                .catch(error => {
                    console.error("❌ CKEditor failed to initialize:", error);
                });
        }
    });
</script>

<!-- Section scripts -->
@yield('scripts')

<!-- Stacked scripts -->
@stack('scripts')

<footer style="text-align: center; padding: 20px 0; background-color: #f8f9fa;">
    <p style="margin: 0; color: #6c757d;">&copy; {{ date('Y') }} Duong Gia Fashion. All rights reserved.</p>
</footer>
</body>
</html>
