<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        <a id="back2Top" class="top-scroll" title="Back to top" href="#" style="left: 20px"><i class="ti-arrow-up"></i></a>

        @auth
            @if (! Auth::user()->isOfType('admin'))
                <!-- GetButton.io widget -->
                <script type="text/javascript">
                    (function () {
                        var options = {
                            whatsapp: "+254707137687", // WhatsApp number
                            call_to_action: "Send Us a Message", // Call to action
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

        function initMap() {
            var mapErrorContainer = document.getElementById('map-error');
            var address = document.getElementById('listing_address').innerText;
            var addressTitle = document.getElementById('listing_name').innerText;
            var addressPostalCode = document.getElementById('listing_postcode').innerText;
            var geocoder = new google.maps.Geocoder();

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
            });

            geocoder.geocode({
                'address': address,
                componentRestrictions : {
                    country: 'UK',
                    postalCode: addressPostalCode
                }
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    mapErrorContainer.style.display = "none";
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        title: addressTitle
                    });
                } else {
                    const mapContainer = document.getElementById('map-container').style.display = "none";
                    // alert('Geocode was not successful for the following reasons: ' + status)
                }
            })
        }
    </script>

    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCisnVFSnc5QVfU2Jm2W3oRLqMDrKwOEoM&callback=initMap" defer></script>
    @livewireScripts
</body>

</html>
