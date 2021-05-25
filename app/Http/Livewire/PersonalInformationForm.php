<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PersonalInformationForm extends Component
{
    public User $user;

    public bool $show_message = false;

    protected $listeners = [
        'saved' => 'show_message'
    ];

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    protected function rules(): array
    {
        return [
            'user.first_name' => ['required'],
            'user.last_name' => ['required'],
            'user.email' => ['required', 'email:rfc', Rule::unique('users', 'email')->ignore($this->user->id)],
            'user.phone_number' => ['required', new PhoneNumber, Rule::unique('users', 'phone_number')->ignore($this->user->id)],
            'user.user_type' => ['required'],
        ];
    }

    public function updatedUser(): void
    {
        $this->user->phone_number = str_replace(' ', '', $this->user->phone_number);
    }

    public function save_changes()
    {
        $this->validate();

        $this->user->save();

        $this->emitSelf('saved');
    }

    public function show_message(): void
    {
        $this->show_message = true;
    }

    public function dismiss_message(): void
    {
        $this->show_message = false;
    }

    public function render()
    {
        return view('livewire.personal-information-form');
    }
}
