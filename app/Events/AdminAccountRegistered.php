<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminAccountRegistered
{
    use Dispatchable, SerializesModels;

    public User $admin;

    public string $generated_password;

    public function __construct(User $admin, string $generated_password)
    {
        $this->admin = $admin;

        $this->generated_password = $generated_password;
    }
}
