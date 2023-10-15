<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
//    public function checkout()
//    {
//        return view('checkout');
//    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productName = $request->get('productName');
        $productPrice = $request->get('price');
        $totalPrice = str_replace([',', '.'], ['', ''], $productPrice);

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'INR',
                        'product_data' => [
                            "name" => $productName,
                        ],
                        'unit_amount'  => $totalPrice,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return redirect()->away('/');
    }
}
