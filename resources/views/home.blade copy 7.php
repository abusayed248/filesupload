<@extends('layouts.app')

    @section('title', 'Download Links' )

    @section('content')

    <div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Upload File</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <button id="browseFile" class="btn btn-primary" multiple>Browse File</button>
                    </div>
                    <div style="display: none" class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                </div>

                <div class="card-footer p-4" style="display: none">
                    <div id="filePreviews" class="row"></div>
                </div>

                <!-- Modal for Password and Expiry Date -->


            </div>

            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Enter Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">File Password (Leave blank for public)</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="expiryDate" class="form-label">Expiry Date</label>
                                <select class="form-select" id="expiryDate" name="userExpiryDate">
                                    <option value="1">1 Day</option>
                                    <option value="3">3 Days</option>
                                    <option value="7">7 Days</option>
                                    <option value="15">15 Days</option>
                                    <option value="30">30 Days</option>
                                    <option value="never">Never</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="startUpload" class="btn btn-primary">Start Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let selectedFilesCount = 0;
        let totalFiles = 0;
        let filesUploaded = 0;
        let filePaths = [];
        let userPassword = '';
        let userExpiryDate = '';
        var uniqueString = Math.random().toString(36).substr(2, 8); // Generate unique 8-character string


        // Initialize Resumable.js
        var r = new Resumable({
            target: '{{ route('
            upload.store ') }}',




            query: {
                _token: '{{ csrf_token() }}',

            },
            fileType: ['png', 'jpg', 'jpeg', 'mp4', 'zip'],
            chunkSize: 2 * 1024 * 1024, // 2 MB chunks
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        r.assignBrowse(browseFile[0]);

        // Show the modal when a file is added
        r.on('fileAdded', function(files) {
            totalFiles = r.files.length;
            $('#uploadModal').modal('show'); // Show the modal to get user input
        });

        // Handle the Start Upload button click
        $('#startUpload').on('click', function() {
            userPassword = $('#password').val();
            userExpiryDate = $('#expiryDate').val();

            // Check if both fields are filled

            // Pass the password and expiry date as part of the upload
            r.opts.query.password = userPassword;
            r.opts.query.expiry_date = userExpiryDate;
            r.opts.query.name = uniqueString


            $('#uploadModal').modal('hide'); // Close the modal

            showProgress(); // Show the upload progress
            r.upload(); // Start the upload

        });

        // File progress event
        r.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        // File success event
        r.on('fileSuccess', function(file, response) {
            response = JSON.parse(response);
            filesUploaded++; // Increment when a file upload is successful
            filePaths.push(response.path + '/' + response.name);

            if (filesUploaded === totalFiles) {

                console.log('All files have been uploaded.');

                const downloadLink = `/get/link/${response.fileUpload_name}`;

                window.location.href = downloadLink;


            }

            const filePreview = document.createElement('div');
            filePreview.classList.add('col-md-4', 'mb-3');

            const downloadBtn = document.createElement('a');
            downloadBtn.href = response.path + '/' + response.name;
            downloadBtn.classList.add('btn', 'btn-success', 'w-100');
            downloadBtn.setAttribute('download', response.name);
            downloadBtn.innerHTML = 'Download';

            const copyBtn = document.createElement('button');
            copyBtn.classList.add('btn', 'btn-info', 'w-100', 'mt-2');
            copyBtn.innerHTML = 'Copy Path';
            copyBtn.onclick = function() {
                navigator.clipboard.writeText(response.path + '/' + response.name)
                    .then(() => alert('File path copied!'))
                    .catch(err => alert('Error copying path: ' + err));
            };

            filePreview.appendChild(downloadBtn);
            filePreview.appendChild(copyBtn);

            document.getElementById('filePreviews').appendChild(filePreview);
            $('.card-footer').show();
        });

        r.on('fileError', function(file, response) {
            alert('File uploading error.');
        });

        // Show the upload progress bar
        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function saveFilePathsToServer(filePaths) {
            $.ajax({
                url: '{{ route('
                store.filepaths ') }}',

                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    file_paths: filePaths
                },
                success: function(response) {
                    console.log('File paths saved successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error saving file paths:', error);
                }
            });
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`);
            progress.find('.progress-bar').html(`${value}%`);
            if (value === 100) {
                progress.find('.progress-bar').addClass('bg-success');
            }
        }
    </script>

    @endsection