<?php

namespace App\Http\Livewire;

use App\Enums\ListingStatusEnum;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Jobs\SendSMSNotification;
use Livewire\Component;

class ListingFeedbackList extends Component
{
    public Listing $listing;

    protected $listeners = [
        'feedbackSubmitted' => '$refresh',
    ];

    public function mount(Listing $listing): void
    {
        $this->listing->load('listingFeedback');
    }

    public function getFeedbackListProperty(): Collection
    {
        return $this->listing->listingFeedback;
    }

    public function markAsResolved(int $feedback_id): void
    {
        $this->listing->listingFeedback
            ->where('id', $feedback_id)
            ->first()
            ->markAsResolved()
            ->save();

        $this->listing->loadCount([
            'listingFeedback as unresolved_feedback_count' => fn (Builder $query) => $query->where('is_resolved', false),
        ]);

        if($this->listing->unresolved_feedback_count == 0) {
            $this->listing->status = ListingStatusEnum::pending();
            $this->listing->save();

            // Send message to admin after addressing all the issues
            SendSMSNotification::dispatchAfterResponse(env('ADMIN_PHONE_NUMBER'), 'The landlord has addressed all the issues that were raised for the listing '. $this->listing->name);
        }
    }

    public function render()
    {
        return view('livewire.listing-feedback-list');
    }
}
