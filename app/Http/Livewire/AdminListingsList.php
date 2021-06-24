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

    public $listingSearch;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Listings' => route('admin.listings.index'),
        ];
    }

    public function render()
    {
        $listingSearch = '%'.$this->listingSearch.'%';
        $listings = Listing::with('user')->where([
                ['status', '!=', ListingStatusEnum::draft()],
                ['address', 'like', $listingSearch],
            ])->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.admin-listings-list', ['listings' => $listings])->layout('layouts.admin', ['pageTitle' => "Property Listings"]);
    }
}
