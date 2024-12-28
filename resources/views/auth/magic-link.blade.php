@extends('layouts.app')

@section('title', 'Login/Register')

@section('content')

<div class="container area login-container">
    <h5 class="title">Login</h5>
    <div class="sep"></div>


    <div class="row">
        <div class="col s12">
            <form method="post" action="{{ route('send-login-link') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12">
                        <span class="loginc" style="display: block; font-size: 1.2rem; line-height: 1.5; color: #000; text-align: center; margin: 10px 0;"> The login system is very simple. You don't need to memorize a password. Just enter your email, and we’ll send you a link to log in to the system. </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="mail">Mail *</label>
                        <input id="mail" type="email" name="email" class="validate" required="" data-length="100" maxlength="100" value="">
                        <img class="icon" src="https://easyupload.io/img/mail.png">
                        <span class="character-counter" style="float: right; font-size: 12px;"></span>
                    </div>
                </div>
                <div class="row center">
                    <div class="cf-turnstile" data-sitekey="0x4AAAAAAAHC6CttzOh3NYgQ" data-theme="light">
                        <div><input type="hidden" name="cf-turnstile-response" id="cf-chl-widget-ob4y4_response" value=""></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 center">
                        <button id="sendlogin" type="submit" class="waves-effect btn" name="login" value="login">Send</button>
                    </div>
                </div>
            </form>





        </div>
    </div>
</div>
@endsection