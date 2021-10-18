<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;
use Image;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banner.banner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'image' =>'required|mimes:jpg,jpeg,png',
            'title' =>'required',
            'slug' =>'required',
            'url' =>'required',
            
        ]);

        $banner = new Banner();
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(1920,500);
            $resize_image->save(public_path('storage/media/banner/'.$image_name));
            // $image->storeAs('public/media/banner',$image_name);
            $banner->image =$image_name;
        }
        $banner->title =$request->post('title');
        $banner->slug =$request->post('slug');
        $banner->url =$request->post('url');
        $banner->status = 1;
        $banner->save();
        session()->flash('success','Banner inserted successfully.');
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // category =Category::find($id);
       if($id>0){
        $arr=Banner::where(['id'=>$id])->get();
            $result['image']  = $arr['0']->image;
            $result['title']  = $arr['0']->title; 
            $result['url']  = $arr['0']->url;
            $result['slug']  = $arr['0']->slug;
            $result['id']  =  $arr['0']->id; 
       }

    //    echo '<pre>';
    //    print_r($result['data']);
    //    die();
    return view('admin.banner.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'image' =>'mimes:jpg,jpeg,png',
            
        ]);

        $banner =Banner::find($id);
        if($request->hasfile('image')){
            $bannerImage =DB::table('banners')->where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($cateImage);
            // die();
            // if(Storage::exists('/public/media/banner/'.$bannerImage[0]->image)){
            //     Storage::delete('/public/media/banner/'.$bannerImage[0]->image);
            // }
            if(File::exists('storage/media/banner/'.$bannerImage[0]->image)){
                File::delete('storage/media/banner/'.$bannerImage[0]->image);
            }
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(1920,500);
            $resize_image->save(public_path('storage/media/banner/'.$image_name));
            // $image->storeAs('public/media/banner',$image_name);
            $banner->image =$image_name;
        }
        $banner->title =$request->post('title');
        $banner->slug =$request->post('slug');
        $banner->url =$request->post('url');
        $banner->save();
        session()->flash('success','Banner Updated successfully.');
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $banner =Banner::find($id);
        $banner->delete();

        $request->session()->flash('success','Banner delete successfully.');
        return redirect()->route('banner.index');
    }

    public function status(Request  $request ,$status ,$id){
        $banner =Banner::find($id);
        $banner->status =$status;
        $banner->save();
        $request->session()->flash('success','Banner status update successfully.');
        return redirect()->route('banner.index');
    }
}
