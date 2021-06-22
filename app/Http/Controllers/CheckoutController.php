<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Listing;
use App\Models\Booking;
use App\PaymentGateway;
use Braintree\Transaction;
use App\Enums\BookingStatusEnum;
use App\Jobs\SendInquiryEmailReply;

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

        // Change status of booking to approved and other bookings as unsuccessful
        $booking = $invoice->invoiceable;
        $bookings = Booking::where('listing_id', '=', $booking->listing_id)->get();
        foreach($bookings as $other_booking) {
            $other_booking->status = BookingStatusEnum::unsuccessful();
            $other_booking->save();
        }
        $booking->status = BookingStatusEnum::approved();
        $booking->save();

        // Make listing unavailable
        $listing = $booking->listing;
        $listing->is_available = false;
        $listing->save();

        // Send email to user with approval message
        $data = [
            'email' => $booking->user->email,
            'subject' => 'Approval of Application for listing '.$booking->listing->name,
            'content' => 'We are hereby glad to inform you that you have been approved to occupy the listing as stated above.\n Please make contact with '.$booking->listing->contact_name.' through the details: Email: '.$booking->listing->contact_email.' or Phone Number: '.$booking->listing->contact_phone_number.' for further instructions', 
        ];
        dispatch(new SendInquiryEmailReply($data['email'], $data['subject'], $data['content']));

        return back()->with(['success' => "Invoice has been settled successfully.", "invoice" => $invoice, "listing" => $listing->id]);
    }

    public function cancelPayment(Invoice $invoice)
    {
        $booking = $invoice->invoiceable;
        $booking->status = BookingStatusEnum::pending()->value;
        $deleteInvoice = Invoice::destroy($invoice);
        
        if($booking->save() && $deleteInvoice == 0) {
            return redirect()->route('listing.bookings.all', $booking->listing_id);
        } else {
            return redirect()->back()->withError('An error occurred during cancellation. Please try again.');
        }
    }
}
