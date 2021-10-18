<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Weight;
use Illuminate\Http\Request;
use Session;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weights = Weight::get();
        return view('admin.weight.weight', compact('weights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weight.create');
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
            
            'weight' =>'required|unique:weights',
        ]);

        $weight = new Weight();
        $weight->weight = $request->post('weight');
        $weight->status = 1;
        $weight->save();
        session()->flash('success','Weight inserted successfully.');
        return redirect()->route('weight.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                // category =Category::find($id);
       if($id>0){
        $arr=Weight::where(['id'=>$id])->get();
            $result['weight']  = $arr['0']->weight; 
            $result['id']  =  $arr['0']->id; 
       }

    //    echo '<pre>';
    //    print_r($result['data']);
    //    die();
    return view('admin.weight.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'weight' =>'required|unique:weights,weight,'.$id,
        ]);
        $weight =Weight::find($id);
        $weight->weight = $request->post('weight');
        $weight->save();
        session()->flash('success','Weight Updated successfully.');
        return redirect()->route('weight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $weight =Weight::find($id);
        $weight->delete();

        $request->session()->flash('success','Weight delete successfully.');
        return redirect()->route('weight.index');
    }

    
    public function status(Request  $request ,$status ,$id){
        $weight =Weight::find($id);
        $weight->status =$status;
        $weight->save();
        $request->session()->flash('success','Weight status update successfully.');
        return redirect()->route('weight.index');
    }
}
