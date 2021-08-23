<x-app-layout pageTitle="Invoice Payment">
    @if ($invoice->invoice_type = 'sponsored_listing')
        <x-page-title title="Sponsored Listing Payment" />
    @else
        @if($invoice->payment()->exists())
            <x-page-title title="Approved Booking" />
        @else
            <x-page-title title="Approve Booking" />
        @endif
    @endif
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

                <a href="{{ route('listing.view.all') }}">
                    <button class="btn btn-theme-light-2 rounded">Back to My Properties</button>
                </a>
                <a href="{{ route('invoice.download', $invoice->id) }}">
                    <button class="btn btn-theme-light-2 rounded">Download PDF</button>
                </a>
            @else
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12">
                    <!-- 2st Step Checkout -->
                    <div class="checkout-wrap">

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
                            <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{{ route('invoice.checkout', $invoice->id)}}" >
                                @csrf
                                <input id="amount" type="text" class="form-control" name="amount" hidden value="{{ $invoice->total }}" autofocus>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-theme-light-2 rounded full-width">
                                        Pay with Paypal
                                    </button>
                                </div>
                            </form>
                            <a href="{{ route('invoice.cancel', $invoice->id) }}">
                                <button class="btn btn-md btn-outline-theme rounded full-width">Cancel</button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    @push('scripts')
    {{-- <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD"></script>
    <script>
        paypal.Buttons({

          // Sets up the transaction when a payment button is clicked
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '10.00' // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                }
              }]
            });
          },

          // Finalize the transaction after payer approval
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
              // Successful capture! For dev/demo purposes:
                  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                  var transaction = orderData.purchase_units[0].payments.captures[0];
                  alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

              // When ready to go live, remove the alert and show a success message within this page. For example:
              // var element = document.getElementById('paypal-button-container');
              // element.innerHTML = '';
              // element.innerHTML = '<h3>Thank you for your payment!</h3>';
              // Or go to another URL:  actions.redirect('thank_you.html');
            });
          }
        }).render('#paypal-button-container');

      </script> --}}

    @endpush
</x-app-layout>
