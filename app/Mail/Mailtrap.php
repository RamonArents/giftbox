<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $ticketNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $ticketNumber)
    {
        $this->email = $email;
        $this->ticketNumber = $ticketNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('giftbox@giftbox.com', 'Mailtrap')
            ->to($this->email)
            ->subject('Orderbevestiging giftbox')
            ->view('mail.mail', ['ticketNumber' => $this->ticketNumber]);
    }
}
