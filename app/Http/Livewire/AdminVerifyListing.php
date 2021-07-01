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

        // Send verification status to the landlord
        SendSMSNotification::dispatchAfterResponse($this->listing->user->phone_number, 'The property '.$this->listing->name.' has been verified by the administrator. Regards, Birmingham Shelteres');

        $this->listing->markAsVerified()->save();

    }

    public function render()
    {
        return <<<'blade'
            @if($listing->is_verified)
            <span class="badge bg-success tex-white"> Verified </span>
            @else
            <button wire:click="markAsVerified" class="btn btn-primary btn-sm">
                Verify Listing
            </button>
            @endif
        blade;
    }
}
