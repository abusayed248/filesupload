@extends('layouts.app')

@section('title', 'Home')



@section('content') 
    
    <section class="herosection">
        <div class="overly pt-5 pb-5">


            <div class="" id="upload-container">
    
                <h1 class="text-center titel fw-bold">Upload files, transfer them easily</h1>
                <p  class="text-center titel">File upload made easy. Upload files up to 20GB and transfer files easily</p>
             <div class="d-flex justify-content-center mt-4" id="drop-area">
              <div class="file-upload-container col-md-5 pt-4 pb-4">
                <input type="file" id="browseFile" multiple />
                <label for="file-upload">
                  <p>Click here or drop files to upload or transfer</p>
                  <small>(Max 50 files, 10 GB per file, total 100 GB)</small>
                  <br />
                  <a href="#" class="premium-link">Upgrade to premium to upload files up to 20GB</a>
                </label>

                <div style="display: none" class="progress mt-3" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                </div>

                <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
              </div>
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

               </div>




            <div class="container">
              
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
                @php
                    $faqs = \App\Models\Faq::paginate(6);
                @endphp

                @foreach ($faqs as $faq)
                <div class="col-md-4 p-5">
                    <h4 class="text-center titel2">{{ $faq->title }}</h4>
                    <p>{{ $faq->description }}</p>
                </div>
                @endforeach
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
                    <p>Upload files effortlessly up to 10GB without any restrictions or the need to register. With filesupload.io’s high-speed servers, sharing files has never been this seamless. Register for free to track your uploads and access advanced features.</p>
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
            @php
                $testimonials = \App\Models\Testimonial::paginate(3);
            @endphp

            @foreach ($testimonials as $testimonial)

                <div class="col-md-4 d-flex justify-content-center flex-column align-items-center p-3">
                    <div class="woman_img">
                        <img class="cline_img" src="{{ asset($testimonial->photo) }}" alt="">
                    </div>
                    <h4 class="text-center titel3 pt-3 ">{{ $testimonial->name }}</h4>
                    <p class="pt-3 pb-3">{{ $testimonial->description }}
                    </p>
                    <img src="./img/quote.png" alt="" srcset="">
                </div>
            @endforeach    
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
                @php
                $news = \App\Models\News::paginate(4);
                @endphp

                @forelse($news as $item)
                <div class="py-5 col-md-6">
                    <span class="fw-light">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</span>
                    <h6 class="mb-4 fst-italic">{{ $item->title }}</h6>
                    <p class="fw-light">
                        {!! $item->description !!}
                    </p>
                </div>
                @empty
                <div class="py-5 col-md-12">
                    <h6 class="mb-4">There are no users.</h6>
                </div>
                @endforelse

            </div>

            
        </div>
        </div>
    </section>

 
@endsection