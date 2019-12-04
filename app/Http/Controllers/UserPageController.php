<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return success or failure
     */
    public function pay(){
        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey("test_VwV3F2FxUxPPmRhyBJTQwCK4yKQcEH");
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
                "webhookUrl" => "https://webshop.example.org/mollie-webhook/",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
            /*
             * Send the customer off to complete the payment.
             * This request should always be a GET, thus we enforce 303 http response code
             */
            header("Location: " . $payment->getCheckoutUrl(), true, 303);


            $payment = $mollie->payments->get($payment->id);
            return redirect($payment->getCheckoutUrl());


        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    /*
     * Check if the user has payed
     * @param the order id
     * @returns, the payed view with success or error
     */
    public function checkPayment($paymentId){



            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
            } elseif ($payment->isOpen()) {
                /*
                 * The payment is open.
                 */
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
            } elseif ($payment->isFailed()) {
                /*
                 * The payment has failed.
                 */
            } elseif ($payment->isExpired()) {
                /*
                 * The payment is expired.
                 */
            } elseif ($payment->isCanceled()) {
                /*
                 * The payment has been canceled.
                 */
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
            }
    }

    protected function APIKeyData(){

    }
}
