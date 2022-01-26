<x-app-layout pageTitle="Invoice Payment">
    <x-page-title title="Enter Your Card Details To Complete Payment" />
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                        <div class="row display-tr" >
                            <h3 class="panel-title display-td" >{{ $invoice->description }}</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <form
                            role="form"
                            action="{{ route('invoice.stripe.callback', $invoice->id) }}"
                            method="post"
                            class="require-validation mb-1"
                            data-cc-on-file="false"
                            data-stripe-publishable-key={{ config('services.stripe.key') }}
                            id="payment-form"
                        >
                        @csrf
                            <input type="hidden" name="amount" value="{{ $invoice->total }}">
                            <div class="form-group">
                                <label>Name on Card</label>
                                <input type="text" class="form-control" placeholder="Name on Card" autofocus>
                            </div>
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control required card-number" placeholder="Card Number" size="20" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>CVC</label>
                                        <input type="text" class="form-control required card-cvc" placeholder="e.g. 311" size="4" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Expiration Month</label>
                                        <input type="text" class="form-control required card-expiry-month" placeholder="MM" size="2" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Expiration Year</label>
                                        <input type="text" class="form-control required card-expiry-year" placeholder="YYYY" size="4" required>
                                    </div>
                                </div>
                            </div>
                            <h5 id="error-message" class="error hide" style="color: red !important;">An error occurred. Please Check the Details and Try Again</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <button class="btn btn-theme-light-2 rounded" type="submit">Pay Now (&#163;{{ $invoice->total }})</button>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <a href="{{ route('invoice.cancel', $invoice->id) }}" class="btn btn-md btn-outline-theme rounded">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
       $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('h5#error-message'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('#error-message')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.append("<input type='hidden' name='payment_method' value='Stripe' />")
                    $form.get(0).submit();
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
