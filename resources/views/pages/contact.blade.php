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
                    
                    <form action="{{ route('contact.form.submit') }}" method="post">
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
    
                        <div class="form-group">
                            <button class="btn btn-theme-light-2 rounded" type="submit">Submit Request</button>
                        </div>
                        
                    </div>
                </form>

                <div class="col-lg-5 col-md-5">
                    <div class="contact-info">

                        <h2>Get In Touch</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. </p>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-home"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Reach Us</h4>
                                2512, New Market,<br>Eliza Road, Sincher 80 CA,<br>Canada, USA
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Drop A Mail</h4>
                                support@Rikada.com<br>Rikada@gmail.com
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Call Us</h4>
                                (41) 123 521 458<br>+91 235 548 7548
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /row -->

        </div>

    </section>
    <!-- ============================ Agency List End ================================== -->
</x-app-layout>
