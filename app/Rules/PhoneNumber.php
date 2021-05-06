<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^2547\d{8}$/i', $value);
    }

    public function message(): string
    {
        return 'Enter a valid phone number 2547xxxxxxxx.';
    }
}
