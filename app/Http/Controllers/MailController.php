<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailtrap;

class MailController extends Controller
{
    /*
     * Sends confirmation mail to user
     * @params $paymentId (the ticket with the user payment_id)
     * @return Redirect to the doneer blade. The user wil receive a mail with the ticket code
     */
    public function ship($paymentId){

        $order = Ticket::where('payment_id', $paymentId)->first();

        $email = $order->email;
        $orderNumber = $order->orderNumber;

        Mail::to($email)->send(new Mailtrap($email, $orderNumber));

        return redirect()->route('donatiepage')->with('success', 'De code is succesvol verzonden. Check u email (ook uw spam folder).');
    }
}
