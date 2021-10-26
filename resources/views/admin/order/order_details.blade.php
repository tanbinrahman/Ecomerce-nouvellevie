@extends('admin/layout')
@section('title','Order Details page')
@section('order_select','active')

@section('container') 
<h1>Order - {{ $order_details[0]->id }}</h1>
<br>
<div class="row">
    <div class="col-md-4 mb-40">
        <div class="order_details">
            <h3 class="Shipping">Shipping Address</h3>
            <table class="table table-borderless table-data3 adminorder">
                <thead>

                </thead>
                <tbody class="o_details">
                    <tr>
                        <td><b>Name:</b></td>
                        <td>{{ $order_details[0]->first_name }}{{'  '. $order_details[0]->last_name  }}</td>
                    </tr>
                    <tr>
                        <td><b> Email:</b></td>
                        <td>{{ $order_details[0]->eamil }}</td>
                    </tr>
                    <tr>
                        <td><b> Mobile Number:</b></td>
                        <td>{{ $order_details[0]->mobile }}</td>
                    </tr>
                    <tr>
                        <td><b>Address:</b></td>
                        <td>{{ $order_details[0]->address }}</td>
                    </tr>
                    <tr>
                        <td><b>Town:</b></td>
                        <td>{{ $order_details[0]->town }}</td>
                    </tr>
                    <tr>
                        <td><b>District:</b></td>
                        <td>{{ $order_details[0]->district }}</td>
                    </tr>
                    <tr>
                        <td><b>Post Code:</b></td>
                        <td>{{ $order_details[0]->post_code }}</td>
                    </tr>
                </tbody>
            </table>    
            {{-- Name: <br> 
            Mobile:{{' '. $order_details[0]->mobile }} <br> 
            Address:{{' '. $order_details[0]->address }} <br> 
            Town:{{' '. $order_details[0]->town }} <br>
            District: {{' '. $order_details[0]->district }}<br>
            Post Code:{{' '. $order_details[0]->post_code }} <br> --}}
        </div>
    </div>
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4 mb-40">
        <div class="order_details">
            <h3 class="Shipping">Order Details</h3>
            <table class="table table-borderless table-data3 adminorder">
                <thead>

                </thead>
                <tbody class="o_details">
                    <tr>
                        <td><b>Order Status:</b></td>
                        <td>{{ $order_details[0]->orders_status }}</td>
                    </tr>
                    <tr>
                        <td><b> Payment Status:</b></td>
                        <td>{{ $order_details[0]->payment_status }}</td>
                    </tr>
                    <tr>
                        <td><b> Order Type:</b></td>
                        <td>{{ $order_details[0]->payment_type }}</td>
                    </tr>
                    <tr>
                        <td><b> Track Details:</b></td>
                        <td>{{$order_details[0]->track_details}}</td>
                    </tr>

                </tbody>
            </table>    
        </div>
    </div>
</div>
<div class="order_operation">
    <b>Update Order Status </b>
    <select class="form-control  m-b-10" id="order_status" onchange="update_order_status({{$order_details[0]->id}})">
      <?php
            foreach($orders_status as $list){
              if($order_details[0]->order_status==$list->id){
                echo "<option value='".$list->id."' selected>".$list->orders_status."</option>";
              }else{
                echo "<option value='".$list->id."'>".$list->orders_status."</option>";
              }
            } 
      ?>          
    </select>


     <b> Update Payment Status </b> 
    <select class="form-control   m-b-10" id="payment_status" onchange="update_payment_status({{$order_details[0]->id}})"> 
        @foreach($payment_status as $list)
                @if($order_details[0]->payment_status==$list)
                <option value="{{$list}}" selected>{{$list}}</option>
                @else
                <option value="{{$list}}">{{$list}}</option>
                @endif  
        @endforeach

    </select>

    <b>Track Details</b>
    <form method="post">
        
      <textarea name="track_details" class="form-control m-b-10"  required>
            {{$order_details[0]->track_details}}
      </textarea>
      <button type="submit" class="btn btn-success">Update</button>
      @csrf
    </form>
</div>    
<div class="col-12">
    <h3 class="m-b-10 m-t-50">Product Details</h3>
    <form action="#">
        <div class="cart-table table-responsive mb-40">
            <table class="table">
                <thead>
                    <tr>
                        <th >Product</th>
                        <th >Image</th>
                        <th >Weight</th>
                        <th >Price</th>
                        <th >Quantity</th>
                        <th >Total amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $productamount =0;
                    ?>
                    @foreach ($order_details as $order_det)
                        <?php 
                        $productamount =$productamount+( $order_det->qty*$order_det->price);
                        // prx($productamount);
                        ?>
                        <tr>
                            <td>{{ $order_det->name }}</td>
                            <td><img width="70px" src="{{ asset('storage/media/product/'.$order_det->image) }}" alt=""></td>
                            <td>{{ $order_det->weight }}{{ $order_det->unit }}</td>
                            <td>{{ $order_det->price }}</td>
                            <td>{{ $order_det->qty }}</td>
                            <td>{{ $order_det->price *$order_det->qty}}</td>
                            
                        </tr> 
                    @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td><b>Total Product Amount:</b></td>
                            <td>{{ $productamount }}</td>
                        </tr>
                        @if($order_details[0]->cupon_value>0)
                            <tr>
                                <td colspan="4"></td>
                                <td><b>Cupon Value: <span class="cupon_apply_txt">({{ $order_details[0]->cupon_code }})</span></b></td>
                                <td>{{ $order_details[0]->cupon_value }}</td>
                            </tr>
                        @endif    
                        <tr>
                            <td colspan="4"></td>
                            <td><b>Shipping Value:</b></td>
                            <td>{{ $order_details[0]->Shipping_value }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td><b>Total amout:</b></td>
                            <td>{{ $order_details[0]->total_amount }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </form>  
</div>

@endsection
