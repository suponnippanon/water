<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Village;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        return view('products.index', ['cartItems'=>$cart])
            ->with("products", Product::paginate(4))
            ->with("categories", Category::all());
    }

    public function details($id)
    {
        $cart = Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        return view("products.details", ['cartItems'=>$cart])
            ->with("product", Product::find($id));
        
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addItem($id, $product);
        $cart->updatePriceQuantity();
        //update ตะกร้าสินค้า
        $request->session()->put('cart', $cart);
        // reset ค่า session
        // $request->session()->forget('cart');
        // dump($cart);
        return to_route('products.showcart');
     
    }
    
    public function addQuantityToCart(Request $request)
    {
        $id = $request->_id;
        $quantity = $request->quantity;

        $product = Product::find($id);
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart); 
        // $cart->addItem($id, $product);
        $cart->addQuantity($id, $product, $quantity);
        $cart->updatePriceQuantity();
        
        //update ตะกร้าสินค้า
        $request->session()->put('cart', $cart);

        return to_route('products.showcart');
    }

    public function showCart()
    {
        $cart = Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        if($cart){
            return view('products.showcart', ['cartItems'=>$cart]);
        }else{
            return to_route('products.index');
        }
    }

    public function deleteFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart');
        if(array_key_exists($id, $cart->items))
        {
            unset($cart->items[$id]); //ลบสินค้าตามไอดีที่ส่งมา
        }
        // สินค้าคงเหลือ
        $afterCart = $request->session()->get('cart');
        $updateCart = new Cart($afterCart);
        $updateCart->updatePriceQuantity();

        //update session อีกรอบ
        $request->session()->put('cart', $updateCart);
        return to_route('products.showcart');

    }

    public function incrementCart(Request $request, $id)
    {
        $product = Product::find($id);
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);
        $cart->addItem($id, $product);
        $request->session()->put('cart', $cart); 
        return to_route('products.showcart');
    }

    public function decrementCart(Request $request, $id)
    {
        $product = Product::find($id);
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        if($cart->items[$id]['quantity']>1)
        {
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity']*$product['price']; //คำนวณราคาสินค้าใหม่
            $cart->updatePriceQuantity();
            $request->session()->put('cart', $cart);
        }else{
            Session()->flash('warning','ต้องมีสินค้าอย่างน้อย 1 รายการ');
        }
        return to_route('products.showcart');
    }
    
    public function searchProduct(Request $request)
    {   
        $cart = Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า

        
        $name = $request->search;
        $products = Product::where('name', 'LIKE', "%{$name}%" )->paginate(4);
        return view('products.searchproduct', ['cartItems'=>$cart])
            ->with('products', $products)
            ->with("categories", Category::all());

    }

    // public function checkout()
    // {
    //     $villages = Village::all();
    //     return view('products.checkout', compact('villages'));
    // }

    // public function createOrder(Request $request)
    // {
    //     $cart = Session::get('cart');

    //     $email = $request->email;
    //     $fname = $request->fname;
    //     $lname = $request->lname;
    //     $address = $request->address;
    //     $zip = $request->zip;
    //     $phone = $request->phone;
    //     $village_id = $request->village_id;
    //     $user_id = Auth::id();

    //    if($cart)
    //    {
    //     $date = date('Y-m-d H:i:s');
    //     //Data
    //     $newOrder = array(
    //         'date'=>$date,
    //         'price'=>$cart->totalPrice,
    //         'status'=>'Not Paid',
    //         'del_date'=>$date,
    //         'fname'=>$fname,
    //         'lname'=>$lname,
    //         'address'=>$address,
    //         'email'=>$email,
    //         'zip'=>$zip,
    //         'phone'=>$phone,
    //         'village_id'=>$village_id,
    //         'user_id'=>$user_id
        
    //     );
    //     // Insert order Data
    //     $create_Order = DB::table('orders')->insert($newOrder);
    //     $order_id = DB::getPDO()->lastInsertId();

    //     // Insert order Item Data
    //     foreach($cart->items as $item)
    //     {
    //         $item_id = $item['data']['id'];
    //         $item_name = $item['data']['name'];
    //         $item_price = $item['data']['price'];
    //         $newOrderItem = array(
    //             'item_id'=>$item_id,
    //             'order_id'=>$order_id,
    //             'item_name'=>$item_name,
    //             'item_price'=>$item_price
    //         );
    //         $create_orderItem = DB::table('orderitems')->insert($newOrderItem);
    //     }
    //     Session::forget('cart');
    //     $payment_info = $newOrder;
    //     $payment_info['order_id'] = $order_id;
    //     $request->session()->put('payment_info', $payment_info);

    //     return to_route('products.showpayment');
    //     }else{
    //         return to_route('products.index');
    //     }
    // }

    // public function showPayment()
    // {
    //     $payment_info = Session::get('payment_info');
    //     if($payment_info['status']=='Not Paid')
    //     {
    //         return view('products.showpayment', ['payment_info'=>$payment_info]);
    //     }else{
    //         return view('products.index');
    //     }
       
    // }

}
