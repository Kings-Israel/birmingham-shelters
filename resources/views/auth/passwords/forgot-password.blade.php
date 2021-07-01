<x-app-layout pageTitle="Reset">
    
    <!-- ============================ User Dashboard ================================== -->
    <section class="bg-light">
        <div class="container-fluid"> 
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h3>Forgot Password</h3></div>
        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
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
 
 