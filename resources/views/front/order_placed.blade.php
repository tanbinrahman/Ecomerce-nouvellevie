@extends('front/layout')
@section('front_title','Order success')

@section('contant')

    
        <div  style="text-align:center;">
            <br><br><br>
               <h2 class="order_place">Your order has been placed.</h2>
               <h2 class="order_place">Order Id:-{{ session()->get('ORDER_ID') }}</h2>
            <br><br><br>
        </div>
   

@endsection