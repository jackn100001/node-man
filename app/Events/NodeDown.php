<?php

namespace App\Events;

use App\Models\Node;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NodeDown
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The node instance.
     *
     * @var \App\Models\Order
     */
    public $node;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
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
