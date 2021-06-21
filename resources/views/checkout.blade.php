<x-app-layout pageTitle="Invoice Payment">

    <section class="gray">
        <div class="container">
            @if(session('error'))
                <x-banner type="danger">
                    <p>{{ session('error')}}</p>
                </x-banner>
            @endif

            @if(session('success'))
                <x-banner type="success">
                    <p>{{ session('success')}}</p>
                </x-banner>
            @endif

            @if($invoice->payment()->exists())
            <div class="row">
                <p class="fs-5 fw-bold">Invoice has been settled.</p>
                <div class="property_block_wrap style-2">
                    <div class="property_block_wrap_header">
                        <h5 class="property_block_title">Invoice ID: <strong>{{ $invoice->id }}</strong></h5>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                                <div class="block-body">
                                    <h4 class="property_block_title">Description:</h4>
                                    <p>{{ $invoice->description }}</p>
                                    <h4 class="property_block_title">Total Amount:</h4>
                                    <p>&#163;{{ $invoice->total }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <i class="ti-check" style="font-size: 120px; color: rgb(0, 169, 20)"></i>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('listing.bookings.all', $invoice->invoiceable->listing_id) }}">
                <button class="btn btn-theme-light-2 rounded">Back to Bookings</button>
            </a>
            <a href="{{ route('listing.view.all') }}">
                <button class="btn btn-theme-light-2 rounded">Back to My Properties</button>
            </a>
            <a href="#">
                <button class="btn btn-theme-light-2 rounded">Download PDF</button>
            </a>
            @else
            <div class="row justify-content-center">
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
                                Invoice ID#<strong>{{ $invoice->id }}</strong>
                            </p>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold fs-4">Description</td>
                                        <td class="fw-bold fs-4">{{ $invoice->description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold fs-4">Total Amount</td>
                                        <td class="fw-bold fs-4">&#163;{{ $invoice->total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form id="payment-form" action="{{ route('invoice.checkout', $invoice->id)}}" method="POST">
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
                            <a href="{{ route('invoice.cancel', $invoice->id) }}">
                                <button class="btn btn-primary rounded full-width">Cancel</button>
                            </a>
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
