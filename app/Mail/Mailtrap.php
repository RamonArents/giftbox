<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;

    public $orderNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('giftbox@giftbox.com', 'Mailtrap')
            ->to('ramonarents@hotmail.com')
            ->subject('Orderbevestiging giftbox')
            ->view('mail.mail', ['orderNumber' => $this->orderNumber]);
    }
}
