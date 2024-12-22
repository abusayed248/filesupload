
@extends('layouts.app')

@section('title', '')

@section('content')
    <section class="herosection">
        <div class="overly">
            <div class="container">
            <div class="">
                <h1 class="text-center titel fw-bold">Upload files, transfer them easily</h1>
                <p  class="text-center titel">File upload made easy. Upload files up to 20GB and transfer files easily</p>
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

    <section class="mtop">
        <div class="container mt-5">
            <h1 class="text-center titel2">FAQ</h1>
            <div class="row">
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Is it free?</h4>
                    <p>Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 1 TB and store them forever.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center">What can I upload?</h4>
                    <p>You can upload any file as long as they are legal. We are very strict about laws so any uploaded file that violates any law or our terms of use will be deleted immediately and your account will be closed without any notification.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">How do I share?</h4>
                    <p class="">It is really easy to share your files. After you complete an upload, a download link will be generated. You can share this link with anyone and when they visit this link they will see a download button and get your files easily.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Download limit per file?</h4>
                    <p>There is no limit download limit for the uploaded files. When the files expires or deleted, It won't be available for downloading anymore.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">Why was my file deleted?</h4>
                    <p>Any file that violates any law or our terms of use will be deleted immediately. Also your file may expire after 30 days if you are a free user.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">How to report a file?</h4>
                    <p class="">You can use "Report File" link on the download file page if you think that the file violates any law or our terms of use. You can also use "Contact Us" menu.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mtop cloud-section pt-5 pb-5">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('files') }}/img/cloud.webp" alt="">
                </div>
                <div class="col-md-10">
                    <p>Upload any kind of file up to 10GB without any restriction or necessity to register. With the high speed easyupload.io servers, file upload will never be the same again. Register for free to keep track of your uploaded files or other advance features.</p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                    <p>Password-protect your uploaded files to keep your files secure. With access control, you will be sure that only the people you want can download your files.</p>
                </div>
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('files') }}/img/l1ock.png" alt="">
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('files') }}/img/time.webp" alt="">
                </div>
                <div class="col-md-10">
                    <p>With expire duration option, you can set your files to expire after some amount of time. This way, your files will only be on our servers for the duration you set. You can select durations of 7 days, 15 days, 30 days or unlimited days.</p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                <p>Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                </div>
                <div class="col-md-2">
                <img class="img-fluid" src="{{ asset('files') }}/img/pc.webp" alt="">
                </div>
                
            </div>
        </div>
    </section>

    <section class="mtop">
        <div class="container">
            <div class="row">
            <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                <div class="woman_img">
                <img class="cline_img" src="{{ asset('files') }}/img/wn.jpg" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Veronica D.</h4>
                <p class="pt-3 pb-3">Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                <img src="./img/quote.webp" alt="" srcset="">
            </div>
            <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                <div class="woman_img">
                <img class="cline_img" src="{{ asset('files') }}/img/wn.jpg" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Veronica D.</h4>
                <p class="pt-3 pb-3">Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                <img src="./img/quote.webp" alt="" srcset="">
            </div>
            <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                <div class="woman_img">
                <img class="cline_img" src="{{ asset('files') }}/img/wn.jpg" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Veronica D.</h4>
                <p class="pt-3 pb-3">Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                <img src="{{ asset('files') }}/img/quote.webp" alt="" srcset="">
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
                
                    <h3 class="titel">DRAG FILE TO UPLOAD</h3>
                    <p class="titel">Drag any file to upload box up to 10GB per file to start your upload, set your desired features like password protection or auto-expire.</p>
                
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2  number2">
                    <h1 class="titel">01</h1>
                </div>
                <div class="col-md-5 conten2">
                
                    <h3 class="titel">DRAG FILE TO UPLOAD</h3>
                    <p class="titel">Drag any file to upload box up to 10GB per file to start your upload, set your desired features like password protection or auto-expire.</p>
                
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2  number3">
                    <h1 class="titel">01</h1>
                </div>
                <div class="col-md-5 conten3">
                
                    <h3 class="titel">DRAG FILE TO UPLOAD</h3>
                    <p class="titel">Drag any file to upload box up to 10GB per file to start your upload, set your desired features like password protection or auto-expire.</p>
                
                </div>
            </div>
        </div>
    </section>
    <section class="mtop">
        <div class="container">
            <h3 class="text-center">Latest News</h3>
            <div class="row">
                <span>21/03/2023 06.11 UTC</span>
                <h6>Influencer Premium Plan Available</h6>
                <p class="">

                    Easyupload.io now offers influencer premium plans for people who share popular files with their followers, friends etc. With this plan, influencer files can be uploaded at maximum speed without any extra charge for downloaders.
                    
                    Influencers will also benefit from premium plan features for free for unlimited time. If you are generating high number of downloads with your files, you can contact us for an influencer plan.
                    
                    Get on board with us!
                    
                    Best,
                </p>
                <h6>John H.</h6>
            </div>
        </div>
    </section>   
@endsection
   
 
    

