<?php

namespace App\Listeners;

use App\Events\AdminAccountRegistered;
use App\Notifications\AdminAccountRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminAccountRegisteredNotification
{

    public function handle(AdminAccountRegistered $event): void
    {
        $event->admin->notify(new AdminAccountRegisteredNotification($event->admin, $event->generated_password));
    }
}
