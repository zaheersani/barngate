@extends('site.layouts.layout-site')

@section("title", "Contact us | Barngate")
@section("description", "We'll help you to buy a horse, cattle, sheep, goat, pig and pets through a friendly experience. Contact us!")

@section("content")

	<div class="banner banner-contact">
		<div class="container relative">
			<div class="banner-text">
				<h1>How can we help you?</h1>
			</div>
		</div> <!-- /container -->
	</div> <!-- /banner-about -->

	<div class="bg-gray text-center pt-15 pb-15">
		<h1 class="text-white fz-25">Contact us</h1>
	</div> <!-- /bg-blue -->

	@include('site.layouts.form-site')

	<div class="container pt-40 pb-40 text-blue">
		<h2 class="fw-700 underline text-center"><a href="faqs">Frequent Asked Questions ></a></h2>
		<div class="row mt-30">
			<div class="col-md-6">
				<h2 class="fw-700">Is the purchase made on the platform?</h2>
				<p class="fz-16">No. The purpose of the platform is to exchange information with the buyer and seller and agree to sell outside the platform.</p>
			</div> <!-- /col-md-6 -->
			<div class="col-md-6">
				<h2 class="fw-700">Do you keep my information private?</h2>
				<p class="fz-16">Barngate does not and will never sell or give your email address to anyone. Read our Privacy Policy.</p>
			</div> <!-- /col-md-6 -->
		</div> <!-- /row -->
	</div> <!-- /container -->

@endsection