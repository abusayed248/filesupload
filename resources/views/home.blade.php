
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
                    <img class="img-fluid clo_img" src="{{ asset('files') }}/img/pc.webp" alt="">
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
@endsection
   
 
    

