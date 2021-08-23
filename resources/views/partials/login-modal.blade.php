<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h4 class="modal-header-title">Sign In</h4>
                <div class="login-form">
                    <form method="POST" id="login-form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-with-icon">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" autofocus>
                                <i class="ti-user"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="password" id="password" class="form-control" placeholder="*******">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" id="login-button" class="btn btn-md full-width btn-theme-light-2 rounded">Login</button>
                        </div>

                    </form>
                    <h5 id="error-message" style="color: red; display: none">Invalid Credentials</h5>
                </div>
                <div class="text-center">
                    <p class="mt-5 forgot-password-link"><a href="{{ url('/forgot-password') }}" class="link">Forgot password?</a></p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(function () {
            $('#login-form').on('submit', function (e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('login') }}",
                    data: formData,
                    success: ({ redirectPath }) => window.location.assign(redirectPath),
                    error: (response) => {
                        if(response.status === 422) {
                            $("#error-message").css({'display': 'block'})
                            setTimeout(() => {
                                $("#error-message").css({'display': 'none'})
                            }, 5000);
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        })
    </script>
    @endpush
</div>

<!-- End Modal -->
