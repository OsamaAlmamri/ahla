<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\PosDetailEvent' => ['App\Listeners\PosDetailListener'],
        'App\Events\RequestsEvent' => ['App\Listeners\RequestsListener'],
        'App\Events\PosCallProblemsEvent' => ['App\Listeners\PosCallProblemListener'],
        'App\Events\SectionRequestsEvent' => ['App\Listeners\SectionRequestListener'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
