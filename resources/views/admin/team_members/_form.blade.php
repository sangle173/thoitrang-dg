{{-- Shared Form --}}
@csrf

<div class="mb-3">
    <label class="form-label">Họ tên</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $teamMember->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Chức vụ</label>
    <input type="text" name="position" class="form-control" value="{{ old('position', $teamMember->position ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Giới thiệu ngắn (tùy chọn)</label>
    <textarea id="editor" name="bio" class="form-control" rows="3">{{ old('bio', $teamMember->bio ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Ảnh đại diện</label>
    <input type="file" name="photo" class="form-control">
    @if(!empty($teamMember->photo))
        <img src="{{ asset($teamMember->photo) }}" class="mt-2 rounded border" style="height: 100px;">
    @endif
</div>

<button class="btn btn-success">Lưu</button>
