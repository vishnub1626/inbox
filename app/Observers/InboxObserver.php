<?php

namespace App\Observers;

use App\ActivityLog;
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

        ActivityLog::logUserActivity("Deleted message from {$message->sender_email}.");

        ActivityLog::logSystemActivity("Deleted message from {$message->sender_email} with uid {$message->uid}.");
    }
}
