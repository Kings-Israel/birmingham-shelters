<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Listing;
use Auth;
use Livewire\Component;

class RefereeBookingList extends Component
{
    public $listing;
    public $refereeData;

    protected $listeners = ['addUserToList' => '$refresh'];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function addUserToList($metadata_id)
    {
        $user = Auth::user();
        // dd($this->listing->id, $user->id, $metadata_id);
        $booking = Booking::create([
            'user_id' => $user->id,
            'listing_id' => $this->listing->id,
            'referee_data_id' => $metadata_id
        ]);

        if($booking) {
            session()->flash('success', 'Added Referee to list');
        } else {
            session()->flash('error', 'An error occurred. Please try again');
        }
        $this->emit('remove_alert');
    }

    public function getRefereeList()
    {
        $refereeList = [];
        foreach (Auth::user()->refereedata()->get() as $metadata) {
            if ($metadata->canBook(Auth::user()->id, $metadata->id, $this->listing->id)) {
                array_push($refereeList, $metadata);
            }
        }
        return $refereeList;
    }

    public function render()
    {
        return view('livewire.referee-booking-list', ['referees' => $this->getRefereeList()]);
    }
}
