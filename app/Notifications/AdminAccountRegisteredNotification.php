<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminAccountRegisteredNotification extends Notification
{
    use Queueable;

    public User $admin;

    public string $generated_password;

    public function __construct(User $admin, string $generated_password)
    {
        $this->admin = $admin;

        $this->generated_password = $generated_password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Administrator Account Registred')
                    ->line("An admin account has been created using your email address. Here are your login credentials to access your account:")
                    ->line('**Email:** '. $this->admin->email)
                    ->line('**Password:** '. $this->generated_password)
                    ->line('Remember to change your password once you login.')
                    ->line('If this was a mistake, ignore this email!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
