<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceProviderAccountCreatedNotification extends Notification
{
    use Queueable;
    protected $serviceProviderEmail;
    protected $serviceProviderPassword;
    public function __construct($serviceProviderEmail, $serviceProviderPassword)
    {
        $this->serviceProviderEmail = $serviceProviderEmail;
        $this->serviceProviderPassword = $serviceProviderPassword;
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
            ->line('Your Service Provider account has been created successfully.')
            ->line('Here are your login credentials:')
            ->line('Shop Email: ' . $this->serviceProviderEmail)
            ->line('Shop Password: ' . $this->serviceProviderPassword)
            ->line('Please use the above credentials to login to your service provider dashboard.')
            ->action('Login to Dashboard', route('serviceProviders.login'))
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
