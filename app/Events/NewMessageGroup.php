<?php

namespace App\Events;

use App\MessageGroups;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageGroup implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_group;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MessageGroups $message_group)
    {
        $this->message_group = $message_group;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chat-Group.' . $this->message_group->group->id);
    }


    // public function broadcastWith()
    // {
    //     return [
    //         'message' => $this->message_group->message,
    //         'user' => [
    //             'id' => $this->message_group->user->id,
    //             'name' => $this->message_group->user->name,
    //         ]
    //     ];
    // }
}
