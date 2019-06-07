<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $totalDiscountPrice = 0;
    public $totalPurePrice = 0;
    public function __construct($oldCart)
    {
        if ($oldCart){
            $this->items = $oldCart->items ;
            $this->totalQty = $oldCart->totalQty ;
            $this->totalPrice = $oldCart->totalPrice ;
            $this->totalDiscountPrice = $oldCart->totalDiscountPrice ;
            $this->totalPurePrice = $oldCart->totalPurePrice ;
        }
    }

    public function add($item , $id)
    {
        if ($item->discount_price){
            $storedItem = ['qty' => 0 , 'price' => $item->discount_price , 'item' => $item];
        }else{
            $storedItem = ['qty' => 0 , 'price' => $item->price , 'item' => $item];
        }

        if ($this->items){
            if (array_key_exists($id , $this->items)){
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['qty']++ ;
        if ($item->discount_price){
            $storedItem['price'] = $item->discount_price * $storedItem['qty'];
            $this->totalPrice += $item->discount_price ;
            $this->totalDiscountPrice += ($item->price - $item->discount_price);

        }else{
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $this->totalPrice += $item->price ;
        }
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPurePrice += $item->price ;
    }

    public function remove($item , $id)
    {
        if ($this->items){
            if (array_key_exists($id , $this->items)){
                if ($item->discount_price){
                    $this->items[$id]['price'] -= $item->discount_price ;
                    $this->totalPrice -= $item->discount_price ;
                    $this->totalDiscountPrice -= ($item->price - $item->discount_price);

                }else{
                    $this->items[$id]['price'] -= $item->price ;
                    $this->totalPrice -= $item->price ;
                }
                $this->totalQty--;
                $this->totalPurePrice -= $item->price ;
                if ($this->items[$id]['qty'] > 1){
                    $this->items[$id]['qty']-- ;
                }else{
                    unset($this->items[$id]);
                }
            }
        }
    }
}
