<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Shipping;
use Illuminate\Http\Request;
use Session;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::get();
        return view('admin.shipping.shipping', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
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
            
            'shipping_address' =>'required|unique:shippings',
        ]);

        $shipping = new Shipping();
        $shipping->shipping_address = $request->post('shipping_address');
        $shipping->shipping_amount = $request->post('shipping_amount');
        $shipping->status = 1;
        $shipping->save();
        session()->flash('success','Shipping details inserted successfully.');
        return redirect()->route('shipping.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id>0){
            $arr=Shipping::where(['id'=>$id])->get();
                $result['shipping_address']  = $arr['0']->shipping_address; 
                $result['shipping_amount']  = $arr['0']->shipping_amount; 
                $result['id']  =  $arr['0']->id; 
           }
    
        //    echo '<pre>';
        //    print_r($result['data']);
        //    die();
        return view('admin.shipping.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'shipping_address' =>'required|unique:shippings,shipping_address,'.$id,
        ]);
        $shipping =Shipping::find($id);
        $shipping->shipping_address = $request->post('shipping_address');
        $shipping->shipping_amount = $request->post('shipping_amount');
        $shipping->save();
        session()->flash('success','Shipping details Updated successfully.');
        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping =Shipping::find($id);
        $shipping->delete();

        $request->session()->flash('success','Shipping details delete successfully.');
        return redirect()->route('shipping.index');
    }

    public function status(Request  $request ,$status ,$id){
        $shipping =Shipping::find($id);
        $shipping->status =$status;
        $shipping->save();
        $request->session()->flash('success','shipping details status update successfully.');
        return redirect()->route('shipping.index');
    }
}
