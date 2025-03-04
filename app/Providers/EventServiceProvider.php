<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\UserRegistered;
use App\Listeners\SendUserRegisterMail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       //
    }

    protected $listen = [
        UserRegistered::class => [
            SendUserRegisterMail::class,
        ],
    ];
    
}
