<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\WeightController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\PromoBannerController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\OrderController;


use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\front\CartController;



use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontController::class,'index'])->name('front.index');
// Route::get('/{id}',[FrontController::class,'index']);
// Route::get('/quick/{id}',[FrontController::class,'quickview'])->name('front.quickview');
Route::get('/product/{slug}',[FrontController::class,'product'])->name('product.view');
Route::get('/shop',[FrontController::class,'shop'])->name('product.shop');
Route::get('/category_filter/{slug}',[FrontController::class,'category_filter'])->name('product.category_filter');
Route::get('/blog',[FrontController::class,'blog'])->name('product.blog');
Route::get('/single-blog/{id}',[FrontController::class,'single_blog'])->name('product.single_blog');
Route::get('/search/{str}',[FrontController::class,'search']);

Route::get('/registration_page',[FrontController::class,'registration'])->name('registration_page');
Route::post('/registration_process',[FrontController::class,'registration_process'])->name('registration_process');
Route::get('/otp',[FrontController::class,'sendotp'])->name('sendotp');
Route::post('/verifyotp',[FrontController::class,'verifyotp'])->name('verifyotp');
Route::get('/verification/{id}',[FrontController::class,'verification'])->name('verification');

Route::get('/login_page',[FrontController::class,'login'])->name('login_page');
Route::post('/login_process',[FrontController::class,'login_process'])->name('login_process');

Route::get('/forget_page',[FrontController::class,'forget_page'])->name('forgot_page');
Route::post('/forgot_password',[FrontController::class,'forgot_password']);
Route::get('/forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
Route::post('/forgot_password_change_process',[FrontController::class,'forgot_password_change_process']);

Route::get('/chekout_page',[FrontController::class,'chekout_page'])->name('chekout_page');
Route::post('/place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'order_placed']);

Route::post('/newsletter',[FrontController::class,'newsletter'])->name('newsletter');

Route::group(['middleware' =>'user_auth'],function(){
    Route::get('/order',[FrontController::class,'order'])->name('order');
    Route::get('/order_details/{id}',[FrontController::class,'order_details'])->name('order_details');
    Route::get('/edit_account/{id}',[FrontController::class,'edit_account'])->name('edit_account');
    Route::post('/update_account/{id}',[FrontController::class,'update_account'])->name('update_account');
});


Route::get('/logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    
    return redirect('/');
});

// Cart Controller
Route::post('/addCart',[CartController::class,'addCart'])->name('addCart');
Route::get('/remove_item/{id}',[CartController::class,'remove_item'])->name('remove_item');
Route::get('/viewCart',[CartController::class,'viewCart'])->name('viewCart');
Route::get('/updateCart',[CartController::class,'updateCart'])->name('updateCart');
Route::post('/apply_coupon',[CartController::class,'apply_coupon'])->name('apply_coupon');
Route::post('/shiping_amount',[CartController::class,'shipping'])->name('shipping_amount');
Route::get('/clear_cart',[CartController::class,'clear_cart'])->name('clear_cart');
Route::get('/remove_cupon',[CartController::class,'remove_cupon'])->name('remove_cupon');






Route::get('admin',[AdminController::class,'index'])->name('admin');
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware' =>'admin_auth'],function(){
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    // Category Controller
    Route::resource('admin/category',CategoryController::class);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class,'status']);
    // Coupon Controller
    Route::resource('admin/coupon', CouponController::class);
    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class,'status']);
    // Weight Controller
    Route::resource('admin/weight', WeightController::class);
    Route::get('admin/weight/status/{status}/{id}', [WeightController::class,'status']);
    // Product Controller
    Route::resource('admin/product', ProductController::class);
    Route::get('admin/product/status/{status}/{id}', [ProductController::class,'status']);
    Route::get('admin/product/product_attr_delete/{paid}/{pid}', [ProductController::class,'delete']);
    Route::get('admin/product/product_images_delete/{piid}/{pid}', [ProductController::class,'image_delete']);
    // Banner Controller
    Route::resource('admin/banner', BannerController::class);
    Route::get('admin/banner/status/{status}/{id}', [BannerController::class,'status']);
    // Promotional Banner Controller
    Route::resource('admin/promo_banner', PromoBannerController::class);
    Route::get('admin/promo_banner/status/{status}/{id}', [PromoBannerController::class,'status']);
    // Category Controller
    Route::resource('admin/customer', CustomerController::class);
    Route::get('admin/customer/status/{status}/{id}', [CustomerController::class,'status']);
     // Unit Controller
    Route::resource('admin/unit', UnitController::class);
    Route::get('admin/unit/status/{status}/{id}', [UnitController::class,'status']);
    //Blog Controller 
    Route::resource('admin/blog', BlogController::class);
    Route::get('admin/blog/status/{status}/{id}', [BlogController::class,'status']);
    //Shipping Controller 
    Route::resource('admin/shipping', ShippingController::class);
    Route::get('admin/shipping/status/{status}/{id}', [ShippingController::class,'status']);
    //Order Controller
    Route::get('admin/order',[OrderController::class,'index'])->name('order.index');
    Route::get('admin/orders_details/{id}',[OrderController::class,'orders_details'])->name('orders_details');
    Route::get('admin/update_payment_status/{status}/{id}',[OrderController::class,'update_payment_status']);
    Route::get('admin/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']);
    Route::post('admin/orders_details/{id}',[OrderController::class,'update_track_details']);


    Route::get('/admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error','Logout successfully.');
        return redirect()->intended(route('admin'));
    });
});

