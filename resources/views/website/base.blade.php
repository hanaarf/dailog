<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dailog</title>
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

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('style')

</head>

<body>
    <!-- navbar -->
    <section class="navbar-dailog">
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container-fluid pt-2 pb-2" id="navbarTogglerDemo02">
                <div class="d-flex gap-2 logo ps-5">
                    <img src="{{ asset('web/img/home-nl/logodai.svg') }}" alt="">
                    <a class="navbar-brand" href="#">Dailog</a>
                </div>
                <form action="{{ route('user.search') }}" method="POST" class="d-flex align-items-center me-auto ps-5 pe-3" role="search">
                    @csrf
                    <div class="position-relative w-100">
                        <input type="text" name="search" class="form-control ps-4 pe-5" placeholder="Search" aria-label="Search">
                        <span
                            class="position-absolute top-50 end-0 translate-middle-y me-3 text-white rounded-circle p-2">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end pe-5" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('user.create.post') }}"><i
                                    class="fa-regular fa-pen-to-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-regular fa-bell"></i></a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown" style="display: flex;align-items: center;gap: 8px;">
                                <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    style="display: flex;align-items: center;gap: 8px;border: none;">
                                    <div class="img-prof">
                                        @if(Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="User Image"
                                            width="40px">
                                        @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}"
                                            alt="User Avatar" width="40px">
                                        @endif
                                    </div>
                                    <p style="margin-top: 14px;cursor: pointer;"> {{ Auth::user()->username }}</p>
                                </button>
                                <ul class="dropdown-menu">
                                    <p style="font-size: 14px;font-weight: 600;padding: 10px;color: #959396;">Welcome
                                        hanaarf !</p>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                            <i class="fa-regular fa-user text-grey"></i> 
                                            Profile
                                        </a>
                                    </li>
                                    <hr>
                                    <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                                width="18" height="18" viewbox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            Logout
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <!-- end navbar -->

    <!-- main body -->
    @yield('main')
    <!-- end main body -->

    <!-- footer -->
    <footer class="footer bg-white py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('web/img/home-nl/logoo.svg') }}" alt="Logo" class="footer-logo"
                        style="width: 120px;">
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

    @yield('script')
</body>

</html>
