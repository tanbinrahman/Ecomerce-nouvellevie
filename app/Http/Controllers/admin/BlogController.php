<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; 
use App\Models\admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Session;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blog.blog', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'slug' =>'required|unique:blogs',
            'description' =>'required',
            
        ]);

        $blog = new Blog();
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(800,600);
            $resize_image->save(public_path('storage/media/blog/'.$image_name));
            // $image->storeAs('public/media/blog',$image_name);
            $blog->image =$image_name;
        }
        $blog->title =$request->post('title');
        $blog->slug =$request->post('slug');
        $blog->description =$request->post('description');
        $blog->status = 1;
        $blog->save();
        session()->flash('success','Blog inserted successfully.');
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // category =Category::find($id);
       if($id>0){
        $arr=Blog::where(['id'=>$id])->get();
            $result['image']  = $arr['0']->image;
            $result['title']  = $arr['0']->title; 
            $result['description']  = $arr['0']->description;
            $result['slug']  = $arr['0']->slug;
            $result['id']  =  $arr['0']->id; 
       }

    //    echo '<pre>';
    //    print_r($result['data']);
    //    die();
    return view('admin.blog.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        $request->validate([
            'image' =>'mimes:jpg,jpeg,png',
            'slug' =>'required|unique:blogs,slug,'.$id,
            
        ]);

        $blog =Blog::find($id);
        if($request->hasfile('image')){
            $blogImage =DB::table('blogs')->where(['id'=>$id])->get();
            // echo '<pre>';
            // print_r($cateImage);
            // die();
            // if(Storage::exists('/public/media/blog/'.$blogImage[0]->image)){
            //     Storage::delete('/public/media/blog/'.$blogImage[0]->image);
            // }
            if(File::exists('storage/media/blog/'.$blogImage[0]->image)){
                File::delete('storage/media/blog/'.$blogImage[0]->image);
            }
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(800,600);
            $resize_image->save(public_path('storage/media/blog/'.$image_name));
            // $image->storeAs('public/media/blog',$image_name);
            $blog->image =$image_name;
        }
        $blog->title =$request->post('title');
        $blog->slug =$request->post('slug');
        $blog->description =$request->post('description');
        $blog->save();
        session()->flash('success','Blog Updated successfully.');
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $blog =Blog::find($id);
        $blog->delete();

        $request->session()->flash('success','Blog delete successfully.');
        return redirect()->route('blog.index');
    }

    public function status(Request  $request ,$status ,$id){
        $blog =Blog::find($id);
        $blog->status =$status;
        $blog->save();
        $request->session()->flash('success','Blog status update successfully.');
        return redirect()->route('blog.index');
    }
}
