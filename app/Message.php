<?php

namespace App;

use Carbon\Carbon;

class Message
{
    public $stream;

    public $number;

    public $uid;

    public $subject;

    public $from;

    public $to;

    public $date;

    public $body;

    public $html;

    public function __construct($stream, $number)
    {
        $this->stream = $stream;
        $this->number = $number;

        $this->setMeta();
        $this->setUID();
        $this->setBody();
    }

    public function setMeta()
    {
        $header = \imap_header($this->stream, $this->number);

        $this->subject = $header->subject;
        $this->from = $header->fromaddress;
        $this->to = $header->toaddress;
        $this->date = Carbon::createFromFormat('D, j M Y H:i:s O', $header->date)->setTimezone('UTC')->toDateTimeString();
    }

    public function setUID()
    {
        $this->uid = \imap_uid($this->stream, $this->number);
    }

    public function setBody()
    {
        $this->setContent(\imap_fetchstructure($this->stream, $this->number));
    }

    private function setContent($structure, $partNumber = null)
    {
        if ($structure->type == 0) {
            if (in_array(strtolower($structure->subtype), ['plain', 'csv', 'html'])) {
                if (!$partNumber) {
                    $partNumber = 1;
                }

                $content = \imap_fetchbody($this->stream, $this->number, $partNumber);

                if (strtolower($structure->subtype) == 'html') {
                    $this->html = $this->decodeString($content, $structure->encoding);
                } else {
                    $this->body = $this->decodeString($content, $structure->encoding);
                }
            }
        } elseif ($structure->type == 1) {
            foreach ($structure->parts as $index => $subStruct) {
                $prefix = $partNumber ? $partNumber . '.' : '';
                $this->setContent($subStruct, $prefix . ($index + 1));
            }
        }
    }

    public function decodeString($string, $encoding)
    {
        if ($encoding == ENCBINARY) {
            return \imap_binary($string);
        }

        if ($encoding == ENCBASE64) {
            return \imap_base64($string);
        }

        if ($encoding == ENCQUOTEDPRINTABLE) {
            return quoted_printable_decode($string);
        }

        if ($encoding == ENC8BIT) {
            return quoted_printable_decode(\imap_8bit($string));
        }

        return $string;
    }
}
