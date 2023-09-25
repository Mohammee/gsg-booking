<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name'))</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/animate/animate.css') }}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/slick/slick-theme.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('siteassets/css/style.css') }}">

    {{-- Font Link --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <style>
        * {
            font-family: 'Almarai', sans-serif;
        }

        a {
            text-decoration: none
        }
    </style>
    @stack('styles')
</head>

<body id="body">

    <!-- Start Top Header Bar -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="contact-number">
                        <a href="tel:0129- 12323-123123" style="color:#333">
                            <i class="fas fa-phone"></i>
                            <span>0129- 12323-123123</span>
                        </a>

                        <br>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Site Logo -->
                    <div class="logo text-center">
                        <a href="{{ route('site.index') }}">
                            <!-- replace logo here -->
                            <img src="{{ asset('gsg.png') }}" style="height:150px; object-fit:contain" />
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Cart -->
                    <ul class="top-menu text-right list-inline">
                        <li>
                            <x-user-notification count="3" />
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="fs-5 btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
                            </form>

                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End Top Header Bar -->


    <!-- Main Menu Section -->
    <section class="menu">
        <nav class="navbar navigation">
            <div class="container">
                <div class="navbar-header">
                    <h2 class="menu-title">Main Menu</h2>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div><!-- / .navbar-header -->

                <!-- Navbar Links -->
                <div id="navbar" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="{{ route('site.index') }}">Home</a>
                        </li><!-- / Home -->

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="{{ route('site.about') }}">About</a>
                        </li><!-- / Home -->

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="{{ route('site.booking-requests') }}">Booking Requests</a>
                        </li><!-- / Home -->

                        <!-- Blog -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Office
                                spaces
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->role != 'user')
                                    <li><a href="{{ route('site.trainingHalls') }}">Training Hall</a>
                                @endif
                                <li><a href="{{ route('site.workspaces') }}">Workspaces</a>
                                </li>

                            </ul>
                        </li>



                    </ul>

                </div>
                <!--/.navbar-collapse -->
            </div><!-- / .container -->
        </nav>
    </section>

    @yield('content')

    <footer class="footer section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="social-media">
                        <li>
                            <a target="_blank" href="https://www.facebook.com/GazaSkyGeeks/">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.instagram.com/gazaskygeeks/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/GazaSkyGeeks">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright-text">Copyright &copy;{{ date('Y') }}, <a
                            href="https://gazaskygeeks.com/" target="_blank">Gaza Sky Geeks</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="{{ asset('siteassets/plugins/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('siteassets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap Touchpin -->
    <script src="{{ asset('siteassets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- Instagram Feed Js -->
    <script src="{{ asset('siteassets/plugins/instafeed/instafeed.min.js') }}"></script>
    <!-- Video Lightbox Plugin -->
    <script src="{{ asset('siteassets/plugins/ekko-lightbox/dist/ekko-lightbox.min.js') }}"></script>
    <!-- Count Down Js -->
    <script src="{{ asset('siteassets/plugins/syo-timer/build/jquery.syotimer.min.js') }}"></script>
    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="{{ asset('siteassets/plugins/themefisher-font/style.css') }}">
    <!-- slick Carousel -->
    <script src="{{ asset('siteassets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('siteassets/plugins/slick/slick-animation.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('siteassets/plugins/google-map/gmap.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('siteassets/js/script.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    @stack('scripts')
</body>


</html>
