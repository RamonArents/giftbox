<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailtrap;

class MailController extends Controller
{
    /*
     * Sends confirmation mail to user
     * @params $request (ticket from user), $orderId (the ticket orderId)
     * @return
     */
    public function ship(Request $request, $paymentId){

        $order = Ticket::where('payment_id', $paymentId)->first();

        $orderNumber = $order->orderNumber;

        Mail::to('ramonarents@hotmail.com')->send(new Mailtrap($orderNumber));
    }
}
