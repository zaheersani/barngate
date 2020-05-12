@extends('site.layouts.layout-site')


@section("content")

	<div class="banner-sale">
		<div class="container">
			<div class="banner-text">
				<h1>How selling with us work</h1>
				<a href="#" class="btn-play btn btn-primary">Watch Video</a>
			</div>
		</div> <!-- /container -->
	</div> <!-- /banner-sale -->

	<div class="wrapper-register container pt-40 pb-40 text-blue">
		<h2 class="fw-700 text-left">Sell your animal with Barngate</h2>
		<p class="fz-20 fw-700 pt-20 pb-20">Select your plan</p>
		
		<div class="row">
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center">
					<h3 class="fw-700 fz-28">BASIC</h3>
					<span class="price fz-24 fw-700">Free</span>
					<div class="flex">
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(30 days)</span></li>
							<li>1 photo</li>
						</ul>
					</div>
					<a class="btn-red" href="#">Choose the Basic Plan ></a>
				</div> <!-- /wrapper-plan -->
			</div>
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center plan-selected">
					<small>Most Popular</small>
					<h3 class="fw-700 fz-28">STANDARD</h3>
					<span class="price fz-24 fw-700">$10</span>
					<ul class="flex-auto pt-40 check-list fz-20 text-left">
						<li>Add duration <span class="fw-700">(90 days)</span></li>
						<li>5 photos</li>
					</ul>
					<a class="btn-red" href="#">Choose the Standard Plan ></a>
				</div> <!-- /wrapper-plan -->
			</div>
			<div class="col-md-4 pb-20">
				<div class="wrapper-plan text-center">
					<h3 class="fw-700 fz-28">PREMIUM</h3>
					<span class="price fz-24 fw-700">$20</span>
					<ul class="flex-auto pt-40 check-list fz-20 text-left">
						<li>Add duration <span class="fw-700">(180 days)</span></li>
						<li>Unlimited photos</li>
						<li>Guide to take the best pictures of your Animal</li>
						<li>Upload Videos</li>
						<li>Guide to take the best Videos of your Animal</li>
					</ul>
					<a class="btn-red" href="#">Choose the Premium Plan ></a>
				</div> <!-- /wrapper-plan -->
			</div>
		</div> <!-- /row -->
		
		<div class="listing-homepage">
			<div class="flex between items-center fz-20 text-white">
				<label><input type="checkbox">Feature your listing on our Homepage</label>
				<span>$20</span>
			</div> <!-- /flex -->
		</div> <!-- /listing-homepage -->
		
		<div class="pt-40 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Next ></a>
		</div>
		
	</div> <!-- /container -->

@endsection