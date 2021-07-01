<x-app-layout pageTitle="Reset">

    <!-- ============================ User Dashboard ================================== -->
    <section class="bg-light">
        <div class="container-fluid"> 
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h3>Set A New Password</h3></div>
        
                        <div class="card-body">

                            <form class="d-inline" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div>
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    <x-input-error for="email" />
                                </div>
                                <x-input-error for="email" />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="">
                                        <x-input-error for="password" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="">
                                        <x-input-error for="password_confirmation" />
                                    </div>
                                </div>
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
 
 