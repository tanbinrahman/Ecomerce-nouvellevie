<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){

            return redirect()->route('admin.dashboard');
        }else{
            $request->session()->flash('error','Access Denied');
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        // return  $request->post();
        $email = $request->post('email');
        $password =$request->post('password');
        

        $result =Admin::where(['email'=>$email])->first();
        // echo '<pre>';
        // print_r($result);
        // die();
        // $username =$result['0']->username;
        if($result){
            if(Hash::check($request->post('password') , $result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID' ,$result->id);
                $request->session()->put('USER_NAME' ,$result->username);
                // $result['id'] =$request->session()->get('ADMIN_ID');
                // echo '<pre>';
                // print_r($result['username']);
                // die();
                return redirect()->intended(route('admin.dashboard'));
            }else{
                $request->session()->flash('error','Please Enter valid password');
                return redirect()->route('admin');
            }

        }else{
             $request->session()->flash('error','Please Enter valid email and password');
            return redirect()->route('admin');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
