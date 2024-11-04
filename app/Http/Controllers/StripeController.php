<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\User;

class StripeController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        // Validate amount and currency
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|size:3'
        ]);
    
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount, // Dynamic amount
            'currency' => $request->currency, // Dynamic currency
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);
        
    
        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
    

    public function handlePaymentSuccess(Request $request)
{
    // Verify if payment was successful with Stripe
    $request->validate([
        'payment_intent_id' => 'required|string'
    ]);

    $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

    if ($paymentIntent->status === 'succeeded') {
        $user = $request->user(); // Authenticated user
        if ($user) {
            $user->assignRole('editor');
        }
        return response()->json([
            'message' => 'Payment successful and role updated to editor!',
            'user' => $user,
        ]);
    } else {
        return response()->json(['message' => 'Payment not successful'], 400);
    }
}

}