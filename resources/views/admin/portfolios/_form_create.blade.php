@csrf

<!-- Title -->
<div class="mb-3">
    <label class="form-label">Tiêu đề *</label>
    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
</div>

<!-- Location -->
<div class="mb-3">
    <label class="form-label">Vị trí</label>
    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
</div>

<!-- Category -->
<div class="mb-3">
    <label class="form-label">Danh mục sản phẩm</label>
    <select name="portfolio_category_id" class="form-select" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('portfolio_category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Short Description -->
<div class="mb-3">
    <label class="form-label">Mô tả ngắn</label>
    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
</div>

<!-- Description -->
<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea id="editor" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
</div>

<!-- Main Image -->
<div class="mb-3 row">
    <label class="form-label col-12">Hình ảnh</label>
    <div class="col-6">
        <input type="file" name="image" class="form-control mt-2" accept="image/*">
    </div>
    <div class="col-6">
        <img id="thumbnail-preview" class="img-fluid rounded mb-2" style="max-height: 150px; display: none;">
    </div>
</div>

<!-- Album Images -->
<div class="mb-3">
    <label class="form-label">Album hình ảnh</label>
    <p class="text-muted">Chọn, sắp xếp và thêm ghi chú cho từng ảnh.</p>

    <div class="mb-2">
        <input type="file" id="album-file-input" class="form-control" accept="image/*" multiple>
    </div>

    <div id="album-rows" class="sortable"></div>
</div>

<!-- Featured -->
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
    <label class="form-check-label" for="is_featured">Hiển thị ở mục "Sản phẩm nổi bật"</label>
</div>

<!-- Hidden inputs -->
<input type="hidden" name="album_order" id="album-order">
<div id="album-hidden-container"></div>

<!-- Submit -->
<button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
<a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Hủy</a>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const albumInput = document.getElementById('album-file-input');
            const albumRows = document.getElementById('album-rows');
            const hiddenContainer = document.getElementById('album-hidden-container');
            let selectedFiles = [];

            albumInput.addEventListener('change', (e) => {
                const files = Array.from(e.target.files);
                selectedFiles = selectedFiles.concat(files);
                renderPreviews();
            });

            function renderPreviews() {
                albumRows.innerHTML = '';

                const promises = selectedFiles.map((file, index) => {
                    return new Promise(resolve => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            resolve({ file, index, dataUrl: e.target.result });
                        };
                        reader.readAsDataURL(file);
                    });
                });

                Promise.all(promises).then(results => {
                    results.forEach((item, index) => {
                        const card = document.createElement('div');
                        card.classList.add('card', 'mb-2', 'preview-card');
                        card.dataset.index = index;

                        const body = document.createElement('div');
                        body.classList.add('card-body');

                        const closeBtn = document.createElement('button');
                        closeBtn.classList.add('btn-close', 'float-end');
                        closeBtn.addEventListener('click', () => {
                            selectedFiles.splice(index, 1);
                            renderPreviews();
                        });

                        const img = document.createElement('img');
                        img.classList.add('img-fluid', 'rounded', 'mb-2');
                        img.src = item.dataUrl;

                        const textarea = document.createElement('textarea');
                        textarea.classList.add('form-control');
                        textarea.placeholder = 'Ghi chú ảnh';
                        textarea.name = `album_notes[${index}]`;

                        body.appendChild(closeBtn);
                        body.appendChild(img);
                        body.appendChild(textarea);
                        card.appendChild(body);
                        albumRows.appendChild(card);
                    });

                    updateHiddenInputs();
                });
            }

            new Sortable(albumRows, {
                animation: 150,
                onEnd: updateHiddenInputs
            });

            function updateHiddenInputs() {
                hiddenContainer.innerHTML = '';
                const orderedCards = albumRows.querySelectorAll('.preview-card');
                const albumOrder = [];

                const reorderedFiles = [];
                const reorderedNotes = [];

                orderedCards.forEach((card, index) => {
                    const originalIndex = parseInt(card.dataset.index);
                    const noteTextarea = card.querySelector('textarea');
                    const note = noteTextarea.value;

                    reorderedFiles.push(selectedFiles[originalIndex]);
                    reorderedNotes.push(note);

                    const noteInput = document.createElement('input');
                    noteInput.type = 'hidden';
                    noteInput.name = `album_notes[${index}]`;
                    noteInput.value = note;
                    hiddenContainer.appendChild(noteInput);

                    albumOrder.push({ order: index + 1 });
                });

                // Replace original <input type="file"> with reordered ones
                const dt = new DataTransfer();
                reorderedFiles.forEach(file => dt.items.add(file));

                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'album_images[]';
                fileInput.multiple = true;
                fileInput.files = dt.files;
                fileInput.style.display = 'none';
                hiddenContainer.appendChild(fileInput);

                selectedFiles = reorderedFiles;
                document.getElementById('album-order').value = JSON.stringify(albumOrder);
            }

            // Preview main image
            const imageInput = document.querySelector('input[name="image"]');
            const thumbnail = document.getElementById('thumbnail-preview');
            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        thumbnail.src = e.target.result;
                        thumbnail.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
