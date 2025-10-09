@props(['title' =>'Go Freightmate', 'logo' => null] )
<header class="mainHead">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/">
                    <img src="{{ asset('assets/images/Go_FreightMate_logo.png') }}" alt="brand-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="/#home" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#screen">Screens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#feature">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#team">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#myblg">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#footer">Contact</a>
                        </li>
                    </ul>
                    <ul class="list-inline socialLinks">
                        <li class="list-inline-item"><a href="#"><img src="{{ asset('assets/images/facebook.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="{{ asset('assets/images/youtube.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="{{ asset('assets/images/insta.png') }}" alt="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="{{ asset('assets/images/tiktok.png') }}" alt="social-icon"></a></li>
                    </ul>
                    <a href="/registration" class="getstartedBtn">Get Started</a>
                </div>
            </div>
        </nav>
    </div>
</header>
