@extends('layouts.app_public')

@section('content')
    @php
        $setting = \App\Models\ContactSetting::first();
    @endphp

    <!-- Breadcrumb -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
{{--                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">--}}
{{--                    <li><a href="{{ route('home') }}">Trang chủ</a></li>--}}
{{--                    <li>Liên hệ</li>--}}
{{--                </ul>--}}
                <div class="section-heading">
                    <h1 class="section__title text-white">{{ $setting->headline ?? 'Liên hệ với chúng tôi' }}</h1>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-3">
                {{ $setting->headline ?? 'Liên hệ với chúng tôi' }}
            </h2>

            @if($setting->subheadline)
                <p class="text-center text-muted mb-4">
                    {{ $setting->subheadline }}
                </p>
            @endif

            @if($setting->note)
                <p class="text-center mb-5">
                    {{ $setting->note }}
                </p>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="#" method="POST" class="bg-white p-4 rounded shadow-sm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ tên của bạn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email hoặc Số điện thoại</label>
                            <input type="text" class="form-control" name="contact" placeholder="Email hoặc số điện thoại">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" rows="4" name="message" placeholder="Ghi chú thêm (nếu có)"></textarea>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary">
                                {{ $setting->button_text ?? 'Gửi liên hệ' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
