<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('files') }}/static_img/favicon_io/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('files') }}/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>
    @include('backend.components.header')
    <section class="herosection">
        <div class="overly">
            <div class="container">
                <div class="">
                    <h1 class="text-center titel fw-bold">Upload files, transfer them easily</h1>
                    <p class="text-center titel">File upload made easy. Upload files up to 20GB and transfer files easily</p>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="file-upload-container col-md-5 pt-4 pb-4">


                            <div class="card-body">
                                <div id="upload-container" class="text-center">
                                    <span id="browseFile" class="btn btn-primary" multiple>Browse File</span>
                                </div>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                </div>

                                <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
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
                                                <input type="password" class="form-control" id="password" style="border: 1px solid !important;" name="password" placeholder="Enter file password">
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

                            <div class="card-footer p-4" style="display: none">
                                <div id="filePreviews" class="row"></div>
                            </div>


                            <label for="file-upload">
                                <p>Click here or drop files to upload or transfer</p>
                                <small>(Max 50 files, 10 GB per file, total 100 GB)</small>
                                <br />
                                <a href="#" class="premium-link">Upgrade to premium to upload files up to 20GB</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center mt-5">
                    <div class="col-md-4 text-center">
                        <img class="spreed_logo" src="{{ asset('files') }}/img/spreed.png" alt="">
                        <h4 class="titel">Fast File Upload</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img class="spreed_logo" src="{{ asset('files') }}/img/send.png" alt="">
                        <h4 class="titel">Effortless File Transfer</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img class="spreed_logo" src="{{ asset('files') }}/img/lock.png" alt="">
                        <h4 class="titel">Secure & Encrypted Uploads</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mtop" id="faq">
        <div class="container mt-5">
            <h1 class="text-center titel2">FAQ</h1>
            <div class="row">
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Is it free?</h4>
                    <p>Yes, uploading your files is completely free. Free users can upload files up to 10 GB, with a storage duration of up to 30 days. For larger file sizes (up to 1 TB) and permanent storage, you can upgrade to a premium account.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">What can I upload?</h4>
                    <p>You can upload any legal files. We strictly adhere to laws and our terms of use, so any file that violates these rules will be deleted immediately, and your account may be permanently suspended without prior notice.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">How do I share?</h4>
                    <p class="">Sharing your files is simple. Once your upload is complete, a download link will be generated. Share this link with others, and they can easily download your files via the provided link.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Are there download limits?</h4>
                    <p>There are no limits on the number of downloads per file. However, files will no longer be available once they expire or are deleted.
                    </p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Why was my file deleted?</h4>
                    <p>Files may be deleted if they violate any laws or our terms of use. Additionally, free users’ files will expire 30 days after upload unless upgraded to a premium account. </p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">How can I report a file?</h4>
                    <p class="">To report a file that you believe violates laws or our terms of use, use the "Report File" link available on the file's download page. Alternatively, you can contact us through the "Contact Us" menu for assistance.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="mtop cloud-section pt-5 pb-5" id="how_it_work">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-2 text-center">
                    <img class="img-fluid  clo_img" src="{{ asset('files') }}/img/cloud.webp" alt="">
                </div>
                <div class="col-md-10">
                    <p>Upload files effortlessly up to 10GB without any restrictions or the need to register. With easyupload.io’s high-speed servers, sharing files has never been this seamless. Register for free to track your uploads and access advanced features.</p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                    <p>PEnhance file security with password protection, ensuring that only authorized individuals can access your files. The access control feature provides peace of mind by restricting downloads to your chosen recipients.
                    </p>
                </div>
                <div class="col-md-2 text-center">
                    <img class="img-fluid clo_img" src="{{ asset('files') }}/img/l1ock.png" alt="">
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-2 text-center">
                    <img class="img-fluid clo_img" src="{{ asset('files') }}/img/time.webp" alt="">
                </div>
                <div class="col-md-10">
                    <p>Take advantage of the file expiration feature to manage your storage effectively. Set your files to expire after 7, 15, or 30 days—or choose unlimited storage duration for long-term needs.
                    </p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                    <p>Uploading is completely free! As a free user, you can upload files up to 10GB with storage for up to 30 days. Upgrade to a premium account to increase file size limits to 500GB and enjoy permanent storage.</p>
                </div>
                <div class="col-md-2 text-center">
                    <!-- <img class="img-fluid clo_img" src="{{ asset('files') }}/img/pc.webp" alt=""> -->
                </div>

            </div>
        </div>
    </section>
    <section class="mtop">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                    <div class="woman_img">
                        <img class="cline_img" src="{{ asset('files') }}/static_img/3.png" alt="">
                    </div>
                    <h4 class="text-center titel3 pt-3 ">Veronica D.</h4>
                    <p class="pt-3 pb-3">Uploading files is absolutely free! As a free user, you can upload files up to 10 GB, which will be stored for up to 30 days. Want more? Upgrade to a premium account to enjoy increased storage up to 500 GB and keep your files saved forever.
                    </p>
                    <img src="./img/quote.png" alt="" srcset="">
                </div>
                <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                    <div class="woman_img">
                        <img class="cline_img" src="{{ asset('files') }}/static_img/2.webp" alt="">
                    </div>
                    <h4 class="text-center titel3 pt-3 ">Eva N.</h4>
                    <p class="pt-3 pb-3">Uploading files is easy and free! Free users can upload files up to 10 GB, with a storage period of 30 days. Need more space and longer storage? Get a premium account for up to 500 GB and unlimited storage time.
                    </p>
                    <img src="./img/quote.png" alt="" srcset="">
                </div>
                <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                    <div class="woman_img">
                        <img class="cline_img" src="{{ asset('files') }}//static_img/1.png" alt="">
                    </div>
                    <h4 class="text-center titel3 pt-3 ">Boris V.</h4>
                    <p class="pt-3 pb-3">Yes, uploading files is free! Free users can upload files up to 10 GB, stored for 30 days. To unlock more features, a premium account offers file uploads up to 500 GB with permanent storage.
                    </p>
                    <img src="{{ asset('files') }}/img/quote.png" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>
    <section class="mtop cloud-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2  number1">
                    <h3 class="titel">01</h3>
                </div>
                <div class="col-md-5 conten1">

                    <h3 class="titel">Drag & Drop to Upload</h3>
                    <p class="titel">Easily upload files up to 10GB each by simply dragging them into the upload box. Customize your upload with options like password protection or automatic expiration for added security.
                    </p>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2  number2">
                    <h1 class="titel">02</h1>
                </div>
                <div class="col-md-5 conten2">
                    <h3 class="titel">Get a Shareable Link </h3>
                    <p class="titel">Once the upload is complete, you'll receive a unique link to share your files with others. Share it directly through our integrated email system or send it via your preferred method.
                    </p>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2  number3">
                    <h1 class="titel">03</h1>
                </div>
                <div class="col-md-5 conten3">

                    <h3 class="titel">Manage Your Files
                    </h3>
                    <p class="titel">Take full control of your uploads. Re-share, delete, or manage your files seamlessly. Please ensure your files comply with legal and copyright regulations.
                    </p>

                </div>
            </div>
        </div>
    </section>
    <section class="mtop">
        <div class="container">
            <h3 class="text-center">Latest News</h3>
            <div class="row">
                <div class="py-5 col-md-6">
                    <span class="fw-light">21/03/2023 06.11 UTC</span>
                    <h6 class="mb-4 fst-italic">Influencer Premium Plan Available</h6>
                    <p class="fw-light">

                        FilesUpload.io now offers influencer premium plans for people who share popular files with their followers, friends etc. With this plan, influencer files can be uploaded at maximum speed without any extra charge for downloaders.

                        <span class="d-block py-3">Influencers will also benefit from premium plan features for free for unlimited time. If you are generating high number of downloads with your files, you can contact us for an influencer plan.</span>

                        <span class="d-block py-2">Get on board with us!</span>
                        <span class="d-block py-2">Best,</span>
                    </p>
                    <h6>John H.</h6>
                </div>

                <div class="py-5 col-md-6">
                    <span class="fw-light">28/01/2020 17.11 UTC</span>
                    <h6 class="mb-4 fst-italic">Why choose cloud services for file and data storage?
                    </h6>
                    <p class="fw-light">
                        File and data storage is one of the most popular concepts nowadays. Keeping the data and files secure is essential for any person or company because they are the most important piece of the puzzle. Many companies say the same sentence over and over : "Data is money". So, to secure these data and keep the files intact, using a cloud storage is the most secure way when compared to hardware solutions: They can be damaged, corrupted, stolen or lost easily but with cloud storage you can be sure that your files and data are only available to you, are always there and secured for you.


                        <span class="d-block py-3">FilesUpload.io offer this for companies and individuals. With an advanced control-panel, users can keep track of their files, send them to any friend or colleague when needed with one-click. Other options like hardware storage makes these more complicated for everyone and it is not safe. Servers on cloud storage are mostly backed-up for any data loss and they are 7/24 monitored for any kind of attack or problem. Also keep in mind that biggest companies today use cloud solutions over hardware solutions.
                        </span>

                        <span class="d-block py-2">So, catch the trend and use cloud storage!</span>
                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Marry H.</h6>
                </div>

            </div>

            <div class="row">
                <div class="py-5 col-md-6">
                    <span class="fw-light">17/11/2019 12.54 UTC</span>
                    <h6 class="mb-4 fst-italic">PC Security</h6>
                    <p class="fw-light">Security concerns associated with cloud computing fall into two categories: security issues faced by cloud providers and by their customers. The responsibility is shared, however. The provider must ensure that their infrastructure is secure and that their clients’ data and applications are protected, while the user must take measures to fortify their application and use strong passwords and authentication measures.
                        <span class="d-block py-3">"To focus on the customer side, first of all, users have to be sure that the device they are using must not be compromised and they are secure to use. Any malware or virus in the computer can leak your password and files to 3rd parties. Using a powerful antivirus may help you protect your files and your computer. Also, users must not use shared computers or public wifi because passwords can easily be stolen.
                        </span>

                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Michael S.</h6>
                </div>

                <div class="col-md-6">
                    <span class="fw-light">16/10/2019 14.19 UTC
                    </span>
                    <h6 class="mb-4 fst-italic">What kind of files can be uploaded?</h6>
                    <p class="fw-light">All kinds of files that is not legal to share or upload should be avoided by all easyupload.io users. Easyupload.io is so strict about the legal issues and does not permit any illegal file including but not limited to: Adult Content, Child Abuse, Movies, Games or any kind of copyrighted material.
                        <span class="d-block py-3">Easyupload.io makes regular checks for uploaded files and take the necessary actions if any violation is made. We also have report mechanisms for uploaded files where you can report any file that you think it is violating the terms of use and law. We instantly delete and block the related url, and block the user account if necessary.
                        </span>
                        <span class="d-block py-3">We are offering a free service for people to share their files and store their files, only condition is to keep them legal!</span>

                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Marry H.</h6>
                </div>
            </div>
        </div>
        </div>
    </section>
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
            </div>
        </div>
    </div>
    @include('backend.components.footer')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let selectedFilesCount = 0;
        let totalFiles = 0;
        let filesUploaded = 0;
        let filePaths = [];
        let userPassword = '';
        let totalSize = 0; //
        let userExpiryDate = '';
        var uniqueString = Math.random().toString(36).substr(2, 8); 
        const paymentPageUrl = "{{ route('payment.page') }}";


        // Initialize Resumable.js
        var r = new Resumable({
            target: '{{ route('upload.store') }}',
            
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

        r.on('fileAdded', function(files) {
            totalFiles = r.files.length;
            totalSize = r.files.reduce((sum, file) => sum + file.size, 0);

            $('#uploadModal').modal('show');
        });

        // Handle the Start Upload button click
        $('#startUpload').on('click', function() {
            userPassword = $('#password').val();
            userExpiryDate = $('#expiryDate').val();
            r.opts.query.password = userPassword;
            r.opts.query.expiry_date = userExpiryDate;
            r.opts.query.name = uniqueString

            r.opts.query.total_size = totalSize; // Pass the total size

            $('#uploadModal').modal('hide'); // Close the modal
            const totalSizeInGB = (totalSize / (1024 * 1024 * 1024)).toFixed(2);
            if (totalSizeInGB > 1) {


                $.ajax({
                    url: '{{ route('subscription.check') }}', // Replace with your route to check subscription
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
                    success: function(response) {
                        if (response.isSubscribed) {
                            console.log(response.isSubscribed,'response.isSubscribed');
                            // User is subscribed, proceed with upload
                            showProgress(); // Show the upload progress
                            r.upload(); // Start the upload
                        } else {
                            r.pause();
                            // User is not subscribed, show error message
                            $('#errorMessage').text('The total file size exceeds 1GB. Please subscribe to upload larger files.').show();
                            window.location.href = paymentPageUrl;
                        }
                    },
                    error: function() {
                        r.pause();
                        // Handle AJAX error
                        $('#errorMessage').text('The total file size exceeds 1GB. Please subscribe to upload larger files.').show();
                        window.location.href = paymentPageUrl;
                    }
                });
                // $('#errorMessage').text('The total file size exceeds 20GB. Please upgrade plan for upload more than 20GB.').show();
            } else {
                showProgress(); // Show the upload progress
                r.upload(); // Start the upload
            }
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
               const downloadLink = `/get/link/${response.fileUpload_name}`;
                window.location.href = downloadLink;
            }
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
                url: '{{ route('store.filepaths') }}',
                
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

</body>

</html>