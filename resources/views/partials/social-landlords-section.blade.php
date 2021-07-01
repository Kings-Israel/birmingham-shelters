<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-7">
                <div>
                    <span class="fs-6 font-weight-bold text-uppercase text-primary mb-2">Get started</span>
                    <h2>Social Landlords</h2>
                    <p class="lead">
                        If you are interested in listing available rooms in your property and represent a Registered Social Landlord, a Housing Association, a supported accommodation charity or if you are a landlord who:
                    </p>
                    <ul class="lead list-style">
                        <li>Complies with the relevant laws of quality standards and charter of rights</li>
                        <li>Accepts people on benefit.</li>
                        <li>Understands the needs of homeless people and the care, support or supervision that should be afforded to them to help them live as independently as possible.</li>
                    </ul>
                    @guest
                        <button class="btn btn-outline-theme-2 mt-2 mb-4" data-bs-toggle="modal" data-bs-target="#signup">Create an account</button>
                    @endguest

                    <div class="social-landlord font-weight-bold fs-5">
                        All room providers must be accredited by Birmingham City Council and or a government-registered Social landlord and meet our quality standards.
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <img src="{{ asset('img/for-sale-house.svg') }}" class="img-fluid" alt="" />
            </div>
        </div>
    </div>
</section>
