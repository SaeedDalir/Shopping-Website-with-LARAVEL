<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function verify()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null ;
        if (!$cart)
        {
            Session::flash('unsuccess','سبد خرید شما خالی می باشد.');
            return redirect('/profile');
        }
        else
        {
            $productId = [];
            foreach ($cart->items as $product){
                $productId[$product['item']->id] = ['qty'=>$product['qty']];
            }
            $order = Order::create([
                'amount' => $cart->totalPrice,
                'user_id' => auth()->user()->id,
                'status' => 0,
            ]);
            $order->products()->attach($productId);
            $payment = new Payment($order->amount,$order->id);
            $result = $payment->doPayment();
            if ($result->Status == 100) {
                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
            } else {
                Session::flash('unsuccess','پرداخت با مشکل مواجه شده است لطفا بعدا تلاش فرمائید.');
                return redirect('/profile');
            }
        }
    }
}
