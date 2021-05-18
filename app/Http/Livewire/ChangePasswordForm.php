<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ChangePasswordForm extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $show_message = false;

    protected $listeners = [
        'saved' => 'show_message'
    ];

    public function save(): void
    {
        /** @var User */
        $user = auth()->user();

        $input = [
            'current_password' => $this->current_password,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation
        ];

        $rules = [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];

        Validator::make($input, $rules)->after(function ($validator) use ($user, $input) {
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', 'The provided password does not match your current password.');
            }
        })->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        $this->emitSelf('saved');

        $this->fill([
            'current_password' => '',
            'password' => '',
            'password_confirmation' => ''
        ]);
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
        return view('livewire.change-password-form');
    }
}
