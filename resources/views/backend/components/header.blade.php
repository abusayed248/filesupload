<section class="navSection">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('files') }}/img/logo-new.webp" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.dmca.com/compliance/easyupload.io"><img src="https://easyupload.io/img/dmca.png" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">DMCA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <div class="person_login">
                    <img class="img-fluid" src="{{ asset('files') }}/img/person.webp" alt="">
                    </div>
                     @guest
                      <a class="nav-link" href="{{ route('login') }}">Login / Register</a>
                    @endguest
                    @auth
                    <a class="nav-link" href="{{ route('login') }}">Log Out</a>
                    @endauth

                </li>
            
                </ul>
            
            </div>
            </div>
        </nav>
    </div>
</section>