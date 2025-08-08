@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Bài viết</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa nội dung & hình ảnh</li>
            </ol>
        </nav>

        <h4 class="mb-4">
            Cập nhật nội dung và hình ảnh cho blog:
            <span class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#blogInfoModal">
            {{ $blog->title }}
        </span>
        </h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- Editor -->
            <div class="col-md-8">
                <form method="POST" action="{{ route('admin.blogs.updateDescription', $blog->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nội dung bài viết</label>
                        <textarea id="blog-content-editor" name="content" class="form-control" rows="12">{!! old('content', $blog->content ?? '') !!}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Lưu nội dung</button>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-secondary">Quay lại chỉnh sửa</a>
                    </div>
                </form>
            </div>

            <!-- Uploads -->
            <div class="col-md-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="mb-3">
                        <label class="form-label">Chọn hình ảnh</label>
                        <input type="file" id="fileInput" class="form-control" multiple accept="image/*">
                    </div>
                    <button id="uploadBtn" class="btn btn-primary w-100 mb-2">Tải ảnh lên</button>
                    <button id="insertAllBtn" class="btn btn-outline-secondary w-100 mb-3">
                        <i class="bi bi-images me-1"></i> Chèn tất cả ảnh vào nội dung
                    </button>

                    <div id="uploaded-images-scroll" class="bg-white rounded shadow-sm"
                         style="max-height: 500px; overflow-y: auto; border: 1px solid #dee2e6; padding: 0.5rem;">
                        <div id="uploaded-images-preview" class="row g-2">
                            @foreach($blog->attachments as $attachment)
                                <div class="col-6" id="attachment-{{ $attachment->id }}">
                                    <div class="card">
                                        <div class="card-body p-2 text-center position-relative">
                                            <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-btn" data-id="{{ $attachment->id }}">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                            <img src="{{ asset($attachment->file_path) }}"
                                                 class="img-fluid rounded shadow-sm mb-2 previewable-img"
                                                 style="max-height: 140px; object-fit: cover; width: 100%; cursor: pointer;">
                                            <button class="btn btn-outline-primary btn-sm insert-btn" data-url="{{ asset($attachment->file_path) }}">
                                                <i class="bi bi-box-arrow-in-down-left me-1"></i> Chèn vào nội dung
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

        <!-- Info Modal -->
        <div class="modal fade" id="blogInfoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin bài viết</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tiêu đề:</strong> {{ $blog->title }}</p>
                        <p><strong>Hashtags:</strong> {{ $blog->hashtags }}</p>
                        <p><strong>Ngày tạo:</strong> {{ $blog->created_at->format('d/m/Y H:i') }}</p>
                        @if($blog->thumbnail)
                            <img src="{{ asset($blog->thumbnail) }}" class="img-fluid rounded shadow-sm">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body position-relative p-0">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"></button>
                        <img id="modalImage" src="" class="img-fluid w-100 rounded-bottom" alt="Preview">
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast -->
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
            <div id="uploadToast" class="toast align-items-center text-bg-success border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body" id="toastMessage"></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ✅ Load CKEditor only once to avoid duplicated module error -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let editor;
            ClassicEditor.create(document.querySelector("#blog-content-editor"))
                .then(e => editor = e)
                .catch(err => console.error("CKEditor error:", err));

            const previewArea = document.getElementById('uploaded-images-preview');
            const fileInput = document.getElementById('fileInput');
            const uploadBtn = document.getElementById('uploadBtn');
            const insertAllBtn = document.getElementById('insertAllBtn');

            function bindInsertButtons() {
                document.querySelectorAll('.insert-btn').forEach(button => {
                    button.onclick = () => {
                        const url = button.dataset.url;
                        if (editor) {
                            editor.model.change(writer => {
                                const insertPosition = editor.model.document.selection.getFirstPosition();
                                const imageElement = writer.createElement("imageBlock", { src: url });
                                editor.model.insertContent(imageElement, insertPosition);
                            });
                        }
                    };
                });
            }

            insertAllBtn.addEventListener('click', () => {
                if (!editor) return;
                const urls = Array.from(document.querySelectorAll('.insert-btn')).map(btn => btn.dataset.url);
                if (urls.length === 0) return alert("Không có ảnh nào để chèn.");
                editor.model.change(writer => {
                    let insertPosition = editor.model.document.selection.getFirstPosition();

                    urls.forEach(url => {
                        const imageElement = writer.createElement("imageBlock", { src: url });
                        editor.model.insertContent(imageElement, insertPosition);

                        // ✅ Move cursor after the inserted image
                        insertPosition = editor.model.createPositionAfter(imageElement);
                    });
                });
            });

            function bindDeleteButtons() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.onclick = () => {
                        const id = button.dataset.id;
                        if (!confirm("Bạn có chắc chắn muốn xoá ảnh này?")) return;
                        fetch(`{{ url('admin/blog-attachments') }}/${id}`, {
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

                let uploadedCount = 0;
                Array.from(files).forEach(file => {
                    const formData = new FormData();
                    formData.append("image", file);
                    formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    formData.append("blog_id", '{{ $blog->id }}');

                    fetch("{{ route('admin.blog.attachments.upload') }}", {
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
                                            <i class="bi bi-box-arrow-in-down-left me-1"></i> Chèn vào nội dung
                                        </button>
                                    </div>
                                </div>
                            `;
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
                }, 500);
            });

            previewArea.addEventListener('click', (e) => {
                if (e.target.classList.contains('previewable-img')) {
                    const modalImage = document.getElementById('modalImage');
                    modalImage.src = e.target.src;
                    new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
                }
            });

            bindInsertButtons();
            bindDeleteButtons();
        });
    </script>
@endsection
