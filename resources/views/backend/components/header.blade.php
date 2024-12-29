<section class="navSection">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('files') }}/static_img/File.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dmca') }}">DMCA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#how_it_work">How It Works</a>
                        </li>

                        <li class="nav-item">
                            @if(auth()->user() && auth()->user()->role == 'admin')
                            <a class="nav-link" href="{{ route('allfiles.index') }}">All files</a>
                            @else
                            <a class="nav-link" href="{{ route('files.index') }}">My files</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
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