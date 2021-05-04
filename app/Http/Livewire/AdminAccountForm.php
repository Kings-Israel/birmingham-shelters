<?php

namespace App\Http\Livewire;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Livewire\Component;

class AdminAccountForm extends Component
{
    public User $admin;

    public function mount()
    {
        $this->admin = new User();
        $this->admin->user_type = UserTypeEnum::admin();
    }

    public function render()
    {
        return view('livewire.admin-account-form');
    }
}
