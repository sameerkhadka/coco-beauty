<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Coco Beauty</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>

<body>

    <section class="login-body">
        <div class="login-wrap">
            <div class="login-form ">
                <div class="lg-head">
                    <img src="./images/logo-icon.png" alt="">
                </div>

                <div class="login">
                    <div class="login-card">
                        <span>E-mail</span>
                        <input class="input-text" type="text" placeholder="username">
                    </div>

                    <div class="login-card">
                        <span>Password</span>
                        <input class="input-text" type="password" placeholder="password">
                    </div>

                    <div class="login-card">
                        <input type="checkbox" name="remember">
                        <label for="remember">Remember me</label>
                    </div>

                    <button>Sign In</button>
                </div>
            </div>

            <div class="login-img">
                <img src="./images/coco-bg.jpg" alt="">
            </div>
        </div>
    </section>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

</body>

</html>
