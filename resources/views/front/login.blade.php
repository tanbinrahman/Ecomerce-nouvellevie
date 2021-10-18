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
							<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
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
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-2 mb-30">
                </div>    
				<div class="col-sm-12 col-md-12 col-xs-12 col-lg-8 mb-30">
					<!-- Login Form s-->
						<div class="login-form">
                            <form id="frmlogin">
                                <h4 class="login-title">Login</h4>

                                <div class="row">
                                    <div class="col-md-12 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input class="mb-0" type="email" name="str_login_email" placeholder="Email Address" required>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Password</label>
                                        <input class="mb-0" type="password" name="str_login_password" placeholder="Password" required>
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
                                        <button id="btnLogin" class="register-button mt-0">Login</button>
                                    </div>

                                </div>
                                @csrf
                            </form>
                            <div id="login_msg"></div>
                            <hr>
                            <span>Don't have an account? </span> &nbsp; <a href="{{ route('registration_page') }}" class="logClass">Register now!</a>
						</div>
                        
					
				</div>

			</div>
		</div>
	</div>

	<!--=====  End of Login register page content  ======-->


@endsection