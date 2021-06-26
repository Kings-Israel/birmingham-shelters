<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\ListingStatusEnum;

class UserListing extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $listingSearch;

    public function render()
    {
        $listingSearch = '%'.$this->listingSearch.'%';
        $listings = Listing::where([
                ['is_available', '=', true],
                ['status', '!=', ListingStatusEnum::draft()],
                ['address', 'like', $listingSearch]
            ])->orderBy('is_sponsored', 'DESC')->inRandomOrder()->paginate(25);
        return view('livewire.user-listing', ['listings' => $listings])->layout('layouts.app', ['pageTitle' => "Listings"]);
    }
}
