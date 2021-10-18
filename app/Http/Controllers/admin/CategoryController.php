<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Storage;
use Image;
use Illuminate\Support\Facades\File;
// use Files;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->post());
        // die(); 
        $request->validate([
            'category_name' =>'required',
            'category_slug' =>'required|unique:categories',
            'category_image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $category = new Category();
        if($request->hasfile('category_image')){
            $image =$request->file('category_image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(200,200);
            $resize_image->save(public_path('storage/media/category/'.$image_name));
            // $image->storeAs('public/media/category',$image_name);
            $category->category_image =$image_name;
        }
        $category->category_name = $request->post('category_name');
        $category->category_slug = $request->post('category_slug');
        $category->is_home =0 ;
        if($request->post('is_home')!==null){
            $category->is_home =1 ;   
        }
        
        $category->description = $request->post('description');
        $category->status = 1;
        $category->save();
        session()->flash('success','Category inserted successfully.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // category =Category::find($id);
       if($id>0){
        $arr=Category::where(['id'=>$id])->get();
            $result['category_name']  = $arr['0']->category_name; 
            $result['category_slug']  = $arr['0']->category_slug;  
            $result['category_image']  = $arr['0']->category_image;
            $result['description']  = $arr['0']->description;
            $result['is_home']  = $arr['0']->is_home;
            $result['is_home_selected']  ="";
            if($arr['0']->is_home==1){
                $result['is_home_selected']  ="checked";
            }
            $result['id']  =  $arr['0']->id; 
       }

    //    echo '<pre>';
    //    print_r($result['data']);
    //    die();
    return view('admin.category.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'category_name' =>'required',
            'category_slug' =>'required|unique:categories,category_slug,'.$id,
            'category_image' => 'mimes:jpeg,jpg,png'
        ]);
        $category =Category::find($id);
        if($request->hasfile('category_image')){
            $cateImage =DB::table('categories')->where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($cateImage); 
            // die();
            // if(Storage::exists('/public/media/category/'.$cateImage[0]->category_image)){
            //     Storage::delete('/public/media/category/'.$cateImage[0]->category_image);
            // }
            if(File::exists('storage/media/category/'.$cateImage[0]->category_image)){
                File::delete('storage/media/category/'.$cateImage[0]->category_image);
            }
            $image =$request->file('category_image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(200,200);
            $resize_image->save(public_path('storage/media/category/'.$image_name));
            // $image->storeAs('public/media/category',$image_name);
            $category->category_image =$image_name;
        }
        $category->category_name = $request->post('category_name');
        $category->category_slug = $request->post('category_slug');
        $category->description = $request->post('description');
        $category->is_home =0 ;
        if($request->post('is_home')!==null){
            $category->is_home =1 ;   
        }
        $category->save();
        session()->flash('success','Category Updated successfully.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $category =Category::find($id);
        $category->delete();

        $request->session()->flash('success','Category delete successfully.');
        return redirect()->route('category.index');
    }

    public function status(Request  $request ,$status ,$id){
        $category =Category::find($id);
        $category->status =$status;
        $category->save();
        $request->session()->flash('success','Category status update successfully.');
        return redirect()->route('category.index');
    }
}
