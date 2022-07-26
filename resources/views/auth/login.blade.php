<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Ivem -  School Management System">
	<meta name="author" content="Ivem">
	<meta name="keywords" content="admin, dashboard, admin dashboard, admin template, responsive dashboard, admin panel, bootstrap dashboard, multi dashboard, html, responsive, responsive admin, bootstrap admin template, dashboard template, bootstrap">

	<!-- Favicon -->
	<link rel="icon" href="{{ url('backend/assets/img/brand/favicon.ico') }}" type="image/x-icon"/>

	<!-- Title -->
	<title>Ivem</title>

	<!-- Bootstrap css-->
	<link id="style" href="{{ url('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

	<!-- Icons css-->
	<link href="{{ url('backend/assets/web-fonts/icons.css') }}" rel="stylesheet"/>
	<link href="{{ url('backend/assets/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ url('backend/assets/web-fonts/plugin.css') }}" rel="stylesheet"/>

	<!-- Style css-->
	<link href="{{ url('backend/assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('backend/assets/css/transparent-style.css') }}" rel="stylesheet">
	<link href="{{ url('backend/assets/css/dark-style.css') }}" rel="stylesheet">
	<link href="{{ url('backend/assets/css/skin-modes.css') }}" rel="stylesheet">

	<!-- Color css-->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('backend/assets/css/colors/color.css') }}">

</head>

<body class="main-body leftmenu ltr light-theme">

	<!-- Loader -->
	<div id="global-loader">
		<img src="{{ url('backend/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->

	<!-- Page -->
	<div class="page main-signin-wrapper">

		<!-- Row -->
		<div class="row signpages text-center">
			<div class="col-md-12">
				<div class="card border-0">
					<div class="row row-sm">
						<div class="col-lg-6 col-xl-6 col-xs-12 col-sm-12 login_form rounded-start-11">
							<div class="container-fluid">
								<div class="row row-sm">
									<div class="card-body mt-2 mb-2">
										<div class="mobilelogo">
											<img src="{{ url('backend/assets/img/brand/logo.png') }}" class=" d-lg-none header-brand-img text-start float-start mb-4 dark-logo" alt="logo">
											<img src="{{ url('backend/assets/img/brand/logo-light.png') }}" class=" d-lg-none header-brand-img text-start float-start mb-4 light-logo" alt="logo">
										</div>
										<div class="clearfix"></div>
											<h2 class="text-start mb-2">Sign In</h2>
											<p class="mb-4 text-muted tx-13 ms-0 text-start">Sign in to Create, Discover and Connect with the Global Community</p>
											<div class="panel desc-tabs border-0 p-0">
												<div class="tab-menu-heading">
													<div class="tabs-menu ">
														<ul class="nav panel-tabs">
															<li class="">
																<a href="#tab01" class="active" data-bs-toggle="tab">Email</a>
															</li>
														</ul>
													</div>
												</div>
												<div class="panel-body tabs-menu-body mt-2">
													<div class="tab-content">
														<div class="tab-pane active" id="tab01">
                                                            <form action="{{ route('login') }}" method="POST">
                                                                @csrf
                                                                <div class="form-group text-start">
                                                                    <label class="tx-medium">{{ __('Email Address') }}</label>
                                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group text-start">
                                                                    <label class="tx-medium">{{ __('Password') }}</label>
                                                                    <input id="password" type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" data-bs-toggle="password" name="password" required autocomplete="current-password">

                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                                            </form>
														</div>
													</div>
												</div>
											</div>
										
										<div class="text-start mt-4 ms-0 mb-3">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link mb-1" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
											<div>Don't have an account? <a href="#">Register Here</a></div>
										</div>
										<div class="signin-or-title">
											<h5 class="fs-12 mb-1 title tx-normal">or</h5>
										</div>
										<div class="pb-1 pt-4">
											<div class="text-center socialicons">
												<button class="btn ripple btn-primary-transparent rounded-circle"><i class="mdi mdi-google"></i></button>
												<button class="btn ripple btn-success-transparent rounded-circle"><i class="mdi mdi-facebook"></i></button>
												<button class="btn ripple btn-info-transparent rounded-circle"><i class="mdi mdi-twitter"></i></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-xl-6 d-none d-lg-block text-center bg-primary details rounded-end-11">
							<div class="mt-4 pt-4 p-2 pos-relative">
								<img src="{{ url('backend/assets/img/brand/logo-light.png') }}" class="header-brand-img mb-3 mt-3" alt="logo">
								<div class="clearfix"></div>
								<img src="{{ url('backend/assets/img/pngs/user.png') }}" class="ht-250 mb-0" alt="user">
								<h2 class="mt-4 text-white tx-normal">Sign In Your Account</h2>
								<span class="tx-white-6 tx-13 mb-5 mt-xl-0">Sign in to Create, Discover and Connect with the Global Community</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

	</div>
	<!-- End Page -->

	<!-- Jquery js-->
	<script src="{{ url('backend/assets/plugins/jquery/jquery.min.js') }}"></script>

	<!-- Bootstrap js-->
	<script src="{{ url('backend/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
	<script src="{{ url('backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

	<!-- Bootstrap Show Password js-->
	<script src="{{ url('backend/assets/js/bootstrap-show-password.min.js') }}"></script>

	<!-- generate-otp js -->
	<script src="{{ url('backend/assets/js/generate-otp.js') }}"></script>

	<!-- Perfect-scrollbar js -->
	<script src="{{ url('backend/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

	<!-- Select2 js-->
	<script src="{{ url('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

	<!-- Color Theme js -->
	<script src="{{ url('backend/assets/js/themeColors.js') }}"></script>

	<!-- Custom js -->
	<script src="{{ url('backend/assets/js/custom.js') }}"></script>

</body>
</html>