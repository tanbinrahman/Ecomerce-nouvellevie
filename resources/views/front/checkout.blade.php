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
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->

	<!--=============================================
	=            Checkout page content         =
	=============================================-->

	<div class="page-section section mb-50">
		<div class="container">
			<div class="row">
				<div class="col-12">

					<!-- Checkout Form s-->
					<form action="#" class="checkout-form" id="frmPlaceOrder">
						<div class="row row-40">

							<div class="col-lg-7 mb-20">
								@if(session()->has('FRONT_USER_LOGIN')==null)
									{{-- <input type="button" value="Login" class="aa-browse-btn" data-toggle="modal" data-target="#login-modal"> --}}
									<a class="btn btn-success btn-lg" href="{{ route('login_page') }}">Login</a>
									<br><br>
									OR
									<br><br>
							  	@endif
								<!-- Billing Address -->
								<div id="billing-form" class="mb-40">
									<h4 class="checkout-title">Billing Address</h4>

									<div class="row">

										<div class="col-md-6 col-12 mb-20">
											<label>First Name*</label>
											<input type="text" placeholder="First Name" name="first_name" required value="{{ $customers['first_name'] }}">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Last Name*</label>
											<input type="text" placeholder="Last Name" name="last_name" required value="{{ $customers['last_name'] }}">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Email Address*</label>
											<input type="email" placeholder="Email Address" name="email" required value="{{ $customers['email'] }}">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Phone no*</label>
											<input type="text" placeholder="Phone number" name="Mobile_number" required value="{{ $customers['Mobile_number'] }}">
										</div>

										{{-- <div class="col-12 mb-20">
											<label>Company Name</label>
											<input type="text" placeholder="Company Name">
										</div> --}}

										<div class="col-12 mb-20">
											<label>Address*</label>
											{{-- <textarea name="street_address" id=""  rows="3"></textarea> --}}
											<input type="text" placeholder="Address" name="street_address" required value="{{ $customers['street_address'] }}">
											{{-- <input type="text" placeholder="Address line 2"> --}}
										</div>

										{{-- <div class="col-md-6 col-12 mb-20">
											<label>Country*</label>
											<select class="nice-select">
												<option>Bangladesh</option>
												<option>China</option>
												<option>country</option>
												<option>India</option>
												<option>Japan</option>
											</select>
										</div> --}}

										<div class="col-md-12 col-12 mb-20">
											<label>Town*</label>
											<input type="text" placeholder="Town" name="town" required value="{{ $customers['town'] }}">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>District*</label>
											<input type="text" placeholder="District" name="district" required value="{{ $customers['district'] }}">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Post Code*</label>
											<input type="text" placeholder="Post Code" name="post_code" required value="{{ $customers['post_code'] }}">
										</div>

										<div class="col-12 mb-20">
											<div class="check-box">
												<input type="checkbox"  id="create_account">
												<label for="create_account">Create an Acount?</label>
											</div>
											<div class="check-box">
												
												<input type="checkbox" name="shiping_address" id="shiping_address" data-shipping>
												<label for="shiping_address">Ship to Different Address</label>
											</div>
										</div>

									</div>

								</div>

								<!-- Shipping Address -->
								<div id="shipping-form" class="mb-40">
									<h4 class="checkout-title">Shipping Address</h4>

									<div class="row">

										<div class="col-md-6 col-12 mb-20">
											<label>First Name*</label>
											<input type="text" name="s_first_name" placeholder="First Name">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Last Name*</label>
											<input type="text" name="s_last_name" placeholder="Last Name">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Email Address*</label>
											<input type="email" name="s_email" placeholder="Email Address">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Phone no*</label>
											<input type="text" name="s_Mobile_number" placeholder="Phone number">
										</div>

										{{-- <div class="col-12 mb-20">
											<label>Company Name</label>
											<input type="text"  placeholder="Company Name">
										</div> --}}

										<div class="col-12 mb-20">
											<label>Address*</label>
											<input type="text" name="s_street_address" placeholder="Address line 1">
											{{-- <input type="text" placeholder="Address line 2"> --}}
										</div>

										{{-- <div class="col-md-6 col-12 mb-20">
											<label>Country*</label>
											<select class="nice-select">
												<option>Bangladesh</option>
												<option>China</option>
												<option>country</option>
												<option>India</option>
												<option>Japan</option>
											</select>
										</div> --}}

										<div class="col-md-12 col-12 mb-20">
											<label>Town*</label>
											<input type="text" name="s_town" placeholder="Town">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>District*</label>
											<input type="text" name="s_district" placeholder="State">
										</div>

										<div class="col-md-6 col-12 mb-20">
											<label>Post Code*</label>
											<input type="text" name="s_post_code" placeholder="Zip Code">
										</div>

									</div>

								</div>

							</div>

							<div class="col-lg-5">
								<div class="row">

									<!-- Cart Total -->
									<div class="col-12 mb-60">

										<h4 class="checkout-title">Cart Total</h4>

										<div class="checkout-cart-total">

											<h4>Product <span>Total</span></h4>
											<?php 
												$productamount =0;
											?>
											<ul>
                                                @foreach ($CartGetContents as $CartGetContent)
													<?php 
														$productamount =$productamount+( $CartGetContent->quantity*$CartGetContent->price);
														// prx($productamount);
													?>
												    <li>{{ $CartGetContent->name }} X {{ $CartGetContent->quantity}} <span>৳ {{ $CartGetContent->quantity*$CartGetContent->price}}</span></li>
                                                @endforeach
											</ul>
											@if($condition !==null)
											<p>Total product amount <span>৳ {{ $productamount }}</span></p>
											<p>Coupon value <span>৳ {{ $productamount-$GetSubTotal }}</span></p>
                                                                
	
                                            @endif
											<p>Sub Total <span>৳ {{ $GetSubTotal }}</span></p>
											<p>Shipping Fee <span>৳ @if($condition1 !==null)
                                                                        {{ $conditionValue1 }}
                                                                    @else 
                                                                        0	
                                                                    @endif</span></p>

											<h4>Grand Total <span>৳ {{ $GetTotal }}</span></h4>

										</div>

									</div>

									<!-- Payment Method -->
									<div class="col-12">

										<h4 class="checkout-title">Payment Method</h4>

										<div class="checkout-payment-method">

											<div class="single-method">
												<input type="radio" id="payment_cash" name="payment_method" value="COD">
												<label for="payment_cash">Cash on Delivery</label>
												<p data-method="cash">Please send a Check to Store name with Store Street, Store Town, Store
													State, Store Postcode, Store Country.</p>
											</div>

										</div>
										<input type="hidden" name="cupon_value" value="{{ $productamount-$GetSubTotal }}">
										<button class="place-order" id="btnPlaceOrder">Place order</button>
										 
									</div>
										<div id="order_place_msg"></div>
								</div>
							</div>

						</div>

						@csrf
					</form>

				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Checkout page content  ======-->

@endsection