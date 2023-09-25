<?php

namespace App\Listeners;

use App\Events\RequestBookingEvent;
use App\Notifications\RequestBookingNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RequestBookingListener
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
    public function handle(RequestBookingEvent $event): void
    {
        $event->booking->user?->notify(new RequestBookingNotification($event->booking));
    }
}
