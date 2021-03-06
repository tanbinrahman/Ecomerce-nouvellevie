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
	
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-2">
                </div>
                    
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-8">
					

						<div class="login-form">
							{{-- @if(session()->has('errors'))
								<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
									{{ session('errors') }}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
							@endif --}}
							<h4 class="login-title">Register</h4>
							{{-- <form action="#" id="frmregistration"> --}}
							<form action="{{ route('registration_process') }}" method="post">	
								<div class="row">
									<div class="col-md-6 col-12 mb-20">
										<label>First Name</label>
										<input class="mb-0" name="first_name" type="text" placeholder="First Name">
										{{-- <span id="first_name_error" class="field_error"></span> --}}
										@error('first_name')
											<div class="alert alert-danger">
												{{ $message }}
											</div>
                                    	@enderror
									</div>
									<div class="col-md-6 col-12 mb-20">
										<label>Last Name</label>
										<input class="mb-0" name="last_name" type="text" placeholder="Last Name">
										{{-- <span id="last_name_error" class="field_error"></span> --}}
										@error('last_name')
											<div class="alert alert-danger">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-md-12 mb-20">
										<label>Email Address*</label>
										<input class="mb-0" name="email" type="email" placeholder="Email Address">
										{{-- <span id="email_error" class="field_error"></span> --}}
										@error('email')
											<div class="alert alert-danger">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-md-12 mb-20">
										<label>Mobile Number*</label>
										<input class="mb-0" name="Mobile_number" type="text" placeholder="Mobile Number">
										{{-- <span id="Mobile_number_error" class="field_error"></span> --}}
										@error('Mobile_number')
											<div class="alert alert-danger">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-md-12 mb-20">
										<label>Password</label>
										<input class="mb-0" name="password" type="password" placeholder="Password">
										{{-- <span id="password_error" class="field_error"></span> --}}
										@error('last_name')
											<div class="alert alert-danger">
												{{ $message }}
											</div>
										@enderror
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