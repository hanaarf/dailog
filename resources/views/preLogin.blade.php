<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dailog</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('web/mycss/style.css') }}" />
    <!-- link favicon -->
    <link rel="shortcut icon" href="{{ asset('web/img/home-nl/logoo.svg') }}" type="image/x-icon">
    <!-- cdn bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- gfont -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

</head>

<body>
    <!-- Navbar -->
    <section class="navbar-dailog">
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <div class="d-flex gap-2 logo">
                    <img src="{{ asset('web/img/home-nl/logodai.svg') }}" alt="">
                    <a class="navbar-brand" href="#">Dailog</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Explores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        @if (Route::has('login'))
                            @auth
                                @if (auth()->user()->role === '1')
                                    <a href="{{ route('index.dashboard') }}" class="btn btn-sign-in">Dashboard</a>
                                @else
                                    <a href="{{ route('index.home') }}" class="btn btn-sign-in">Home</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sign-in">Sign In</a>
                                <a href="{{ route('register') }}" class="btn btn-sign-up">Sign Up</a>
                            @endauth
                        @endif
                    </div>
                    
                </div>
            </div>
        </nav>
    </section>
    <!-- end navbar -->

    <!-- hero -->
    <section class="hero-page">
        <div class="hero">
            <h1 class="text-uppercase">dailog</h1>
            <p>Blog Platform for Your Ideas</p>
        </div>
        <div class="text-jalan">
            <div class="marquee">
                <p class="text-uppercase">
                    Blog Platform for Your Ideas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blog Platform for Your Ideas
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blog Platform for Your Ideas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
                <p class="text-uppercase">
                    Blog Platform for Your Ideas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blog Platform for Your Ideas
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blog Platform for Your Ideas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>
        </div>
        <div class="tigabox">
            <div class="box">
                <img src="{{ asset('web/img/home-nl/ab1.svg') }}" alt="">
            </div>
            <div class="box">
                <img src="{{ asset('web/img/home-nl/ab2.svg') }}" alt="">
            </div>
            <div class="box">
                <img src="{{ asset('web/img/home-nl/ab3.svg') }}" alt="">
            </div>
        </div>
    </section>
    <!-- end hero -->

    <!-- about -->
    <section class="about-page">
        <div class="about">
            <h1>About Dailog</h1>
            <p>Welcome to Dailog, where your everyday thoughts and stories come to life. Built for anyone with a passion
                for writing, Dailog is a space to share insights, reflections, and creativity, one day at a time.
                Whether you're documenting personal experiences, sharing knowledge, or exploring new ideas, our platform
                is designed to make daily blogging easy and enjoyable.
            </p>
        </div>
    </section>
    <!-- end about -->

    <!-- see -->
    <section class="see container">
        <div class="row">
            <div class="col-md-6 content-see d-flex align-items-center">
                <div class="desc-see">
                    <h1>Start Today</h1>
                    <div class="garis"></div>
                    <p>Start to the Dailog App to help you on <br> your way to a better stories <br> wellbeing.</p>
                    <a href="">
                        See More
                        <img src="{{ asset('web/img/home-nl/arrow.svg') }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-md-6 img-see">
                <img src="{{ asset('web/img/home-nl/img-start.svg') }}" alt="see 1" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- end see -->

    <!-- features -->
    <div class="container my-5 fitur-page">
        <h1>Our Features</h1>
        <div class="row">
            <div class="col-md-4 mb-3 kartu">
                <div class="card">
                    <img src="{{ asset('web/img/home-nl/image.svg') }}" class="card-img-top" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Like, Comment</h5>
                        <p class="card-text">Engage and Interact: Like, Comment</p>
                        <a href="">
                            Learn More
                            <img src="{{ asset('web/img/home-nl/arrow.svg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 kartu">
                <div class="card">
                    <img src="{{ asset('web/img/home-nl/detail.svg') }}" class="card-img-top" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Blog</h5>
                        <p class="card-text">Explore Collections: create your blogs</p>
                        <a href="">
                            Learn More
                            <img src="{{ asset('web/img/home-nl/arrow.svg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 kartu">
                <div class="card">
                    <img src="{{ asset('web/img/home-nl/search.svg') }}" class="card-img-top" alt="Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Search</h5>
                        <p class="card-text">Stay Connected: Search Other Users</p>
                        <a href="">
                            Learn More
                            <img src="{{ asset('web/img/home-nl/arrow.svg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end features -->

    <!-- explore -->
    <section class="explore container">
        <h1>Explore <br>
            Our Blog</h1>
        <div class="row">
            <div class="col-md-6 img-karir d-flex justify-content-end">
                <img src="{{ asset('web/img/home-nl/img1.svg') }}" alt="karir 1" class="img-fluid">
            </div>
            <div class="col-md-6 content-karir d-flex align-items-center">
                <div class="desc-karir">
                    <span>Share Your Story</span>
                    <h3>Everyday Moments</h3>
                    <p>We're dedicated to helping our students build a bright future. <br> A quick interview is a great
                        way to start shaping <br> your journey with us.</p>
                    <a href="" class="btn btn-karir">Learn More</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 content-karir d-flex align-items-center">
                <div class="desc-karir">
                    <span>Start Your Journey</span>
                    <h3>Capture Each Step</h3>
                    <p>We’re here to support your growth and aspirations. <br> Share your story with us—start with a
                        quick <br> introduction to help us guide you forward.</p>
                    <a href="" class="btn btn-karir">Learn More</a>
                </div>
            </div>
            <div class="col-md-6 img-karir d-flex justify-content-end">
                <img src="{{ asset('web/img/home-nl/img2.svg') }}" alt="karir 1" class="img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 img-karir d-flex justify-content-end">
                <img src="{{ asset('web/img/home-nl/img3.svg') }}" alt="karir 1" class="img-fluid">
            </div>
            <div class="col-md-6 content-karir d-flex align-items-center">
                <div class="desc-karir">
                    <span>Begin Your Story</span>
                    <h3>Embrace the Journey</h3>
                    <p>We’re invested in helping you shape a meaningful <br> path forward. A quick introduction is a
                        great first step <br> to discovering new possibilities together.</p>
                    <a href="" class="btn btn-karir">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end explore -->

    <!-- footer -->
    <footer class="footer bg-white py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('web/img/home-nl/logoo.svg') }}" alt="Logo" class="footer-logo" style="width: 120px;">
                </div>
                <div class="col-md-4 mb-3 text-center menu">
                    <ul class="list-unstyled d-flex justify-content-center align-items-center">
                        <li class="mx-2"><a href="#">Home</a></li>
                        <li class="mx-2"><a href="#">About</a></li>
                        <li class="mx-2"><a href="#">Explore</a></li>
                        <li class="mx-2"><a href="#">Features</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3 text-center icon">
                    <ul class="list-unstyled d-flex justify-content-end align-items-center">
                        <li class="mx-2"><a href="#" class="text-dark"><i class="bi bi-facebook"></i></a></li>
                        <li class="mx-2"><a href="#" class="text-dark"><i class="bi bi-twitter"></i></a></li>
                        <li class="mx-2"><a href="#" class="text-dark"><i class="bi bi-instagram"></i></a></li>
                        <li class="mx-2"><a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="row justify-content-center mt-2">
                <div class="col-md-6 text-center menu">
                    <ul class="list-unstyled d-flex justify-content-start align-items-center">
                        <li class="mx-2"><a href="#">@2024 dailog</a></li>
                        <li class="mx-2"><a href="#">Terms</a></li>
                        <li class="mx-2"><a href="#">Privacy</a></li>
                        <li class="mx-2"><a href="#">Cookies</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-center menu">
                    <ul class="list-unstyled d-flex justify-content-end align-items-center">
                        <li class="mx-2"><a href="#">For Designer</a></li>
                        <li class="mx-2"><a href="#">Tags</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->


    <!-- cdn bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>