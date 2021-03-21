<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">SURL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav justify-content-between">
                <li class="nav-item d-flex">
                    <a class="nav-link {{ Request::is('/')? "active" : "" }} " aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                @guest
                    <li class="nav-item d-flex">
                        <a class="nav-link {{ Request::is('login')? "active" : "" }}" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item d-flex">
                        <a class="nav-link {{ Request::is('register')? "active" : "" }}" aria-current="page" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item d-flex">
                        <a class="nav-link" aria-current="page" href="{{ route('logout') }}">Logout</a>
                    </li>
                    
                @endauth
            </ul>
        </div>
    </div>
</nav>