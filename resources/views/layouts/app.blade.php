<!doctype html>
<html lang="en">

<head>
    <title>Filesupload @yield('title')</title>

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

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11403635670"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11403635670');

</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T867XL5L');</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9114057348489404" crossorigin="anonymous"></script>

</head>

<body>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T867XL5L"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    


    {{-- header section start --}}
    @include('backend.components.header')
    {{-- header section end --}}


    @yield('content')

    {{-- footer section start --}}
    @include('backend.components.footer')
    {{-- footer section end --}}

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>



 
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let selectedFilesCount = 0;
        let totalFiles = 0;
        let filesUploaded = 0;
        let filePaths = [];
        let userPassword = '';
        let totalSize = 0; 
        let userExpiryDate = '';
        var uniqueString = Math.random().toString(36).substr(2, 8);
        const paymentPageUrl = "{{ route('payment.page') }}";

        // Initialize Resumable.js
        var r = new Resumable({
            target: '{{ route('upload.store') }}',
            query: {
                _token: '{{ csrf_token() }}',
            },
            fileType: [
                'png', 'jpg', 'jpeg', 'gif', 'bmp', 'svg', 'webp',
                'mp4', 'mkv', 'avi', 'mov', 'wmv', 'flv', 'webm',
                'mp3', 'wav', 'ogg', 'aac', 'flac',
                'zip', 'rar', '7z', 'tar', 'gz',
                'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt',
                'html', 'css', 'js', 'json', 'xml', 'sql', 'py', 'java', 'php', 'c', 'cpp', 'cs', 'rb', 'go', 'ts',
                'apk', 'dll', 'iso', 'dmg'
            ],
            chunkSize: 2 * 1024 * 1024, // 2 MB chunks
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        r.assignBrowse(browseFile[0]);
        // Drag-and-drop functionality
        var dropArea = $('#drop-area');
        r.assignDrop(dropArea[0]);

        r.on('fileAdded', function(files) {
            totalFiles = r.files.length;
            totalSize = r.files.reduce((sum, file) => sum + file.size, 0);
            $('#uploadModal').modal('show');
        });

        $('#startUpload').on('click', function() {
            userPassword = $('#password').val();
            userExpiryDate = $('#expiryDate').val();
            r.opts.query.password = userPassword;
            r.opts.query.expiry_date = userExpiryDate;
            r.opts.query.name = uniqueString
            r.opts.query.total_size = totalSize;

            $('#uploadModal').modal('hide');
            const totalSizeInGB = (totalSize / (1024 * 1024 * 1024)).toFixed(2);
            if (totalSizeInGB > 20) {
                $.ajax({
                    url: '{{ route('subscription.check') }}',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.isSubscribed) {
                            showProgress();
                            r.upload();
                        } else {
                            r.pause();
                            $('#errorMessage').text('The total file size exceeds 1GB. Please subscribe to upload larger files.').show();
                            window.location.href = paymentPageUrl;
                        }
                    },
                    error: function() {
                        r.pause();
                        $('#errorMessage').text('The total file size exceeds 20GB. Please subscribe to upload larger files.').show();
                        window.location.href = paymentPageUrl;
                    }
                });
            } else {
                showProgress();
                r.upload();
            }
        });

        r.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        r.on('fileSuccess', function(file, response) {
            response = JSON.parse(response);
            filesUploaded++;
            filePaths.push(response.path + '/' + response.name);

            if (filesUploaded === totalFiles) {
                const downloadLink = `/get/link/${response.fileUpload_name}`;
                window.location.href = downloadLink;
            }
        });

        r.on('fileError', function(file, response) {
            alert('File uploading error.');
        });

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', value + '%');
            progress.find('.progress-bar').html(value + '%');
        }
    </script>
</body>

</html>