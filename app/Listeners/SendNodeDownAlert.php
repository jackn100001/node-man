<?php

namespace App\Listeners;

use App\Events\NodeDown;
use App\Mail\NodeDownAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNodeDownAlert
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeviceDown  $event
     * @return void
     */
    public function handle(NodeDown $event)
    {
        Mail::to('test@test.com')->send(new NodeDownAlert($event->node));
    }
}
