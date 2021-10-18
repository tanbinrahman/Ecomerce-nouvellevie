<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Cart;
// use Illuminate\Support\Facades\DB;
// use App\Models\admin\Admin;
// use Illuminate\Http\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        // if(session()->has('ADMIN_LOGIN')){
        //     $user =session()->get('USER_NAME');
        //     View::share('username', session()->get('USER_NAME'));
        //   }
        View::composer('*', function ($view) {
            // $view->with('admin_user', Admin::where(['ADMIN_LOGIN'=>1])->get());
            // $view->with('admin_user', DB::table('admins')->where([`ADMIN_LOGIN` => 1])->get());
            if(session()->has('ADMIN_LOGIN')){
                // $user =session()->get('USER_NAME');
                $view->with('username', session()->get('USER_NAME'));
              }

              $view->with('CartGetContents', Cart::getContent());  
              $view->with('CartTotalQuantity', Cart::getTotalQuantity()); 
              $view->with('GetSubTotal', Cart::getSubTotal());
              $view->with('GetTotal', Cart::getTotal());
            

            //   Cupon condition
            $view->with('conditionAll', Cart::getConditions());
            $view->with('condition', Cart::getCondition('apply_cupon'));
            $condition = Cart::getCondition('apply_cupon');
            if($condition!==null){
              
              $view->with('conditionTarget', $condition->getTarget());
              $view->with('conditionName', $condition->getName());
              $view->with('conditionType', $condition->getType());
              $view->with('conditionValue', $condition->getValue());
            }
            //   Shipping condition
            $view->with('condition1',Cart::getCondition('shippin'));
            $condition1 = Cart::getCondition('shippin');
            if($condition1!==null){
              $view->with('conditionTarget1', $condition1->getTarget());
              $view->with('conditionName1', $condition1->getName());
              $view->with('conditionType1', $condition1->getType());
              $view->with('conditionValue1', $condition1->getValue());
            }
              
              
        }); 

    }
}
