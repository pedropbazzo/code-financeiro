<?php

namespace CodeFinance\Listeners;

use CodeFinance\Events\BankCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankLogoUpload
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
     * @param  BankCreatedEvent  $event
     * @return void
     */
    public function handle(BankCreatedEvent $event)
    {
        echo "Listener executado";
    }
}
