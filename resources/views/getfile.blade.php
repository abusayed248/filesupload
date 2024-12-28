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
                            <!-- Download Button -->
                            <button
                                class="btn btn-primary downloadBtn"
                                data-password="{{ $fileUpload->password }}"
                                data-filepath="{{ $fileUrl->filepath }}">
                                Download File
                            </button>
                            <br><br>

                            <!-- Copy Link Button -->
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

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="password" id="passwordInput" class="form-control" placeholder="Enter file password">
                <input type="hidden" id="downloadFilePath">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="validatePasswordBtn" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Clipboard.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clipboard.js for copying links
        const clipboard = new ClipboardJS('.copyLinkBtn');

        clipboard.on('success', function(e) {
            alert('Download link copied to clipboard!');
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert('Failed to copy the link. Please try again!');
        });

        // Handle Download Button Click
        document.querySelectorAll('.downloadBtn').forEach(button => {
            button.addEventListener('click', function() {
                const password = this.dataset.password;
                const filePath = this.dataset.filepath;

                if (password) {
                    // Open modal if a password is required
                    document.getElementById('passwordInput').value = '';
                    document.getElementById('downloadFilePath').value = filePath;

                    const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
                    passwordModal.show();
                } else {
                    // Directly download the file if no password is required
                    window.open(filePath, '_blank');
                }
            });
        });

        // Validate Password
        document.getElementById('validatePasswordBtn').addEventListener('click', function() {
            const enteredPassword = document.getElementById('passwordInput').value;
            const filePath = document.getElementById('downloadFilePath').value;

            // You can add backend validation for passwords here if needed

            // Simulated password match check
            const correctPassword = document.querySelector(`.downloadBtn[data-filepath="${filePath}"]`).dataset.password;
            console.log(correctPassword, 'correctPassword');
            if (enteredPassword === correctPassword) {
                const passwordModal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
                passwordModal.hide();
                window.open(filePath, '_blank');
            } else {
                alert('Incorrect password. Please try again.');
            }
        });
    });
</script>
@endsection