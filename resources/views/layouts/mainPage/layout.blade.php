<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Crowd Funding App</title>

		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">


		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('siteTemplate/css/style.css')}}">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('siteTemplate/css/responsive.css')}}">

        @stack('css')

		<!-- Fix Internet Explorer ______________________________________-->

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->

			
	</head>

    <body>

		<div class="main-page-wrapper">

			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>
            @include('layouts.mainPage.header')

            @yield('main-content')

            @include('layouts.mainPage.footer')

            <!-- Scroll Top Button -->
			<button class="scroll-top tran3s">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</button>

        </div>

        <!-- Optional JavaScript _____________________________  -->

    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="{{asset('siteTemplate/vendor/jquery.2.2.3.min.js')}}"></script>
		<!-- Popper js -->
		<script src="{{asset('siteTemplate/vendor/popper.js/popper.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('siteTemplate/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Camera Slider -->
		<script src='{{asset('siteTemplate/vendor/Camera-master/scripts/jquery.mobile.customized.min.js')}}'></script>
		<script src='{{asset('siteTemplate/vendor/Camera-master/scripts/jquery.easing.1.3.js')}}'></script>
		<script src='{{asset('siteTemplate/vendor/Camera-master/scripts/camera.min.js')}}'></script>
		<!-- Language Stitcher -->
		<script src="{{asset('siteTemplate/vendor/language-switcher/jquery.polyglot.language.switcher.js')}}"></script>
	    <!-- Mega menu  -->
		<script src="{{asset('siteTemplate/vendor/bootstrap-mega-menu/js/menu.js')}}"></script>
		<!-- WOW js -->
		<script src="{{asset('siteTemplate/vendor/WOW-master/dist/wow.min.js')}}"></script>
		<!-- owl.carousel -->
		<script src="{{asset('siteTemplate/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
		<!-- js count to -->
		<script src="{{asset('siteTemplate/vendor/jquery.appear.js')}}"></script>
		<script src="{{asset('siteTemplate/vendor/jquery.countTo.js')}}"></script>
		<!-- Fancybox -->
		<script src="{{asset('siteTemplate/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
		<!-- Social media Share -->
		<script src="{{asset('siteTemplate/js/social-share.js')}}"></script>

		<!-- Theme js -->
		<script src="{{asset('siteTemplate/js/theme.js')}}"></script>
    </body>
