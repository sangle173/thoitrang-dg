@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Thêm Thế mạnh</h2>
        <form method="POST" action="{{ route('admin.strengths.store') }}">
            @csrf
            @include('admin.strengths._form')
            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.strengths.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
