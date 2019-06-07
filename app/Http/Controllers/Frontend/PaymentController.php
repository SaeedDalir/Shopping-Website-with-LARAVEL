<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function verify(Request $request,$orderId)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null ;
        if (!$cart)
        {
            Session::flash('unsuccess','سبد خرید شما خالی می باشد.');
            return redirect('/profile');
        }
        else
        {
            $payment = new Payment($cart->totalPrice,$orderId);
            $result = $payment->verifyPayment($request->Authority , $request->Status);
            if ($result)
            {
                if ($result->Status == 100)
                {
                    $order = Order::findOrFail($orderId)->update(['status'=>1]);
                    $newPayment = new Payment();
                    $newPayment->Authority =$request->Authority;
                    $newPayment->Status =$request->Status;
                    $newPayment->RefID =$result->RefID;
                    $newPayment->order_id =$orderId;
                    $newPayment->save();

                    Session::forget('cart');
                    Session::flash('success','پرداخت با موفقیت انجام شد.');
                    return redirect('/profile');
                }
                else
                {
                    Session::flash('unsuccess','با عرض پوزش پرداخت با موفقیت انجام نشد.');
                    return redirect('/profile');
                }
            }
            else
            {
                $order = Order::findOrFail($orderId)->delete();
                Session::flash('unsuccess','پرداخت توسط کاربر لغو گردیده است.');
                return redirect('/profile');
            }

        }
    }
}
