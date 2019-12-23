<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject=null;
    public $body=null;
    public $attach=null;
    public $from=null;

    public function __construct($subject, $body, $attach=null, $fromm=null){
        $this->subject  = $subject;
        $this->body     = $body;
        $this->attach   = $attach;
        $this->fromm    = $fromm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $mail = $this->subject($this->subject)
            ->markdown('emails.test.mail')
            ->with("subject", $this->subject)
            ->with("body", $this->body);
        if($this->fromm)
            $mail = $mail->from($this->fromm);
        if($this->attach)
            $mail = $mail->attach(storage_path("app/".$this->attach));

        return $mail;
    }
}
