<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Order;

class UserPageController extends Controller
{

    /*
     * Function to return the homepage
     * @return view welcome.blade
     */
    public function getHomePage(){
        return view('welcome');
    }
    /*
    * Function to return the donatiepage
    * @return view doneer.blade
    */
    public function getDoneerPage(){
        return view('doneer');
    }
    /*
    * This function returns the view connected tot the webhook url
    * @return view payed.blade
    */
    public function payed(){
        return view('payed');
    }
    /*
    * Function to return the buyCode view
    * @return view buycode.blade
    */
    public function getBuyPage(){
        return view('buycode');
    }
    /*
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
            /*
             * Generate a unique order id for this example. It is important to include this unique attribute
             * in the redirectUrl (below) so a proper return page can be shown to the customer.
             */
            $orderId = time();
            /*
             * Determine the url parts to these example files.
             */
//            $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
//            $hostname = $_SERVER['HTTP_HOST'];
//            $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
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
                "description" => "Order #{$orderId}",
                "redirectUrl" => route('finish', ['orderId' => $orderId]),
                "webhookUrl" => route('webhook'),
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
            //validate the data
            $this->validate($request, [
                'email' => ['required', 'string', 'max:255'],
                'numberOfCodes' => ['required', 'integer', 'max:1']
            ]);


            //create the data to store in DB
            $order = new Order;
            $order->email = $request->input('email');
            $order->payment_id = $payment->id;
            $order->orderNumber = $orderId;
            $order->numberOfCodes = $numberOfCodes;
            $order->paymentStatus = $payment->status;
            $order->save();

            //create tickets as many as the numberOfCodes
            $ticket = new Ticket;
            for($i = 0; i < $numberOfCodes; $i++){
                $ticket->order_id = $orderId;
                $ticket->ticketNumber = time();
                $ticket->used = false;
                $ticket->save();
            }
            //check if the user wants to pay with ideal or paypal
            if($request->input('paymethod') == 'ideal'){
                $payUrl = $payment->getCheckoutUrl();
            }else{
                //TODO: Put the right link here later
                $payUrl = 'Paypal';
            }
            /*
             * Send the customer off to complete the payment.
             * This request should always be a GET, thus we enforce 303 http response code
             */
            return redirect($payUrl, 303);


        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: (Pay)" . htmlspecialchars($e->getMessage());
        }
    }

    /*
     * Function to finish the payment
     * @param Ticket object
     * @return view doneer
     */
    public function finishPayment($orderId){

        $order = Order::where('orderNumber', $orderId)->first();
        $mollie = $this->APIKeyData();

        $payment = $mollie->payments->get($order->payment_id);

        if (!$payment->isPaid()) {
            return view('order_status', [
                'payment' => $payment,
                'order' => $order,
            ]);
        }
        $order->paymentStatus = $payment->status;
        $order->save();

        return redirect()->route('sendmail', ['paymentId' => $payment->id]);
    }

    public function getOrderStatus(){
        return view('order_status');
    }

    /*
     * Check if the paymentstatus
     * @param the order id
     * @returns, the payed view with success or error
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

    /*
     * Function to get the LEDS
     * @return json file
     */
    public function getLeds(){
        return response()->file(storage_path('ledjes.json'));
    }

    /*
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
