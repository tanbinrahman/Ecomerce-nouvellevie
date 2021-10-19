@extends('front/layout')
@section('front_title','Update password page')

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
							<li class="active">Update password page</li>
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
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-2 mb-30">
                </div>    
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-8 mb-30">
					<!-- Login Form s-->
						<div class="login-form">
                            <form id="frmUpdatePassword">
                                <h4 class="login-title">Update Password</h4>

                                <div class="row">
                                    <div class="col-md-12 col-12 mb-20">
                                        <label>Update Password*</label>
                                        <input class="mb-0" type="password" name="password" value="" placeholder="Update Password" required>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                            {{-- <input type="checkbox" name="rememberme" id="remember_me" >
                                            <label for="remember_me">Remember me</label> --}}
                                            <a href="{{ route('login_page') }}" > Go to Login Page Now!</a>
                                        </div>

                                    </div>

                                    <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                        {{-- <a href="{{ route('login_page') }}" > Go to Login Page Now!</a> --}}
                                    </div>
                                    <div class="col-md-12 mt-20">
                                        <button id="btnUpdatePassword" class="register-button mt-0">Update Password</button>
                                    </div>

                                </div>
                                @csrf
                            </form>
                            <div id="thank_you_msg" class="field_error"></div>
                            <hr>
                            <span>Don't have an account? </span> &nbsp; <a href="{{ route('registration_page') }}" class="logClass">Register now!</a>
						</div>
                        
					
				</div>

			</div>
		</div>
	</div>

	<!--=====  End of Login register page content  ======-->


@endsection