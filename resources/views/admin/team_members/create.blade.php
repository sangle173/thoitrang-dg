@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Thêm thành viên mới</h2>

        <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
            @include('admin.team_members._form')
        </form>
    </div>
@endsection
