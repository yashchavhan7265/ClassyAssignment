<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModelActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->action = $params['action'];
        $this->tableName = $params['table_name'];
        $this->resourceId = $params['resource_id'];
        $this->resourceParams = $params['resource_params'];
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getTable()
    {
        return $this->tableName;
    }

    public function getResourceId()
    {
        return $this->resourceId;
    }

    public function getResourceParams()
    {
        return $this->resourceParams;
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
