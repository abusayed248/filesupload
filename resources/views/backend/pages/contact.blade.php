
@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <section class="">
       <div class="container">
           <div class="row mt-5">
                    <div class="col-md-7  border-right">
                        <div class="mt-5 p-4">
                            <h5 class=" border-bottom pb-3">Contact Form</h5>
                            <p class="text-center"><span class="text-bold">For Abuse and Copyright Infringement Reports: </span>abuse@easyupload.io <br>
                              <span class="text-bold">  For General Help: </span>support@filesupload.io</p>
                                <form class="gap-10">
                                    <div class="form-group">
                                        <label >Name</label>
                                      <div class="d-flex align-items-center input-border mt-3">
                                        <input type="text" class="form-control" >
                                        <i class="fa-solid fa-user p-3"></i>
                                      </div>
                                     
                                    </div>
                                    <div class="form-group">
                                        <label >Email</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="email" class="form-control" >
                                            <i class="fa-regular fa-envelope p-3"></i>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                      <label >Message</label>
                                      <div class="d-flex align-items-center input-border mt-3">
                                        <textarea type="text" class="form-control"></textarea>
                                      <i class="fa-solid fa-pen-nib p-3"></i>
                                      </div>
                                    </div>
                                   <div class="d-flex justify-content-lg-center">
                                    <button type="submit" class="btn btn-success ">Submit</button>
                                   </div>
                                </form>
                        </div>
                    </div>
                    <div class="col-md-5 ">
                        <div class="mt-5 p-4 gap-10">
                          
                            <h5 class=" border-bottom pb-3">Contact Form</h5>
                            <div class="footLogo con_logo">
                                <img class="img-fluid" src="{{ asset('files') }}/static_img/File.png" alt="">
                            </div>
                            <p class="text-center">You can contact us using the mail addresses stated on the left side. You can also use the contact us form and send us a message directly. We will respond to abuse requests ASAP (up to at most 5 business days ) and all other inquiries in 5 business days.</p>
                            <div class="gap-10">
                                <div>
                                    <i class="fa-solid fa-users"></i>
                                    <span class="text-bold">Company:</span><span> Ingenium Yazilm</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-hashtag"></i>
                                    <span class="text-bold">Tax No:</span><span> 024100</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-bold">Address:</span><span>Göztepe Mh.26 Kadikoy / Istanbul</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-phone"></i>
                                    <span class="text-bold">Tel:</span><span>+90 216 3594224</span>
                                </div>
                                <div>
                                    <i class="fa-regular fa-envelope"></i>
                                    <span class="text-bold">E-mail:</span><span>welcome@easyupload.io</span>
                                </div>
                                <div>
                                    <i class="fa-brands fa-twitter"></i>
                                    <span class="text-bold">Twitter:</span><span>@filesupload_io</span>
                                </div>
                            </div>
                              
                        </div>
                    </div>
                </div>
            </div> 
     
    </section>

   
@endsection
   
 
    

