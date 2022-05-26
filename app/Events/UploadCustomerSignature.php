<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class UploadCustomerSignature
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Customer
     */
    public $data;



    public function __construct($data)
    {
        $this->data = $data;
    }


    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
    }
}
