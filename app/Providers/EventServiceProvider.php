<?php

namespace CodeFinance\Providers;

use CodeFinance\Events\BankCreatedEvent;
use CodeFinance\Events\BankStoredEvent;
use CodeFinance\Listeners\BankActionListener;
use CodeFinance\Listeners\BankLogoUpload;
use CodeFinance\Listeners\BankLogoUploadListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //Registra o evento e seus listeneres que pode ser um ou vários
        'CodeFinance\Events\SomeEvent' => [
            'CodeFinance\Listeners\EventListener',
        ],

        // Pode ser chamado da maneira acima ou com ::class
        // Não esquecer de registrar todos os listeners (Escuta de eventos)
        // e atrelar o listener a um evento criado
        BankCreatedEvent::class => [
            BankLogoUpload::class,
            BankActionListener::class
        ],

        BankStoredEvent::class => [
            BankLogoUploadListener::class
        ],

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
