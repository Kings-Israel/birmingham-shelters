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

    public $listingLocation;

    public $listingTitle;

    public function render()
    {
        $listingLocation = '%'.$this->listingLocation.'%';
        $listingTitle = '%'.$this->listingTitle.'%';
        $listings = Listing::where([
                ['is_available', '=', true],
                ['status', '!=', ListingStatusEnum::draft()],
                ['name', 'like', $listingTitle],
                ['address', 'like', $listingLocation]
            ])->orderBy('is_sponsored', 'DESC')->inRandomOrder()->paginate(25);
        return view('livewire.user-listing', ['listings' => $listings])->layout('layouts.app', ['pageTitle' => "Listings"]);
    }
}
