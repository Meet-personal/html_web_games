<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <link rel="shortcut icon" href="{{asset('/assets/frontend/images/freewebsgames.webp')}}" type=" image/x-icon">
    <title>Home - Free Webs Games</title>
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/frontend/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <link rel="stylesheet" href="{{asset('/assets/fonts/tabler-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/frontend/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
<!-- fafa -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <!-- slider -->
    <!--  badch-->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->


<!-- google add link -->
{{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8909269798689347"
     crossorigin="anonymous"></script> --}}


</head>
<body>
    <!-- header -->
    @include('frontend.layouts.header')
    <!-- end header -->
    <main class="main-container container-fluid d-flex pt-20 px-0 position-relative">

        @include('frontend.layouts.sidebar')

        <article class="main-content">
            @yield('body')
            <!-- App footer start -->
            @include('frontend.layouts.footer')
            <!-- App footer end -->
        </article>
    </main>
    <!-- ==== js dependencies start ==== -->
    <!-- jquery  -->
    <script src="{{asset('/assets/js/frontend/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js" integrity="sha512-9CWGXFSJ+/X0LWzSRCZFsOPhSfm6jbnL+Mpqo0o8Ke2SYr8rCTqb4/wGm+9n13HtDE1NQpAEOrMecDZw4FXQGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- gsap  -->
    <script src="{{asset('/assets/js/frontend/gsap.min.js')}}"></script>
    <!-- gsap scroll trigger -->
    <script src="{{asset('/assets/js/frontend/ScrollTrigger.min.js')}}"></script>
    <!-- lenis  -->
    <script src="{{asset('/assets/js/frontend/lenis.min.js')}}"></script>
    <!-- gsap split text -->
    <script src="{{asset('/assets/js/frontend/SplitText.min.js')}}"></script>
    <!-- tilt js -->
    <script src="{{asset('/assets/js/frontend/vanilla-tilt.js')}}"></script>

    <!-- scroll magic -->
    <script src="{{asset('/assets/js/frontend/ScrollMagic.min.js')}}"></script>
    <!-- animation.gsap -->
    <script src="{{asset('/assets/js/frontend/animation.gsap.min.js')}}"></script>
    <!-- gsap customization  -->
    <script src="{{asset('/assets/js/frontend/gsap-customization.js')}}"></script>
    <!-- apex chart  -->
    <script src="{{asset('/assets/js/frontend/apexcharts.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('/assets/js/frontend/swiper-bundle.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('/assets/js/frontend/bootstrap.bundle.min.js')}}"></script>
    <!-- main js  -->
    <script src="{{asset('/assets/js/frontend/main.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- slider -->
<script src="{{asset('/assets/js/frontend/popper.min.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>



@stack('scripts')
</body>
</html>
