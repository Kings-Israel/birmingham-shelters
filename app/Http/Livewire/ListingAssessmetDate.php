<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use Livewire\Component;

class ListingAssessmetDate extends Component
{
    public Listing $listing;

    public $date;

    protected $listeners = [
        'assessmentDateUpdated' => '$refresh',
    ];

    public function mount(Listing $listing) 
    {}

    public function render()
    {
        $this->date = $this->listing->assessment_date;
        return view('livewire.listing-assessmet-date', ['date' => $this->date]);
    }
}
