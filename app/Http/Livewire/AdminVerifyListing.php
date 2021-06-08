<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AdminVerifyListing extends Component
{
    use AuthorizesRequests;

    public Listing $listing;

    public function mount(Listing $listing): void {}

    public function markAsVerified(): void
    {
        $this->authorize('verify', $this->listing);

        $this->listing->markAsVerified()->save();
    }

    public function render()
    {
        return <<<'blade'
            @if($listing->is_verified)
            <span class="badge bg-gray-800 text-gray-300">Verified
                <time datetime="{{ $listing->verified_at }}">{{ $listing->verified_at->diffForHumans() }}</time> </span>
            @else
            <button wire:click="markAsVerified" class="btn btn-primary btn-sm">
                Verify Listing
            </button>
            @endif
        blade;
    }
}
