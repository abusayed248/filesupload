
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
                    <p>Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 1 TB and store them forever.</p>
                </div>
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">What can I upload?</h4>
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

    <section class="mtop cloud-section pt-5 pb-5" id="how_it_work">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-2 text-center">
                    <img class="img-fluid  clo_img" src="{{ asset('files') }}/img/cloud.webp" alt="">
                </div>
                <div class="col-md-10">
                    <p>Upload any kind of file up to 10GB without any restriction or necessity to register. With the high speed easyupload.io servers, file upload will never be the same again. Register for free to keep track of your uploaded files or other advance features.</p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                    <p>Password-protect your uploaded files to keep your files secure. With access control, you will be sure that only the people you want can download your files.</p>
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
                    <p>With expire duration option, you can set your files to expire after some amount of time. This way, your files will only be on our servers for the duration you set. You can select durations of 7 days, 15 days, 30 days or unlimited days.</p>
                </div>
            </div>
            <div class="row align-items-center mtop">
                <div class="col-md-10">
                <p>Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
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
                <img class="cline_img" src="{{ asset('files') }}/static_img/woman1.webp" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Veronica D.</h4>
                <p class="pt-3 pb-3">Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                <img src="./img/quote.webp" alt="" srcset="">
            </div>
            <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                <div class="woman_img">
                <img class="cline_img" src="{{ asset('files') }}/static_img/man1.webp" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Eva N.</h4>
                <p class="pt-3 pb-3">Uploading your files is totally free. You can upload files up to 10 GB as a free user but your files can be stored for maximum 30 days if you are a free user. You can optionally purchase a premium account to increase file size and storage up to 500 GB and store them forever.</p>
                <img src="./img/quote.webp" alt="" srcset="">
            </div>
            <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                <div class="woman_img">
                <img class="cline_img" src="{{ asset('files') }}//static_img/woman2.webp" alt="">
                </div>
                <h4 class="text-center titel3 pt-3 ">Boris V.</h4>
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
                <div class="py-5">
                    <span class="fw-light">21/03/2023 06.11 UTC</span>
                    <h6 class="mb-4 fst-italic">Influencer Premium Plan Available</h6>
                    <p class="fw-light">

                        Easyupload.io now offers influencer premium plans for people who share popular files with their followers, friends etc. With this plan, influencer files can be uploaded at maximum speed without any extra charge for downloaders.
                        
                        <span class="d-block py-3">Influencers will also benefit from premium plan features for free for unlimited time. If you are generating high number of downloads with your files, you can contact us for an influencer plan.</span>
                        
                        <span class="d-block py-2">Get on board with us!</span>
                        <span class="d-block py-2">Best,</span>
                    </p>
                    <h6>John H.</h6>
                </div>

                <div class="py-5">
                    <span class="fw-light">28/01/2020 17.11 UTC</span>
                    <h6 class="mb-4 fst-italic">Why choose cloud services for file and data storage?
                    </h6>
                    <p class="fw-light">
                        File and data storage is one of the most popular concepts nowadays. Keeping the data and files secure is essential for any person or company because they are the most important piece of the puzzle. Many companies say the same sentence over and over : "Data is money". So, to secure these data and keep the files intact, using a cloud storage is the most secure way when compared to hardware solutions: They can be damaged, corrupted, stolen or lost easily but with cloud storage you can be sure that your files and data are only available to you, are always there and secured for you.

                        
                        <span class="d-block py-3">Easyupload.io offer this for companies and individuals. With an advanced control-panel, users can keep track of their files, send them to any friend or colleague when needed with one-click. Other options like hardware storage makes these more complicated for everyone and it is not safe. Servers on cloud storage are mostly backed-up for any data loss and they are 7/24 monitored for any kind of attack or problem. Also keep in mind that biggest companies today use cloud solutions over hardware solutions.
                        </span>
                        
                        <span class="d-block py-2">So, catch the trend and use cloud storage!</span>
                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Marry H.</h6>
                </div>

                <div class="py-5">
                    <span class="fw-light">25/01/2020 14.11 UTC</span>
                    <h6 class="mb-4 fst-italic">How secure is cloud storage?</h6>
                    <p class="fw-light">According to Phoenixnap.com, the definition of cloud security is:
                        <span class="d-block py-3">"Cloud-based internet security is an outsourced solution for storing data. Instead of saving data onto local hard drives, users store data on Internet-connected servers. Data Centers manage these servers to keep the data safe and secure to access. Enterprises turn to cloud storage solutions to solve a variety of problems. Small businesses use the cloud to cut costs. IT specialists turn to the cloud as the best way to store sensitive data. Any time you access files stored remotely, you are accessing a cloud. Email is a prime example. Most email users don’t bother saving emails to their devices because those devices are connected to the Internet."
                        </span>
                        
                        <span class="d-block py-2">There are 2 types of cloud storage, one is public and the other one is private. While private cloud is more secure than the public cloud services, it is costly and requires technical knowledge to set up private cloud. So choosing a known and secure public cloud would be more beneficial for users.
                        </span>
                        <span class="d-block py-2">Here at easyupload.io, we are doing our best for the file and user security to offer public cloud services just like the private cloud so users will save money and avoid technical requirements to set up a private cloud. Keeping you and your files is our only priority so either go with private cloud or easyupload.io
                        </span>
                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Marry H.</h6>
                </div>

                <div class="py-5">
                    <span class="fw-light">17/11/2019 12.54 UTC</span>
                    <h6 class="mb-4 fst-italic">PC Security</h6>
                    <p class="fw-light">Security concerns associated with cloud computing fall into two categories: security issues faced by cloud providers and by their customers. The responsibility is shared, however. The provider must ensure that their infrastructure is secure and that their clients’ data and applications are protected, while the user must take measures to fortify their application and use strong passwords and authentication measures.
                        <span class="d-block py-3">"To focus on the customer side, first of all, users have to be sure that the device they are using must not be compromised and they are secure to use. Any malware or virus in the computer can leak your password and files to 3rd parties. Using a powerful antivirus may help you protect your files and your computer. Also, users must not use shared computers or public wifi because passwords can easily be stolen.
                        </span>
                        
                        <span class="d-block py-2">Have a good day !</span>
                    </p>
                    <h6>Michael S.</h6>
                </div>

                <div>
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
    </section>   
@endsection
   
 
    

