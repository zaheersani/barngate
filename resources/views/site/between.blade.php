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
		<div class="pt-40 pb-40 row-plan">
			<h3 class="fw-700 fz-28 text-center">STANDARD <span>$10</span></h3>
			<ul class="flex-auto pt-40 check-list fz-20 text-left">
				<li>Add duration <span class="fw-700">(90 days)</span></li>
				<li>5 photos</li>
				<li>Guide to take the best pictures of your Animal</li>
			</ul>
		</div> <!-- /row-plan -->
		
		<div class="mb-40 listing-homepage listing-white">
			<div class="flex between items-center fz-20 text-blue">
				<label><input type="checkbox">Feature your listing on our Homepage</label>
				<span>$20</span>
			</div> <!-- /flex -->
		</div> <!-- /listing-homepage -->
		
		<div class="pt-20 pb-20 row-total">
			<h3 class="fw-700 fz-28 text-center">Total: $30</h3>
			<!--<input type="text" class="form-input" placeholder="Credit Card">
			<div class="pt-20 row">
				<div class="col-md-6">
					<input type="text" class="form-input" placeholder="Expiration">
				</div>
				<div class="col-md-6">
					<input type="text" class="form-input" placeholder="CVC">
				</div>
			</div>-->
		</div> <!-- /row-total -->
		
		<div class="pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Next</a>
		</div>
		
	</div> <!-- /container -->

@endsection