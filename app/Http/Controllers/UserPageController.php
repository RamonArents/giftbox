<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use App\Order;
use Storage;

class UserPageController extends Controller
{

    /**
     * Function to return the homepage
     * @return view welcome.blade
     */
    public function getHomePage(){
        return view('welcome');
    }
    /**
     * Function to return the donatiepage
     * @return view doneer.blade
     */
    public function getDoneerPage(){
        return view('doneer');
    }
    /**
     * This function returns the view connected tot the webhook url
     * @return view payed.blade
     */
    public function payed(){
        return view('payed');
    }
    /**
     * Function to return the buyCode view
     * @return view buycode.blade
     */
    public function getBuyPage(){
        return view('buycode');
    }
    /**
     * Function to send payment with the API
     * @param request (send the data of the payment to the DB)
     * @return success or failure
     */
    public function pay(Request $request){
        try {
            //initialize Mollie
            $mollie = $this->APIKeyData();
            //number of codes to save
            $numberOfCodes = $request->input('numberOfCodes');
            $totalEuros = number_format($numberOfCodes, 2);
            //check if the user wants to pay with ideal or paypal
            if($request->input('paymethod') == 'ideal'){
                $payMethod = 'ideal';
            }else{
                $payMethod = 'paypal'; // or creditcard. Ask the right value to the employer
            }
            /*
             * Generate a unique order id for this example. It is important to include this unique attribute
             * in the redirectUrl (below) so a proper return page can be shown to the customer.
             */
            $orderNumber = time();
            /*
             * Payment parameters:
             *   amount        Amount in EUROs.
             *   description   Description of the payment.
             *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
             *   webhookUrl    Webhook location, used to report when the payment changes state.
             *   metadata      Custom metadata that is stored with the payment.
             */
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $totalEuros // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "method" => $payMethod,
                "description" => "Order #{$orderNumber}",
                "redirectUrl" => route('finish', ['orderNumber' => $orderNumber]),
                "webhookUrl" => route('webhook'),
                "metadata" => [
                    "order_id" => $orderNumber,
                ],
            ]);
            //validate the data
            $this->validate($request, [
                'email' => ['required', 'string', 'max:255'],
                'numberOfCodes' => ['required']
            ]);


            //create the data to store in DB
            $order = new Order;
            $order->email = $request->input('email');
            $order->payment_id = $payment->id;
            $order->orderNumber = $orderNumber;
            $order->numberOfCodes = $numberOfCodes;
            $order->paymentStatus = $payment->status;
            $order->save();


            $orderTableId = Order::where('orderNumber', $orderNumber)->first();
            for($i = 0; $i < (int) $numberOfCodes; $i++){
                //create tickets as many as the numberOfCodes
                $ticket = new Code;
                $ticket->order_id = $orderTableId->id;
                $ticket->codeNumber = rand(1, 1000000000);
                $ticket->used = false;
                $ticket->save();
            }
            /*
             * Send the customer off to complete the payment.
             * This request should always be a GET, thus we enforce 303 http response code
             */
            return redirect($payment->getCheckoutUrl(), 303);


        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: (Pay)" . htmlspecialchars($e->getMessage());
        }
    }

    /**
     * Function to finish the payment
     * @param Ticket object
     * @return view doneer
     */
    public function finishPayment($orderNumber){
        //get the right order from the DB
        $order = Order::where('orderNumber', $orderNumber)->first();
        $mollie = $this->APIKeyData();
        //find the Mollie payment
        $payment = $mollie->payments->get($order->payment_id);
        // if the order isn't paid, return a page with the current status
        if (!$payment->isPaid()) {
            return view('order_status', [
                'payment' => $payment,
                'order' => $order,
            ]);
        }
        //save the payment status in the DB
        $order->paymentStatus = $payment->status;
        $order->save();
        //redirect to send email with the codes
        return redirect()->route('sendmail', ['paymentId' => $payment->id]);
    }
    /**
     * Gets the payment status other than paid
     * @return, the payed view with the status
     */
    public function getOrderStatus(){
        return view('order_status');
    }

    /**
     * Function to activate the cadles
     * @param Request to get the request from the user
     * @return doneer.blade.php
     */
    public function useCode(Request $request){
        //get the right ticket
        $code = $request->input('code');
        $getCode = Code::where('codeNumber', $code)->first();
        //check if the ticket exists or is already used
        if(!isset($getCode)){
            return redirect()->route('donatiepage')->with('error', 'De code die u heeft ingevuld bestaat niet.');
        }else if($getCode->used == true){
            return redirect()->route('donatiepage')->with('error', 'De code die u heeft ingevuld is al gebruikt.');
        }
        else{
            $leds = file_get_contents(storage_path('ledjes.json'));
            $ledsData = json_decode($leds, true);

            $ledArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
            $ledsData['led_list'] = $ledArray[0]; //array_rand($ledArray, 1)
            $newLeds = json_encode($ledsData, JSON_PRETTY_PRINT);
            file_put_contents(storage_path('ledjes.json'), stripslashes($newLeds));
            unset($ledArray[$ledsData['led_list']]);

            $getCode->used = true;
            $getCode->save();

            if(time() + 10 > time()){
                array_unshift($ledArray, $ledsData['led_list']);
            }
            return redirect()->route('donatiepage')->with('success', 'U kaarsje brand nu. U heeft kaars nr ' . $ledsData['led_list']);
        }
    }
    /**
     * Function to get the LEDS
     * @return json file
     */
    public function getLeds(){
        return response()->file(storage_path('ledjes.json'));
    }
    /**
     * Check if the paymentstatus
     * @param the order id
     * @return, the payed view with success or error
     */
    protected function checkPayment($paymentId){
        try {
            //status payment
            $payStatus = '';
            //initialize Mollie
            $mollie = $this->APIKeyData();

            $payment = $mollie->payments->get($paymentId);


            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                $payStatus = 'paid';
            } elseif ($payment->isOpen()) {
                $payStatus = 'open';
            } elseif ($payment->isPending()) {
                $payStatus = 'pending';
            } elseif ($payment->isFailed()) {
                $payStatus = 'failed';
            } elseif ($payment->isExpired()) {
                $payStatus = 'expired';
            } elseif ($payment->isCanceled()) {
                $payStatus = 'refused';
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
                $payStatus = 'paid';
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
                $payStatus = 'paid';
            }
            return $payStatus;
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed (checkPayment): " . htmlspecialchars($e->getMessage());
        }
    }

    /**
     * This function contains the API key for mollie
     * @return Mollie payment object
     */
    protected function APIKeyData(){
        /*
         * Initialize the Mollie API library with your API key.
         *
         * See: https://www.mollie.com/dashboard/developers/api-keys
         */
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_VwV3F2FxUxPPmRhyBJTQwCK4yKQcEH");
        return $mollie;
    }
}
