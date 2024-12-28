@extends('layouts.app')

@section('title', 'Download Links')

@section('content')
<section class="herosection">
    <div class="overly">
        <div class="container">
            <div class="">
                <h1 class="text-center titel fw-bold">Files Uploaded Successfully</h1>
                <p class="text-center titel">Click any of the links below to download your file or copy it to share.</p>

                <!-- Download Links Section -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-6 pt-4 pb-4 text-center">
                        @foreach($trackFile as $fileUrl)
                        <div class="mb-4">
                            <!-- The download link for each file -->
                            <a href="{{ $fileUrl->filepath }}" class="btn btn-primary" target="_blank">Download File</a>
                            <br><br>

                            <!-- Copy Link Button for each file -->
                            <input type="text" value="{{ $fileUrl->filepath }}" readonly class="form-control mt-2" id="downloadUrl_{{ $loop->index }}">
                            <button class="btn btn-secondary mt-2 copyLinkBtn" data-clipboard-target="#downloadUrl_{{ $loop->index }}">Copy Link</button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Clipboard.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Clipboard.js to handle copy functionality
        const clipboard = new ClipboardJS('.copyLinkBtn');

        clipboard.on('success', function(e) {
            alert('Download link copied to clipboard!');
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert('Failed to copy the link. Please try again!');
        });
    });
</script>

@endsection