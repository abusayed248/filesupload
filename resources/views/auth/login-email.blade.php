@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container area login-container">
    <div class="row justify-content-center">
        <div class="col-md-5 login_container">
            <h5 class="title text-center pt-4 pb-4">Admin Login</h5>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
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

            <form method="post" action="{{ route('admin-login') }}">
                @csrf

                <div class="row">
                    <div class="input-field col s12 mb-4">
                        <span class="loginc mb-4">
                            Please enter your email and password to log in.
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 d-flex align-items-center">
                        <label class="mx-2 col-2" for="email">Email *</label>
                        <input id="email" type="email" name="email" class="validate col-10" required="" data-length="100" maxlength="100" value="{{ old('email') }}">
                        <span class="character-counter" style="float: right; font-size: 12px;"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 d-flex align-items-center mt-3">
                        <label class="mx-2 col-2" for="password">Password *</label>
                        <input id="password" type="password" name="password" class="validate col-10" required="" data-length="100" maxlength="100">
                    </div>
                </div>
               <div class="input-field col s12 d-flex justify-content-center align-items-center mt-3">
                       <div class="col-10">
                            <button id="login" type="submit" class="waves-effect btn w-100" name="login" value="login">Login</button>
                        </div>
                    </div>
             
            </form>
        </div>
    </div>
</div>
@endsection