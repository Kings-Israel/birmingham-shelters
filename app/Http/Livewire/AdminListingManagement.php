<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListingManagement extends Component
{
    use WithPagination;

    public function getListingsProperty()
    {
        return Listing::with('listingimage', 'user')->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin-listing-management');
    }
}
