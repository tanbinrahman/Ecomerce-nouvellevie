<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Unit;
use Illuminate\Http\Request;
use Session;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::get();
        return view('admin.unit.unit', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
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
            
            'unit' =>'required|unique:units',
        ]);

        $unit = new Unit();
        $unit->unit = $request->post('unit');
        $unit->status = 1;
        $unit->save();
        session()->flash('success','Unit inserted successfully.');
        return redirect()->route('unit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id>0){
            $arr=Unit::where(['id'=>$id])->get();
                $result['unit']  = $arr['0']->unit; 
                $result['id']  =  $arr['0']->id; 
           }
    
        //    echo '<pre>';
        //    print_r($result['data']);
        //    die();
        return view('admin.unit.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'unit' =>'required|unique:units,unit,'.$id,
        ]);
        $unit =Unit::find($id);
        $unit->unit = $request->post('unit');
        $unit->save();
        session()->flash('success','Unit Updated successfully.');
        return redirect()->route('unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $unit =Unit::find($id);
        $unit->delete();

        $request->session()->flash('success','Unit delete successfully.');
        return redirect()->route('unit.index');
    }

    public function status(Request  $request ,$status ,$id){
        $unit =Unit::find($id);
        $unit->status =$status;
        $unit->save();
        $request->session()->flash('success','Unit status update successfully.');
        return redirect()->route('unit.index');
    }
}
