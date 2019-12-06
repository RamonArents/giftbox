<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

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
    * Function to return the success or failure page when someone has payed
    * @param, the orderid
    * @return view payed.blade
    */
    public function payed($orderId){
        return view('payed', ['orderId' => $orderId]);
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

            /*
             * Generate a unique order id for this example. It is important to include this unique attribute
             * in the redirectUrl (below) so a proper return page can be shown to the customer.
             */
            $orderId = time();
            /*
             * Determine the url parts to these example files.
             */
            $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
            $hostname = $_SERVER['HTTP_HOST'];
            $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);
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
                    "value" => "1.00" // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Order #{$orderId}",
                "redirectUrl" => route('payed', ['orderId' => $orderId]),
                //TODO: This link works only online (not localhost). The route should call the finishPayment function
                "webhookUrl" => "https://webshop.example.org/mollie-webhook/",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
            //send the data to the database
            $this->validate($request, [
                'email' => ['required', 'string', 'max:255'],
            ]);



            $ticket = new Ticket;
            $ticket->email = $request->input('email');
            $ticket->payment_id = $payment->id;
            $ticket->orderNumber = $orderId;
            $ticket->paymentStatus = $this->checkPayment($payment->id);
            $ticket->used = false;
            /*
             * Send the customer off to complete the payment.
             * This request should always be a GET, thus we enforce 303 http response code
             */
            return redirect($payment->getCheckoutUrl(), 303);


        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: (Pay)" . htmlspecialchars($e->getMessage());
        }
    }

    /*
     * Function to finish the payment
     * @param Ticket object
     * @return view doneer
     */
    public function finishPayment(Ticket $ticket){
        $payment = $this->payment->get($ticket->payment_id);

        $payStatus = $this->checkPayment($payment->id);

        $ticket->paymentStatus = $payStatus;
        $ticket->save();

        //TODO: call here function to send email with the Order data

        return redirect()->route('doneer')->with('success', 'Code is succesvol betaald. Check u email.');
    }

    /*
     * Check if the user has payed
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
                $payStatus = 'betaald';
            } elseif ($payment->isOpen()) {
                $payStatus = 'open';
            } elseif ($payment->isPending()) {
                $payStatus = 'bezig';
            } elseif ($payment->isFailed()) {
                $payStatus = 'mislukt';
            } elseif ($payment->isExpired()) {
                $payStatus = 'verlopen';
            } elseif ($payment->isCanceled()) {
                $payStatus = 'geweigerd';
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
                $payStatus = 'betaald';
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
                $payStatus = 'betaald';
            }
            return $payStatus;
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed (checkPayment): " . htmlspecialchars($e->getMessage());
        }
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
