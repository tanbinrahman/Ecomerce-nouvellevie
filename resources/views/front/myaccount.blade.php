@extends('front/layout')
@section('front_title','My Account')
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
							<li class="active">My Account</li>
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
                <h3 class="account_header">User Details</h3>
                 <hr>
                <table class="table table-borderless table-data3">
                    <thead>

                    </thead>
                    <tbody class="myaccount">
                        <tr>
                            <td><b>Name:</b></td>
                            <td>{{' '. $customer[0]->first_name }}{{'  '. $customer[0]->last_name  }}</td>
                        </tr>
                        <tr>
                            <td><b> Email:</b></td>
                            <td>{{' '. $customer[0]->email }}</td>
                        </tr>
                        <tr>
                            <td><b> Mobile Number:</b></td>
                            <td>{{' '. $customer[0]->Mobile_number }}</td>
                        </tr>
                        <tr>
                            <td><b>Address:</b></td>
                            <td>{{' '. $customer[0]->street_address }}</td>
                        </tr>
                        <tr>
                            <td><b>Town:</b></td>
                            <td>{{' '. $customer[0]->town }}</td>
                        </tr>
                        <tr>
                            <td><b>District:</b></td>
                            <td>{{' '. $customer[0]->district }}</td>
                        </tr>
                        <tr>
                            <td><b>Post Code:</b></td>
                            <td>{{' '. $customer[0]->post_code }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
<div class="page-section section mb-50">
    <div class="container">
        <div class="row">
            <h3 class="order_header">My Order</h3>
            <div class="col-12">
                <form action="#">
                    <div class="cart-table table-responsive mb-40">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >Order Id</th>
                                    <th >Order Status</th>
                                    <th >Payment Type</th>
                                    <th >Cupon Code</th>
                                    <th >Total amount</th>
                                    <th >Placed At</th>
                                    <th >Detailst</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)

                                    <tr>
                                        <td >{{ $order->id }}</td>
                                        <td >{{ $order->orders_status }}</td>
                                        <td ><span>{{ $order->payment_type }} </span></td>
                                        <td ><span>{{ $order->cupon_code }} </span></td>
                                        <td ><span>৳{{ $order->total_amount }} </td>
                                        <td ><span>{{ $order->added_on }} </td>
                                        <td ><span><a class="btn btn-success text-withe" href="{{ route('order_details',$order->id) }}" >Click Here</a> </td>    
                                        
                                    </tr> 
                                @endforeach     
                            </tbody>
                        </table>
                    </div>
                </form>  
            </div>
        </div>   
    </div>
</div>                                   

@endsection