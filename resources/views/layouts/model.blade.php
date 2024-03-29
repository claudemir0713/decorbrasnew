<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Decorbras</title>
        <link rel="shortcut icon" href=" {{ asset('img/favicon.png') }} ">
        <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!--external css-->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

        <script src="https://kit.fontawesome.com/a076d05399.js"></script>


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



        <!-- javascripts -->


        <script src="{{ asset('js/jquery.min.js')}}"></script>
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap4_5_0.min.js') }}"></script>

        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

        <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <!-- nice scroll -->
        <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/functions.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

        <!-- Chosen -->
        <script src="{{ asset('js/chosen.jquery.min.js') }}" type="text/javascript"></script>
        <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">

        <script src="{{ asset('ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('ckeditor/ckeditor/sample.js') }}" type="text/javascript"></script>

    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">
            <input type="hidden" name="appurl" id="appurl" value="{{ url('/') }}" >

            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
                        <i class="icon_menu"></i>
                    </div>
                </div>

                <!--logo start-->
                <a href="#" class="logo">
                    <img src=" {{asset('img/logo.png')}} " height="30"> &nbsp; &nbsp;
                    <i id="oculta">Decorbras</i>
                </a>
                <!--logo end-->

                <div class="top-nav notification-row">
                    <!-- notificatoin dropdown start-->
                    <ul class="nav pull-right top-menu">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="profile-ava">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="username"> {{ Auth::user()->name }} </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-door-open"> Sair</i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <!-- user login dropdown end -->
                    </ul>
                    <!-- notificatoin dropdown end-->
                </div>
            </header>
            <!--header end-->

            {!! $menu !!}
            <!--sidebar start-->

            <!--sidebar end-->
        </section>


        <section id="main-content" class="hover_content">
            <section class="wrapper">
                <div class="col-lg-12">
                    @yield('content')
            </section>
        </section>


    </body>

</html>
