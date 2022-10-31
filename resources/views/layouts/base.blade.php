<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restaurant mgt sys</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->

    {{-- <link href="assets/https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS File -->
    <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    {{-- <link rel="stylesheet" href="build/assets/app.b00e971d.css"> --}}
    <link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    {{-- <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet"> --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body style=" margin: 0; padding: 0;">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}">
                <h2>Restaurant Food Service Management System</h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer-order') }}">Menu</a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->user_type === 'ADM')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Account ({{ Auth::user()->name }})
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('admin.menus') }}"><i
                                                class="fa fa-tachometer"></i> Menu</a>
                                        <a class="dropdown-item" href="{{ route('admin.tables') }}"><i
                                                class="fa fa-image"></i> Table</a>
                                        <a class="dropdown-item" href="{{ route('admin.orders') }}"> <i
                                                class="fa fa-book"></i> Orders</a>
                                        <hr>
                                        <i class="fa fa-sign-out"></i> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf

                                        </form>
                                    </div>
                                </li>
                            @elseif (Auth::user()->user_type === 'USR')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}"
                                        href="{{ route('cart') }}">Cart
                                        <span class="badge badge-pill bg-primary text-white cart-count">0</span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Account ({{ Auth::user()->name }})
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        {{-- <a class="dropdown-item" href=""><i class="fa fa-tachometer"></i> Make Order</a> --}}
                                        <a class="dropdown-item" href="{{ route('my-orders') }}"><i class="fa fa-book"></i>
                                            Order History</a>
                                        <i class="fa fa-sign-out"></i> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf

                                        </form>
                                    </div>
                                </li>
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    @yield('content')

    <br><br><br>
    <div class="copyright p-3 text-center fixed-bottom">
        &copy; 2022 Copyright: <span class="copyright-b">Restaurant Food Service Management System</span>
    </div>

    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/jquery/jquery-migrate.min.js"></script>
    <script src="assets/lib/popper/popper.min.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/lib/scrollreveal/scrollreveal.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="assets/contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="assets/js/main.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function scrollToTop() {
            window.scrollTo(0, 0);
        }
    </script>
    <script>
        $('.menu-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $(document).ready(function() {
            loadcart();

            function loadcart() {
                $.ajax({
                    method: "GET",
                    url: "/load-cart-data",
                    success: function(response) {
                        $('.cart-count').html('');
                        $('.cart-count').html(response.count);
                    }

                });

            }

        });
    </script>

</body>

</html>
