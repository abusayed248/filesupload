@extends('layouts.app')

@section('title', 'Download Links')

@section('content')
<section class="herosection">
    <div class="overly">
        <div class="container">

            <div class="">
                <h1 class="text-center titel fw-bold">Download the file</h1>
                <p class="text-center titel">Click any of the links below to download your file.</p>

                @php
                // Calculate expiration status
                $isExpired = false;
                if (!is_null($fileUpload->expires_at)) {
                $expirationTime = $fileUpload->expires_at; // Value in days (e.g., 1, 3, etc.)
                $createdAt = \Carbon\Carbon::parse($fileUpload->created_at);
                $expiryDate = $createdAt->addDays($expirationTime);
                $isExpired = now()->greaterThan($expiryDate);
                }
                @endphp

                @if($isExpired)
                <!-- Download Links Section -->
                <div class="d-flex justify-content-center mt-4">
                    <div class="col-md-6 pt-4 pb-4 text-center">
                        <span class="text-danger">Link has expired.</span>
                    </div>
                </div>
                <!-- Expired Message -->

                @else

                <!-- Download Links Section -->
                <div class="d-flex justify-content-center mt-4">

                    <div class="col-md-6 pt-4 pb-4 text-center">
                        <button id="downloadAllBtn" class="btn btn-success mt-4">Download All as ZIP</button>

                        <?php
                        $paths = collect($trackFile)->map(function ($item) {
                            return $item['filepath'];
                        });
                        ?>


                        <!-- The actual link for the download -->
                        <!-- <a id="downloadZipLink" href="{{ route('download.zip', ['files' => $paths->toArray()]) }}" style="display: none;">Download ZIP</a> -->


                        <a id="downloadZipLink"
                            href="{{ route('download.zip', ['files' => json_encode($paths->toArray())]) }}"
                            style="display: none;">
                            Download ZIP
                        </a>


                        @foreach($trackFile as $fileUrl)
                        <div class="mb-4">
                            <!-- Download Button -->
                            <button
                                class="btn btn-primary downloadBtn"
                                data-password="{{ $fileUpload->password }}"
                                data-filepath="{{ $fileUrl->filepath }}">
                                Download File
                            </button>

                            <!-- The actual link for the download -->
                            <a id="downloadLinkSingleFile" href="{{ route('force.download', ['filepath' => $fileUrl->filepath]) }}" style="display: none;">Download File</a>

                            <br><br>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
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
                <input type="password" id="passwordInput" class="form-control" style="border: 1px solid !important;" placeholder="Enter file password">
                <input type="hidden" id="downloadFilePath">
                <input type="hidden" id="isZipDownload">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="validatePasswordBtn" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Password Modal -->
<div class="modal fade" id="passwordModalZip" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="password" id="passwordInputZip" class="form-control" style="border: 1px solid !important;" placeholder="Enter file password">
                <input type="hidden" id="downloadFilePath">
                <input type="hidden" id="isZipDownload">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="validatePasswordBtnZip" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- Include Clipboard.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    document.getElementById('downloadAllBtn').addEventListener('click', function() {

        const password = @json($fileUpload->password);
        // If there are files that require a password, show the modal to ask for it
        if (password) {
            const passwordModal = new bootstrap.Modal(document.getElementById('passwordModalZip'));
            passwordModal.show();

        } else {
            const downloadLinkZip = document.getElementById('downloadZipLink');
            downloadLinkZip.click();
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Clipboard.js for copying links

        // Handle Download Button Click
        document.querySelectorAll('.downloadBtn').forEach(button => {
            button.addEventListener('click', function() {
                const password = this.dataset.password;
                const filePath = this.dataset.filepath;

                if (password) {
                    // Open modal if a password is required
                    document.getElementById('passwordInput').value = '';
                    document.getElementById('downloadFilePath').value = filePath;
                    document.getElementById('isZipDownload').value = '0'; // Indicate individual file download

                    const passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
                    passwordModal.show();
                } else {

                    const downloadLinkSingleFileDownload = document.getElementById('downloadLinkSingleFile');
                    downloadLinkSingleFileDownload.click();
                }
            });
        });


        // Validate Password
        document.getElementById('validatePasswordBtnZip').addEventListener('click', function() {
            const enteredPassword = document.getElementById('passwordInputZip').value;
            const filePath = document.getElementById('downloadFilePath').value;
            const isZipDownload = document.getElementById('isZipDownload').value;
            console.log(enteredPassword, 'enteredPassword');
            const correctPassword = @json($fileUpload->password);
            if (enteredPassword === correctPassword) {
                const passwordModal = bootstrap.Modal.getInstance(document.getElementById('passwordModalZip'));
                passwordModal.hide();
                const downloadLinkZip = document.getElementById('downloadZipLink');
                downloadLinkZip.click();
            } else {
                alert('Incorrect password. Please try again.');
            }

        });


        // Validate Password
        document.getElementById('validatePasswordBtn').addEventListener('click', function() {
            const enteredPassword = document.getElementById('passwordInput').value;
            const filePath = document.getElementById('downloadFilePath').value;
            const isZipDownload = document.getElementById('isZipDownload').value;
            console.log(enteredPassword, 'enteredPassword');
            // Simulated password match check
            const correctPassword = document.querySelector(`.downloadBtn[data-filepath="${filePath}"]`).dataset.password;

            if (enteredPassword === correctPassword) {
                const passwordModal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
                passwordModal.hide();
                const downloadLinkSingleFileDownload = document.getElementById('downloadLinkSingleFile');
                downloadLinkSingleFileDownload.click();
            } else {
                alert('Incorrect password. Please try again.');
            }

        });
    });
</script>
@endsection