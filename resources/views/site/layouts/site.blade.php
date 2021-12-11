<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>@yield('title', 'E-commerce')</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/magnific-popup.min.css') }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/font-awesome.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/jquery.fancybox.min.css') }}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/themify-icons.css') }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/niceselect.css') }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/animate.css') }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/flex-slider.min.css') }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl-carousel.css') }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/slicknav.min.css') }}">

	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset('assets/site/css/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/site/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/responsive.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    @stack('css')

</head>

@include('site.includes/header')

@yield('content')

@include('site.includes/footer')

<!-- Jquery -->
    <script src="{{ asset('assets/site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery-migrate-3.0.0.js') }}"></script>
	<script src="{{ asset('assets/site/js/jquery-ui.min.js') }}"></script>
	<!-- Popper JS -->
	<script src="{{ asset('assets/site/js/popper.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
	<!-- Color JS -->
	<script src="{{ asset('assets/site/js/colors.js') }}"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset('assets/site/js/slicknav.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('assets/site/js/owl-carousel.js') }}"></script>
	<!-- MagnificPopup JS -->
	<script src="{{ asset('assets/site/js/magnific-popup.js') }}"></script>
	<!-- Waypoints JS -->
	<script src="{{ asset('assets/site/js/waypoints.min.js') }}"></script>
	<!-- Countdown JS -->
	<script src="{{ asset('assets/site/js/finalcountdown.min.js') }}"></script>
	<!-- Nice Select JS -->
	<script src="{{ asset('assets/site/js/nicesellect.js') }}"></script>
	<!-- Flex Slider JS -->
	<script src="{{ asset('assets/site/js/flex-slider.js') }}"></script>
	<!-- ScrollUpJS -->
	<script src="{{ asset('assets/site/js/scrollup.js') }}"></script>
	<!-- OnepageNav JS -->
	<script src="{{ asset('assets/site/js/onepage-nav.min.js') }}"></script>
	<!-- Easing JS -->
	<script src="{{ asset('assets/site/js/easing.js') }}"></script>
	<!-- Active JS -->
	<script src="{{ asset('assets/site/js/active.js') }}"></script>
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
    @stack('js')
</body>
</html>
