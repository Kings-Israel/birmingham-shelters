<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\PaymentGateway;
use Braintree\Transaction;

class CheckoutController extends Controller
{
    public function show(Invoice $invoice, PaymentGateway $gateway)
    {
        return view('checkout', [
            'invoice' => $invoice,
            'token' => $gateway->getClientToken()
        ]);
    }

    public function checkout(Invoice $invoice, PaymentGateway $gateway)
    {
        abort_if($invoice->payment()->exists(), 403, "Invoice has already been settled");

        $result = $gateway->charge([
            'amount' => $invoice->total,
            'paymentMethodNonce' => request('payment_method_nonce'),
            'customFields' => ['invoice_id' => $invoice->id],
        ]);

        if (! $result->success) {
            return back()->with('error', $gateway->retrieveErrors($result->errors));
        }

        /** @var Transaction */
        $transaction = $result->transaction;
        $invoice->payment()->create([
            'amount' => $transaction->amount,
            'method' => $transaction->paymentInstrumentType,
            'transaction_id' => $transaction->id
        ]);

        return back()->with('success', "Invoice has been settled successfully.");
    }
}
