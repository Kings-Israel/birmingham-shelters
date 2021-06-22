<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class UserListing extends Component
{

    public $listingSearch;

    public function render()
    {
        $listingSearch = '%'.$this->listingSearch.'%';
        $listings = Listing::where([
                ['is_available', '=', true],
                ['address', 'like', $listingSearch]
            ])->orderBy('created_at', 'DESC')->get();
        return view('livewire.user-listing', ['listings' => $listings])->layout('layouts.app', ['pageTitle' => "Listings"]);
    }
}
