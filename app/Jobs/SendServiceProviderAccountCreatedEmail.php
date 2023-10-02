<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\ServiceProviderAccountCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendServiceProviderAccountCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $serviceProviderEmail;
    public $serviceProviderPassword;
    public function __construct($user, $serviceProviderEmail, $serviceProviderPassword)
    {
        $this->user = $user;
        $this->serviceProviderEmail = $serviceProviderEmail;
        $this->serviceProviderPassword = $serviceProviderPassword;
    }

    
    public function handle(): void
    {
        $this->user->notify(new ServiceProviderAccountCreatedNotification($this->serviceProviderEmail, $this->serviceProviderPassword));
    }
}
