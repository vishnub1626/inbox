<?php

namespace App\Observers;

use App\Inbox;
use App\Services\Mailbox;

class InboxObserver
{
    public function deleted(Inbox $message)
    {
        (new Mailbox(
            config('imap.host'),
            config('imap.username'),
            config('imap.password')
        ))->delete($message->number);
    }
}
