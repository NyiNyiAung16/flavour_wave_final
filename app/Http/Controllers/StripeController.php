<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function getSession(){
        $privatekey = env('STRIPE_PRIVATE_KEY');
        $stripe = new \Stripe\StripeClient($privatekey);
        $checkout = $stripe->checkout->sessions->create([
            'success_url'=>'http://127.0.0.1:8000/dashboard',
            'cancel_url'=>'http://127.0.0.1:8000/checkout',
            'mode'=>'payment',
            ]);
        return $checkout;
    }
}
