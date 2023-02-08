<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use App\Models\payment;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

         // Getting the value via an array method
         $payment = new Payment();

         $payment->email = $paymentDetails['data']['customer']['email'];// Getting email I passed from the form
         $payment->status = $paymentDetails['data']['status']; // Getting the status of the transaction
         $payment->amount = $paymentDetails['data']['amount']; //Getting the Amount
         $payment->trans_id = $paymentDetails['data']['id']; // Getting the id of the transaction
         $payment->ref_id = $paymentDetails['data']['reference']; //Getting the reference id
         
         if ($payment->save()) {
            return redirect('/my-orders')->with('message', 'Transaction successful');
         }else {
            return redirect()->back()->with('message', 'Transaction failed');
         }
    }
}