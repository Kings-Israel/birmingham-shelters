<?php

namespace App\Http\Livewire;

use App\Enums\ListingStatusEnum;
use App\Models\Listing;
use App\Models\ListingFeedback;
use Auth;
use Livewire\Component;

class AdminSubmitFeedback extends Component
{
    public Listing $listing;

    public ListingFeedback $feedback;

    protected $rules = [
        'feedback.message' => ['required', 'string'],
        'feedback.listing_id' => ['required'],
        'feedback.admin_id' => ['required'],
    ];

    public function mount(Listing $listing)
    {
        $this->initialiseFeedbackInstance();

    }

    protected function initialiseFeedbackInstance(): void
    {
        $this->feedback = new ListingFeedback([
            'listing_id' => $this->listing->id,
            'admin_id' => auth()->id(),
        ]);
    }

    public function submitFeedback(): void
    {
        abort_unless(Auth::user()->isAdministrator(), 403, 'Unauthorized action');

        $this->validate();

        $this->feedback->save();

        $this->listing->status = ListingStatusEnum::needs_review();

        $this->listing->save();

        $this->initialiseFeedbackInstance();

        $this->emit('feedbackSubmitted');
    }

    public function render()
    {
        return view('livewire.admin-submit-feedback');
    }
}
