<?php

namespace App\Events;

use App\Models\Record;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewRecordEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $record;

    /**
     * Create a new event instance.
     *
     * @param Record $record (Required): Record that was created
     * 
     * @return void
     */
    public function __construct(Record $record)
    {
        $this->record   = $record;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
