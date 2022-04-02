<x-app-layout>
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <x-page-title title="Contact Us" description="How to find or reach us" />

    <!-- ============================ Agency List Start ================================== -->
    <section class="bg-light">

        <div class="container">

            <!-- row Start -->
            <div class="row">

                <div class="col-lg-7 col-md-7">

                    <form action="{{ route('contact') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="message_contact_name" class="form-control simple" value="{{ old('message_contact_name') }}">
                                    <x-input-error for="message_contact_name" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="message_contact_email" class="form-control simple" value="{{ old('message_contact_email') }}">
                                    <x-input-error for="message_contact_email" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="message_contact_subject" class="form-control simple" value="{{ old('message_contact_subject') }}">
                            <x-input-error for="message_contact_subject" />
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control simple" name="message_contact">{{ old('message_contact') }}</textarea>
                            <x-input-error for="message_contact" />
                        </div>
                        <input type="hidden" name="recaptcha" id="recaptcha">
                        <div class="form-group">
                            <button class="btn btn-theme-light-2 rounded" type="submit">Submit Message</button>
                        </div>

                    </div>
                </form>

                <div class="col-lg-5 col-md-5">
                    <div class="contact-info">

                        <h2>Get In Touch</h2>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-home" style="color: brown"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Reach Us</h4>
                                Charity House, High Street,<br>Coleshill,<br>Birmingham, B46 3BP
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-email" style="color: brown"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Drop A Mail</h4>
                                <a style="color: #2D3954" class="link link-primary" href="mailto:info@birminghamshelters.co.uk">info@birminghamshelters.co.uk</a>
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-mobile" style="color: brown"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Call Us</h4>
                                (44) 7450 310532
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /row -->

        </div>

    </section>
    <!-- ============================ Agency List End ================================== -->
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
        <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'contact'}).then(function(token) {
                        if (token) {
                        document.getElementById('recaptcha').value = token;
                        }
                    });
                });
        </script>
    @endpush
</x-app-layout>
