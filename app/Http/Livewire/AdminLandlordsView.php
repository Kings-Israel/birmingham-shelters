<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\ListingInquiry;
use App\Models\ListingDocument;
use App\Models\ListingFeedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class AdminLandlordsView extends Component
{
    use WithPagination;

    public User $user;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteUser' => '$refresh'];

    public array $breadcrumb;

    public function mount(User $user): void
    {
        $this->user = $user;
        
        $this->breadcrumb = [
            'Landlords' => route('admin.landlords.show'),
        ];
    }

    public function deleteUser(User $user)
    {
        if($user->isOfType("landlord")) {

            $user->listings->each(fn ($listing) => $this->deleteListing($listing));

            $user->delete();
        }
    }

    protected function deleteListing(Listing $listing)
    {
        $listing->load(['documents', 'bookings', 'inquiry', 'listingFeedback']);

        $listing->documents->each(fn (ListingDocument $document) => $document->delete());

        $listing->bookings()->delete();

        $listing->inquiry()->delete();

        $listing->listingFeedback()->delete();

        $listing->delete();
    }

    public function render()
    {
        $landlords = User::where('user_type', '=', 'landlord')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-landlords-view', ['landlords' => $landlords])->layout('layouts.admin', ['pageTitle' => 'Landlords']);
    }
}
