<x-app-layout pageTitle="Reset">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible flash">
        <p>{{ session('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('success'))
    <div class="alert alert-success alert-dismissible flash">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <!-- ============================ User Dashboard ================================== -->
    <section class="bg-light">
        <div class="container-fluid"> 
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h3>Forgot Password</h3></div>
        
                        <div class="card-body">
                            {{ __('Please enter your email address.') }}

                            <form class="d-inline" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <x-input-error for="email" />
                                <br>
                                <button type="submit" class="btn btn-theme">{{ __('Submit') }}</button>.
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- ============================ User Dashboard End ================================== -->
 
 </x-app-layout>
 
 