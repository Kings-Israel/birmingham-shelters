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

    public bool $editingMode = false;

    public function mount(User $admin): void
    {
        $this->admin = $admin;

        $this->editingMode = $this->admin->exists;

        if (! $this->editingMode) {
            $this->admin->user_type = UserTypeEnum::admin();
        }
    }

    protected function rules(): array
    {
        $rules = [
            'admin.first_name' => ['required'],
            'admin.last_name' => ['required'],
            'admin.email' => ['required', 'email:rfc,dns'],
            'admin.phone_number' => ['required', new PhoneNumber],
            'admin.user_type' => ['required'],
        ];

        $rules['admin.email'][] = $this->editingMode ?
            Rule::unique('users', 'email')->ignore($this->admin->id) :
            Rule::unique('users', 'email');

        $rules['admin.phone_number'][] = $this->editingMode ?
            Rule::unique('users', 'phone_number')->ignore($this->admin->id) :
            Rule::unique('users', 'phone_number');

        return $rules;
    }

    public function updatedAdmin(): void
    {
        $this->admin->phone_number = str_replace(' ', '', $this->admin->phone_number);
    }

    public function save_details()
    {
        $this->validate();

        if (!$this->editingMode) {
            $generated_password = Str::random(12);
            $this->admin->password = Hash::make($generated_password);
        }

        $this->admin->save();

        session()->flash('bannerStyle', 'success');
        session()->flash(
            'banner',
            $this->editingMode ? 'Admin account updated successfully.' : 'Admin account created successfully.'
        );

        // TODO: dispatch AdminRegistered event, pass model and generated password only on creation.

        return redirect()->route('admins.index');
    }

    public function render()
    {
        return view('livewire.admin-account-form');
    }
}
