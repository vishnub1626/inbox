<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $guarded = [];

    protected $table = 'inbox';

    public $timestamps = false;

    public static function createFromMessage(Message $message)
    {
        return static::create([
            'from' => $message->from,
            'subject' => $message->subject,
            'body' => $message->body,
            'html' => $message->html,
            'number' => $message->number,
            'uid' => $message->uid,
            'received_at' => $message->date,
        ]);
    }
}
