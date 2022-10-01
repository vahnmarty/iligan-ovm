<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Person;
use App\Observers\UserObserver;
use App\Observers\PersonObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        Person::class => [PersonObserver::class],
        User::class => [UserObserver::class],
    ];
    
    

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
