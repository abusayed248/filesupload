@extends('layouts.app')

@section('title', 'Login/Register')

@section('content')

<div class="container area login-container">
 
    <div class="row justify-content-center">
        <div class="col-md-5 login_container">
            <h5 class="title text-center pt-4 pb-4">Login</h5>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('magic-link.send') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12  mb-4">
                      <span class="loginc mb-4" > The login system is very simple. You don't need to memorize a password. Just enter your email, and we’ll send you a link to log in to the system. </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 d-flex  align-items-center">
                        <label class="mx-2" for="mail">Mail *</label>
                        <input id="mail" type="email" name="email" class="validate" required="" data-length="100" maxlength="100" value="">
                        <img class="icon mx-2" src="https://easyupload.io/img/mail.png">
                    <span class="character-counter" style="float: right; font-size: 12px;"></span></div>
                </div>
                <div class="row center">
                    <div class="cf-turnstile" data-sitekey="0x4AAAAAAAHC6CttzOh3NYgQ" data-theme="light">
                        <div><input type="hidden" name="cf-turnstile-response" id="cf-chl-widget-ob4y4_response" value=""></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 d-flex justify-content-center">
                        <button id="sendlogin" type="submit" class="waves-effect btn" name="login" value="login">Send</button>
                    </div>
                </div>
            </form>





        </div>
    </div>
</div>
@endsection