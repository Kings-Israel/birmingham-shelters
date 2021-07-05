<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;
use App\Jobs\SendSMSNotification;

class AdminListingAssessment extends Component
{
    public Listing $listing;

    public $assessment_date;

    protected $rules = [
        'assessment.date' => 'required|date',
    ];

    public function mount(Listing $listing) {}

    public function resetAssessmentDate()
    {
        $this->assessment_date = '';
    }

    public function submitAssessmentDate()
    {
        $this->listing->setAssessmentDate($this->assessment_date);
        $this->listing->save();
        // Send message to landlord with the set date
        // SendSMSNotification::dispatchAfterResponse($this->listing->user->phone_number, 'A physical assessment date has been set to '.$this->listing->assessment_date.' for the listing '.$this->listing->name.'. Please make sure you are available on this day for the assessment. Regards, Birmingham Shelters.');
        // Send message to admin
        // SendSMSNotification::dispatchAfterResponse(env('ADMIN_PHONE_NUMBER'), 'You have set an assessment date of '.$this->listing->assessment_date.' for the listing'.$this->listing->name);
        $this->resetAssessmentDate();
        $this->emit('assessmentDateUpdated');
    }

    public function render()
    {
        return view('livewire.admin-listing-assessment');
    }
}
