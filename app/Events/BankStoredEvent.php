<?php

namespace CodeFinance\Events;

use CodeFinance\Models\Bank;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BankStoredEvent
{
    use InteractsWithSockets, SerializesModels;

    private $bank;
    private $logo;

    /**
     * Create a new event instance.
     *
     * @param Bank $bank
     * @param UploadedFile $logo
     */
    public function __construct(Bank $bank, UploadedFile $logo)
    {
        $this->bank = $bank;
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
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
