<!DOCTYPE html>
<html lang="en">
<head>
    <title>Andrea - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/animate.css">

    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/magnific-popup.css">

    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/aos.css">

    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/ionicons.min.css">

    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/flaticon.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/icomoon.css">
    <link rel="stylesheet" href="/themes/{{ currentTheme() }}/css/style.css">
</head>
<body>

<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight">
        {!! renderMenu(1); !!}

        <div class="colorlib-footer">
            <p class="pfooter">
                Copyright &copy;{{ date('Y') }} All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            </p>
        </div>
    </aside>
    <div id="colorlib-main">
        <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-xl-8 py-5 px-md-5">
                        @yield('content')
                    </div>
                    <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                        @include('themes.'.currentTheme().'.layouts.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<script src="/themes/{{ currentTheme() }}/js/jquery.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/popper.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/bootstrap.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery.easing.1.3.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery.waypoints.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery.stellar.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/owl.carousel.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery.magnific-popup.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/aos.js"></script>
<script src="/themes/{{ currentTheme() }}/js/jquery.animateNumber.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/scrollax.min.js"></script>
<script src="/themes/{{ currentTheme() }}/js/google-map.js"></script>
<script src="/themes/{{ currentTheme() }}/js/main.js"></script>

</body>
</html>
