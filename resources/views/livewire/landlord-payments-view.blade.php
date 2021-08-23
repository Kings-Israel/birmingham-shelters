<div>
    @if ($payments->isNotEmpty())
        <h4>My Payments</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>Invoice Type</td>
                    <td>Amount</td>
                    <td>Description</td>
                    <td>Date Paid</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr class="booking-details-row">
                    <td><strong>{{ $payment->invoice_type }}</strong></td>
                    <td><strong>{{ $payment->payment->amount }}</strong></td>
                    <td>{{ $payment->description }}</td>
                    <td><strong>{{ $payment->created_at->format('d-m-Y') }}</strong></td>
                    <td>
                        <a href="{{ route('invoice.download', $payment->id) }}">
                            <button class="btn btn-theme-light-2 rounded btn-sm">Download PDF</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
