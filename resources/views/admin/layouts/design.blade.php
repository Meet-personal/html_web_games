<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{$model ?? 'Dashboard'}} | Dream games</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.svg ')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.2.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <!-- *************
			************ CSS Files *************
		************* -->
    <link rel="stylesheet" href="{{asset('/assets/fonts/bootstrap/bootstrap-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/css/main.min.css')}}" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->
    <!-- tool -->

    <!--  -->
    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />

    <!-- Toastify CSS -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/toastify/toastify.css')}}" />


    <!-- select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- App header starts -->
        @include('admin.layouts.header')
        <!-- App header ends -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Sidebar wrapper start -->
            @include('admin.layouts.sidebar')
            <!-- Sidebar wrapper end -->

            <!-- App container starts -->
            <div class="app-container">
                <!-- App hero header starts -->
                @include('admin.layouts.burger')
                <!-- App body starts -->
                <div class="app-body">
                    @yield('body')
                </div>
                <!-- App body ends -->

                <!-- App footer start -->
                @include('admin.layouts.footer')
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
			************ JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/js/moment.min.js')}}"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{asset('/assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

    <!-- Toastify JS -->
    <script src="{{asset('/assets/vendor/toastify/toastify.js')}}"></script>
    <script src="{{asset('/assets/vendor/toastify/custom.js')}}"></script>

    <!-- Apex Charts -->
    <!-- <script src="{{asset('/assets/vendor/apex/apexcharts.min.js')}}"></script>
		<script src="{{asset('/assets/vendor/apex/custom/dash1/visitors.js')}}"></script>
		<script src="{{asset('/assets/vendor/apex/custom/dash1/sales.js')}}"></script>
		<script src="{{asset('/assets/vendor/apex/custom/dash1/sparkline.js')}}"></script>
		<script src="{{asset('/assets/vendor/apex/custom/dash1/tasks.js')}}"></script>
		<script src="{{asset('/assets/vendor/apex/custom/dash1/income.js')}}"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Include jQuery from CDN -->
    <!-- Include DataTables JS from CDN -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- Include Bootstrap JS if needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS files -->
    <script src="{{asset('/assets/js/custom.js')}}"></script>
    <script src="{{asset('/assets/js/todays-date.js')}}"></script>

    <!-- Load OverlayScrollbars -->
    <script src="{{asset('/assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

    <!-- select2 -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> -->


    <!-- tool -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->



    <!-- select2 -->
<!-- end -->
    @stack('scripts')
</body>

</html>
