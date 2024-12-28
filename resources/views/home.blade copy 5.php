<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Resumablejs + Laravel Chunk Upload</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

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
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control" id="expiryDate" required>
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

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let selectedFilesCount = 0; // Variable to track the number of files selected
        var totalFiles = 0; // Variable to track the total number of files added
        let filesUploaded = 0; // Variable to track how many files have been uploaded successfully
        let filePaths = [];
        var r = new Resumable({
            target: '{{ route('
            upload.store ') }}',








            query: {
                _token: '{{ csrf_token() }}',
                name: 'Saidur'
            },
            fileType: ['png', 'jpg', 'jpeg', 'mp4', 'zip'],
            chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        r.assignBrowse(browseFile[0]);

        r.on('fileAdded', function(files) {
            totalFiles = r.files.length;
            showProgress();
            r.upload();


        });
        // Function to log the total files count
        function logTotalFiles() {
            console.log('Total Files: ', totalFiles); // Log total files count
        }

        // Call the log function after a short delay to ensure files are added first
        setTimeout(logTotalFiles, 10000);

        r.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        r.on('fileSuccess', function(file, response) {
            response = JSON.parse(response);
            filesUploaded++; // Increment when a file upload is successful
            filePaths.push(response.path + '/' + response.name);

            // Check if all files have been uploaded
            if (filesUploaded === totalFiles) {
                console.log('All files have been uploaded.');
                saveFilePathsToServer(filePaths);

            }
            // Create a download button and copy path button
            const filePreview = document.createElement('div');
            filePreview.classList.add('col-md-4', 'mb-3');

            // Download Button
            const downloadBtn = document.createElement('a');
            downloadBtn.href = response.path + '/' + response.name;
            downloadBtn.classList.add('btn', 'btn-success', 'w-100');
            downloadBtn.setAttribute('download', response.name); // Trigger download on click
            downloadBtn.innerHTML = 'Download';

            // Copy File Path Button
            const copyBtn = document.createElement('button');
            copyBtn.classList.add('btn', 'btn-info', 'w-100', 'mt-2');
            copyBtn.innerHTML = 'Copy Path';
            copyBtn.onclick = function() {
                navigator.clipboard.writeText(response.path + '/' + response.name)
                    .then(() => alert('File path copied!'))
                    .catch(err => alert('Error copying path: ' + err));
            };

            // Append buttons to file preview container
            filePreview.appendChild(downloadBtn);
            filePreview.appendChild(copyBtn);

            document.getElementById('filePreviews').appendChild(filePreview);

            $('.card-footer').show();
        });

        r.on('fileError', function(file, response) {
            alert('File uploading error.');
        });

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
                // Your backend route to store the file paths
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
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
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)

            if (value === 100) {
                progress.find('.progress-bar').addClass('bg-success');
                console.log('okkk');
            }
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

</body>

</html>