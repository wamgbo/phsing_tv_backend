<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = [
            'user_name' => $message->user_name,
            'content' => $message->content,
            'created_at' => $message->created_at,
        ];
    }

    public function broadcastOn(): Channel
    {
        return new Channel('chatroom'); // 公開頻道，不用驗證身分
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}