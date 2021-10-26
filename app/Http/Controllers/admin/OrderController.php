<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;

class OrderController extends Controller
{
    public function index(){
        $result['orders']=DB::table('orders')
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->select('orders.*','orders_status.orders_status')
        ->orderBy('orders.id','desc')
        ->simplePaginate(10);
        // prx($result);
        return view('admin.order.order',$result);
    }

    public function orders_details(Request $request, $id){
        $result['order_details'] =DB::table('orders_details')
                ->where(['orders_details.orders_id'=>$id])
                ->leftJoin('products','products.id','=','orders_details.product_id')
                ->leftJoin('orders','orders.id','=','orders_details.orders_id')
                ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                ->select('orders.*','products.name','products.image','orders_details.price','orders_details.weight','orders_details.unit','orders_details.qty','orders_status.orders_status')
                ->get();
        //  prx($result); 

        $result['orders_status']=DB::table('orders_status')->get(); 
        
        $result['payment_status']=['Pending','Success','Fail'];

        //    prx($result);
        return view('admin.order.order_details',$result);  
    }


    public function update_payment_status(Request $request ,$status, $id){
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['payment_status'=>$status]);
        return redirect('/admin/orders_details/'.$id);
    }

    public function update_order_status(Request $request ,$status, $id){
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['order_status'=>$status]);
        return redirect('/admin/orders_details/'.$id);
    }


    public function update_track_details(Request $request,$id){
        
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['track_details'=>$request->post('track_details')]);
        return redirect('/admin/orders_details/'.$id);
    }
}
