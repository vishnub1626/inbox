<?php

namespace App;

use App\Services\Mailbox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
            'sender_email' => $message->from['email'],
            'sender_name' => $message->from['name'],
            'subject' => $message->subject,
            'body' => $message->body ?? '',
            'html' => $message->html ?? '',
            'number' => $message->number,
            'uid' => $message->uid,
            'received_at' => $message->date,
        ]);
    }

    public function scopeSearch(Builder $query, $q)
    {
        $query->where(function ($query) use ($q) {
            $query->whereRaw("sender_email REGEXP '{$q}'")
                ->orWhereRaw("subject REGEXP '$q'")
                ->orWhereRaw("sender_name REGEXP '$q'")
                ->orWhereRaw("body REGEXP '$q'")
                ->orWhere('sender_email', 'LIKE', "%{$q}%")
                ->orWhere('subject', 'LIKE', "%{$q}%")
                ->orWhere('sender_name', 'LIKE', "%{$q}%")
                ->orWhere('body', 'LIKE', "%{$q}%");
        });
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
