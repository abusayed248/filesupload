
@extends('layouts.admin')

@section('title', 'Contact info edit')

@section('content')
    <section class="">
       <div class="container">
           <div class="row justify-content-center mt-5">
                    <div class="col-md-6 ">
                        <div class="mt-5 p-4 gap-10">
                            @if (session('infostatus'))
                                <div class="alert alert-success py-3">
                                    {{ session('infostatus') }}
                                </div>
                            @endif
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <h5 class="  pb-3">Update Contact Info</h5>
                                </div>
                                <div class="col-md-6 text-end">
                       
                                </div>
                            </div>
                            
                            
                            <form class="gap-10" action="{{ route('update.company.status') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $info->id }}">

                                <div class="form-group">
                                    <label >Company</label>
                                    <div class="d-flex align-items-center input-border mt-3">
                                        <input type="text" name="company_name" class="form-control"  value="{{ $info->company_name }}">
                                    </div>
                                 
                                </div>
                                
                                <div class="form-group">
                                    <label >Adress</label>
                                    <div class="d-flex align-items-center input-border mt-3">
                                        <input type="text" name="address" class="form-control"  value="{{ $info->address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label >Tax No</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="text" name="text_no" class="form-control" value="{{ $info->text_no }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label >Tel</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="text" name="tel" class="form-control"  value="{{ $info->tel }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label >Email</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="email" name="email" class="form-control"  value="{{ $info->email }}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label >Twitter</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input type="text" name="twitter" class="form-control"  value="{{ $info->twitter }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label >Description</label>
                                  <div class="d-flex align-items-center input-border mt-3">
                                    <textarea name="description" type="text" class="form-control">{{ $info->description }}</textarea>
                                  </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="form-group col-md-6">
                                        <label >Company Logo</label>
                                        <div class="d-flex align-items-center input-border mt-3">
                                            <input name="photo" type="file" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group text-end  col-md-6">
                                        <label >Existing Company Logo</label>
                                        <div class="mt-3">
                                            <input type="hidden" name="old_photo" value="{{ $info->photo }}">
                                            <img src="{{ asset($info->photo) }}" height="20" width="100" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                               <div class="d-flex justify-content-lg-center">
                                <button type="submit" class="btn btn-success ">Update</button>
                               </div>
                            </form>
                              
                        </div>
                    </div>
                </div>
            </div> 
     
    </section>

   
@endsection
   
 
    

