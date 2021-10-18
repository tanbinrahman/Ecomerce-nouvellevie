@extends('front/layout')
@section('front_title','Registration page')

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
							<li class="active">Login - Register</li>
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
				{{-- <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
					<!-- Login Form s-->
					<form action="#">

						<div class="login-form">
							<h4 class="login-title">Login</h4>

							<div class="row">
								<div class="col-md-12 col-12 mb-20">
									<label>Email Address*</label>
									<input class="mb-0" type="email" placeholder="Email Address">
								</div>
								<div class="col-12 mb-20">
									<label>Password</label>
									<input class="mb-0" type="password" placeholder="Password">
								</div>
								<div class="col-md-8">

									<div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
										<input type="checkbox" id="remember_me">
										<label for="remember_me">Remember me</label>
									</div>

								</div>

								<div class="col-md-4 mt-10 mb-20 text-left text-md-right">
									<a href="#"> Forgotten pasward?</a>
								</div>

								<div class="col-md-12">
									<button class="register-button mt-0">Login</button>
								</div>

							</div>
						</div>

					</form>
				</div> --}}
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-2">
                </div>
                    
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-8">
					

						<div class="login-form">
							<h4 class="login-title">Register</h4>
							<form action="#" id="frmregistration">
								<div class="row">
									<div class="col-md-6 col-12 mb-20">
										<label>First Name</label>
										<input class="mb-0" name="first_name" type="text" placeholder="First Name">
										<span id="first_name_error" class="field_error"></span>
									</div>
									<div class="col-md-6 col-12 mb-20">
										<label>Last Name</label>
										<input class="mb-0" name="last_name" type="text" placeholder="Last Name">
										<span id="last_name_error" class="field_error"></span>
									</div>
									<div class="col-md-12 mb-20">
										<label>Email Address*</label>
										<input class="mb-0" name="email" type="email" placeholder="Email Address">
										<span id="email_error" class="field_error"></span>
									</div>
									<div class="col-md-12 mb-20">
										<label>Mobile Number*</label>
										<input class="mb-0" name="Mobile_number" type="text" placeholder="Mobile Number">
										<span id="Mobile_number_error" class="field_error"></span>
									</div>
									<div class="col-md-12 mb-20">
										<label>Password</label>
										<input class="mb-0" name="password" type="password" placeholder="Password">
										<span id="password_error" class="field_error"></span>
									</div>
									{{-- <div class="col-md-6 mb-20">
										<label>Confirm Password</label>
										<input class="mb-0" name="c_password" type="password" placeholder="Confirm Password">
									</div> --}}
									<div class="col-12">
										<button id="btnregistration" class="register-button mt-0">Register</button>
									</div>
								</div>
								@csrf
							</form>
							<div id="success_msg" class="field_success"></div>
						</div>

				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Login register page content  ======-->


@endsection