<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^44\d{10}$/i', $value);
    }

    public function message(): string
    {
        return 'Enter a valid phone number 44xxxxxxxxxx.';
    }
}