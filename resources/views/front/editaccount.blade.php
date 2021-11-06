@extends('front/layout')
@section('front_title','Edit Account')
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
							<li class="active">Edit Account</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->

	<!--=============================================
	=            Login register page content         =
	=============================================-->

	<div class="page-content mb-50">
		<div class="container">
			<div class="row">
	
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-2">
                </div>
                    
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-8">
					

						<div class="login-form">
							<h4 class="login-title">Edit Account</h4>
							{{-- <form action="#" id="frmregistration"> --}}
							<form action="{{ route('update_account',$customer->id) }}" method="post">
                                @csrf	
								<div class="row">

                                        <div class="col-md-6 col-12 mb-20">
                                            <label>First Name</label>
                                            <input class="mb-0" name="first_name" value="{{ $customer->first_name }}" type="text" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Last Name</label>
                                            <input class="mb-0" name="last_name" value="{{ $customer->last_name }}" type="text" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Address</label>
                                            <input class="mb-0" name="street_address" value="{{ $customer->street_address }}" type="text" placeholder="Street Address ">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Town</label>
                                            <input class="mb-0" name="town" value="{{ $customer->town }}" type="text" placeholder="Town">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>District</label>
                                            <input class="mb-0" name="district" value="{{ $customer->district }}" type="text" placeholder="District">
                                        </div>
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Post Code</label>
                                            <input class="mb-0" name="post_code" value="{{ $customer->post_code }}" type="text" placeholder="Post Code">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="register-button mt-0">Update</button>
                                        </div>
                                                                            

								</div>
								
							</form>
							{{-- <div id="success_msg" class="field_success"></div> --}}
						</div>

				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Login register page content  ======-->


@endsection