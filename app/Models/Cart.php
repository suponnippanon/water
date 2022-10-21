<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart{


    public $items;//Array
    public $totalQuantity;//จำนวนสินค้าในตะกร้า
    public $totalPrice;//จำนวนราคารวม

    public function __construct($prevCart)
    {
        //ตะกร้าเก่า
        if($prevCart != null)
        {
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
        }else{
            //ตะกร้าใหม่
            $this->items=[];
            $this->totalQuantity=0;
            $this->totalPrice=0;

        }
        
    }

    public function addItem($id, $product)
    {
        $price = (int)($product->price);
        if(array_key_exists($id, $this->items))
        {
            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++; //เพิ่มจำนวนสินค้าในรายการนั้นๆ
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity']*$price;
        }else{
            $productToAdd = ['quantity'=>1, 'totalSinglePrice'=>$price, 'data'=>$product];
        }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice+$price;

    }

    public function addQuantity($id, $product, $amount)
    {
        if($amount>0)
        {
            $price = (int)($product->price);
            if(array_key_exists($id, $this->items))
            {
                $productToAdd = $this->items[$id];
                $productToAdd['quantity']+=$amount; //เพิ่มจำนวนสินค้าในรายการนั้นๆ
                $productToAdd['totalSinglePrice'] = $productToAdd['quantity']*$price;
            }else{
                $productToAdd = ['quantity'=>$amount, 'totalSinglePrice'=>$price*$amount, 'data'=>$product];
            }
        }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity+=$amount;
        $this->totalPrice = $this->totalPrice+$price;

    }

    public function updatePriceQuantity()
    {
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach($this->items as $item){
            $totalQuantity = $totalQuantity+$item['quantity']; //จำนวนสินค้ารวม
            $totalPrice = $totalPrice+$item['totalSinglePrice']; //ราคารวมแต่ละรายการ
        }
        
        $this->totalQuantity = $totalQuantity;
        $this->totalPrice = $totalPrice;

    }



}





