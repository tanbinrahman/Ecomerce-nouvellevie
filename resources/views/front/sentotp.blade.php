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
							<h4 class="login-title">Veryfy Otp</h4>
                            @if ($flash =session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ $flash ." ".$phone_no}}
                            </div>

                           @endif
                           @if ($flash =session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ $flash }}
                            </div>

                           @endif
							<form action="{{ route('verifyotp') }}" method="post">
							    @csrf
                                <div class="row">
										<input class="mb-0" name="phone_no" type="hidden" value="{{ $phone_no }}">
									<div class="col-md-6 col-12 mb-20">
										<label>Otp</label>
										<input class="mb-0 @error('otp') is-invalid @enderror" name="otp" type="text" placeholder="Otp" required>
                                        <span id="otp" class="field_error"></span>
                                        @error('otp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
									</div>
                                    <div class="col-12">
										<button id="btnregistration" class="register-button mt-0">Submit</button>
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
