<?php

namespace CodeFinance\Listeners;

use CodeFinance\Events\BankStoredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankLogoUploadListener
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
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        // Lógica de upload do arquivo
    }
}
