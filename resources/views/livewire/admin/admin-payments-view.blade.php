<div>
    <x-breadcrumb :items="$breadcrumb" />
    <div class="property_block_wrap style-2">
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Invoice ID</td>
                            <td>Invoice Type</td>
                            <td>Paid By</td>
                            <td>Amount</td>
                            <td>Transaction ID</td>
                            <td>Date Paid</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr class="booking-details-row">
                            <td>{{ $payment->invoice_id }}</td>
                            <td><strong>{{ $payment->invoice->invoice_type }}</strong></td>
                            <td>{{ $payment->invoice->user->full_name }}</td>
                            <td><strong>{{ $payment->amount }}</strong></td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="row">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
