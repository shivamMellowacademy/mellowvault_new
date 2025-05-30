<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    @php
        $fileUrl = !empty($fileName) ? asset('public/' . trim($filePath, '/') . '/' . $fileName) : null;
        $ext = $fileName ? strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) : null;
    @endphp

    @if($fileUrl && $ext)
        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
            <a href="{{ $fileUrl }}" target="_blank">
                <img src="{{ $fileUrl }}" class="img-thumbnail mt-1 preview-img" style="height: 80px; width: 80px;">
            </a>
        @elseif($ext === 'pdf')
            <a href="{{ $fileUrl }}" target="_blank">
                <img src="{{ asset('public/upload/pdf_10435045.png') }}" class="img-thumbnail mt-1" style="height: 80px; width: 80px;" alt="PDF Icon">
            </a>
        @else
            <a href="{{ $fileUrl }}" target="_blank">View File</a>
        @endif
    @else
        <span class="text-muted">No file uploaded.</span>
    @endif
</div>
