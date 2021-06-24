<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Booking;
use App\Models\RefereeData;
use App\Models\ApplicantAddressInfo;
use App\Models\ApplicantHealthInfo;
use App\Models\ApplicantRiskAssessment;
use App\Models\ApplicantIncomeInfo;
use App\Models\ApplicantSupportNeeds;
use App\Models\Consent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class AdminAgentsView extends Component
{
    use WithPagination;

    public User $user;

    protected $listeners = ['deleteUser' => '$refresh'];

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(User $user): void
    {
        $this->user = $user;

        $this->breadcrumb = [
            'Agents' => route('admin.agents.show'),
        ];
    }

    public function deleteUser(User $user)
    {
        if($user->isOfType('agent')) {
            $user->refereedata->each(fn ($referee_data) => $this->deleteRefereeData($referee_data));

            $user->bookings()->delete();

            $user->delete();
        }
    }

    protected function deleteRefereeData(RefereeData $refereeData)
    {
        $refereeData->applicantaddressinfo->each(fn (ApplicantAddressInfo $address) => $address->delete());

        $refereeData->applicanthealthinfo()->delete();

        $refereeData->applicantincomeinfo()->delete();

        $refereeData->applicantriskassessment->each(fn (ApplicantRiskAssessment $risk) => $risk->delete());

        $refereeData->applicantsupportneeds->each(fn (ApplicantSupportNeeds $support) => $support->delete());

        $refereeData->consent()->delete();
        
        $refereeData->delete();
    }

    public function render()
    {
        $agents = User::where('user_type', '=', 'agent')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-agents-view', ['agents' => $agents])->layout('layouts.admin', ['pageTitle' => 'Agents']);
    }
}
