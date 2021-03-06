<?php

namespace App\Console\Commands;

use App\Inbox;
use App\ActivityLog;
use App\Services\Mailbox;
use Illuminate\Console\Command;

class MailboxSync extends Command
{
    protected $signature = 'mailbox:sync';

    protected $description = 'Fetch emails from smtp';

    protected $mailbox;

    public function __construct()
    {
        parent::__construct();

        $this->mailbox = new Mailbox(
            config('imap.host'),
            config('imap.username'),
            config('imap.password')
        );
    }

    public function handle()
    {
        $message = $this->getMostRecentMessage();

        $messages = $message ? $this->mailbox->messagesAfter($message) : $this->mailbox->allMessages();

        $newMessagesCount = 0;
        foreach ($messages as $message) {
            if ($message) {
                Inbox::createFromMessage($message);
                $newMessagesCount++;
            }
        }

        $this->mailbox->close();

        if ($newMessagesCount) {
            ActivityLog::logSystemActivity("{$newMessagesCount} new message(s) fetched.");
        }
    }

    private function getMostRecentMessage()
    {
        $recentMessage = Inbox::query()
            ->latest('received_at')
            ->first();

        if ($recentMessage) {
            try {
                return $this->mailbox->getMessageByUID($recentMessage->uid);
            } catch (\Exception $e) {
                return  null;
            }
        }
        return null;
    }
}
