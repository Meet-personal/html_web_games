<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from gameplex-final.vercel.app/gameplex-v2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Nov 2024 09:07:05 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/assets/frontend/images/freewebsgames.webp') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/frontend/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/frontend/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/frontend/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/assets/frontend/images/site.webmanifest') }}">

    <title>Home - FreeWebsGames</title>
    <link rel="stylesheet" href="{{ asset('frontend-new/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-new/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <!-- fafa -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <span></span>
        </div>
    </div>

    <!-- cursor effect-->
    <div class="cursor"></div>
    <!-- Header area  -->
    @include('frontend-new.layouts.header')


    <main class="main-container container-fluid d-flex pt-20 px-0 position-relative">
        @include('frontend-new.layouts.sidebar')


        <article class="main-content">
            @yield('body')

            @include('frontend-new.layouts.ads')
            @include('frontend-new.layouts.footer')

        </article>

    </main>
    @stack('scripts')
    <!-- ==== js dependencies start ==== -->
    <!-- jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- gsap  -->
    <script src="{{ asset('frontend-new/js/gsap.min.js') }}"></script>
    <!-- gsap scroll trigger -->
    <script src="{{ asset('frontend-new/js/ScrollTrigger.min.js') }}"></script>
    <!-- lenis  -->
    <script src="{{ asset('frontend-new/js/lenis.min.js') }}"></script>
    <!-- gsap split text -->
    <script src="{{ asset('frontend-new/js/SplitText.min.js') }}"></script>
    <!-- tilt js -->
    <script src="{{ asset('frontend-new/js/vanilla-tilt.js') }}"></script>

    <!-- scroll magic -->
    <script src="{{ asset('frontend-new/js/ScrollMagic.min.js') }}"></script>
    <!-- animation.gsap -->
    <script src="{{ asset('frontend-new/js/animation.gsap.min.js') }}"></script>
    <!-- gsap customization  -->
    <script src="{{ asset('frontend-new/js/gsap-customization.js') }}"></script>
    <!-- apex chart  -->
    <script src="{{ asset('frontend-new/js/apexcharts.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('frontend-new/js/swiper-bundle.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend-new/js/bootstrap.bundle.min.js') }}"></script>
    <!-- main js  -->

    <script src="{{ asset('frontend-new/js/main.js') }}"></script>
</body>


<!-- Mirrored from gameplex-final.vercel.app/gameplex-v2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Nov 2024 09:07:13 GMT -->

</html>
