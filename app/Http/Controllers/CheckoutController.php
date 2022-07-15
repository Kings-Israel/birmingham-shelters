<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Booking;
use URL;
use Session;
use Redirect;
use Stripe;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Enums\BookingStatusEnum;
use App\Jobs\SendBookingApprovalMail;
use App\Jobs\SendSMSNotification;
use Carbon\Carbon;
use App\Enums\InvoiceTypeEnum;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\InputFields;
use PayPal\Api\WebProfile;

class CheckoutController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function show(Invoice $invoice)
    {
        return view('checkout', [
            'invoice' => $invoice,
        ]);
    }

    public function checkout(Invoice $invoice, Request $request)
    {
        // dd($request->all());
        abort_if($invoice->payment()->exists(), 403, "Invoice has already been settled");

        $rules = [
            'payment_method' => ['required']
        ];

        $message = [
            'payment_method.required' => 'Please select a payment option'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        switch ($request->payment_method) {
            case 'paypal':
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $amount = new Amount();
                $amount->setCurrency('GBP')
                    ->setTotal($request->amount);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setDescription($invoice->description);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('invoice.status', $invoice->id))
                    ->setCancelUrl(URL::route('invoice.checkout.page', $invoice->id));

                $inputFields = new InputFields();
                $inputFields->setNoShipping(1);

                $webProfile = new WebProfile();
                $webProfile->setName('test' . uniqid())->setInputFields($inputFields);

                $webProfileId = $webProfile->create($this->_api_context)->getId();

                $payment = new Payment();
                $payment->setExperienceProfileId($webProfileId);
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        \Session::put('error','Connection timeout');
                        return Redirect::route('invoice.checkout.page', $invoice->id);
                    } else {
                        \Session::put('error','Some error occur, sorry for inconvenient');
                        return Redirect::route('invoice.checkout.page', $invoice->id);
                    }
                }

                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                Session::put('paypal_payment_id', $payment->getId());

                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }

                \Session::put('error','Unknown error occurred');
                return Redirect::route('invoice.checkout.page', $invoice->id);
                break;

            case 'stripe':
                return view('stripe')->with(['amount' => $request->amount, 'invoice' => $invoice]);
            default:
                return back()->with('error', 'An error occurred. Please try again');
                break;
        }
    }

    public function stripeView(Invoice $invoice, Request $request)
    {
        abort_if($invoice->payment()->exists(), 403, "Invoice has already been settled");
        return view('stripe')->with(['amount' => $request->amount, 'invoice' => $invoice]);
    }

    public function stripeCallback(Invoice $invoice, Request $request)
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        Stripe\Charge::create ([
            "amount" => $invoice->total * 100,
            "currency" => "gbp",
            "source" => $request->stripeToken,
            "description" => $invoice->description
        ]);

        /** @var Transaction */
        $invoice->payment()->create([
            'amount' => $invoice->total,
            'method' => 'Debit/Credit Card',
            'transaction_id' => $request->stripeToken
        ]);

        if ($invoice->invoice_type == InvoiceTypeEnum::referral_fee()->label) {
            // Change status of booking to approved and other bookings as unsuccessful
            $booking = $invoice->invoiceable;
            $bookings = Booking::where('listing_id', '=', $booking->listing_id)->get();

            // Reduce available room by 1 and if available rooms is 0 make the listing unavailable
            $listing = $booking->listing;
            $listing->available_rooms -= 1;
            if ($listing->available_rooms == 0) {
                foreach($bookings as $other_booking) {
                    if($other_booking->status = BookingStatusEnum::pending()->value) {
                        $other_booking->status = BookingStatusEnum::unsuccessful()->value;
                        $other_booking->save();
                    }
                }

                $listing->is_available = false;
            }

            // Change other bookings for the user to unsuccessful
            $user_other_bookings = Booking::where([
                    ['referee_data_id', '=', $booking->referee_data_id],
                    ['listing_id', '!=', $booking->listing_id]
                ])->get();
            foreach ($user_other_bookings as $bookings) {
                $bookings->status = BookingStatusEnum::unsuccessful()->value;
                $bookings->save();
            }

            $booking->status = BookingStatusEnum::approved()->value;
            $booking->save();

            $listing->occupied_rooms += 1;
            $listing->save();

            // Send email to user with approval message
            $data = [
                'email' => $booking->user->email,
                'subject' => 'Approval of Application for listing '.$booking->listing->name,
                'content' => 'We are hereby glad to inform you that you have been approved to occupy the listing as stated above. Please make contact with '.$booking->listing->contact_name.' through the details: Email: '.$booking->listing->contact_email.' or Phone Number: '.$booking->listing->contact_number.' for further instructions',
            ];
            // Send notification to user on approval of listing booking
            SendSMSNotification::dispatchAfterResponse($booking->user->phone_number, 'Your Booking for the listing '.$booking->listing->name.' has been approved. Please contact '.$booking->listing->contact_name.' through the details, Phone Number: '.$booking->listing->contact_number.', Email: '.$booking->listing->contact_email.', for more Information. Regards, Sheltered Birmingham.');
            SendBookingApprovalMail::dispatchAfterResponse($data['email'], $data['subject'], $data['content']);

            return redirect()->route('invoice.checkout.page', $invoice->id)->with(['success' => 'Invoice settled successfully']);

        } elseif($invoice->invoice_type == InvoiceTypeEnum::sponsored_listing()->label) {
            $listing = $invoice->invoiceable;
            $listing->is_sponsored = Carbon::now()->addMonth();
            $listing->save();

            return redirect()->route('invoice.checkout.page', $invoice->id)->with(['success' => 'Invoice settled successfully']);
        }
    }

    public function getPaymentStatus(Invoice $invoice, Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('invoice.checkout.page', $invoice->id);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        /** @var Transaction */
        $invoice->payment()->create([
            'amount' => $result->transactions[0]->amount->total,
            'method' => $result->payer->payment_method,
            'transaction_id' => $result->id
        ]);

        if ($result->getState() == 'approved') {

            if ($invoice->invoice_type == InvoiceTypeEnum::referral_fee()->label) {
                // Change status of booking to approved and other bookings as unsuccessful
                $booking = $invoice->invoiceable;
                $bookings = Booking::where('listing_id', '=', $booking->listing_id)->get();

                // Reduce available room by 1 and if available rooms is 0 make the listing unavailable
                $listing = $booking->listing;
                $listing->available_rooms -= 1;
                if ($listing->available_rooms == 0) {
                    foreach($bookings as $other_booking) {
                        if($other_booking->status = BookingStatusEnum::pending()->value) {
                            $other_booking->status = BookingStatusEnum::unsuccessful()->value;
                            $other_booking->save();
                        }
                    }

                    $listing->is_available = false;
                }

                // Change other bookings for the user to unsuccessful
                $user_other_bookings = Booking::where([
                        ['referee_data_id', '=', $booking->referee_data_id],
                        ['listing_id', '!=', $booking->listing_id]
                    ])->get();
                foreach ($user_other_bookings as $bookings) {
                    $bookings->status = BookingStatusEnum::unsuccessful()->value;
                    $bookings->save();
                }

                $booking->status = BookingStatusEnum::approved()->value;
                $booking->save();

                $listing->occupied_rooms += 1;
                $listing->save();

                // Send email to user with approval message
                $data = [
                    'email' => $booking->user->email,
                    'subject' => 'Approval of Application for listing '.$booking->listing->name,
                    'content' => 'We are hereby glad to inform you that you have been approved to occupy the listing as stated above. Please make contact with '.$booking->listing->contact_name.' through the details: Email: '.$booking->listing->contact_email.' or Phone Number: '.$booking->listing->contact_number.' for further instructions',
                ];
                // Send notification to user on approval of listing booking
                SendSMSNotification::dispatchAfterResponse($booking->user->phone_number, 'Your Booking for the listing '.$booking->listing->name.' has been approved. Please contact '.$booking->listing->contact_name.' through the details, Phone Number: '.$booking->listing->contact_number.', Email: '.$booking->listing->contact_email.', for more Information. Regards, Sheltered Birmingham.');
                SendBookingApprovalMail::dispatchAfterResponse($data['email'], $data['subject'], $data['content']);

                return redirect()->route('invoice.checkout.page', $invoice->id)->with(['success' => 'Invoice settled successfully']);

            } elseif($invoice->invoice_type == InvoiceTypeEnum::sponsored_listing()->label) {
                $listing = $invoice->invoiceable;
                $listing->is_sponsored = Carbon::now()->addMonth();
                $listing->save();

                return redirect()->route('invoice.checkout.page', $invoice->id)->with(['success' => 'Invoice settled successfully']);
            }
        }

        \Session::put('error','Payment failed !!');
		return Redirect::route('invoice.checkout.page', $invoice->id);

    }

    public function cancelPayment(Invoice $invoice)
    {
        if ($invoice->invoice_type == InvoiceTypeEnum::referral_fee()->label) {
            $booking = $invoice->invoiceable;
            $booking->status = BookingStatusEnum::pending()->value;
            $deleteInvoice = Invoice::destroy($invoice->id);

            if($booking->save() && $deleteInvoice) {
                return redirect()->route('listing.bookings.all', $booking->listing_id);
            } else {
                return redirect()->back()->withError('An error occurred during cancellation. Please try again.');
            }
        } elseif($invoice->invoice_type == InvoiceTypeEnum::sponsored_listing()->label) {
            $listing = $invoice->invoiceable;
            $deleteInvoice = Invoice::destroy($invoice->id);
            if ($deleteInvoice) {
                return redirect()->route('listing.view.one', $listing);
            } else {
                return redirect()->back()->withError('An error occurred. Please try again.');
            }
        }
    }

    public function downloadPdf(Invoice $invoice)
    {
        $pdf = PDF::loadView('invoice.invoice-pdf', ['invoice' => $invoice]);
        return $pdf->download($invoice->payment->transaction_id.'.pdf');
    }
}
