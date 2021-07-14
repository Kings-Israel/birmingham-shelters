
<div class="image-cover hero-banner light-text" style="background:#2CA9E3 url({{ asset('assets/img/banner-7.png') }}) no-repeat;">
    <div class="container">
        <div class="simple-search-wrap">
            <div class="hero-search-2">
                <h2 class="mb-4">Birmingham Shelters</h2>
                <p class="lead" style="font-weight: 900">
                    Where we link those impacted by homelessness with quality-assured supported accommodation. @guest Join the platform as either a landlord or a room seeker @endguest
                <p>
                    <div class="mt-4">
                        @guest
                        <button class="btn btn-black" data-bs-toggle="modal" data-bs-target="#signup" style="background-color: #F6B833; color: #000">Get started</button>
                        @endguest
                        <a href="{{ route('listing.all') }}">
                            <button class="btn btn-black" style="background-color: #F6B833; color: #000">View Rooms</button>
                        </a>
                        @guest
                        <p class="mt-2">
                            Already registred? <a class="" style="font-weight: 900" href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login">Sign In</a>
                        </p>
                        @endguest
                    </div>
            </div>
        </div>

    </div>
</div>
<!-- ============================ Hero Banner End ================================== -->
