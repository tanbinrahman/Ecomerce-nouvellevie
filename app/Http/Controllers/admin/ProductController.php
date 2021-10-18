<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Image;
use Session;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $products =Product::get();
        return view('admin.product.product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =DB::table('categories')->where(['status'=>1])->get();
        $weights =DB::table('weights')->where(['status'=>1])->get();
        $units =DB::table('units')->where(['status'=>1])->get();
        // echo '<pre>';
        // print_r($categories);
        // die();
        return view('admin.product.create',compact('categories','weights','units'));

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
        // return $request->post();
        $request->validate([
            'name' =>'required',
            'slug' =>'required|unique:products',
            'image'=>'required|mimes:jpeg,jpg,png',
            'images.*'=>'required|mimes:jpeg,jpg,png',
            'sku' =>'required|unique:products',
            'quantity' =>'required',
            
        ]);

        $product = new Product();
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(300,400);
            $resize_image->save(public_path('storage/media/product/'.$image_name));
            // $image->storeAs('public/media/product',$image_name);
            $product->image =$image_name;
        }
        $product->category_id = $request->post('category_id');
        $product->name = $request->post('name');
        $product->slug = $request->post('slug');
        $product->short_desc = $request->post('short_desc');
        $product->description = $request->post('description');
        $product->is_featured = $request->post('is_featured');
        $product->is_discount = $request->post('is_discount');
        $product->sku = $request->post('sku');
        $product->quantity = $request->post('quantity');
        $product->status = 1;
        $product->save();
        $pid =$product->id;
        
        // product Attribute start
        // $skuArr = $request->post('sku');
        $orginal_priceArr = $request->post('orginal_price');
        $weight_idArr = $request->post('weight_id');
        $unit_idArr = $request->post('unit_id');
        $offer_priceArr = $request->post('offer_price');
        // foreach($skuArr as $key => $val){
        //     $check =DB::table('products_attr')
        //     ->where('sku','=',$skuArr[$key])
            
        //     ->get();
        //     // echo '<pre>';
        //     // print_r($check);
        //     // die();
        //     if(isset($check[0])){
        //         $request->session()->flash('sku_error',$skuArr[$key].' SKU already used.');

        //      return redirect(request()->headers->get('referer'));   
        //     }
        // }
        
        // $product->save();
        // $pid =$product->id;
        foreach($orginal_priceArr as $key => $val){
            $productAttrArr['products_id'] =$pid;
            // $productAttrArr['sku'] =$skuArr[$key];
            $productAttrArr['orginal_price'] =$orginal_priceArr[$key];
            $productAttrArr['weight_id'] =$weight_idArr[$key];
            $productAttrArr['unit_id'] =$unit_idArr[$key];
            $productAttrArr['offer_price'] =$offer_priceArr[$key];
            // if($discountArr[$key]==''){
            //     $productAttrArr['discount'] =0;
            // }else{
            //     $productAttrArr['discount'] =$discountArr[$key];
            // }
            
            DB::table('products_attr')->insert($productAttrArr);
        }


        // Product Attribute end
        
        // Product images start
        $piidArr = $request->post('piid');
        foreach($piidArr as $key=>$val){
            $productImageArr['products_id'] =$pid;
            if($request->hasFile("images.$key")){
                $rend =rand('111111111','999999999');
                $images =$request->file("images.$key");
                $ext =$images->extension();
                $images_name =$rend.'.'.$ext;
                $resize_image =Image::make($images->getRealPath());
                $resize_image->resize(300,400);
                $resize_image->save(public_path('storage/media/images/'.$images_name));
                // $request->file("images.$key")->storeAs('public/media/images',$images_name);
                $productImageArr['images'] =$images_name;
            }
            DB::table('product_images')->insert($productImageArr);
            
        }
        
        // product images end
        
        session()->flash('success','Product inserted successfully.');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id>0){
            $arr=Product::where(['id'=>$id])->get();
                $result['category_id']  = $arr['0']->category_id; 
                $result['name']  = $arr['0']->name;  
                $result['slug']  =  $arr['0']->slug;
                $result['image']  =  $arr['0']->image;                 
                $result['short_desc']  =  $arr['0']->short_desc;
                $result['description']  =  $arr['0']->description;
                $result['is_featured']  =  $arr['0']->is_featured;
                $result['is_discount']  =  $arr['0']->is_discount;
                $result['quantity']  =  $arr['0']->quantity;
                $result['sku']  =  $arr['0']->sku;
                $result['id']  =  $arr['0']->id;

                $result['productAttrArr'] = DB::table('products_attr')->where(['products_id' =>$id])->get();
                $result['productImagesArr'] = DB::table('product_images')->where(['products_id' =>$id])->get();
                // echo '<pre>';
                // print_r($result);
                // die();
           }
           $result['units'] =DB::table('units')->where(['status'=>1])->get();
           $result['categories'] =DB::table('categories')->where(['status'=>1])->get();
           $result['weights'] =DB::table('weights')->where(['status'=>1])->get();
           return view('admin.product.edit',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request ,$id)
    {
        // dd($request->post());
        // echo '<pre>';
        // print_r($request->post());
        // die();
        $request->validate([
            'name' =>'required',
            'slug' =>'required|unique:products,slug,'.$id,
            'image'=>'mimes:jpeg,jpg,png',
            'images.*'=>'mimes:jpeg,jpg,png',
            'sku' =>'required|unique:products,sku,'.$id,
            'quantity' =>'required',
        ]);

        $product =Product::find($id);
        if($request->hasfile('image')){
            $proImage =DB::table('products')->where(['id'=>$id])->get();
            // if(Storage::exists('/public/media/product/'.$proImage[0]->image)){
            //     Storage::delete('/public/media/product/'.$proImage[0]->image);
            // };
            if(File::exists('storage/media/product/'.$proImage[0]->image)){
                File::delete('storage/media/product/'.$proImage[0]->image);
            }
            $image =$request->file('image');
            $ext =$image->extension();
            $image_name =time().'.'.$ext;
            $resize_image =Image::make($image->getRealPath());
            $resize_image->resize(300,400);
            $resize_image->save(public_path('storage/media/product/'.$image_name));
            // $image->storeAs('public/media/product',$image_name);
            $product->image =$image_name;
        }
        $product->category_id = $request->post('category_id');
        $product->name = $request->post('name');
        $product->slug = $request->post('slug');       
        $product->short_desc = $request->post('short_desc');
        $product->description = $request->post('description');
        $product->is_featured = $request->post('is_featured');
        $product->is_discount = $request->post('is_discount');
        $product->quantity = $request->post('quantity');
        $product->sku = $request->post('sku');
        $product->save();
        $pid =$product->id;


        // product Attribute start
        $paidArr =$request->post('paid');
        // $skuArr = $request->post('sku');
        $orginal_priceArr = $request->post('orginal_price');
        $weight_idArr = $request->post('weight_id');
        $unit_idArr = $request->post('unit_id');
        $offer_priceArr = $request->post('offer_price');
        // foreach($orginal_priceArr as $key => $val){
        //     // $check =DB::table('products_attr')
        //     // ->where('sku','=',$skuArr[$key])
        //     // ->where('products_id','!=',$pid)
        //     // ->get();
        //     // echo '<pre>';
        //     // print_r($check);
        //     // die();
        //     if(isset($check[0])){
        //         $request->session()->flash('sku_error',$skuArr[$key].' SKU already used.');

        //      return redirect(request()->headers->get('referer'));   
        //     }
        // }

        foreach($orginal_priceArr as $key => $val){
            $productAttrArr['products_id'] =$pid;
            // $productAttrArr['sku'] =$skuArr[$key];
            $productAttrArr['orginal_price'] =$orginal_priceArr[$key];
            $productAttrArr['weight_id'] =$weight_idArr[$key];
            $productAttrArr['unit_id'] =$unit_idArr[$key];
            $productAttrArr['offer_price'] =$offer_priceArr[$key];
            // if($discountArr[$key]==''){
            //     $productAttrArr['discount'] =0;
            // }else{
            //     $productAttrArr['discount'] =$discountArr[$key];
            // }

            if($paidArr[$key]!=''){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else{
                DB::table('products_attr')->insert($productAttrArr);
            }
            
        }
        // Product Attribute end

        // Product images start
        $piidArr = $request->post('piid');
        // echo '<pre>';
        // print_r($piidArr);
        // die();
        foreach($piidArr as $key=>$val){
            $productImageArr =[];
            $productImageArr['products_id'] =$pid;
            if($request->hasFile("images.$key")){
                $arrImage =DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                // if(Storage::exists('/public/media/images/'.$arrImage[0]->images)){
                //     Storage::delete('/public/media/images/'.$arrImage[0]->images);
                // };
                if(File::exists('storage/media/images/'.$arrImage[0]->images)){
                    File::delete('storage/media/images/'.$arrImage[0]->images);
                }
                $rand =rand('111111111','999999999');
                $images =$request->file("images.$key");
                $ext =$images->extension();
                $images_name =$rand.'.'.$ext;
                $resize_image =Image::make($images->getRealPath());
                $resize_image->resize(300,400);
                $resize_image->save(public_path('storage/media/images/'.$images_name));
                // $request->file("images.$key")->storeAs('public/media/images',$image_name);
                $productImageArr['images'] =$images_name;
            }
            if($piidArr[$key]!=''){
                DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
            }else{
                DB::table('product_images')->insert($productImageArr);
            }
            
            
        }
        
        // product images end
        
        session()->flash('success','Product updated successfully.');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request ,$id)
    {
        $product =Product::find($id);
        $product->delete();

        $request->session()->flash('success','Product delete successfully.');
        return redirect()->route('product.index');
    }

    public function status(Request  $request ,$status ,$id){
        $product =Product::find($id);
        $product->status =$status;
        $product->save();
        $request->session()->flash('success','Product status update successfully.');
        return redirect()->route('product.index');
    }

    public function delete(Request $request ,$paid ,$pid){
        DB::table('products_attr')->where(['id'=>$paid])->delete();
        $request->session()->flash('success','Product Attribute delete successfully.');
        // return redirect()->route('product.index');
        return redirect('admin/product/'.$pid.'/edit');
    }

    public function image_delete(Request $request ,$piid ,$pid){

        $arrImage =DB::table('product_images')->where(['id'=>$piid])->get();
        if(Storage::exists('/public/media/images/'.$arrImage[0]->images)){
            Storage::delete('/public/media/images/'.$arrImage[0]->images);
        };

        DB::table('product_images')->where(['id'=>$piid])->delete();
        $request->session()->flash('success','Product Images delete successfully.');
        // return redirect()->route('product.index');
        return redirect('admin/product/'.$pid.'/edit');
    }
}
