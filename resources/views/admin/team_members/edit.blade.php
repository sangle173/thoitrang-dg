@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Cập nhật thành viên</h2>

        <form method="POST" action="{{ route('admin.team-members.update', $teamMember) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.team_members._form', ['teamMember' => $teamMember])
        </form>
    </div>
@endsection
