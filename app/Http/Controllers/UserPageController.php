<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use App\Order;
use App\Card;
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
            //check if the user wants to pay with ideal or paypal (this can later be included in the Mollie profile)
//            if($request->input('paymethod') == 'ideal'){
//                $payMethod = 'ideal';
//            }else{
//                $payMethod = 'paypal'; // or creditcard.
//            }
            $payMethod = 'ideal';
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
                $code = new Code;
                $code->order_id = $orderTableId->id;
                $code->codeNumber = rand(1, 1000000000);
                $code->used = false;
                $code->save();
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
     * @param Code object
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
     * Function to activate the candles
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

            if(time() > time() + 10){
                array_unshift($ledArray, $ledsData['led_list']);
            }
            return redirect()->route('donatiepage')->with('success', 'U lampje brand nu. U heeft lampje ' . $ledsData['led_list']);
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
     * Function to get the view to get the balance of the RFID card
     * @return view opladen
     */
    public function getBalancePage(){

        return view('opladen');
    }
    /**
     * Function to add balance to the RFID card
     * @param Request, the card to add balance
     * @return redirect to view opladen
     */
    public function addBalance(Request $request){
        $cardNumber = $request->input('card');

        $selectedCard = Card::where('cardNumber', $cardNumber)->first();

        if(!isset($selectedCard)){
            return redirect()->route('getBalance')->with('error', 'Het kaartnummer bestaat niet.');
        }else {
            try {
                //initialize Mollie
                $mollie = $this->APIKeyData();
                $amount = $request->input('amount');
                $totalEuros = number_format($amount, 2);
                //check if the user wants to pay with ideal or paypal (this can later be included in the Mollie profile)
//                if($request->input('paymethod') == 'ideal'){
//                    $payMethod = 'ideal';
//                }else{
//                    $payMethod = 'paypal'; // or creditcard. Ask the right value to the employer
//                }
                $payMethod = 'ideal';
                /*
                 * Generate a unique order id for this example. It is important to include this unique attribute
                 * in the redirectUrl (below) so a proper return page can be shown to the customer.
                 */
                //$orderNumber = time();
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
                    "description" => "Order #{$cardNumber}",
                    "redirectUrl" => route('finishAdd', ['cardNumber' => $cardNumber]),
                    "webhookUrl" => route('webhook'),
                    "metadata" => [
                        "order_id" => $cardNumber,
                    ],
                ]);
                //validate the data
                $this->validate($request, [
                    'card' => ['required', 'string'],
                    'amount' => ['required', 'integer'],
                ]);
                $selectedCard->payment_id = $payment->id;
                $selectedCard->cardNumber = $cardNumber;
                $selectedCard->save();
                /*
                 * Send the customer off to complete the payment.
                 * This request should always be a GET, thus we enforce 303 http response code
                 */
                return redirect($payment->getCheckoutUrl(), 303);

            } catch (\Mollie\Api\Exceptions\ApiException $e) {
                echo "API call failed: (Pay)" . htmlspecialchars($e->getMessage());
            }
        }
    }
    /**
     * Function to finish the payment
     * @param Code object
     * @return view doneer
     */
    public function finishPaymentAddToCard($cardNumber){
        //get the right order from the DB
        $card = Card::where('cardNumber', $cardNumber)->first();
        $mollie = $this->APIKeyData();
        //find the Mollie payment
        $payment = $mollie->payments->get($card->payment_id);
        //set the status to paid
//        $payment->status = 'paid';
        // if the order isn't paid, return a page with the current status
        if (!$payment->isPaid()) {
            return view('order_status', [
                'payment' => $payment,
                'order' => $card,
            ]);
        }
        //convert payment amount to number
        $amount = intval($payment->amount);
        $card->balance =  $card->balance + $amount;
        $card->save();
        //redirect to send email with the codes
        return redirect()->route('getBalance')->with('success', 'Kaart succesvol opgeladen. Uw saldo is €' . $card->balance);
    }
    /**
     * Function to check the balance of the RFID card
     * @param Request, the card to be checked
     * @return redirect to view opladen
     */
    public function getBalanceFromDB(Request $request){
        $cardNumber = $request->input('cardNumber');

        $getBalance = Card::where('cardNumber', $cardNumber)->first();

        if(!isset($getBalance)){
            return redirect()->route('getBalance')->with('error', 'Het kaartnummer bestaat niet.');
        }else {
            return redirect()->route('getBalance')->with('success', 'Uw saldo is €' . $getBalance->balance);
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
