<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^07\d{9}$/i', $value);
    }

    public function message(): string
    {
        return 'Enter a valid phone number 07xxxxxxxxx.';
    }
}
