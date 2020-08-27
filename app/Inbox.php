<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $guarded = [];

    protected $table = 'inbox';

    public $timestamps = false;

    protected $casts = [
        'received_at' => 'datetime'
    ];

    public static function createFromMessage(Message $message)
    {
        return static::create([
            'from' => $message->from['email'],
            'sender_name' => $message->from['name'],
            'subject' => $message->subject,
            'body' => $message->body,
            'html' => $message->html,
            'number' => $message->number,
            'uid' => $message->uid,
            'received_at' => $message->date,
        ]);
    }

    public function getSenderAvatarUrlAttribute()
    {
        return url('/avatar?for=' . $this->sender_name ?? $this->from);
    }

    public function path()
    {
        return url('/messages/' . $this->id);
    }
}
