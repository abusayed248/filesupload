@extends('layouts.admin')

@section('title', 'Contact')

@section('content')
<section class="">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 ">
                <div class="mt-5 p-4 gap-10">
                    <div class="footLogo ">
                        <img class="img-fluid" src=" @isset ($contact_info->photo) {{ asset($contact_info->photo) }} @endisset " alt="">
                    </div>



                    <p class="text-center">@isset ($contact_info->description ) {{ $contact_info->description }} @endisset</p>



                    <div class="gap-10">
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <span class="text-bold">Company:</span><span>@isset ( $contact_info->company_name ) {{ $contact_info->company_name }} @endisset </span>
                        </div>
                        <div>
                            <i class="fa-solid fa-hashtag"></i>
                            <span class="text-bold">Tax No:</span><span>@isset ( $contact_info->text_no ) {{ $contact_info->text_no }} @endisset </span>
                        </div>
                        <div>
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="text-bold">Address:</span><span>@isset ( $contact_info->address ) {{ $contact_info->address }} @endisset </span>
                        </div>
                        <div>
                            <i class="fa-solid fa-phone"></i>
                            <span class="text-bold">Tel:</span><span>@isset ( $contact_info->tel ) {{ $contact_info->tel }} @endisset </span>
                        </div>

                        <div>
                            <i class="fa-regular fa-envelope"></i>
                            <span class="text-bold">E-mail:</span><span>@isset ($contact_info->email ) {{ $contact_info->email }} @endisset </span>
                        </div>
                        <div>
                            <i class="fa-brands fa-twitter"></i>
                            <span class="text-bold">Twitter:</span><span> @isset ($contact_info->twitter ) {{ $contact_info->twitter }} @endisset </span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</section>


@endsection