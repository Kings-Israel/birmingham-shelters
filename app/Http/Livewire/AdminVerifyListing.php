<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Jobs\SendSMSNotification;

class AdminVerifyListing extends Component
{
    use AuthorizesRequests;

    public Listing $listing;

    public function mount(Listing $listing): void {}

    public function markAsVerified(): void
    {
        $this->authorize('verify', $this->listing);

        $this->listing->markAsVerified()->save();

        // Send verification status to the landlord
        SendSMSNotification::dispatchAfterResponse($this->listing->user->phone_number, 'The property '.$this->listing->name.' has been verified by the administrator. Regards, Birmingham Shelteres');
    }

    public function render()
    {
        return <<<'blade'
            @if($listing->is_verified)
            <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-4" style="font-size: 15px"> Verified </span>
            @else
            <button wire:click="markAsVerified" class="badge rounded-pill fw-bold text-warning bg-light-warning m-l-4" style="font-size: 15px">
                Verify Listing
            </button>
            @endif
        blade;
    }
}
