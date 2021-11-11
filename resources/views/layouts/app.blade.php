<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>
        @if($pageTitle)
        {{ $pageTitle }} | {{ config('app.name') }}
        @else
        {{ config('app.name') }}
        @endif
    </title>

    <!-- Template Theme CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet">

    <!-- Custom  CSS -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <script defer>
        var BASE_URL = '{!! url('/') !!}';
    </script>

    @livewireStyles

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

        @auth
            @if (! Auth::user()->isOfType('admin'))
                <!-- GetButton.io widget -->
                <script type="text/javascript">
                    (function () {
                        var options = {
                            whatsapp: "+44 7450 310532", // WhatsApp number
                            call_to_action: "Reach Us on Whatsapp", // Call to action
                            position: "right", // Position may be 'right' or 'left'
                        };
                        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
                        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
                        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
                        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
                    })();
                </script>
                <!-- /GetButton.io widget -->
            @endif
        @endauth

        <a id="back2Top" class="top-scroll" title="Back to top" href="#" style="left: 20px"><i class="ti-arrow-up"></i></a>

    </div>

    @include('partials.login-modal')
    @include('partials.signup-modal')
    @stack('modals')

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/slider-bg.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    @stack('scripts')
    <script>
        function openFilterSearch() {
            document.getElementById("filter_search").style.display = "block";
        }
        function closeFilterSearch() {
            document.getElementById("filter_search").style.display = "none";
        }
        $(function () {
            $(".alert").delay(5000).slideUp(300);
        })

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if(dd<10){
        dd='0'+dd
        }
        if(mm<10){
        mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        let date_fields = document.querySelectorAll("#date");
        date_fields.forEach(field => {
            field.setAttribute("max", today);
        });

        $(function() {
            var tomorrow = new Date();
            $('#assessment-date').attr('min', today)
        })

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
                }
            }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });

        function forceKeyPressUppercase(e)
        {
            var charInput = e.keyCode;
            if((charInput >= 97) && (charInput <= 122)) { // lowercase
            if(!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
                var newChar = charInput - 32;
                var start = e.target.selectionStart;
                var end = e.target.selectionEnd;
                e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
                e.target.setSelectionRange(start+1, start+1);
                e.preventDefault();
            }
            }
        }

        document.getElementById('applicant_ni_number').addEventListener('keypress', forceKeyPressUppercase, false)
    </script>

    @livewireScripts
</body>

</html>
