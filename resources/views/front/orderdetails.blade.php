@extends('front/layout')
@section('front_title','Order Details')
@section('contant')


	<!--=============================================
    =            breadcrumb area         =
    =============================================-->

	<div class="breadcrumb-area mb-50">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-container">
						<ul>
							<li><a href="{{ route('front.index') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="{{ route('order') }}"><i class="fa fa-home"></i> My Account</a></li>
							<li class="active">Order Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->

    <div class="page-section section mb-50">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="order_details">
                        <h3>Shipping Address</h3>
                        Name:{{' '. $order_details[0]->first_name }}{{'  '. $order_details[0]->last_name  }} <br> 
                        Mobile:{{' '. $order_details[0]->mobile }} <br> 
                        Address:{{' '. $order_details[0]->address }} <br> 
                        Town:{{' '. $order_details[0]->town }} <br>
                        District: {{' '. $order_details[0]->district }}<br>
                        Post Code:{{' '. $order_details[0]->post_code }} <br>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_detail">
                        <h3>Order Details</h3>
                         Order Status: {{$order_details[0]->orders_status}}<br>
                         Payment Status: {{$order_details[0]->payment_status}}<br>
                         Payment Type: {{$order_details[0]->payment_type}}<br>
                    </div>
                         @if($order_details[0]->track_details!='')
                        <b>track_details</b> : <br> {{$order_details[0]->track_details}}
                         @endif  
                </div>
                
                <div class="col-12">
                    <h3>Product Details</h3>
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
            </div>   
        </div>
    </div>                                   
    


    @endsection