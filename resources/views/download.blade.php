@extends('layouts.app')

@section('title', 'Download Page')

@section('content')
<section class="download-section">
    <div class="container text-center">
        <h1 class="fw-bold">Your File is Ready to Download</h1>
        <p>Click the link below to download your file:</p>

        <!-- Download Link -->
        <a href="{{ $downloadLink }}" class="btn btn-primary" id="downloadLink">Download File</a>
        <br><br>

        <!-- Copy Link Button -->
        <button class="btn btn-secondary" id="copyLinkBtn">Copy Link</button>

        <input type="text" id="downloadUrl" value="{{ $downloadLink }}" readonly class="mt-3">
    </div>
</section>

<script>
    // Copy link functionality
    document.getElementById('copyLinkBtn').addEventListener('click', function() {
        const linkInput = document.getElementById('downloadUrl');
        linkInput.select();
        document.execCommand('copy');
        alert('Download link copied to clipboard!');
    });
</script>
@endsection
