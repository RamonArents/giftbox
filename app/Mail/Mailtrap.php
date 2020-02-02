<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;
    //send the codes and email address
    public $email;
    public $codeNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $codeNumber)
    {
        $this->email = $email;
        $this->codeNumber = $codeNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //the from email address and subject can be changed
        return $this->from('giftbox@giftbox.com', 'Mailtrap')
            ->to($this->email)
            ->subject('Orderbevestiging giftbox')
            ->view('mail.mail', ['codeNumber' => $this->codeNumber]);
    }
}
