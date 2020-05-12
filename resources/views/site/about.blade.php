@extends('site.layouts.layout-site')

@section("title", "About us | Barngate")
@section("description", "Barngate aim is to create an easy and friendly experience for buying and sale horses, cattle, goats, sheeps, pigs and pets.")

@section("content")

	<div class="banner banner-about"></div> <!-- /banner-about -->

	<div class="bg-gray text-center pt-15 pb-15">
		<h1 class="text-white fz-25">About Us</h1>
	</div> <!-- /bg-blue -->

	<div class="container pt-40 pb-40 text-blue text-center">
		
		<div class="container-text">
			
			<h2 class="fw-700">Our Mission</h2>
			<p class="fz-16">Be the best and safest online marketplace for sellers and buyers of horses, cattle, goats, pigs, sheeps and pets.</p>
			<h2 class="mt-40 fw-700">About</h2>
			<p class="fz-16">We rely on our years of knowledge and experience to bring you a marketplace where you can find the best deals on all of your horse, cattle, goat, pig, sheep and pets needs.</p>
			<p class="pt-10 fz-16">Our main differentiator is an intuitive and easy-to-use platform, as well as a support team ready to help you.</p>

			<div class="mt-40 row team">
				<div class="col-md-12">
					<img src="images/krystel-trejo-barngate.png">
					<h3>Krystel Trejo</h3>
					<p>CEO</p>
				</div>
			</div> <!-- /row -->
		</div> <!-- /container-text -->
		
	</div> <!-- /container -->

	{{-- @include('site.layouts.form-site') --}}

@endsection