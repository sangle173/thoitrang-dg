@csrf
@method('PUT')

<!-- Title -->
<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
</div>

<!-- Location -->
<div class="mb-3">
    <label class="form-label">Vị trí</label>
    <input type="text" name="location" class="form-control" value="{{ old('location', $portfolio->location) }}">
</div>

<!-- Category -->
<div class="mb-3">
    <label class="form-label">Danh mục dự án</label>
    <select name="portfolio_category_id" class="form-select" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('portfolio_category_id', $portfolio->portfolio_category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Short Description -->
<div class="mb-3">
    <label class="form-label">Mô tả ngắn</label>
    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $portfolio->short_description) }}</textarea>
</div>

<!-- Description -->
<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea id="editor" name="description" class="form-control" rows="5">{{ old('description', $portfolio->description) }}</textarea>
</div>

<!-- Main Image -->
<div class="mb-3 row">
    <label class="form-label col-12">Hình ảnh</label>
    <div class="col-6">
        <input type="file" name="image" class="form-control mt-2" accept="image/*">
    </div>
    <div class="col-6">
        @if($portfolio->image)
            <img src="{{ asset($portfolio->image) }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
        @endif
    </div>
</div>

<!-- Album -->
<div class="mb-3">
    <label class="form-label">Album hình ảnh</label>
    <p class="text-muted">Kéo thả để sắp xếp, thêm ghi chú và xoá ảnh nếu cần.</p>

    <div class="mb-2">
        <input type="file" id="album-file-input" class="form-control" accept="image/*" multiple>
    </div>

    <div id="album-rows" class="sortable">
        @foreach($portfolio->images->sortBy('order') as $image)
            <div class="card mb-2 preview-card" data-id="{{ $image->id }}">
                <div class="card-body">
                    <button type="button" class="btn-close float-end remove-old-image-btn"></button>
                    <img src="{{ asset($image->image) }}" class="img-fluid rounded mb-2">
                    <textarea name="existing_notes[{{ $image->id }}]" class="form-control" placeholder="Ghi chú ảnh">{{ $image->note }}</textarea>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured -->
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Hiển thị ở mục "Dự án nổi bật"</label>
</div>

<!-- Hidden -->
<input type="hidden" name="album_order" id="album-order">
<input type="hidden" name="removed_images" id="removed-images">
<div id="hidden-new-files"></div>

<!-- Submit -->
<button type="submit" class="btn btn-primary">Cập nhật</button>
<a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Hủy</a>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const albumRows = document.getElementById('album-rows');
            const input = document.getElementById('album-file-input');
            const hiddenContainer = document.getElementById('hidden-new-files');
            const removedImageInput = document.getElementById('removed-images');
            let selectedFiles = [];
            let removedImageIds = [];

            input.addEventListener('change', (e) => {
                const newFiles = Array.from(e.target.files);
                selectedFiles = selectedFiles.concat(newFiles);
                renderNewPreviews();
            });

            function renderNewPreviews() {
                albumRows.querySelectorAll('.preview-card.new-upload').forEach(el => el.remove());

                const readers = selectedFiles.map((file, index) => {
                    return new Promise(resolve => {
                        const reader = new FileReader();
                        reader.onload = e => {
                            resolve({ file, dataUrl: e.target.result, index });
                        };
                        reader.readAsDataURL(file);
                    });
                });

                Promise.all(readers).then(results => {
                    results.forEach((result, i) => {
                        const card = document.createElement('div');
                        card.classList.add('card', 'mb-2', 'preview-card', 'new-upload');
                        card.dataset.index = i;

                        const body = document.createElement('div');
                        body.classList.add('card-body');

                        const closeBtn = document.createElement('button');
                        closeBtn.classList.add('btn-close', 'float-end');
                        closeBtn.addEventListener('click', () => {
                            selectedFiles.splice(i, 1);
                            renderNewPreviews();
                        });

                        const img = document.createElement('img');
                        img.classList.add('img-fluid', 'rounded', 'mb-2');
                        img.src = result.dataUrl;

                        const textarea = document.createElement('textarea');
                        textarea.classList.add('form-control');
                        textarea.name = `album_notes[${i}]`;
                        textarea.placeholder = 'Ghi chú ảnh';

                        body.appendChild(closeBtn);
                        body.appendChild(img);
                        body.appendChild(textarea);
                        card.appendChild(body);
                        albumRows.appendChild(card);
                    });

                    updateFileInput();
                });
            }

            function updateFileInput() {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => dt.items.add(file));

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'file';
                hiddenInput.name = 'album_images[]';
                hiddenInput.files = dt.files;
                hiddenInput.multiple = true;
                hiddenInput.style.display = 'none';

                hiddenContainer.innerHTML = '';
                hiddenContainer.appendChild(hiddenInput);
            }

            document.querySelectorAll('.remove-old-image-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const card = btn.closest('.card');
                    const id = card.dataset.id;
                    if (id) {
                        removedImageIds.push(id);
                        removedImageInput.value = JSON.stringify(removedImageIds);
                    }
                    card.remove();
                });
            });

            new Sortable(albumRows, {
                animation: 150,
                onEnd: updateOrder
            });

            document.getElementById('portfolio-form').addEventListener('submit', updateOrder);

            function updateOrder() {
                const cards = albumRows.querySelectorAll('.preview-card');
                const order = [];

                const reorderedNotes = [];
                const reorderedFiles = [];

                cards.forEach((card, index) => {
                    const isNew = card.classList.contains('new-upload');
                    const textarea = card.querySelector('textarea');
                    if (isNew) {
                        const fileIndex = parseInt(card.dataset.index);
                        reorderedFiles.push(selectedFiles[fileIndex]);
                        reorderedNotes.push(textarea.value);

                        textarea.name = `album_notes[${index}]`;
                    } else {
                        const id = card.dataset.id;
                        if (id) {
                            order.push({ id, order: index + 1 });
                        }
                    }
                });

                // Replace file + notes in correct order
                selectedFiles = reorderedFiles;
                const noteInputs = hiddenContainer.querySelectorAll('input[name^="album_notes"]');
                noteInputs.forEach(input => input.remove());

                reorderedNotes.forEach((note, index) => {
                    const hiddenNote = document.createElement('input');
                    hiddenNote.type = 'hidden';
                    hiddenNote.name = `album_notes[${index}]`;
                    hiddenNote.value = note;
                    hiddenContainer.appendChild(hiddenNote);
                });

                updateFileInput();
                document.getElementById('album-order').value = JSON.stringify(order);
            }
        });
    </script>
@endpush
