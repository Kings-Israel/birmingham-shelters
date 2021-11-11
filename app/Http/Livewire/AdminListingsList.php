<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\ListingStatusEnum;

class AdminListingsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public $listingLocation;

    public $listingTitle;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Listings' => route('admin.listings.index'),
        ];
    }

    public function render()
    {
        $listingLocation = '%'.$this->listingLocation.'%';
        $listingTitle = '%'.$this->listingTitle.'%';
        $listings = Listing::with('user')->where([
                ['status', '!=', ListingStatusEnum::draft()],
                ['address', 'like', $listingLocation],
                ['name', 'like', $listingTitle],
            ])->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.admin-listings-list', ['listings' => $listings])->layout('layouts.admin', ['pageTitle' => "Property Listings"]);
    }
}
