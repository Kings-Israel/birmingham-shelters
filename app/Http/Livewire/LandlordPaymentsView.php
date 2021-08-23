<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Invoice;
use Auth;

class LandlordPaymentsView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $invoices = Invoice::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(15);

        $payments = $invoices->filter(function ($payment) {
            if($payment->payment()->exists()) {
                return $payment;
            }
        })->values();
        return view('livewire.landlord-payments-view', ['payments' => $payments]);
    }
}
