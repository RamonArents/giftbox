<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailtrap;

class MailController extends Controller
{
    /*
     * Sends confirmation mail to user
     * @params $paymentId (the ticket with the user payment_id)
     * @return Redirect to the doneer.blade. The user wil receive a mail with the ticket code
     */
    public function ship($paymentId){

        //get the ticket and the connected orders
        $order = Order::where('payment_id', $paymentId)->first();
        $tickets = Ticket::where('order_id', $order->id)->get();
        // send to the correct email and send for each ticket
        $email = $order->email;
        foreach($tickets as $ticket){
            $ticketNumber = $ticket->ticketNumber;
            Mail::to($email)->send(new Mailtrap($email, $ticketNumber));
        }
        //redirect to donatipage
        return redirect()->route('donatiepage')->with('success', 'De code is succesvol verzonden. Check u email (ook uw spam folder).');
    }
}
