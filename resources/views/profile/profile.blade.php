<x-app-dashboard-layout :pageTitle="$user->full_name">
    <section class="bg-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">

                    <div class="property_block_wrap style-4">
                        <div class="prt-detail-title-desc">
                            <h3 class="text-light">{{ $user->full_name }}</h3>
                            <span>{{ $user->email }}</span>
                            <p class="prt-price-fix"><strong id="listing_postcode">+{{ $user->phone_number }}</strong>
                            </p>
                        </div>
                    </div>

                </div>
                
            </div>
            
        </div>
    </section>
    <br>
    @if ($errors->any())
        {{ $errors }}
    @endif
    <div class="dashboard-wraper">
		<form action="{{ route('profile.update') }}" method="post">
            @csrf
        
        <div class="form-submit">	
            <h4>My Account</h4>
            <div class="submit-section">
                <div class="row">
                
                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                        @error('first_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                        @error('last_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="form-submit">	
            <h4>Change Password</h4>
            <div class="submit-section">
                <div class="row">
                
                    <div class="form-group col-md-12">
                        <label>Current Password</label>
                        <input type="password" name="old_password" class="form-control" value="">
                        @error('old_password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" value="">
                        @error('new_password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" value="">
                        @error('password_confirmation')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group col-lg-12 col-md-12">
                        <button class="btn btn-theme-light-2 rounded" type="submit">Save Changes</button>
                    </div>
                    
                </div>
            </div>
        </div>

        </form>
        
    </div>
</x-app-dashboard-layout>