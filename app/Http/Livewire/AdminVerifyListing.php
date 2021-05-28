<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;

class AdminVerifyListing extends Component
{
    public Listing $listing;

    public function mount(Listing $listing): void {}

    public function markAsVerified(): void
    {
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
