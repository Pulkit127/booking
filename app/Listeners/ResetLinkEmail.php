<?php

namespace App\Listeners;

use App\Events\SendResetLinkEmail;
use App\Mail\SendResetLinkEmail as MailSendResetLinkEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetLinkEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendResetLinkEmail $event): void
    {
        $resetLink = Str::random(60);
        $event->users->update(['reset_link' => $resetLink]);        
        Mail::to($event->users->email)->send(new MailSendResetLinkEmail($resetLink));
    }
}
