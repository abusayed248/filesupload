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

        // Send the data to the server via AJAX
        $.ajax({
            url: '/api/upload-details',
            type: 'POST',
            data: formData,
            processData: false, // Important to send FormData correctly
            contentType: false, // Important to send FormData correctly
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response
                alert('Files uploaded successfully!');

                // Close the modal
                $('#uploadModal').modal('hide');

                // Reset the form and selected files
                $('#uploadDetailsForm')[0].reset();
                selectedFiles = [];
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('An error occurred while uploading files.');
                console.log(xhr, status, error);
            }
        });
    });
</script>

@endsection

<!-- <script>
    document.getElementById('file-upload').addEventListener('change', function(e) {
        console.log('okk', e);
        if (e.target.files.length > 0) {
            // Store selected file names
            const files = Array.from(e.target.files).map(file => file.name);
            document.getElementById('selectedFiles').value = JSON.stringify(files);

            // Use a delay to ensure the file dialog closes before showing the modal
            setTimeout(() => {
                const modal = new bootstrap.Modal(document.getElementById('uploadModal'));
                modal.show();
            }, 100); // Adjust delay if needed
        }
    });

    document.getElementById('confirmUpload').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('uploadDetailsForm'));
        console.log("Password:", formData.get('password'));
        console.log("Expiry Date:", formData.get('expire_date'));
        console.log("Selected Files:", JSON.parse(formData.get('selectedFiles')));
        // Add your upload logic here (e.g., AJAX call to send form data to the server)
    });
</script> -->