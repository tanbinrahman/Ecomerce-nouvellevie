<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Coupon;
use Illuminate\Http\Request;
use Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupon.coupon', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required',
            'code' =>'required|unique:coupons',
            'value' =>'required',
        ]);

        $coupon = new Coupon();
        $coupon->title = $request->post('title');
        $coupon->code = $request->post('code');
        $coupon->value = $request->post('value');
        $coupon->type = $request->post('type');
        $coupon->is_one_time = $request->post('is_one_time');
        $coupon->min_order_amt = $request->post('min_order_amt');
        $coupon->status = 1;
        $coupon->save();
        session()->flash('success','Coupon inserted successfully.');
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $coupon =Coupon::find($id);
       if($id>0){
        $arr=Coupon::where(['id'=>$id])->get();
            $result['title']  = $arr['0']->title; 
            $result['code']  = $arr['0']->code;
            $result['value']  = $arr['0']->value; 
            $result['type']  = $arr['0']->type;
            $result['is_one_time']  = $arr['0']->is_one_time;
            $result['min_order_amt']  = $arr['0']->min_order_amt;
            $result['id']  =  $arr['0']->id; 
       }

    //    echo '<pre>';
    //    print_r($result['data']);
    //    die();
    return view('admin.coupon.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'title' =>'required',
            'code' =>'required|unique:coupons,code,'.$id,
            'value' =>'required',
        ]);
        $coupon =Coupon::find($id);
        $coupon->title = $request->post('title');
        $coupon->code = $request->post('code');
        $coupon->value = $request->post('value');
        $coupon->type = $request->post('type');
        $coupon->is_one_time = $request->post('is_one_time');
        $coupon->min_order_amt = $request->post('min_order_amt');
        $coupon->save();
        session()->flash('success','Coupon Updated successfully.');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $coupon =Coupon::find($id);
        $coupon->delete();

        $request->session()->flash('success','Coupon delete successfully.');
        return redirect()->route('coupon.index');
    }

    public function status(Request  $request ,$status ,$id){
        $coupon =Coupon::find($id);
        $coupon->status =$status;
        $coupon->save();
        $request->session()->flash('success','Coupon status update successfully.');
        return redirect()->route('coupon.index');
    }
}
