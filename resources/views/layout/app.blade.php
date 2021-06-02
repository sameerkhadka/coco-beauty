<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Coco Beauty</title>




    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

</head>

<body>

    <section class="wrapper">
        <div class="sidenav">
            <div class="logo">
                <a href=""><img src="{{ asset('images/logo-white.png') }}" alt=""> </a>
            </div>

            <div class="navigation">
                <ul>
                    <li class="active"><a href=""><img src="{{ asset('images/menu-icons/services.svg') }}" alt=""> </a></li>
                    <li><a href=""><img src="{{ asset('images/menu-icons/members.svg') }}" alt=""> </a></li>
                    <li><a href=""><img src="{{ asset('images/menu-icons/aoointment.svg') }}" alt=""> </a></li>
                    <li><a href=""><img src="{{ asset('images/menu-icons/transaction.svg') }}" alt=""> </a></li>
                    <li><a href=""><img src="{{ asset('images/menu-icons/gift.svg') }}" alt=""> </a></li>
                    <li><a href=""><img src="{{ asset('images/menu-icons/birthday.svg') }}" alt=""> </a></li>
                </ul>
            </div>
        </div>

        @yield('main')
    </section>



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')
</body>
</html>
