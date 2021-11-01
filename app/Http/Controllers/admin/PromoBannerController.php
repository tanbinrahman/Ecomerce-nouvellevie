<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Promo_Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Storage;
use Image;
use Illuminate\Support\Facades\File;

class PromoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotionals = Promo_Banner::get();
        return view('admin.promotion.promotion', compact('promotionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =DB::table('categories')->where(['status'=>1])->get();
        return view('admin.promotion.create',compact('categories'));
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
            'category_id'=>'required',
            'pro_banner_priority' =>'required|unique:promo__banners',
        ]);

        $promotion = new Promo_Banner();
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(570,247);
            $resize_image->save(public_path('storage/media/promo_banner/'.$image_name));
            // $image->storeAs('public/media/promo_banner',$image_name);
            $promotion->image =$image_name;
        }
        $promotion->title =$request->post('title');
        $promotion->slug =$request->post('slug');
        $promotion->url =$request->post('url');
        $promotion->category_id =$request->post('category_id');
        $promotion->pro_banner_priority =$request->post('pro_banner_priority');
        $promotion->status = 1;
        $promotion->save();
        session()->flash('success','promotional banner inserted successfully.');
        return redirect()->route('promo_banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo_Banner  $promo_Banner
     * @return \Illuminate\Http\Response
     */
    public function show(Promo_Banner $promo_Banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo_Banner  $promo_Banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id>0){
            $arr=Promo_Banner::where(['id'=>$id])->get();
                $result['title']  = $arr['0']->title;
                $result['slug']  = $arr['0']->slug; 
                $result['url']  = $arr['0']->url;
                $result['image']  = $arr['0']->image;
                $result['category_id']  = $arr['0']->category_id;
                $result['pro_banner_priority']  = $arr['0']->pro_banner_priority;
                $result['id']  =  $arr['0']->id; 
           }
    
        //    echo '<pre>';
        //    print_r($result['data']);
        //    die();
        $result['categories'] =DB::table('categories')->where(['status'=>1])->get();
        return view('admin.promotion.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo_Banner  $promo_Banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'image' =>'mimes:jpg,jpeg,png',
            'category_id'=>'required',
            'pro_banner_priority' =>'required|unique:promo__banners,pro_banner_priority,'.$id
        ]);

        $promotion =Promo_Banner::find($id);
        if($request->hasfile('image')){
            $promobannerImage =DB::table('promo__banners')->where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($cateImage);
            // die();
            // if(Storage::exists('/public/media/promo_banner/'.$promobannerImage[0]->image)){
            //     Storage::delete('/public/media/promo_banner/'.$promobannerImage[0]->image);
            // }
            if(File::exists('storage/media/promo_banner/'.$promobannerImage[0]->image)){
                File::delete('storage/media/promo_banner/'.$promobannerImage[0]->image);
            }
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(570,247);
            $resize_image->save(public_path('storage/media/promo_banner/'.$image_name));
            // $image->storeAs('public/media/promo_banner',$image_name);
            $promotion->image =$image_name;
        }
        $promotion->title =$request->post('title');
        $promotion->slug =$request->post('slug');
        $promotion->url =$request->post('url');
        $promotion->category_id =$request->post('category_id');
        $promotion->pro_banner_priority =$request->post('pro_banner_priority');
        $promotion->save();
        session()->flash('success','promotional banner updated successfully.');
        return redirect()->route('promo_banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo_Banner  $promo_Banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $promotion =Promo_Banner::find($id);
        $promotion->delete();

        $request->session()->flash('success','promotional banner delete successfully.');
        return redirect()->route('promo_banner.index');
    }

    public function status(Request  $request ,$status ,$id){
        $promotion =Promo_Banner::find($id);
        $promotion->status =$status;
        $promotion->save();
        $request->session()->flash('success','promotional banner status update successfully.');
        return redirect()->route('promo_banner.index');
    } 
}
