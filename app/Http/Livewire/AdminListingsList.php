<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminListingsList extends Component
{
    use WithPagination;

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Listings' => route('admin.listings.index'),
        ];
    }

    public function getListingsProperty()
    {
        return Listing::with('user')->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin-listings-list')->layout('layouts.admin', ['pageTitle' => "Property Listings"]);
    }
}
