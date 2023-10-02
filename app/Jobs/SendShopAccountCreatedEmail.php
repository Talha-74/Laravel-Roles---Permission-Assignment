<?php

namespace App\Jobs;

use App\Mail\ShopAccountCreatedMail;
use App\Notifications\ShopAccountCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendShopAccountCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $shopEmail;
    protected $shopPassword;
    public function __construct($user, $shopEmail, $shopPassword )
    {
        $this->user = $user;
        $this->shopEmail = $shopEmail;
        $this->shopPassword = $shopPassword;
    }

    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     $user = $this->user;
    //     Mail::to($user->email)->send(new ShopAccountCreatedMail($user));
    // }

    public function handle()
{
    $this->user->notify(new ShopAccountCreatedNotification($this->shopEmail, $this->shopPassword));
}
}
