<?php

namespace App\Http\Livewire;

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminAccountForm extends Component
{
    public User $admin;

    public function mount()
    {
        $this->admin = new User();
        $this->admin->user_type = UserTypeEnum::admin();
    }

    protected function rules(): array
    {
        return [
            'admin.first_name' => ['required'],
            'admin.last_name' => ['required'],
            'admin.email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')],
            'admin.phone_number' => ['required' ,new PhoneNumber, Rule::unique('users', 'phone_number')],
            'admin.user_type' => ['required'],
        ];
    }

    public function updatedAdmin(): void
    {
        $this->admin->phone_number = str_replace(" ", "", $this->admin->phone_number);
    }

    public function create_account()
    {
        $this->validate();

        $generated_password = Str::random(12);
        $this->admin->password = Hash::make($generated_password);

        $this->admin->save();

        session()->flash('banner', 'Admin account created successfully.');
        session()->flash('bannerStyle', 'success');

        // TODO: dispatch AdminRegistered event, pass model and generated password

        return redirect()->route('admins.index');
    }

    public function render()
    {
        return view('livewire.admin-account-form');
    }
}
