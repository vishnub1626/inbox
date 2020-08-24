<?php

namespace App\Services;

use App\Message;

class Mailbox
{
    public $mailbox;

    public $username;

    public $password;

    public $stream;

    public function __construct($mailbox, $username, $password)
    {
        $this->mailbox = $mailbox;
        $this->username = $username;
        $this->password = $password;

        $this->openStream();
    }

    public function openStream()
    {
        $this->stream = \imap_open(
            $this->mailbox,
            $this->username,
            $this->password
        );

        return $this;
    }

    public function getMessageByUID($uid)
    {
        return new Message($this->stream, \imap_msgno($this->stream, $uid));
    }

    public function getMessageByNumber($number)
    {
        return new Message($this->stream, $number);
    }

    public function allMessages()
    {
        $totalMessages = \imap_num_msg($this->stream);

        foreach (range(1, $totalMessages) as $messageNumber) {
            yield $this->getMessageByNumber($messageNumber);
        }
    }

    public function messagesAfter(Message $message)
    {
        $messageNumber = $message->number;
        $totalMessages = \imap_num_msg($this->stream);

        while ($messageNumber < $totalMessages) {
            $messageNumber++;
            yield $this->getMessageByNumber($messageNumber);
        }
    }

    public function delete(Message $message)
    {
        \imap_delete($this->stream, $message->number);
        \imap_expunge($this->stream);

        return $this;
    }

    public function close()
    {
        \imap_close($this->stream, CL_EXPUNGE);
    }
}
