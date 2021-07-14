<!-- Sign Up Modal -->
<div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">Sign Up</h4>
                <div class="login-form">
                    <form method="POST" id="register-form" action="{{ route('register') }}">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                        <i class="ti-user"></i>
                                    </div>
                                    <span id="first_nameError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                        <i class="ti-user"></i>
                                    </div>
                                    <span id="last_nameError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        <i class="ti-email"></i>
                                    </div>
                                    <span id="emailError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="tel" class="form-control" id="phone_number_input" name="phone_number" placeholder="123 546 5847" onfocus="showIntNumber()" required>
                                        <i class="lni-phone-handset"></i>
                                    </div>
                                    <span id="phone_numberError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                        <i class="ti-unlock"></i>
                                    </div>
                                    <span id="passwordError">
                                        <strong></strong>
                                    </span>
                                    </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-enter Password" required>
                                        <i class="ti-unlock"></i>
                                    </div>
                                    <span id="password_confirmationError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <select class="form-control" name="user_type" required>
                                            <option value="">Select user type</option>
                                            <option value="user">As a Customer</option>
                                            <option value="landlord">As a Landlord</option>
                                            <option value="agent">As a Referral Agent</option>
                                        </select>
                                        <i class="ti-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" id="register-button" class="btn btn-md full-width btn-theme-light-2 rounded">Sign
                                Up</button>
                        </div>

                    </form>
                </div>
                <div class="text-center">
                    <p class="mt-5"><i class="ti-user mr-1"></i>Already Have An Account? <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#login" class="link">Go For
                            LogIn</a></p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function showIntNumber() {
                let phone_number_input = document.getElementById('phone_number_input')
                phone_number_input.value = '44'
            }
            $('#register-form').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $("#register-button").attr('disabled', 'disabled')
                $("#register-button").text('Please Wait...')
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('register') }}",
                    data: formData,
                    success: ({ redirectPath }) => window.location.assign(redirectPath),
                    error: (response) => {
                        if(response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });
                            $("#register-button").removeAttr('disabled')
                            $("#register-button").text('Sign Up')
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        </script>
    @endpush
</div>
<!-- End Modal -->
