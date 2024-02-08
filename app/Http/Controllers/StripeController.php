<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index(){
        return view('payment');
    }

    public function checkout(Product $product){

        $product->update(['payment' => 1]);

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'kgs',
                        'product_data' => [
                            'name' => 'gimme money!!!!',
                        ],
                        'unit_amount'  => $product->price*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('payment.success',$product->update(['payment' => 1])),
            'cancel_url'  => route('payment.checkout',$product),
        ]);

        return redirect()->away($session->url);
    }

    public function success(){
        return redirect()->route('dashboard')->with('success','Успешно оплачено');
    }
}
