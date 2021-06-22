<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;


class AdminPaymentsView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Payments' => route('admin.payments.show'),
        ];
    }

    public function render()
    {
        $payments = Payment::orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-payments-view', ['payments' => $payments])->layout('layouts.admin', ['pageTitle' => "Payments"]);
    }
}
