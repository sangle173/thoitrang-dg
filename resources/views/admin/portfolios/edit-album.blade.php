@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.portfolios.index') }}">sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ isset($portfolio->id) ? 'Cập nhật ảnh / mô tả' : 'Thêm ảnh / mô tả' }}
                </li>
            </ol>
        </nav>

        <!-- Header Title -->
        <h4 class="mb-4">
            {{ isset($portfolio->id) ? 'Cập nhật mô tả và hình ảnh album cho sản phẩm:' : 'Thêm hình ảnh album cho sản phẩm:' }}
            <button type="button"
                    class="btn btn-link text-decoration-none text-primary fw-bold p-0"
                    style="font-size: inherit; line-height: inherit;"
                    data-bs-toggle="modal"
                    data-bs-target="#portfolioInfoModal">
                {{ $portfolio->title }}
            </button>
        </h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- Left CKEditor Form -->
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.portfolios.updateDescription', $portfolio->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Ghi chú mô tả thêm (tuỳ chọn)</label>
                        <textarea id="album-description-editor" name="description" class="form-control" rows="10">
                            {!! old('description', $portfolio->description ?? '') !!}
                        </textarea>
                    </div>

                    <div class="d-flex justify-content-start align-items-center mt-4 gap-2">
                        <button type="submit" class="btn btn-success">Lưu mô tả</button>
                        <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-secondary">
                            Quay lại chỉnh sửa sản phẩm
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right Sticky Upload + Preview -->
            <div class="col-md-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="mb-3">
                        <label class="form-label">Chọn hình ảnh(có thể chọn nhiều)</label>
                        <input type="file" id="fileInput" class="form-control" multiple accept="image/*">
                    </div>
                    <button id="uploadBtn" class="btn btn-primary w-100 mb-3">Tải ảnh lên</button>
                    <button id="insertAllBtn" class="btn btn-outline-secondary w-100 mb-3">
                        <i class="bi bi-images me-1"></i> Chèn tất cả ảnh vào mô tả
                    </button>

                    <div id="uploaded-images-scroll" class="bg-white rounded shadow-sm"
                         style="max-height: 500px; overflow-y: auto; border: 1px solid #dee2e6; padding: 0.5rem;">
                        <div id="uploaded-images-preview" class="row g-2">
                            @foreach($portfolio->attachments as $attachment)
                                <div class="col-6" id="attachment-{{ $attachment->id }}">
                                    <div class="card">
                                        <div class="card-body position-relative p-2 text-center">
                                            <button
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-btn"
                                                data-id="{{ $attachment->id }}">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                            <img src="{{ asset($attachment->file_path) }}"
                                                 class="img-fluid rounded shadow-sm mb-2 previewable-img"
                                                 style="max-height: 140px; object-fit: cover; width: 100%; cursor: pointer;">
                                            <button class="btn btn-outline-primary btn-sm insert-btn"
                                                    data-url="{{ asset($attachment->file_path) }}">
                                                <i class="bi bi-box-arrow-in-down-left me-1"></i> Chèn vào mô tả
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                <div class="modal-body text-center p-0">
                    <img id="modalImage" src="" class="img-fluid" style="max-height: 90vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="uploadToast" class="toast align-items-center text-bg-success border-0" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    <!-- Portfolio Info Modal -->
    <div class="modal fade" id="portfolioInfoModal" tabindex="-1" aria-labelledby="portfolioInfoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông tin sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tiêu đề:</strong> {{ $portfolio->title }}</p>
                    <p><strong>Danh mục:</strong> {{ $portfolio->category->name ?? '—' }}</p>
                    <p><strong>Vị trí:</strong> {{ $portfolio->location ?? '—' }}</p>
                    <p><strong>Hiển thị nổi bật:</strong> {{ $portfolio->is_featured ? 'Có' : 'Không' }}</p>
                    @if($portfolio->image)
                        <div class="mb-2">
                            <strong>Ảnh đại diện:</strong><br>
                            <img src="{{ asset($portfolio->image) }}" class="img-fluid rounded mt-2"
                                 style="max-height: 200px;">
                        </div>
                    @endif
                    @if($portfolio->short_description)
                        <p><strong>Mô tả ngắn:</strong><br>{{ $portfolio->short_description }}</p>
                    @endif
                    @if($portfolio->creator)
                        <p><strong>Người tạo:</strong> {{ $portfolio->creator->name ?? 'Không xác định' }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let editor;

            ClassicEditor.create(document.querySelector("#album-description-editor"))
                .then(e => editor = e)
                .catch(err => console.error("CKEditor error:", err));

            const previewArea = document.getElementById('uploaded-images-preview');
            const fileInput = document.getElementById('fileInput');
            const uploadBtn = document.getElementById('uploadBtn');

            function bindInsertButtons() {
                document.querySelectorAll('.insert-btn').forEach(button => {
                    button.onclick = () => {
                        const url = button.dataset.url;
                        if (editor) {
                            editor.model.change(writer => {
                                const imageElement = writer.createElement("imageBlock", {src: url});
                                editor.model.insertContent(imageElement, editor.model.document.selection);
                            });
                        }
                    };
                });
            }

            function bindDeleteButtons() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.onclick = () => {
                        const id = button.dataset.id;
                        if (!confirm("Bạn có chắc chắn muốn xoá ảnh này?")) return;

                        fetch(`{{ url('admin/attachments') }}/${id}`, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(res => res.json()).then(data => {
                            if (data.success) {
                                document.getElementById(`attachment-${id}`)?.remove();
                            }
                        });
                    };
                });
            }

            uploadBtn.addEventListener('click', () => {
                const files = fileInput.files;
                if (!files.length) return alert("Chọn ít nhất một hình ảnh");

                const existingNames = Array.from(document.querySelectorAll('#uploaded-images-preview img'))
                    .map(img => img.src.split('/').pop());

                let uploadedCount = 0;

                Array.from(files).forEach(file => {
                    const fileName = file.name;

                    if (existingNames.includes(fileName)) {
                        const confirmUpload = confirm(`Ảnh "${fileName}" đã tồn tại. Bạn có muốn tải lại không?`);
                        if (!confirmUpload) return;
                    }

                    const formData = new FormData();
                    formData.append("image", file);
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    formData.append("portfolio_id", '{{ $portfolio->id }}');

                    fetch("{{ route('admin.attachments.upload') }}", {
                        method: "POST",
                        body: formData
                    }).then(res => res.json()).then(data => {
                        if (data.url) {
                            const col = document.createElement("div");
                            col.className = "col-6";
                            col.id = `attachment-${data.id}`;
                            col.innerHTML = `
                            <div class="card">
                                <div class="card-body position-relative p-2 text-center">
                                    <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-btn" data-id="${data.id}">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                    <img src="${data.url}" class="img-fluid rounded shadow-sm mb-2 previewable-img" style="max-height: 140px; object-fit: cover; width: 100%; cursor: pointer;">
                                    <button class="btn btn-outline-primary btn-sm insert-btn" data-url="${data.url}">
                                        <i class="bi bi-box-arrow-in-down-left me-1"></i> Chèn vào mô tả
                                    </button>
                                </div>
                            </div>`;
                            previewArea.appendChild(col);
                            uploadedCount++;
                            bindInsertButtons();
                            bindDeleteButtons();
                        }
                    });
                });

                fileInput.value = '';
                setTimeout(() => {
                    if (uploadedCount > 0) {
                        document.getElementById("toastMessage").innerText = `${uploadedCount} ảnh đã được tải lên.`;
                        new bootstrap.Toast(document.getElementById("uploadToast")).show();
                    }
                }, 600);
            });

            previewArea.addEventListener('click', (e) => {
                if (e.target.tagName === 'IMG') {
                    const modalImage = document.getElementById('modalImage');
                    modalImage.src = e.target.src;
                    new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
                }
            });

            const insertAllBtn = document.getElementById('insertAllBtn');

            insertAllBtn.addEventListener('click', () => {
                const allImages = document.querySelectorAll('.previewable-img');
                if (!allImages.length || !editor) return;

                editor.model.change(writer => {
                    const selection = editor.model.document.selection;
                    let insertPosition = selection.getFirstPosition();

                    allImages.forEach(img => {
                        const url = img.getAttribute('src');

                        // Create and insert image
                        const imageElement = writer.createElement('imageBlock', { src: url });
                        editor.model.insertContent(imageElement, insertPosition);

                        // Move cursor after the inserted image and add a paragraph (line break)
                        insertPosition = editor.model.createPositionAfter(imageElement);
                        const paragraph = writer.createElement('paragraph');
                        editor.model.insertContent(paragraph, insertPosition);

                        // Update position again after paragraph
                        insertPosition = editor.model.createPositionAfter(paragraph);
                    });
                });
            });
            bindInsertButtons();
            bindDeleteButtons();
        });
    </script>
@endsection
