<footer class="dark-footer skin-dark-footer">
    <div>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-4">
                    <div class="footer-widget">
                        <img src="{{ asset('img/sb-mock-logo.png') }}" class="img-footer" alt="" />
                        <div class="footer-add">
                            <p>Collins Street West, Victoria 8007, Australia.</p>
                            <p>+1 246-345-0695</p>
                            <p>info@example.com</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Navigations</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ url('/about') }}">About Us</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                            <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                @auth
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">My Account</h4>
                            <ul class="footer-menu">
                                <li><a href="{{ route('user-profile') }}">My Profile</a></li>
                                <li><a href="#">My Properties</a></li>
                                <li><a href="#">Favorites</a></li>
                            </ul>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">
                    <p class="mb-0">© 2021 {{ config('app.name') }}. All Rights Reserved</p>
                </div>

                <div class="text-right col-lg-6 col-md-6">
                    <ul class="footer-bottom-social">
                        <li><a href="#"><i class="ti-facebook"></i></a></li>
                        <li><a href="#"><i class="ti-twitter"></i></a></li>
                        <li><a href="#"><i class="ti-instagram"></i></a></li>
                        <li><a href="#"><i class="ti-linkedin"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
