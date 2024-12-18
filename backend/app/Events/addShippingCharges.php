<?php

namespace App\Events;

use App\Enum\ShipMethod;
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addShippingCharges
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Order $order;
    public ShipMethod $method;
    /**
     * Create a new event instance.
     */
    public function __construct(Order $order,ShipMethod $method)
    {
        $this->order = $order;
        $this->method = $method;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
