<?php

namespace App\Notifications;

use App\Models\vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VenderCreated extends Notification
{
    use Queueable;

    public $vendor;
    /**
     * Create a new notification instance.
     */
    public function __construct(vendor $vendors)
    {
        $this-> vendor=$vendors;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject=sprintf('%s:لقد تم انشاء حسابك في موقع مصطفي خالد سيد علي%s!',9,config('app.name'));
        $greeting=sprintf('%s!:مرحبا ',9,$notifiable->name);
        return (new MailMessage)
        ->subject($subject)
                    ->greeting($greeting)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
