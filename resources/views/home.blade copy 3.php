@extends('layouts.app')

@section('title', '')

@section('content')
<section class="herosection">
    <div class="overly">
        <div class="container">
            <div class="">
                <h1 class="text-center titel fw-bold">Upload files, transfer them easily</h1>
                <p class="text-center titel">File upload made easy. Upload files up to 20GB and transfer files easily</p>
                <div class="d-flex justify-content-center mt-4">
                    <div class="file-upload-container col-md-5 pt-4 pb-4">
                        <input type="file" id="file-upload" multiple />
                        <label for="file-upload">
                            <p>Click here or drop files to upload or transfer</p>
                            <small>(Max 50 files, 10 GB per file, total 100 GB)</small>
                            <br />
                            <a href="#" class="premium-link">Upgrade to premium to upload files up to 20GB</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Set Password & Expiry Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadDetailsForm">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password (optional)">
                    </div>

                    <div class="mb-3">
                        <label for="expire_date" class="form-label">Expiry Date</label>
                        <select class="form-select" id="expire_date" name="expire_date">
                            <option value="1">1 Day</option>
                            <option value="3">3 Days</option>
                            <option value="7">7 Days</option>
                            <option value="15">15 Days</option>
                            <option value="30">30 Days</option>
                            <option value="never">Never</option>
                        </select>
                    </div>


                    <input type="hidden" id="selectedFiles" name="selectedFiles">
                </form>
                <div class="progress mt-3" style="height: 20px; display: none;">
                    <div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p id="uploadStatus" class="mt-2" style="display: none;">Uploading: 0%</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUpload">Upload</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedFiles = []; // To store selected file objects
    let uploadInProgress = false;
    let batchId = null;

    // Event listener for file selection
    $('#file-upload').on('change', function(e) {
        if (e.target.files.length > 0) {
            selectedFiles = Array.from(e.target.files); // Store file objects

            // Show the modal after a short delay
            setTimeout(() => {
                $('#uploadModal').modal('show');
            }, 100); // Adjust delay if needed
        }
    });

    // Handle the upload when the 'Upload' button is clicked
    $('#confirmUpload').on('click', function() {
        if (uploadInProgress) return; // Prevent multiple uploads

        const formData = new FormData();
        const password = $('#password').val();
        const expire_date = $('#expire_date').val();

        // Append password and expiry date
        formData.append('password', password);
        formData.append('expire_date', expire_date);

        // Append each selected file
        selectedFiles.forEach((file, index) => {
            formData.append(`files[${index}]`, file);
        });

        // Show progress bar and start upload
        $('.progress').show();
        $('#uploadStatus').show();
        $('#uploadProgress').css('width', '0%').attr('aria-valuenow', 0);
        $('#uploadStatus').text('Uploading: 0%');

        uploadInProgress = true; // Prevent multiple uploads

        // Start the upload process via AJAX
        $.ajax({
            url: '/api/upload-details',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.batch, 'response');
                batchId = response.batch; // Assume response includes batchId
                // Start polling for progress
                pollBatchProgress(batchId);
            },
            error: function(xhr, status, error) {
                alert('An error occurred while uploading files.');
                console.log(xhr, status, error);
                uploadInProgress = false;
            }
        });
    });

    // Poll API to check the progress of the batch upload
    function pollBatchProgress(batchId) {
        const progressInterval = setInterval(function() {
            $.ajax({
                url: `/get-upload-progress/${batchId}`,
                method: 'GET',
                success: function(response) {
                    const progress = response.progress; // Assume the API returns a `progress` value

                    // Update progress bar
                    $('#uploadProgress').css('width', progress + '%').attr('aria-valuenow', progress);
                    $('#uploadStatus').text('Uploading: ' + Math.round(progress) + '%');

                    // If progress reaches 100%, stop polling and redirect
                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        $('#uploadModal').modal('hide');

                        // Reset the form and selected files
                        $('#uploadDetailsForm')[0].reset();
                        selectedFiles = [];

                        // Redirect to the download page or success page
                        const downloadLink = `/get/download/${response.trackFileName}`;
                      //  window.location.href = downloadLink;
                    }
                },
                error: function(xhr, status, error) {
                    clearInterval(progressInterval);
                    alert('Error checking progress.');
                    console.log(xhr, status, error);
                }
            });
        }, 2000); // Poll every 2 seconds, adjust as needed
    }
</script>

@endsection