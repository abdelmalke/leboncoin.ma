<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\StripeController;
































  // public function processPayment(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    
    //     $paymentMethodId = $request->input('paymentMethodId');
    //     $amount = 900; // Amount in cents
    
    //     try {
    //         $paymentIntent = \Stripe\PaymentIntent::create([
    //             'amount' => $amount,
    //             'currency' => 'usd',
    //             'payment_method' => $paymentMethodId,
    //             'confirm' => true,
    //             'description' => 'Upgrade to Editor Role',
    //         ]);
    
    //         // Promote user to "editor" role
    //         $user = auth()->user();
    //         if (!$user) {
    //             return response()->json(['success' => false, 'message' => 'User not authenticated.'], 403);
    //         }
    
    //         $user->assignRole('editor');
    
    //         return response()->json(['success' => true, 'message' => 'Payment successful! You are now an Editor.'], 200);
    //     } catch (\Stripe\Exception\ApiErrorException $e) {
    //         \Log::error('Stripe error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Payment error: ' . $e->getMessage()], 500);
    //     } catch (\Exception $e) {
    //         \Log::error('Payment error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()], 500);
    //     }
    // }
//     public function processPayment(Request $request)
// {
//     Stripe::setApiKey(env('STRIPE_SECRET'));

//     $token = $request->input('token');
//     // $amount = $request->input('amount');
//     $amount = 900;

//     try {
//         // Create a charge using the token
//         $charge = \Stripe\Charge::create([
//             'amount' => $amount, // Amount in cents
//             'currency' => 'usd',
//             'source' => $token,
//             'description' => 'Upgrade to Editor Role',
//         ]);

//         // Promote user to "editor" role
//         $user = auth()->user();
//         $user->assignRole('editor');
        

//         return response()->json(['success' => true, 'message' => 'Payment successful!'], 200);
//     } catch (\Exception $e) {
//         \Log::error('Payment error: ' . $e->getMessage());
//         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
//     }
// }

    // public function success(Request $request)
    // {
    //     $session_id = $request->query('session_id');

    //     if ($session_id) {
    //         Stripe::setApiKey(env('STRIPE_SECRET'));

    //         // Retrieve checkout session details
    //         $session = \Stripe\Checkout\Session::retrieve($session_id);
    //         $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

    //         // Assign 'editor' role to the authenticated user after payment is successful
    //         $user = auth()->user();
    //         $user->assignRole('editor');

    //         return redirect('/home')->with('success', 'Payment successful! You are now upgraded to the Editor role.');
    //     }

    //     return redirect('/home')->with('error', 'Payment failed.');
    // }

    // public function cancel()
    // {
    //     return redirect('/home')->with('error', 'Payment was canceled.');
    // }
     // public function processPayment(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     // Create Stripe checkout session for role upgrade service
    //     $session = Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'product_data' => [
    //                     'name' => 'Upgrade to Editor Role',
    //                     'description' => 'This payment will upgrade your account to Editor, allowing you to publish posts.',
    //                 ],
    //                 'unit_amount' => 1000, // Charge $10 for the role upgrade
    //             ],
    //             'quantity' => 1,
    //         ]],
    //         'mode' => 'payment',
    //         'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('payment.cancel'),
    //     ]);

    //     return response()->json(['id' => $session->id]);
    // }
    // public function processPayment(Request $request)
    // {
    //     // Set your secret key
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     // Get the token from the request
    //     $token = $request->input('token');
    //     $amount = $request->input('amount');

    //     try {
    //         // Create a charge using the token
    //         $charge = Charge::create([
    //             'amount' => $amount, // Amount in cents
    //             'currency' => 'usd',
    //             'source' => $token,
    //             'description' => 'Upgrade to Editor Role',
    //         ]);

    //         // If payment is successful, promote user to "editor" role
    //         $user = auth()->user();
    //         $user->assignRole('editor');

    //         return response()->json(['success' => true, 'message' => 'Payment successful!'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }