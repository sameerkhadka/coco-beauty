<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Me | Coco Beauty</title>

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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>

<body>


    <section class="main-wrap">
        <div class="mn-head">
            <img src="./images/logo.png" alt="">
        </div>

        <div class="mn-card-wrap">

            <div class="mn-card">
                <a href="{{ route('services') }}">
                    <img src="./images/menu-icons/servicesbg.png" alt="">
                    Services
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('members') }}">
                    <img src="./images/menu-icons/membersbg.png" alt="">
                    Members
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('appointments') }}">
                    <img src="./images/menu-icons/appointmentbg.png" alt="">
                    Appointment
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('transactions') }}">
                    <img src="./images/menu-icons/transactionbg.png" alt="">
                    Transaction
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('gift-vouchers') }}">
                    <img src="./images/menu-icons/giftvoucher.png" alt="">
                    Gift Voucher
                </a>
            </div>

            <div class="mn-card">
                <a href="promotions">
                    <img src="./images/menu-icons/promotionbg.png" alt="">
                    Promotion
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('birthdays') }}">
                    <img src="./images/menu-icons/birthdaybg.png" alt="">
                    Birthday
                </a>
            </div>

            <div class="mn-card">
                <a href="{{ route('crud.services') }}">
                    <img src="./images/menu-icons/settingbg.png" alt="">
                    Settings
                </a>
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
