<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Autentikasi Dailog</title>
    <link rel="stylesheet" href="{{ asset('web/mycss/auth.css') }}" />
    <!-- link favicon -->
    <link rel="shortcut icon" href="{{ asset('web/img/home-nl/logoo.svg') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form method="POST" action="{{ route('login') }}" class="sign-in-form">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('web/img/home-nl/logoo.svg') }}" alt="pixsphere" />
                        </div>
                        <div class="heading">
                            <h2>Sign In Here !</h2>
                            <h6> Enter your login details to proceed on your journey.</h6>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="email" minlength="4" class="input-field @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="off" required />
                                <label>Email</label>
                            </div>
                            @error('email')
                            <span style="color: red;font-weight: 500;margin-bottom: 15px">{{ $message }}</span>
                            @enderror

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="off" required />
                                <label>Password</label>
                            </div>
                            @error('password')
                            <span style="color: red;font-weight: 500;margin-bottom: 15px">{{ $message }}</span>
                            @enderror

                            <div class="kotak"
                                style="margin-top: -10px;color:#bbb;font-size:12px;display: flex;gap: 3px;">
                                <input type="checkbox" id="passwordVisibilityCheckbox">
                                <span class="material-symbols-outlined"
                                    style="color:#bbb;font-size: 1.2rem; text-align: center;">visibility_off</span>
                            </div>

                            <div class="button" style="display: flex;gap: 5px;">
                                <input type="submit" value="Sign In" class="sign-btn" />
                                <div class="sign-btn1">
                                    <img src="{{ asset('web/img/image 6.png') }}" alt="" width="20px">Google
                                </div>
                            </div>

                            <div class="heading">
                                <h6>Not registered yet?
                                    <a href="{{ route('register')}}" class="toggle">Sign Up</a></h6>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('register') }}" autocomplete="off" class="sign-up-form">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('web/img/home-nl/logoo.svg') }}" alt="pixsphere" />
                        </div>

                        <div class="heading">
                            <h2 style="font-size: 25px;">Sign Up Here !</h2>
                            <h6>Let's begin your journey by creating your account</h6>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="name" minlength="4" class="input-field" autocomplete="off" required />
                                <label>name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="text" name="username" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Username</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" name="email" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password_confirmation" class="input-field">
                                <label>confirm Password</label>
                            </div>

                            <div class="kotak"
                                style="margin-top: -10px;color:#bbb;font-size:12px;display: flex;gap: 3px;">
                                <input type="checkbox" id="passwordVisibilityCheckbox1">
                                <span class="material-symbols-outlined"
                                    style="color:#bbb;font-size: 1.2rem; text-align: center;">visibility_off</span>
                            </div>

                            <div class="button" style="display: flex;gap: 5px;">
                                <input type="submit" value="Sign Up" class="sign-btn" />
                                <div class="sign-btn1">
                                    <img src="{{ asset('web/img/image 6.png') }}" alt="" width="20px">Google
                                </div>
                            </div>

                            <div class="heading">
                                <h6>Already have an account?
                                    <a href="#" class="toggle">Sign In</a></h6>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="{{ asset('web/img/auth/advertising-5-83.svg') }}" class="image img-1 show" alt="" />
                        <img src="{{ asset('web/img/auth/social-media-1-63.svg') }}" class="image img-2" alt="" />
                        <img src="{{ asset('web/img/auth/marketing-20.svg') }}" class="image img-3" alt="" />
                    </div>

                    <div class="text-slider1">
                        <div class="text-wrap1">
                            <div class="text-group1">
                                <h2>Great to See You Here</h2>
                                <h2>Customize as you like</h2>
                                <h2>Let's get started</h2>
                            </div>
                        </div>
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Welcome! Ready to continue your journey?</h2>
                                <h2>Please enter your credentials to access your account</h2>
                                <h2> Let's start exploring photos!</h2>
                            </div>
                        </div>
                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const checkbox = document.getElementById('passwordVisibilityCheckbox');
        const icon = document.querySelector('.kotak .material-symbols-outlined');
        const passwordInput = document.querySelector('.input-wrap input[type="password"]');
        checkbox.addEventListener('click', function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "visibility";
            } else {
                passwordInput.type = "password";
                icon.textContent = "visibility_off";
            }
        });

        const checkbox1 = document.getElementById('passwordVisibilityCheckbox1');
        const icon1 = document.querySelector('.kotak .material-symbols-outlined');
        const passwordInputt = document.querySelector('.sign-up-form .input-wrap input[type="password"]');
        checkbox1.addEventListener('click', function () {
            if (passwordInputt.type === "password") {
                passwordInputt.type = "text";
                icon1.textContent = "visibility";
            } else {
                passwordInputt.type = "password";
                icon1.textContent = "visibility_off";
            }
        });
    </script>
    
    

    <script src="{{ asset('web/js/app.js') }}"></script>
</body>

</html>