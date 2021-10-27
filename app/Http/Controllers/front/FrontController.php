<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Str;
use Crypt;
use Mail;
use Cart;

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
          foreach($result['categories'] as $list4){
          $result['categories_quantity'][$list4->id] =DB::table('products')
                                ->where(['products.category_id'=>$list4->id])
                                ->where(['status'=>1])
                                ->count();
          }                  
                            
        // echo '<pre>';
        // print_r($result);
        // die();                     
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


         $result['featured_products'] =DB::table('products')
                ->where(['products.status'=>1])
                ->where(['is_featured'=>1])
                ->get();
            foreach($result['featured_products'] as $list3){
            $result['featured_product_attr'][$list3->id] =DB::table('products_attr')
                    ->leftJoin('weights','weights.id','=','products_attr.weight_id')
                    ->leftJoin('units','units.id','=','products_attr.unit_id')
                    ->where(['products_id'=>$list3->id])
                    ->get();                       

            } 
        //  prx($result['featured_product_attr']);
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
            $rand_id =rand(111111111 ,999999999);
            $arr=[
                'first_name'=> $request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'Mobile_number'=>$request->Mobile_number,
                'password'=>Crypt::encrypt($request->password),
                'is_verify'=>0,
                'is_forgot_password'=>0,
                'rand_id'=>$rand_id,
                'status'=>1,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ];
           $query= DB::table('customers')->insert($arr);
           if($query){
            $data=['name'=>$request->first_name,'rand_id'=>$rand_id];
            $user['to']=$request->email;
            Mail::send('front/email_verification',$data,function($messages) use ($user){
              $messages->to($user['to']);
              $messages->subject('Email Id Verification.');
            });
                return response()->json(['status'=>'success','msg'=>'Registration successfully done.Please check your email id for verification.']);
           }
        }

    }




    public function verification(Request $request, $id){

        $result =DB::table('customers')
        ->where(['rand_id'=>$id])
        ->where(['is_verify'=>0])
        ->get();
        // prx($result);
        //'rand_id'=>''
        if(isset($result[0])){
            DB::table('customers')
                ->where(['id'=>$result[0]->id])
                ->update(['is_verify'=>1,'rand_id'=>'']);
                return view('front.verification');
          }else{
            return redirect('/');
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
            $status =$result[0]->status;
            $is_verify=$result[0]->is_verify;
    
            if($is_verify==0){
              return response()->json(['status'=>"error",'msg'=>"Please verify your email id."]);
            }
    
            if($status==0){
              return response()->json(['status'=>"error",'msg'=>"Your account is deactivate."]);
            }
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



    public function forget_page(){
        return view('front.forget_page');
    }


    


    public function forgot_password(Request $request){
        // echo $request->$_POST;
        // die();
        $result =DB::table('customers')
                ->where(['email'=>$request->str_forgot_email])
                ->get();
        $rand_id =rand(111111111,999999999);
        if(isset($result[0])){
            DB::table('customers')
            ->where(['email'=>$request->str_forgot_email])
            ->update(['is_forgot_password'=>1, 'rand_id'=>$rand_id]);

            $data=['name'=>$result[0]->first_name,'rand_id'=>$rand_id];
            $user['to']=$request->str_forgot_email;
            Mail::send('front/forgot_email',$data,function($message) use ($user){
                $message->to($user['to']);
                $message->subject('Forgot Password');
            });
                return response()->json(['status'=>'success','msg'=>'please check your email id for change password.']);
            }else{
            return response()->json(['status'=>'error','msg'=>'Email id not registered']);
        }

    }




    public function forgot_password_change(Request $request,$id){
        $result=DB::table('customers')
            ->where(['is_forgot_password'=>1])
            ->where(['rand_id'=>$id])
            ->get();
  
            if(isset($result[0])){
                $request->session()->put('FORGOT_PASSWORD_USER_ID', $result[0]->id);
  
              return view('front.forgot_password_change');
            }else{
              return redirect('/');
            }
    }




    public function forgot_password_change_process(Request $request){

        $result =DB::table('customers')
            ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
            ->update([
              'is_forgot_password'=>0,
              'rand_id'=>'',
              'password'=>Crypt::encrypt($request->password),
  
            ]);
  
            return response()->json(['status'=>'success','msg'=>'Password update successfully.']);
        
    }



    public function chekout_page(Request $request){

        // prx(Cart::getCondition('shippin'));
        if(Cart::getCondition('shippin') !==null){
            if($request->session()->has('FRONT_USER_LOGIN')){
               $uid = $request->session()->get('FRONT_USER_ID');
                $customer_info =DB::table('customers')
                ->where(['id'=>$uid])
                ->get();
                // prx($customer_info);
              $result['customers']['first_name']= $customer_info[0]->first_name; 
              $result['customers']['last_name']= $customer_info[0]->last_name;
              $result['customers']['street_address']= $customer_info[0]->street_address;
              $result['customers']['town']= $customer_info[0]->town;
              $result['customers']['district']= $customer_info[0]->district;
              $result['customers']['post_code']= $customer_info[0]->post_code;
              $result['customers']['Mobile_number']= $customer_info[0]->Mobile_number;
              $result['customers']['email']= $customer_info[0]->email;
            }else{
                $result['customers']['first_name']= ''; 
                $result['customers']['last_name']= '';
                $result['customers']['street_address']= '';
                $result['customers']['town']= '';
                $result['customers']['district']= '';
                $result['customers']['post_code']= '';
                $result['customers']['Mobile_number']= '';
                $result['customers']['email']= '';
            }
            return view('front.checkout',$result);
        }else{
            return redirect()->back()->with('message','Please select any shipping Address.');
        }
        
    }




    public function place_order(Request $request){
        // prx($_POST);
        // die();
        // echo $request->session()->get('FRONT_USER_ID');
        $total =Cart::getTotal();
        $product_details =Cart::getContent();
        // prx($product_details);
        $condition = Cart::getCondition('apply_cupon');
        if($condition!==null){
          
          $condition->getTarget();
          $condition->getName();
          $conditionType =$condition->getType();
          $condition->getValue();
        }else{
            $conditionType ="";
        }


        if($request->session()->has('FRONT_USER_LOGIN')){

            // $arr=[
            //     // 'first_name'=> $request->first_name,
            //     // 'last_name'=>$request->last_name,
            //     // 'email'=>$request->email,
            //     // 'Mobile_number'=>$request->Mobile_number,
            //     // 'password'=>Crypt::encrypt($rand_id ),
            //     'street_address'=>$request->street_address,
            //     'town'=>$request->town,
            //     'district'=>$request->district,
            //     'post_code'=>$request->post_code,
            //     // 'is_verify'=>1,
            //     // 'rand_id'=>$rand_id,
            //     // 'status'=>1,
            //     // 'is_forgot_password'=>0,
            //     // 'created_at'=>date('Y-m-d h:i:s'),
            //     'updated_at'=>date('Y-m-d h:i:s'),
            // ];
            // DB::table('customers')->update($arr);
            $result =DB::table('customers')
            ->where(['id'=>$request->session()->get('FRONT_USER_ID')])
            ->update([
                'street_address'=>$request->street_address,
                'town'=>$request->town,
                'district'=>$request->district,
                'post_code'=>$request->post_code,
                'updated_at'=>date('Y-m-d h:i:s'),
                
            ]);

        }else{
            $valid =Validator::make($request->all(),[
                'email'=>'required|email|unique:customers,email', 
              ]);
        
              if(!$valid->passes()){
                return response()->json(['status'=>'false','msg'=>"The email has already been taken."]);
              }else{
                $rand_id =rand(111111111 ,999999999);
                $arr=[
                    'first_name'=> $request->first_name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                    'Mobile_number'=>$request->Mobile_number,
                    'password'=>Crypt::encrypt($rand_id ),
                    'street_address'=>$request->street_address,
                    'town'=>$request->town,
                    'district'=>$request->district,
                    'post_code'=>$request->post_code,
                    'is_verify'=>1,
                    'rand_id'=>$rand_id,
                    'status'=>1,
                    'is_forgot_password'=>0,
                    'created_at'=>date('Y-m-d h:i:s'),
                    'updated_at'=>date('Y-m-d h:i:s'),
                ];
                  $user_id= DB::table('customers')->insertGetId($arr);
                  $name =$request->first_name.' '.$request->last_name;
                  $request->session()->put('FRONT_USER_LOGIN',true);
                  $request->session()->put('FRONT_USER_ID',$user_id);
                  $request->session()->put('FRONT_USER_NAME',$name);

                  $data=['name'=>$name,'password'=>$rand_id];
                  $user['to']=$request->email;
                  Mail::send('front/password_send',$data,function($message) use ($user){
                    $message->to($user['to']);
                    $message->subject('Forgot Password');
                  });
              }
        }   

            $uid=$request->session()->get('FRONT_USER_ID');
            if($request->shiping_address===null){
                $arr=[
                    "customer_id"=>$uid,
                    "first_name"=>$request->first_name,
                    "last_name"=>$request->last_name,
                    "eamil"=>$request->email,
                    "mobile"=>$request->Mobile_number,
                    "address"=>$request->street_address,
                    "town"=>$request->town,
                    "district"=>$request->district,
                    "post_code"=>$request->post_code,
                    "cupon_code"=>$conditionType,
                    "cupon_code"=>$conditionType,
                    "cupon_value"=>$request->cupon_value,
                    "Shipping_value"=>$request->shipping_value,
                    "order_status"=>1,
                    "payment_status"=>"Pending",
                    "payment_type"=>$request->payment_method,
                    "total_amount"=>$total,
                    "added_on"=>date("Y-m-d h:i:s"),
                       
                ];
            }else{
                $arr=[
                    "customer_id"=>$uid,
                    "first_name"=>$request->s_first_name,
                    "last_name"=>$request->s_last_name,
                    "eamil"=>$request->s_email,
                    "mobile"=>$request->s_Mobile_number,
                    "address"=>$request->s_street_address,
                    "town"=>$request->s_town,
                    "district"=>$request->s_district,
                    "post_code"=>$request->s_post_code,
                    "cupon_code"=>$conditionType,
                    "cupon_code"=>$conditionType,
                    "cupon_value"=>$request->cupon_value,
                    "Shipping_value"=>$request->shipping_value,
                    "order_status"=>1,
                    "payment_status"=>"Pending",
                    "payment_type"=>$request->payment_method,
                    "total_amount"=>$total,
                    "added_on"=>date("Y-m-d h:i:s"),
                    
                    
                ];
            }

            $order_id =DB::table('orders')->insertGetId($arr);
            // echo $query;
            if($order_id>0){
                foreach($product_details as $product_detail){
                    $productDetailArr['orders_id']=$order_id;
                    $productDetailArr['product_id']=$product_detail->id ;
                    $productDetailArr['products_attr_id']=$product_detail->attributes->product_attr_id ;
                    $productDetailArr['weight']=$product_detail->attributes->weight ;
                    $productDetailArr['unit']=$product_detail->attributes->unit ;
                    $productDetailArr['price']=$product_detail->price;
                    $productDetailArr['qty']=$product_detail->quantity;
                    DB::table('orders_details')->insertGetId($productDetailArr);
                }
                Cart::clear();
                Cart::clearCartConditions();

                $request->session()->put('ORDER_ID',$order_id);

                $status ="success";
                $msg ="Order placed.";
            }else{
                $status ="false";
                $msg ="Please try after sometime.";
            }
       
        return response()->json(['status'=>$status,'msg'=>$msg]);
    }





    public function order_placed(Request $request){
        if($request->session()->has('ORDER_ID')){
            return view('front.order_placed');
        }else{
            return redirect('/');
        }
    }




    public function order(Request $request){
        $result['customer'] =DB::table('customers')
                    ->where(['id'=>$request->session()->get('FRONT_USER_ID')])
                    ->get();  
        $result['orders']=DB::table('orders')
                    ->where(['customer_id'=>$request->session()->get('FRONT_USER_ID')])
                    ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                    ->select('orders.*','orders_status.orders_status')
                    ->orderBy('orders.id','desc')
                    ->simplePaginate(10);
                    // prx($result);
        return view('front.myaccount',$result);
    }




    public function order_details(Request $request ,$id){
        // echo $id;
          
        $result['order_details'] =DB::table('orders_details')
                ->where(['orders_details.orders_id'=>$id])
                ->leftJoin('products','products.id','=','orders_details.product_id')
                ->leftJoin('orders','orders.id','=','orders_details.orders_id')
                ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                ->select('orders.*','products.name','products.image','orders_details.price','orders_details.weight','orders_details.unit','orders_details.qty','orders_status.orders_status')
                ->where(['orders.customer_id'=>$request->session()->get('FRONT_USER_ID')])
                ->get();
                // prx($result);
                if(!isset($result['order_details'][0])){
                    return redirect('/');
                }
        return view('front.orderdetails',$result);
    }


}
