<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">

<title>@yield('title')</title>

<meta name="description" content="@yield('description')">
{{-- <link rel="stylesheet" href="css/app.css"> --}}
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/style.css" >
<link rel="stylesheet" type="text/css" href="/css/message.css">	
<link href="/mmenu/jquery.mmenu.all.css" rel="stylesheet">
@yield("css-content")
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="/slick/slick.css" rel="stylesheet">
<link href="/slick/slick-theme.css" rel="stylesheet">
    
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png" />


@guest
	<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
@endguest
	
</head>

<body>

<div class="preloader" style="display: none;">
	<div class="lds-ripple">
		<div class="lds-pos"></div>
		<div class="lds-pos"></div>
	</div>
</div>

<!-- header desktop -->
	
<div class="general">
	
	<a class="menu-movil" href="#menu"><i class="fa fa-bars fa-2x"></i></a>
	<a class="menu-movil" href="#page"><i class="fa fa-close fa-2x"></i></a>

	<header class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<a href="{{ route("home") }}"><img class="logo" src="/images/logos/logo-barngate.svg" alt="Barngate"></a>
				</div>
				<div class="col-md-10 text-right">
					<nav>
						<ul class="menu_top">
							<li><a href="{{ route("faqs") }}" class="{{ request()->routeIs("faqs") ? "active_menu" : "" }}">FAQ's</a></li>
							<li><a href="https://blog.barngate.com/" target="_blank">Blog</a> </li>
							<li><a href="{{ route("contact") }}" class="{{ request()->routeIs("contact-us") ? "active_menu" : "" }}" >Contact Us</a> </li>

							@auth
								<li class="no-style" style="padding: 0 18px;"><a href="{{ route("logout.get") }}">Logout</a> </li>
								<li class="no-style"><a href="{{ route("sale") }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sale</a> </li>
							@endauth
							@guest
								<li class="login"><a class="show-log" href="#">Log in</a> </li>
								<li class="no-style btn-f"><a href="#" class="show-registro btn btn-primary">Register to buy</a> </li>
							@endguest
						</ul>
					</nav>
					@auth
						<nav>
							<ul class="menu_registro">
								<li><a href="{{ route("myaccount") }}" class="{{ request()->routeIs("myaccount") ? "active_menu" : "" }}" ><img src="/images/horse-classifieds-barngate-myaccount-icon.png" alt="Barngate">My account</a></li>
								<li class="notificacion">
									@if (auth()->user()->getNotifyCount() > 0)		
										<span class="icon-n">{{ auth()->user()->getNotifyCount() }}</span>
									@endif
									<a href="#" class="{{ request()->routeIs("notifications") ? "active_menu" : "" }}"><img src="/images/horse-classifieds-barngate-notificatios-icon.png" alt="Barngate">Notifications</a>
									<ul class="s-notificacion">
										<span>Notifications</span>
										@if (@$notificaciones != null)	
											<li>
												@for($i=0; $i <= count($notificaciones) - 1; $i++)
													@if ($notificaciones[$i]["typo_not"] == 1)
														<div data-href="{{ route("chat.index", $notificaciones[$i]["url"]) }}" class="flex txt-notificacion @if($notificaciones[$i]["pending"] == 1) pendding @endif">
															@if ($notificaciones[$i]["img_user"] != null)
																<div class="img_mini" style="background-image: url('{{ Storage::url($notificaciones[$i]["img_user"]) }}')"></div>
															@else
																<div class="img_mini" style="background-image: url('/images/sin_foto.jpeg')"></div>
															@endif
															<div>
																<p class="fw-700">{{ $notificaciones[$i]["nombre_usuario"] }}</p>
																<p>The user sent you a message</p>
																<span>{{ $notificaciones[$i]["time"] }}</span>
															</div>
														</div>
													@elseif ($notificaciones[$i]["typo_not"] == 2)
														<div data-href="{{ route("sale.show", $notificaciones[$i]["url"]) }}" class="flex txt-notificacion @if($notificaciones[$i]["pending"] == 1) pendding @endif">
															@if ($notificaciones[$i]["img"] != null)
																<img src="{{ Storage::url("images/".$notificaciones[$i]["img"]) }}">
															@else
																<img src="/images/sin_foto.jpeg">
															@endif
															<div>
																<p class="fw-700">{{ $notificaciones[$i]["sale_name"] }}</p>
																<p>The ad has expired</p>
																<span>{{ $notificaciones[$i]["time"] }}</span>
															</div>
														</div>
													@elseif ($notificaciones[$i]["typo_not"] == 3)
														<div data-href="{{ route("sale.show", $notificaciones[$i]["url"]) }}" class="flex txt-notificacion @if($notificaciones[$i]["pending"] == 1) pendding @endif">
															@if ($notificaciones[$i]["img"] != null)
																<img src="{{ Storage::url("images/".$notificaciones[$i]["img"]) }}">
															@else
																<img src="/images/sin_foto.jpeg">
															@endif
															<div>
																<p class="fw-700">{{ $notificaciones[$i]["sale_name"] }}</p>
																<p>The ad is 2 days from expiring</p>
																<span>{{ $notificaciones[$i]["time"] }}</span>
															</div>
														</div>
													@endif
												@endfor
											</li>
										@else
											<li><p><em>No notifications</em></p></li>
										@endif
										<a class="seeall" href="/notifications">See all</a>
									</ul>
								</li>
							</ul>
						</nav>
					@endauth
				</div>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav>
					<ul class="menu_home">
						<li><a href="{{ route("home") }}"><i class="fas fa-home"></i></a></li>
						<li><a @if (@$category == 1) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-cattle-online") }}">Cattle for Sale</a></li>
						<li><a @if (@$category == 2) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-a-horse-online") }}">Horse for Sale</a></li>
						<li><a @if (@$category == 3) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-sheep-online") }}">Sheep for Sale</a></li>
						<li><a @if (@$category == 4) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-goat-online") }}">Goat for Sale</a></li>
						<li><a @if (@$category == 5) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-pig-online") }}">Pig for Sale</a></li>
						<li><a @if (@$category == 6) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "online-pet-classifleds") }}">Pet Section</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div> 

	<div class="main-wrapper">

		@yield("content")

	</div> <!-- /main-wrapper -->

	<section id="footer" class="footer">
		<div class="container">
			<div class="row align-items-center row-eq-height">
				<div class="col-md-2">
					<img src="/images/logos/logo-footer.svg">
				</div>
				<div class="col-md-2">
					<ul>
						<li><a href="{{ route("home") }}">Home</a></li>
						<li><a href="{{ route("about") }}">About Us</a></li>
						<li><a href="/faqs">FAQ's</a></li>
						<li><a href="https://blog.barngate.com/" target="_blank">Blog</a> </li>
						<li><a href="{{ route("contact") }}">Contact Us</a> </li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
					</ul>
				</div>

				@guest
					<div class="col-md-2">
						<ul>
							<li><a href="#" class="show-registro">Register to buy</a> </li>
							<li><a href="#" class="show-log">Log In</a> </li>
						</ul>
					</div>
				@endguest

				<div class="col-md-6">
					<p class="text-blue-light fz-20 mb-5">Subscribe to our weekly Newsletter</p>
					<form id="signup" action="" method="post" class="form-inline">
						<div class="form-group mb-2">
							<label for="inputPassword2" class="sr-only">Enter your email</label>
						</div>
						<div class="form-group mx-sm-3 mb-2 w-60">
							<input type="email" class="form-control w-100" id="email" name="email" placeholder="Enter your email" data-name="Email" data-required="true" data-mail="true">
						</div>
						<input type="submit" class="btn btn-primary btn-red mb-2 w-35" id="mc-embedded-subscribe" value="Subscribe >">
					</form>
					<div class="fz-16 mb-10" id="message"></div>
					<ul class="list-inline">
						<li class="list-inline-item"><a href="https://www.facebook.com/barngate/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/barngate_" target="_blank"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row text-center">
			<div class="col-md-12 mt-20 mb-20 fz-18">
				© <?= date('Y'); ?> by Barngate. All Rights Reserved.
			</div>
		</div>
	</div> <!-- /container -->

</div>


<nav id="menu" class="navbar">
	
	<ul>
		<li><a href="#">Listing</a>
			<ul>
				<li><a @if (@$category == 1) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-cattle-online") }}">Cattle for Sale</a></li>
				<li><a @if (@$category == 2) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-a-horse-online") }}">Horse for Sale</a></li>
				<li><a @if (@$category == 3) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-sheep-online") }}">Sheep for Sale</a></li>
				<li><a @if (@$category == 4) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-goat-online") }}">Goat for Sale</a></li>
				<li><a @if (@$category == 5) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "buy-pig-online") }}">Pig for Sale</a></li>
				<li><a @if (@$category == 6) style="background: #29385A; color: #fff" @endif href="{{ route("vistaSearch", "online-pet-classifleds") }}">Pet for Sale</a></li>
			</ul>
		</li>
		<li><a href="{{ route("about") }}">About Us</a></li>
		<li><a href="{{ route("contact") }}">Contact Us</a> </li>
		<li><a href="/faqs">FAQ's</a></li>
		<li><a href="https://blog.barngate.com/">Blog</a></li>
		@guest
			<li><a class="show-log" href="#">Log in</a> </li>
			<li class="no-style"><a href="#" class="show-registro">Register to buy</a> </li>
			{{-- <li class="no-style"><a href="{{ route("sale") }}" data-toggle="modal" data-target="#myModal">Sale</a> </li> --}}
		@endguest

		@auth
			<li><a href="{{ route("myaccount") }}">My account</a></li>
			<li><a href="{{ route("sale") }}">Sale</a></li>
			<li><a href="/notifications">Notifications</a>
				<!--<ul>
					<li class="flex txt-notificacion">
						<img src="/images/picture.jpg">
						<span>
							<p class="fw-700">Animal</p>
							<p>Username</p>
							<small>1 hr</small>
						</span>
					</li>
					<li class="flex txt-notificacion">
						<img src="/images/picture.jpg">
						<span>
							<p class="fw-700">Animal</p>
							<p>Username</p>
							<small>1 hr</small>
						</span>
					</li>
					<a class="seeall" href="/notifications">See all</a>
				</ul>-->
			</li>
		@endauth
		
	</ul>
	
</nav> <!-- /navbar -->


@guest
	<div class="shadowbox" id="registro">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				{{-- {{ var_dump($errors->all()) }} --}}
				<h3 class="text-center text-blue fz-30 mb-30">Welcome to Barngate!</h3>
				<form class="forma" action="/register" method="POST" id="form_register">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="text" class="input" name="email_register" placeholder="Email">
					<input type="text" class="input" name="username" placeholder="Username (what others see when you comment)">
					<input type="password" class="input" name="password_register" placeholder="Password">
					<input type="password" class="input" name="password_confirmation" placeholder="Confirm Password">
					<div class="g-recaptcha" data-sitekey="6LcFBegUAAAAAKqmPunoAQBuCrgWjVxAezHO2_D2"></div>
					<input class="enviar register-send" type="submit" value="Register >">
				</form>
				<a class="link" href="/privacy-policy">Privacy policy</a>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endguest


@guest
	<div class="shadowbox" id="login">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3 class="text-center text-blue fz-30 mb-30">Log In</h3>
				<form class="forma" action="/login" method="POST" id="form_login">
					@csrf
					<input type="text" class="input" name="email_login" placeholder="Email">
					<input type="password" class="input" name="password" placeholder="Password">
					<input class="enviar login_send" type="submit" value="Log in">
				</form>
				<a class="link" href="/password/reset">Forgot your password?</a>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endguest


{{-- @auth --}}

	<div class="shadowbox" id="loading">
		<div class="wrapper-form">
            <div>
                <img src="/images/loading.gif" alt="loading">
            </div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

{{-- @endauth --}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/superagent/3.8.3/superagent.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

@yield("js-content")

<script src="/mmenu/jquery.mmenu.all.js"></script>
<script src="/slick/slick.js"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
@yield("js-content_main")

</body>
</html>