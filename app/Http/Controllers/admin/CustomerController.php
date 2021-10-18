<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::get();
        return view('admin.customer.customer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr = Customer::where(['id'=>$id])->get();
        // echo '<pre>';
        // print_r($result['customer']);
        // die();
        $result['id'] =$arr['0']->id;
        $result['first_name'] =$arr['0']->first_name;
        $result['last_name'] =$arr['0']->last_name;
        $result['street_address'] =$arr['0']->street_address;
        $result['town'] =$arr['0']->town;
        $result['district'] =$arr['0']->district;
        $result['post_code'] =$arr['0']->post_code;
        $result['Mobile_number'] =$arr['0']->Mobile_number;
        $result['email'] =$arr['0']->email;

        return view('admin.customer.show',$result);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function status(Request  $request ,$status ,$id){
        $customer =Customer::find($id);
        $customer->status =$status;
        $customer->save();
        $request->session()->flash('success','Customer status update successfully.');
        return redirect()->route('customer.index');
    }
}
