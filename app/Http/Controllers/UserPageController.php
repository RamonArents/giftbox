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
    * @return view payed.blade
    */
    public function payed(){
        return view('payed');
    }
    /*
     * Function to send payment with the API
     * @return success or failure
     */
    public function pay(){
        try {
            /*
             * Initialize the Mollie API library with your API key.
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
                "redirectUrl" => "{$protocol}://{$hostname}{$path}/payments/return.php?order_id={$orderId}",
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
            dd($payment);

//            if ($payment->isPaid())
//            {
//                echo "Payment received.";
//            }else{
//                echo "Payment not received.";
//            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
