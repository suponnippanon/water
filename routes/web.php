<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Admin\CheckOrdersController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\PaymentPanelController;
use App\Http\Controllers\Frontend\OrderController  as FrontendOrderController;
use App\Http\Controllers\Frontend\ProductController  as FrontendProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('/products/details/{id}', [FrontendProductController::class, 'details'])->name('products.details');
Route::get('/products/search', [FrontendProductController::class, 'searchProduct'])->name('products.search');
// //add to cart
// Route::get('/products/addtocart/{id}', [FrontendProductController::class, 'addToCart'])->name('products.addtocart');
// Route::get('/products/cart', [FrontendProductController::class, 'showCart'])->name('products.showcart');
// Route::get('/products/cart/deletefromcart/{id}',  [FrontendProductController::class, 'deleteFromCart'])->name('products.deletefromcart');
// Route::get('/products/cart/incrementcart/{id}',  [FrontendProductController::class, 'incrementCart'])->name('products.incrementcart');
// Route::get('/products/cart/decrementcart/{id}',  [FrontendProductController::class, 'decrementCart'])->name('products.decrementcart');




Route::get('/',function(){
    return redirect('/products');
});
// Route::get('/', [WelcomeController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verifyIsAdmin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/',[AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/villages', VillageController::class);
    Route::resource('/orders', OrderController::class);

    Route::get('/payments',[PaymentPanelController::class, 'paymentsPanel'])->name('payments.panel');
});

Route::middleware(['auth'])->group(function(){
    //add to cart
    Route::get('/products/addtocart/{id}', [FrontendProductController::class, 'addToCart'])->name('products.addtocart');
    Route::get('/products/cart', [FrontendProductController::class, 'showCart'])->name('products.showcart');
    Route::get('/products/cart/deletefromcart/{id}',  [FrontendProductController::class, 'deleteFromCart'])->name('products.deletefromcart');
    Route::get('/products/cart/incrementcart/{id}',  [FrontendProductController::class, 'incrementCart'])->name('products.incrementcart');
    Route::get('/products/cart/decrementcart/{id}',  [FrontendProductController::class, 'decrementCart'])->name('products.decrementcart');
    Route::post('/products/addquantitytocart', [FrontendProductController::class, 'addQuantityToCart'])->name('products.addquantitytocart');
    

    //create orders
    Route::get('/products/checkout', [FrontendOrderController::class, 'checkout'])->name('products.checkout');
    Route::post('/products/createOrder', [FrontendOrderController::class, 'createOrder'])->name('products.createorder');
    Route::get('/products/showpayment', [FrontendOrderController::class, 'showPayment'])->name('products.showpayment');
    

    Route::get('/paymentreceipt/{paypalOrderID}/{payerID}', [PaymentController::class,'showPaymentreceipt']);
});

