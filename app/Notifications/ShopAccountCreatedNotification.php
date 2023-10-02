<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShopAccountCreatedNotification extends Notification
{
    use Queueable;
    protected $shopEmail;
    protected $shopPassword;
    public function __construct($shopEmail, $shopPassword)
    {
    
        $this->shopEmail = $shopEmail;
        $this->shopPassword = $shopPassword;
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
        return (new MailMessage)
            ->line('A new shop account has been created successfully.')
            ->line('Here are your login credentials:')
            ->line('Shop Email: ' . $this->shopEmail)
            ->line('Shop Password: ' . $this->shopPassword)
            // ->line('Email: ' . $notifiable->email)
            // ->line('Password: Your chosen password (not displayed for security reasons)')
            ->action('Login to Dashboard', route('shops.login'))
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
