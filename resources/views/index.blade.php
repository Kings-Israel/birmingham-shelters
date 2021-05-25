<x-app-layout pageTitle="Home">
    @include('partials.hero-banner')

    <div style="background-color:gray; padding-top: 10px; padding-bottom: 10px">
        <div class="container" style="text-align: center">
            <div class="row">
                <h2 class="index-page-text">About Us</h2>
                <div class="col-lg-6 col-md-12">
                    <h4 class="index-page-text">What we do</h4>
                    <p class="index-page-text">Everything we do is about people – whether that is ensuring we link the homeless persons with a a good quality, safe home or helping this vulnerable group of people to live an independent life. Birmingham Shelters links the various accommodation to homeless persons of all ages and difficulties or diagnoses in all sections of the Birmingham community. We provide a safe, secure platform to match-up Birmingham’s empty supported accommodation rooms with those who need them. We intend to help fill empty rooms as these rooms were not properly advertised before.</p>
                </div>
                <div class="col-lg-6 col-md-12">
                    <h4 class="index-page-text">Our Mission</h4>
                    <p class="index-page-text">Birmingham Shelters  provides a service that has been designed to address the homelessness crisis in the UK by linking persons impacted by homelessness with quality-assured supported accommodation.</p>
                    <h4 class="index-page-text">Our Vision</h4>
                    <p class="index-page-text">To become the best link up for homeless persons with rightly suited accommodation that meets the needs of the homeless and empower them to become more independent within the community.</p>
                </div>
            </div>
            <h2 class="index-page-text">Our Values</h2>
            <h4 class="index-page-text">Integrity</h4>
            <p class="index-page-text">Being honest and truthful with carrying out our tasks as we are working to meet the interests of the homeless persons and the social landlords. </p>
            <h4 class="index-page-text">Teamwork</h4>
            <p class="index-page-text">Bringing skilled people from various backgrounds together to attain the goal of reducing homelessness in Birmingham City.</p>
            <h4 class="index-page-text">Empowerment</h4>
            <p class="index-page-text">Empowering the homeless persons by matching them with the right accommodations that will seek to focus on their needs</p>
            <h4 class="index-page-text">Commitment</h4>
            <p class="index-page-text">Devoting ourselves to the great social goals that we want to attain within the community with regards to reduction of homelessness within the community.</p>
        </div>
    </div>

    @push('modals')
        @include('partials.login-modal')
        @include('partials.signup-modal')
    @endpush
</x-app-layout>

