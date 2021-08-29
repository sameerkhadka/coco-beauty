<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin | Coco Beauty</title>




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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                    <li class="{{ Request::segment(1)=='services' ? 'active' : '' }}">
                        <a href="{{ route('services') }}" title="Services" class="tooltips">
                            <img src="{{ asset('images/menu-icons/Services.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='members' ? 'active' : '' }}">
                        <a href="{{ route('members') }}" title="Members" class="tooltips">
                            <img src="{{ asset('images/menu-icons/members.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='appointments' ? 'active' : '' }}">
                        <a href="{{ route('appointments') }}" title="Appointment" class="tooltips">
                            <img src="{{ asset('images/menu-icons/Appointment.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='transactions' ? 'active' : '' }}">
                        <a href="{{ route('transactions') }}" title="Transaction" class="tooltips">
                            <img src="{{ asset('images/menu-icons/transaction.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='gift-vouchers' ? 'active' : '' }}">
                        <a href="{{ route('gift-vouchers') }}" title="Gifts Voucher" class="tooltips">
                            <img src="{{ asset('images/menu-icons/Gift Voucher.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='promotions' ? 'active' : '' }}">
                        <a href="{{ route('promotions') }}" title="Promotions" class="tooltips">
                            <img src="{{ asset('images/menu-icons/promotion.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="{{ Request::segment(1)=='birthdays' ? 'active' : '' }}" >
                        <a href="{{ route('birthdays') }}" title="Birthday" class="tooltips">
                            <img src="{{ asset('images/menu-icons/birthday.svg') }}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        @yield('main')
    </section>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{--    <script src="{{ asset('js/cart.js') }}"></script>--}}

    @yield('js')
    @stack('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "300",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        window.addEventListener('from-backend', function(e) {
            if (e.detail.is == 'alert') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed')
                    }
                })
            }
            if (e.detail.is == 'toastr') {
                toastr[e.detail.type](e.detail.message);
            }
        })

    </script>
</body>

</html>
