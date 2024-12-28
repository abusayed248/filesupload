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

                        <!-- QR Code -->
                        <div class="mb-4">
                            <h5 class="text-center">Scan the QR Code</h5>
                            <div>{!! $qrCode !!}</div>
                        </div>

                        <!-- Copy Link Section -->
                        <div class="mb-4">
                            <input type="text" value="{{ $link }}" readonly class="form-control mt-2" id="downloadUrl">
                            <button class="btn btn-secondary mt-2 copyLinkBtn" data-clipboard-target="#downloadUrl">Copy Link</button>
                        </div>

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
