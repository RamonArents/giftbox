<?php

namespace App\Http\Controllers;

use App\Code;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailtrap;

class MailController extends Controller
{
    /**
     * Sends confirmation mail to user
     * @params $paymentId (the code with the user payment_id)
     * @return Redirect to doneer.blade. The user wil receive a mail with the code
     */
    public function ship($paymentId){

        //get the code and the connected orders
        $order = Order::where('payment_id', $paymentId)->first();
        $codes = Code::where('order_id', $order->id)->get();
        // send to the correct email and send for each code
        $email = $order->email;
        Mail::to($email)->send(new Mailtrap($email, $codes));
        //redirect to donatiepage
        return redirect()->route('donatiepage')->with('success', 'De code is succesvol verzonden. Check u email (ook uw spam folder).');
    }
}
