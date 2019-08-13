<?php

namespace CodeFinance\Events;

use CodeFinance\Models\Bank;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BankCreatedEvent
{
    use InteractsWithSockets, SerializesModels;

    private $bank;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
