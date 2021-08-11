<section class="bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-5">
                <img src="{{ asset('assets/img/helping_homeless.png') }}" class="img-fluid" alt="" />
            </div>

            <div class="col-lg-7 col-md-7">
                <div>
                    <span class="fs-6 font-weight-bold text-uppercase text-primary mb-2">Get started</span>
                    <h2>Homeless Persons</h2>

                    <div class="lead">
                        <p>If you are homeless and from Birmingham, we are looking forward to assisting you find a safe and secure room in a quality supported accommodation that is suitable for your needs.</p>
                        <p>
                            New rooms are added onto the website frequently and rooms become available quite often, but how soon you will receive a match is dependent upon the areas you have chosen. The best way to get one of the rooms on our website is to register below by filling out the form. <strong>Please fill it out in as much detail as you can, as this will assist us find you tailored support.</strong> After the form is filled out, we will reach out to you via the contacts provided by you and let you know when a room that meets your needs becomes available.
                        </p>
                    </div>
                    @guest
                        <button class="btn btn-outline-theme-2 mt-2 mb-4" data-bs-toggle="modal" data-bs-target="#signup">Get Started</button>
                    @endguest
                </div>
            </div>

        </div>
    </div>
</section>
