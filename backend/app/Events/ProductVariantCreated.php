<?php

namespace App\Events;

use App\Models\ProductVariant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductVariantCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public ProductVariant $productVariant;
    /**
     * Create a new event instance.
     */
    public function __construct(ProductVariant $productVariant)
    {
        $this->productVariant = $productVariant;
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
