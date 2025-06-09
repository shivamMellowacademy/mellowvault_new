@extends('admin.layout')
@section('content')
<div class="container" style="margin-top:100px">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-paper-plane me-2"></i> Send Email
                    </h2>
                </div>
            </div>
        </div>

        @if(Session::has('errmsg'))                 
	                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
	                    	       <strong>{{Session::get('errmsg')}}</strong>
	                        </div>
	                        {{Session::forget('message')}}
	                        {{Session::forget('errmsg')}}
	                    @endif
        
        <!-- Card Body -->
        <div class="card-body p-4">
            <form id="emailForm" method="POST" action="{{ url('admin-send-mail-save') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Recipient Selection -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-users me-1 text-primary"></i> Recipients
                    </label>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control rounded-0" name="recipient_type" id="recipientType" required>
                                    <option value="single">Single Recipient</option>
                                    <option value="developer">Developer</option>
                                    <option value="employer">Employer</option>
                                    <option value="all">All Users</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating" id="singleEmailContainer">
                                <input type="email" class="form-control" name="email" id="singleEmail" placeholder="name@example.com">
                                <label for="singleEmail">Email Address</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Email Composition -->
                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="subject" id="emailSubject" placeholder="Subject" required>
                                <label for="emailSubject">Subject</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="sender_name" id="senderName" placeholder="Sender Name"  required>
                                <label for="senderName">Sender Name</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Email Body -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-align-left me-1 text-primary"></i> Message
                    </label>
                    <div class="border rounded-3 p-2 bg-light">
                        <textarea id="emailEditor" name="message" style="display:none;"></textarea>
                        <div id="editor" style="min-height: 300px;"></div>
                    </div>
                </div>
                
                <!-- Attachments -->
                <!-- <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-paperclip me-1 text-primary"></i> Attachments
                    </label>
                    <div class="file-upload-area border rounded-3 p-3 bg-light text-center">
                        <input type="file" name="attachments[]" id="emailAttachments" class="d-none" multiple>
                        <div class="file-upload-icon mb-2">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                        </div>
                        <p class="mb-2">Drag & drop files here or click to browse</p>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill" onclick="document.getElementById('emailAttachments').click()">
                            <i class="fas fa-folder-open me-1"></i> Select Files
                        </button>
                        <div id="filePreview" class="mt-3 d-none">
                            <h6 class="mb-2">Selected Files:</h6>
                            <ul class="list-group list-group-flush" id="fileList"></ul>
                        </div>
                    </div>
                </div> -->
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                        <i class="fas fa-paper-plane me-1"></i> Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .file-upload-area {
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
    }
    
    .file-upload-area:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .file-upload-area.dragover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    #editor {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        background: white;
    }
    
    .ql-toolbar {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    
    .ql-container {
        border-radius: 0 0 0.375rem 0.375rem !important;
    }
    
    .list-group-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .file-icon {
        width: 24px;
        text-align: center;
        margin-right: 10px;
    }
</style>

<!-- Include Quill library -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    // Initialize rich text editor
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        },
        placeholder: 'Compose your email here...'
    });

    // Handle recipient type change
    document.getElementById('recipientType').addEventListener('change', function() {
        const type = this.value;
        const emailContainer = document.getElementById('singleEmailContainer');
        
        if (type === 'single') {
            emailContainer.classList.remove('d-none');
            document.getElementById('singleEmail').required = true;
        } else {
            emailContainer.classList.add('d-none');
            document.getElementById('singleEmail').required = false;
        }
    });

    // Handle file uploads
    const fileInput = document.getElementById('emailAttachments');
    const filePreview = document.getElementById('filePreview');
    const fileList = document.getElementById('fileList');
    const uploadArea = document.querySelector('.file-upload-area');

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        updateFileList();
    });

    fileInput.addEventListener('change', updateFileList);

    function updateFileList() {
        fileList.innerHTML = '';
        if (fileInput.files.length > 0) {
            filePreview.classList.remove('d-none');
            Array.from(fileInput.files).forEach(file => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                
                const fileInfo = document.createElement('div');
                fileInfo.className = 'd-flex align-items-center';
                
                const icon = document.createElement('span');
                icon.className = 'file-icon';
                icon.innerHTML = getFileIcon(file.type);
                
                const fileName = document.createElement('span');
                fileName.textContent = file.name;
                
                const fileSize = document.createElement('small');
                fileSize.className = 'text-muted ms-2';
                fileSize.textContent = formatFileSize(file.size);
                
                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-sm btn-outline-danger';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                removeBtn.onclick = () => removeFile(file.name);
                
                fileInfo.appendChild(icon);
                fileInfo.appendChild(fileName);
                fileInfo.appendChild(fileSize);
                listItem.appendChild(fileInfo);
                listItem.appendChild(removeBtn);
                fileList.appendChild(listItem);
            });
        } else {
            filePreview.classList.add('d-none');
        }
    }

    function getFileIcon(fileType) {
        if (fileType.includes('image')) return '<i class="fas fa-file-image text-primary"></i>';
        if (fileType.includes('pdf')) return '<i class="fas fa-file-pdf text-danger"></i>';
        if (fileType.includes('word')) return '<i class="fas fa-file-word text-primary"></i>';
        if (fileType.includes('excel')) return '<i class="fas fa-file-excel text-success"></i>';
        if (fileType.includes('zip')) return '<i class="fas fa-file-archive text-warning"></i>';
        return '<i class="fas fa-file text-secondary"></i>';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function removeFile(fileName) {
        const dt = new DataTransfer();
        Array.from(fileInput.files).filter(file => file.name !== fileName)
            .forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
        updateFileList();
    }

    // Before form submission, update the hidden textarea with the editor content
    document.getElementById('emailForm').addEventListener('submit', function(e) {
        document.getElementById('emailEditor').value = quill.root.innerHTML;
    });

    // Initialize with single recipient visible
    document.getElementById('recipientType').dispatchEvent(new Event('change'));
</script>
@endsection