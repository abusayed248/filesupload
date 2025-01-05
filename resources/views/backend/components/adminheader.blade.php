<section class="navSection">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="header_logo" src="{{ asset('files') }}/static_img/File.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end align-items-center">


                        <li class="nav-item">
                            @if(auth()->user() && auth()->user()->role == 'admin')
                            <a class="nav-link" href="{{ route('allfiles.index') }}">All files</a>
                            @endif
                        </li>


                        <li class="nav-item dropdown">
                            @if(auth()->user() && auth()->user()->role == 'admin')
                            <a class="nav-link dropdown-toggle" href="#" id="termsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Terms
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="termsDropdown">
                                <li><a class="dropdown-item" href="{{ route('terms.index') }}">View Terms</a></li>

                                <li><a class="dropdown-item" href="{{ route('terms.edit') }}">Edit Terms</a></li>
                            </ul>
                            @endif
                        </li>

                        <li class="nav-item dropdown">
                            @if(auth()->user() && auth()->user()->role == 'admin')
                            <a class="nav-link dropdown-toggle" href="#" id="privacyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Privacy Policy
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="privacyDropdown">
                                <li><a class="dropdown-item" href="{{ route('privacy-policy.index') }}">View Privacy Policy</a></li>
                                <li><a class="dropdown-item" href="{{ route('policy.edit') }}">Edit Privacy Policy</a></li>
                            </ul>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            @if(auth()->user() && auth()->user()->role == 'admin')
                            <a class="nav-link dropdown-toggle" href="#" id="privacyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Contacts Info
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="privacyDropdown">
                                <li><a class="dropdown-item" href="{{ route('contact.index') }}">View Contacts Info</a></li>
                                <li><a class="dropdown-item" href="{{ route('update.contact.info') }}">Edit Contacts Info</a></li>
                            </ul>
                            @endif
                        </li>



                        <li class="nav-item d-flex align-items-center">
                            <div class="person_login">
                                <img class="img-fluid" src="{{ asset('files') }}/img/person.webp" alt="">
                            </div>
                            @guest
                            <a class="nav-link" href="{{ route('login') }}">Login / Register</a>
                            @endguest

                            @auth
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @endauth

                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>
</section>