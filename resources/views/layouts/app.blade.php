<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if($pageTitle)
        {{ $pageTitle }} | {{ config('app.name') }}
        @else
        {{ config('app.name') }}
        @endif
    </title>

    <!-- Template Theme CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="assets/css/colors.css" rel="stylesheet">

    @livewireScripts()

    @stack('styles')
</head>

<body class="blue-skin">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>

    <div id="main-wrapper">
        @include('partials.navigation')

        {{ $slot }}

        @include('partials.footer')

        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
    </div>

    @stack('modals')

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/rangeslider.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/slider-bg.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/imagesloaded.js"></script>

    <script src="assets/js/custom.js"></script>

    @livewireScripts()

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    @stack('scripts')
</body>

</html>
