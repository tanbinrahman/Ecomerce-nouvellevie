@extends('front/layout')
@section('front_title','Product page')

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
							<li class="active">Cart</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->


	<!--=============================================
    =            Cart page content         =
    =============================================-->


	<div class="page-section section mb-50">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="#">
						<!--=======  cart table  =======-->

						<div class="cart-table table-responsive mb-40">
							<table class="table">
								<thead>
									<tr>
										<th class="pro-thumbnail">Image</th>
										<th class="pro-title">Product</th>
										<th class="pro-title">Weight</th>
										<th class="pro-price">Price</th>
										<th class="pro-quantity">Quantity</th>
                                        <th class="pro-quantity">update</th>
										<th class="pro-subtotal">Total</th>
										<th class="pro-remove">Remove</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$productamount =0;
									?>
                                    @foreach ($CartGetContents as $CartGetContent)
										<?php 
											// prx($CartGetContent);
										?>
										<?php 
											$productamount =$productamount+( $CartGetContent->quantity*$CartGetContent->price);
											// prx($productamount);
										?>
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#"><img src="{{ asset('storage/media/product/'.$CartGetContent->attributes->image) }}"
                                                        class="img-fluid" alt="Product"></a></td>
                                            <td class="pro-title"><a href="#">{{ $CartGetContent->name }}</a></td>
											<td class="pro-price"><span> {{ $CartGetContent->attributes->weight}}{{ $CartGetContent->attributes->unit}}</span></td>
                                            <td class="pro-price"><span>৳ {{ $CartGetContent->price}}</span></td>
                                        <form action="{{ route('updateCart') }}" method="get"> 
											  
                                            @csrf  
                                            <td class="pro-quantity">
                                                <div class="pro-qty"><input type="text" name="quantity" value="{{ $CartGetContent->quantity}}"></div>
												{{-- <input type="hidden" name="quantity" value="{{ $CartGetContent->quantity}}"> --}}
												{{-- <input type="number" value="1" id="quantity" name="quantity" min="1" value="{{ $CartGetContent->quantity}}" > --}}
												<input type="hidden" name="product_id" value="{{ $CartGetContent->id }}">
                                            </td>  
                                            <td>
                                                
                                                 
                                                <button class="btn btn-success btn-lg" type="submit" >Update</button>
                                                
                                            </td>
											
                                        </form>
                                            <td class="pro-subtotal"><span>৳ {{ $CartGetContent->quantity*$CartGetContent->price}}</span></td>
                                            <td class="pro-remove"><a href="{{ route('remove_item',$CartGetContent->id) }}"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    @endforeach    
								</tbody>
							</table>
						</div>

						<!--=======  End of cart table  =======-->


					</form>

					<div class="row">

						<div class="col-lg-6 col-12">
							<!--=======  Discount Coupon  =======-->

							<div class="discount-coupon">
								<h4>Discount Coupon Code</h4>
								<form action="{{ route('apply_coupon') }}" method="post">
									@csrf
									<div class="row">
										<div class="col-md-6 col-12 mb-25">
											<input type="text" name="cupon_code" id="coupon_code" placeholder="Coupon Code">
										</div>
										<div class="col-md-6 col-12 mb-25">
											<input type="hidden" name="subtotal" value="{{ $GetSubTotal }}">
											<input type="submit"  value="Apply Code" onclick="applyCouponCode()">
										</div>
										{{-- <input type="text" id="coupon_code_str" name="coupon_cod"> --}}
									</div>
								</form>
							</div>
							@if($condition !==null)
								<div class="discount-coupon">
									<form action="{{ route('remove_cupon') }}" method="get">
										@csrf
										<div class="row">
											<div class="col-md-6 col-12 mb-25">
												{{-- @if($condition1 !==null)	
													<input type="text"> --}}
												<input type="submit" value="Remove Coupon">
											</div>
										</div>
									</form>
								</div>
							@endif	
							@if(session()->has('error'))
							<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
								{{ session('error') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							@endif
							<!--=======  End of Discount Coupon  =======-->

							<!--=======  Calculate Shipping  =======-->
							<?php 
								// prx($condition);
							?>

							<div class="calculate-shipping">
								<h4>Calculate Shipping</h4>
								<form action="{{ route('shipping_amount') }}" method="post">
									@csrf
									<div class="row">
										<div class="col-md-6 col-12 mb-25">
											<select class="nice-select">
												<option>Bangladesh</option>
											</select>
										</div>
										<div class="col-md-6 col-12 mb-25">
											<select name="shipping_amount" class="nice-select">
												@foreach ($shipping_details as $shipping)
													{{-- <option  value="{{ $shipping->shipping_amount }}"> <a href="javascript:void(0)" onchange="select_amoute('{{ $shipping->shipping_amount }}')"> {{ $shipping->shipping_address }} </a></option> --}}
													<option onchange="select_amoute('{{ $shipping->shipping_amount }}')" value="{{ $shipping->shipping_amount }}"> {{ $shipping->shipping_address }} </option>
												@endforeach
												{{-- <option value="70">Dhaka</option>
												<option value="150">Other District</option> --}}
											</select>
										</div>
										<div class="col-md-6 col-12 mb-25">
											{{-- <input type="text" id="sp_amount" name="amount" > --}}
											<input type="submit" value="Estimate">
										</div>
									</div>
								</form>
							</div>
							<!--=======  End of Calculate Shipping  =======-->
						</div>

						<div class="col-lg-6 col-12 d-flex">
							<!--=======  Cart summery  =======-->

							<div class="cart-summary">
								<div class="cart-summary-wrap">
									<h4>Cart Summary</h4>
									{{-- @if($condition !==null)
										<p>Cupon Value <span>৳ {{ $conditionValue }}</span></p>
									@endif	 --}}
									@if($condition !==null)
										<p>Total product amount <span>৳ {{ $productamount }}</span></p>
										<p>Coupon value <span>৳ {{ $productamount-$GetSubTotal }}</span></p>
									@endif
									<p>Sub Total <span>৳ {{ $GetSubTotal }}</span></p>
									<p>Shipping Cost <span>৳ @if($condition1 !==null)
																{{ $conditionValue1 }}
															@else 
																0	
															@endif</span></p>
									<h2>Grand Total <span>৳ {{ $GetTotal }}</span></h2>
								</div>
								<div class="cart-summary-button">
									{{-- <button class="checkout-btn">Checkout</button> --}}
									<a href="{{ route('clear_cart') }}" class="checkout-btn btn btn-outline-success btn-lg mr-140">Clear Cart</a>&nbsp;&nbsp;&nbsp;
									<a href="{{ route('chekout_page') }}" class="update-btn btn btn-success btn-lg">Checkout</a>
									
									{{-- <button class="update-btn"></button> --}}
								</div>
								@if(session()->has('message'))
									<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
										{{ session('message') }}
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								@endif
							</div>

							<!--=======  End of Cart summery  =======-->

						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Cart page content  ======-->
@endsection