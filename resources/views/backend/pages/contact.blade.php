
@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <section class="">
       <div class="container">
           <div class="row mt-5">
                    <div class="col-md-7  border-right">
                        <div class="mt-5 p-4">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h5 class=" border-bottom pb-3">Contact Form</h5>
                            <p class="text-center"><span class="text-bold">For Abuse and Copyright Infringement Reports: </span>abuse@filesupload.io <br>
                              <span class="text-bold">  For General Help: </span>support@filesupload.io</p>

                                <form class="gap-10" action="{{ route('contact.msg.send') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label >Name</label>
                                      <div class="d-flex align-items-center input-border mt-3">
                                        <input type="text" name="name" class="form-control" >
                                        <i class="fa-solid fa-user p-3"></i>
                                      </div>
                                     
                                    </div>
                                    <div class="form-group">
                                        <label >Email</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="email" name="email" class="form-control" >
                                            <i class="fa-regular fa-envelope p-3"></i>
                                          </div>
                                      </div>
                                    <div class="form-group">
                                      <label >Message</label>
                                      <div class="d-flex align-items-center input-border mt-3">
                                        <textarea name="message" type="text" class="form-control"></textarea>
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
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class=" border-bottom pb-3">Contact Form</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h5 class=" border-bottom pb-3"><a href="{{ route('update.contact.info') }}" class="update_info_link">Update contact info</a></h5>
                                </div>
                            </div>
                            <div class="footLogo con_logo">
                                <img class="img-fluid" src="{{ asset($contact_info->photo) }}" alt="">
                            </div>
                            <p class="text-center">{{ $contact_info->description }}</p>
                            <div class="gap-10">
                                <div>
                                    <i class="fa-solid fa-users"></i>
                                    <span class="text-bold">Company:</span><span> {{ $contact_info->company }}</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-hashtag"></i>
                                    <span class="text-bold">Tax No:</span><span> {{ $contact_info->text_no }}</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-bold">Address:</span><span>{{ $contact_info->address }}</span>
                                </div>
                                <div>
                                    <i class="fa-solid fa-phone"></i>
                                    <span class="text-bold">Tel:</span><span>{{ $contact_info->tel }}</span>
                                </div>
                                <div>
                                    <i class="fa-regular fa-envelope"></i>
                                    <span class="text-bold">E-mail:</span><span>{{ $contact_info->email }}</span>
                                </div>
                                <div>
                                    <i class="fa-brands fa-twitter"></i>
                                    <span class="text-bold">Twitter:</span><span>{{ $contact_info->twitter }}</span>
                                </div>
                            </div>
                              
                        </div>
                    </div>
                </div>
            </div> 
     
    </section>

   
@endsection
   
 
    

