<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use Cart;

class CartController extends Controller
{
    public function addCart(Request $request){
        // return $request->all;
        // die();
        // if($request->session()->has('FRONT_USER_LOGIN')){
        //     $uid=$request->session()->get('FRONT_USER_LOGIN');
        //     // $user_type="Reg";
        // }else{
        //     $uid=getUserTempId();
        //     // $user_type="Not-Reg";
        // }
        // echo $uid;
        // echo $user_type;

        $product_attr =DB::table('products_attr')
        ->select('products_attr.id')
        ->leftJoin('weights','weights.id','=','products_attr.weight_id')
        ->leftJoin('units','units.id','=','products_attr.unit_id')
        ->where(['products_id'=>$request->product_id])
        ->where(['weights.weight'=>$request->weight])
        ->where(['units.unit'=>$request->unit])
        ->get();

        // $order_qty =DB::table('orders_details')
        //     ->where(['orders_details.product_id'=>$request->product_id])
        //     ->leftJoin('orders','orders.id','=','orders_details.orders_id')
        //     ->select('orders_details.qty')
        //     ->sum('orders_details.qty');
        // prx($order_qty);    
        // die();
        // prx($product_attr[0]->id);
        $product_qty = DB::table('products')
            ->where(['products.id'=>$request->product_id])
            ->select('products.quantity')
            ->get();
        // prx($product_qty[0]->quantity); 
        // die();
        // if()
        // $available_qty =$product_qty[0]->quantity-$order_qty;
        // prx($available_qty);    
        // die();
        if($request->quantity<$product_qty[0]->quantity){
            if($request->weight!==null){
                Cart::add([
                    // 'product_id' =>$request->product_id ,
                    // 'product_attr_id' =>$product_attr[0]->id ,
                    // 'name' => $request->name ,
                    // 'price' => $request->price,
                    // 'weight' => $request->weight,
                    // 'unit' => $request->unit,
                    // 'quantity' => $request->quantity,
                    // 'image' => $request->image,
                    // 'added_on' =>date('Y-m-d h:i:s'),
                    'id' => $request->product_id ,
                    'name' => $request->name ,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'attributes' => [
                        'product_attr_id' =>$product_attr[0]->id ,
                        'weight' => $request->weight,
                        'unit' => $request->unit,
                        'image' => $request->image,
                        'added_on' =>date('Y-m-d h:i:s'),
                    ]

                ]);

            }else{
                $request->session()->flash('error','Please select any  weight of this product.');
            }
        }else{
            $request->session()->flash('error','Your selected product quantity is more than stocks.Please reduce the products  quantity.... ');
        }      
        
        // return redirect()->back();
        return back();
        // return Cart::getContent();

    }


    public function remove_item($id){
        Cart::remove($id);

        return back();
    }



    public function viewCart(){
        $result['shipping_details'] =DB::table('shippings')
                            ->where(['status'=>1])
                            ->get();
        $cartCollection = Cart::getTotalQuantity();
        // prx($cartCollection);
        if($cartCollection==0){
        // if(isset($cartCollection)){    
            //  echo 'yes';
            return redirect('/');
        }else{
            return view('front.cart',$result);
            // echo 'no';
        }
        // $cartproduct =Cart::getContent();
        // if(isset($cartproduct)){
        //     return view('front.cart',$result);
        // }else{
        //     return redirect()->back()->with('message','Please select any Product for add cart.');
        // }
        // if(Cart::getContent() !==null){
        //     return view('front.cart',$result);
        // }else{
        //     return redirect()->back()->with('message','Please select any Product for add cart.');
        // }                                                        
    //    return view('front.cart',$result);
    }



    public function updateCart(Request $request){
        // echo $id;
        // die();
        // return $request->all();
        Cart::update($request->product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
          ));
        return back();
    }

    public function shipping(Request $request){
        // $result['shipping_amt'] = $request->shipping_amount;
        // prx($result);
        // die();
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'shippin',
            'type' => 'amount',
            'target' => 'total', 
            'value' => $request->shipping_amount,
        ));
        
        Cart::condition($condition);

        // return Cart::getContent();
        return back();
        // return redirect('/viewCart',$result);
        // return view('front.cart',$result);
    }

    public function apply_coupon(Request $request){
        // return $request->post();
        $cupon_details =DB::table('coupons')
                    ->where(['code'=>$request->post('cupon_code')])
                    ->where(['status'=>1])
                    ->get();
        // prx($cupon_details[0]->value);

        if(isset($cupon_details[0])){
            if($request->post('subtotal')>$cupon_details[0]->min_order_amt){
                $condition1 = new \Darryldecode\Cart\CartCondition(array(
                    'name' => 'apply_cupon',
                    'type' => $cupon_details[0]->code,
                    'target' => 'subtotal',
                    'value' => '-'.$cupon_details[0]->value,
                ));
                Cart::condition($condition1);
            }else{
                $request->session()->flash('error','Please order more product .If you want to apply cupon code.');
                
            }
        }else{
            $request->session()->flash('error','Please enter valid coupon code.');
        }
        // return Cart::getContent();
        return back();
        // return view('front.cart');
        
    }

    public function clear_cart(){
        Cart::clear();
        Cart::clearCartConditions();
        return back();
    }

    public function remove_cupon(){
        $conditionName = 'apply_cupon';
        Cart::removeCartCondition($conditionName);
        return back();
    }


}
