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

class AdminUsersView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteUser' => '$refresh'];

    public array $breadcrumb;

    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;

        $this->breadcrumb = [
            'Users' => route('admin.users.show'),
        ];
    }

    public function deleteUser(User $user)
    {
        if($user->isOfType('user')) {
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
    }

    public function render()
    {
        $users = User::where('user_type', '=', 'user')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-users-view', ['users' => $users])->layout('layouts.admin', ['pageTitle' => 'Users']);
    }
}
