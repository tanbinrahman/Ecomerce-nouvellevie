<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Str;
use Crypt;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $result['banners'] =DB::table('banners')
                            ->where(['status'=>1])
                            ->get();
        $result['promo__banners'] =DB::table('promo__banners')
                            ->where(['status'=>1])
                            ->take(2)->get();
        foreach($result['promo__banners'] as $list){
            $result['promo__banners_category'][$list->id] =DB::table('categories')
                                                ->where(['status'=>1])
                                                ->where(['id'=>$list->category_id])
                                                ->get();
        }  
        // echo '<pre>';
        // print_r($result);
        // die();                  
        $result['categories'] =DB::table('categories')
                            ->where(['status'=>1])
                            ->get();  
        $result['products'] =DB::table('products')
                            ->where(['status'=>1])
                            ->get();
          foreach($result['products'] as $list1){
             $result['products_attr'][$list1->id] =DB::table('products_attr')
                            ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                            ->leftJoin('units','units.id','=','products_attr.unit_id')
                            ->where(['products_id'=>$list1->id])
                            ->get();                       

          } 
          foreach($result['products'] as $list2){
            $result['product_images'][$list2->id] =DB::table('product_images')
                           
                           ->where(['products_id'=>$list2->id])
                           ->get();                       

         }
         
         $result['blogs'] =DB::table('blogs')
                        ->where(['status'=>1])
                        ->get();
        // echo '<pre>';
        // print_r($result);
        // die();                 
        // if($id>0){
        //     echo $id;

        //     die(); 
        // }
       
        return view('front.index',$result);
    }

    // public function quickview($id){

    //     // echo "$id";
    //     // die();

    //     $result['quick_products'] =DB::table('products')
    //     ->where(['id'=>$id])
    //     ->where(['status'=>1])
    //     ->get();
    //     foreach($result['quick_products'] as $list1){
    //     $result['quick_products_attr'][$list1->id] =DB::table('products_attr')
    //             ->leftJoin('weights','weights.id','=','products_attr.weight_id')
    //             ->leftJoin('units','units.id','=','products_attr.unit_id')
    //             ->where(['products_id'=>$list1->id])
    //             ->get();                       

    //     } 
    //     foreach($result['quick_products'] as $list2){
    //     $result['quick_product_images'][$list2->id] =DB::table('product_images')
            
    //         ->where(['products_id'=>$list2->id])
    //         ->get();                       

    //     }
    //     // echo '<pre>';
    //     // print_r($result);
    //     // die();
    // // return view('front.migration.quick',$result); 
    //     // return view('front.index',$result);
    // }

    public function product(Request $request ,$slug){
        $result['product'] =DB::table('products')           
                ->where(['products.status'=>1])
                ->where(['slug'=>$slug])
                ->leftJoin('categories','categories.id','=','products.category_id')
                ->select('products.*','categories.category_name','categories.category_slug')
                ->get();
                
        foreach($result['product'] as $list1){
        $result['product_attr'][$list1->id] =DB::table('products_attr')
                ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                ->leftJoin('units','units.id','=','products_attr.unit_id')
                ->where(['products_id'=>$list1->id])
                ->get();                       

        } 
        foreach($result['product'] as $list2){
        $result['product_images'][$list2->id] =DB::table('product_images')
            ->where(['products_id'=>$list2->id])
            ->get();                       

        } 

        $result['related_product'] =DB::table('products')
                ->where(['products.status'=>1])
                ->where('slug','!=',$slug)
                ->where(['category_id'=>$result['product'][0]->category_id])
                ->leftJoin('categories','categories.id','=','products.category_id')
                ->select('products.*','categories.category_name','categories.category_slug')
                ->get();
        foreach($result['related_product'] as $list1){
        $result['related_product_attr'][$list1->id] =DB::table('products_attr')
                ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                ->leftJoin('units','units.id','=','products_attr.unit_id')
                ->where(['products_id'=>$list1->id])
                ->get();                       

        } 
        $result['upsell_product'] =DB::table('products')
                ->where(['products.status'=>1])
                ->where(['is_featured'=>1])
                ->leftJoin('categories','categories.id','=','products.category_id')
                ->select('products.*','categories.category_name','categories.category_slug')
                ->get();
        foreach($result['upsell_product'] as $list1){
        $result['upsell_product_attr'][$list1->id] =DB::table('products_attr')
                ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                ->leftJoin('units','units.id','=','products_attr.unit_id')
                ->where(['products_id'=>$list1->id])
                ->get();                       

        } 

        $result['min_price'] =DB::table('products')           
        ->where(['products.status'=>1])
        ->where(['slug'=>$slug])
        ->leftJoin('products_attr','products_attr.products_id','=','products.id')
        ->min('offer_price');

        $result['max_price'] =DB::table('products')           
        ->where(['products.status'=>1])
        ->where(['slug'=>$slug])
        ->leftJoin('products_attr','products_attr.products_id','=','products.id')
        ->max('offer_price');


        // echo '<pre>';
        // print_r($result);
        // die();

        return view('front.product',$result);
    }





    public function shop(Request $request){
        $sort="";
        $sort_text="";
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }
        // echo $sort;
            $query=DB::table('products');
            $query= $query->where(['products.status'=>1]);
            $query= $query->leftJoin('categories','categories.id','=','products.category_id');
            $query= $query->leftJoin('products_attr','products_attr.products_id','=','products.id');
            $query= $query->distinct()->select('products.*','categories.category_name','categories.category_slug');
            // ->get();
            if($sort=='name'){
                $query= $query->orderBy('products.name','asc');
                $sort_text ="Product Name";
            }
            if($sort=='date'){
                $query =$query->orderBy('products.id','desc');
                $sort_text ="Date";
            }
            if($sort=='price_asc'){
                $query =$query->orderBy('products_attr.offer_price','asc');
                $sort_text ="Price-Asc";
            }
            if($sort=='price_desc'){
                $query =$query->orderBy('products_attr.offer_price','desc');
                $sort_text ="Price-Desc";
            }
            $query= $query->simplePaginate(9);
        $result['products'] = $query;          
        foreach($result['products'] as $list1){
            $result['products_attr'][$list1->id] =DB::table('products_attr')
                            ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                            ->leftJoin('units','units.id','=','products_attr.unit_id')
                            ->where(['products_id'=>$list1->id])
                            ->get();                       

        }

        $result['categoryes'] =DB::table('categories')
                              ->where(['status'=>1])
                              ->get();

        $result['count_product'] =DB::table('products')           
                              ->where(['products.status'=>1])
                              ->count('id');                      
        
        $result['sort']=$sort;
        $result['sort_text']=$sort_text;
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('front.shop',$result);
    }





    public function category_filter(Request $request ,$slug){
        $sort="";
        $sort_text="";
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }
        // echo $sort;
        $query =DB::table('products');
            $query= $query->where(['products.status'=>1]);
            $query= $query->leftJoin('categories','categories.id','=','products.category_id');
            $query= $query->where(['categories.category_slug'=>$slug]);
            $query= $query->leftJoin('products_attr','products_attr.products_id','=','products.id');
            $query= $query->distinct()->select('products.*','categories.category_name','categories.category_slug');
            if($sort=='name'){
                $query= $query->orderBy('products.name','asc');
                $sort_text ="Product Name";
            }
            if($sort=='date'){
                $query =$query->orderBy('products.id','desc');
                $sort_text ="Date";
            }
            if($sort=='price_asc'){
                $query =$query->orderBy('products_attr.offer_price','asc');
                $sort_text ="Price-Asc";
            }
            if($sort=='price_desc'){
                $query =$query->orderBy('products_attr.offer_price','desc');
                $sort_text ="Price-Desc";
            }
            $query= $query->simplePaginate(9);
        $result['products'] = $query;         
        foreach($result['products'] as $list1){
        $result['products_attr'][$list1->id] =DB::table('products_attr')
                    ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                    ->leftJoin('units','units.id','=','products_attr.unit_id')
                    ->where(['products_id'=>$list1->id])
                    ->get();                     
        }
        $result['categoryes'] =DB::table('categories')
                ->where(['status'=>1])
                ->get();
        $result['count_product'] =DB::table('products')           
                ->where(['products.status'=>1])
                ->leftJoin('categories','categories.id','=','products.category_id')
                ->where(['categories.category_slug'=>$slug])
                ->count('products.id'); 
        $result['slug']=$slug; 
        
        
        $result['sort']=$sort;
        $result['sort_text']=$sort_text;
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('front.category_filter',$result);
    }




    public function blog(){
        $result['blogs'] =DB::table('blogs')
                        ->where(['status'=>1])
                        ->simplePaginate(4);

        $result['recent_blogs'] =DB::table('blogs')
                        ->where(['status'=>1])
                        ->orderBy('blogs.id','desc')
                        ->take(5)->get();
                   
        return view('front.blog',$result);

        
    }




    public function single_blog(Request $request ,$id){
        $result['blog'] =DB::table('blogs')
                ->where(['status'=>1])
                ->where(['blogs.id'=>$id])
                ->get();

        $result['recent_blogs'] =DB::table('blogs')
                ->where(['status'=>1])
                ->orderBy('blogs.id','desc')
                ->take(5)->get();
            
        $result['related_blogs'] =DB::table('blogs')
                ->where(['status'=>1])
                ->where('id','!=',$id)
                ->orderBy('blogs.id','asc')
                ->take(5)->get();        
        // echo '<pre>';
        // print_r($result);
        // die();
        // $result['hi'] =getData();
        return view('front.single_blog',$result);
    }



    
    public function search(Request $request,$str){
        // echo $str;
        // die();
        $result['products']=DB::table('products')
                ->where(['products.status'=>1])
                // ->leftJoin('categories','categories.id','=','products.category_id')           
                ->where('name','like',"%$str%")
                ->orwhere('slug','like',"%$str%")
                ->orwhere('short_desc','like',"%$str%")
                ->orwhere('description','like',"%$str%")
                // ->select('products.*','categories.category_name','categories.category_slug')
                ->simplePaginate(9);
                 
        foreach($result['products'] as $list1){
            $result['products_attr'][$list1->id] =DB::table('products_attr')
                            ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                            ->leftJoin('units','units.id','=','products_attr.unit_id')
                            ->where(['products_id'=>$list1->id])
                            ->get();                       

        }
        // echo '<pre>';
        // print_r($result);
        // die();
        return view('front.search',$result);
    }




    public function registration(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')!=null){
            return redirect('/');
        }
        return view('front.registration');
    }




    public function registration_process(Request $request){
        // prx($_POST);
        // return $request->all();
        $valid =validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'Mobile_number' => 'required|numeric|digits:11|unique:customers,Mobile_number',
            'password' => 'required',
            
        ]);

        if(!$valid->passes()){
            return response()->json(['status'=>'error','error'=>$valid->errors()->toArray()]);
        }else{
            $arr=[
                'first_name'=> $request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'Mobile_number'=>$request->Mobile_number,
                'password'=>Crypt::encrypt($request->password),
                'status'=>1,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ];
           $query= DB::table('customers')->insert($arr);
           if($query){
                return response()->json(['status'=>'success','msg'=>'Registration successfully done.']);
           }
        }

    }




    public function login(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')!=null){
            return redirect('/');
        }
        return view('front.login');
    }



    public function login_process(Request $request){
        // prx($request->post());
        // prx($_POST);

        $result =DB::table('customers')
                ->where(['email'=>$request->str_login_email])
                ->get();
            //   prx($result); 
        if(isset($result[0])){
            $name =$result[0]->first_name.' '.$result[0]->last_name;
            // prx($name);

            $db_pwd =Crypt::decrypt($result[0]->password);
            if($db_pwd==$request->str_login_password){
                if($request->rememberme===null){
                    setcookie('login_email',$request->str_login_email,100);
                    setcookie('login_pwd',$request->str_login_password,100);
                }else{
                    setcookie('login_email',$request->str_login_email,time()+60*60*24*30);
                    setcookie('login_pwd',$request->str_login_password,time()+60*60*24*30);
                }
                $request->session()->put('FRONT_USER_LOGIN',true);
                $request->session()->put('FRONT_USER_ID',$result[0]->id);
                $request->session()->put('FRONT_USER_NAME',$name);
                $status="success";
                $msg="";
            }else{
                $status="error";
                $msg="Please enter valid password.";  
            }
        }else{
            $status="error";
            $msg="Please enter valid email id.";
        }
        return response()->json(['status'=>$status,'msg'=>$msg]);     
    }

}
