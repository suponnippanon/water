<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{

    public function checkout()
    {
        $cart = Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        $villages = Village::all();
        return view('products.checkout', compact('villages'), ['cartItems'=>$cart]);
    }

    public function createOrder(Request $request)
    {

        $validated = $request->validate([
            'email' => ['required'],
            'fname' => ['required'],
            'lname' => ['required'],
            'address' => ['required'],
            'zip' => ['required'],
            'phone' => ['required'],
        ]);


        $cart = Session::get('cart');

        $email = $request->email;
        $fname = $request->fname;
        $lname = $request->lname;
        $address = $request->address;
        $zip = $request->zip;
        $phone = $request->phone;
        $village_name = $request->village_name;
        $user_id = Auth::id();

       if($cart)
       {
        $date = date('Y-m-d H:i:s');
        //Data
        $newOrder = array(
            'date'=>$date,
            'price'=>$cart->totalPrice,
            'status'=>'Not Paid',
            'del_date'=>$date,
            'fname'=>$fname,
            'lname'=>$lname,
            'address'=>$address,
            'email'=>$email,
            'zip'=>$zip,
            'phone'=>$phone,
            'village_name'=>$village_name,
            'user_id'=>$user_id
        
        );
        // Insert order Data
        $create_Order = DB::table('orders')->insert($newOrder);
        $order_id = DB::getPDO()->lastInsertId();

        // Insert order Item Data
        foreach($cart->items as $item)
        {
            $item_id = $item['data']['id'];
            $item_name = $item['data']['name'];
            $item_price = $item['data']['price'];
            $item_amount = $item['quantity'];
            $newOrderItem = array(
                'item_id'=>$item_id,
                'order_id'=>$order_id,
                'item_name'=>$item_name,
                'item_price'=>$item_price,
                'item_amount'=>$item_amount,
            );
            $create_orderItem = DB::table('orderitems')->insert($newOrderItem);
        }
        Session::forget('cart');
        $payment_info = $newOrder;
        $payment_info['order_id'] = $order_id;
        $request->session()->put('payment_info', $payment_info);

        return to_route('products.showpayment');
        }else{
            return to_route('products.index');
        }
    }

    public function showPayment()
    {
        $payment_info = Session::get('payment_info');
        if($payment_info['status']=='Not Paid')
        {
            return view('products.showpayment', ['payment_info'=>$payment_info]);
        }else{
            return view('products.index');
        }
       
    }

}
