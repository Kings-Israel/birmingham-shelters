<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;


class AdminBookingsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Bookings' => route('admin.bookings.show'),
        ];
    }

    public function render()
    {
        $bookings = Booking::paginate(15);
        return view('livewire.admin.admin-bookings-list', ['bookings' => $bookings])->layout('layouts.admin', ['pageTitle' => "Bookings"]);
    }
}
