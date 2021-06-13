<x-app-layout pageTitle="Invoice Payment">
    <x-page-title title="Invoice #{{ $invoice->id}}" :description="$invoice->description" />

    <section class="gray">
        <div class="container">
            @if(session('errors'))
                <x-banner type="danger">
                    <p>{{ session('errors')}}</p>
                </x-banner>
            @endif

            @if(session('success'))
                <x-banner type="success">
                    <p>{{ session('success')}}</p>
                </x-banner>
            @endif

            @if($invoice->payment()->exists())
            <div class="row">
                <p class="fs-5 fw-bold">Invoice has already been settled.</p>
            </div>
            @else
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <!-- 2st Step Checkout -->
                    <div class="checkout-wrap">

                        <div class="checkout-head">
                            <ul>
                                <li class="active"><span>1</span>Payment Information</li>
                                <li><span>2</span>Confirmation!</li>
                            </ul>
                        </div>

                        <div class="checkout-body">
                            <p class="fw-bold fs-4">
                                Total Amount: &#163;{{ $invoice->total }}
                            </p>
                            <form id="payment-form" action="{{ route('invoices.checkout', $invoice->id)}}" method="POST">
                                @csrf
                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group text-center">
                                            <button class="btn btn-theme-light-2 rounded full-width">Make
                                                Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    @push('scripts')
    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');

        braintree.dropin.create({
            authorization: '{{ $token }}',
            selector: '#bt-dropin',
            // paypal: {
            //     flow: 'vault'
            // }
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });

    </script>

    @endpush
</x-app-layout>
