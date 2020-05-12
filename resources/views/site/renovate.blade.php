@extends('site.layouts.layout-site')


@section("content")

	<form role="form" action="{{ route("sale.pageupdateplan", $id) }}" method="POST" id="form_sale" accept-charset="UTF-8" class="require-validation" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
		@csrf

		<div class="wrapper-register container pt-40 pb-40 text-blue step2_plan" {{ stepErrorCard(2) }}>
			<h2 class="fw-700 text-left">Plan Update</h2>
			<p class="fz-20 fw-700 pt-20 pb-20">Select your plan</p>
			
			<div class="row">
				<div class="col-md-4 pb-20">
					<div class="wrapper-plan text-center plancenter {{ planSelectedUpdate(1, $sale) }}" data-plan="1"">
						<h3 class="fw-700 fz-28">BASIC</h3>
						<span class="price fz-24 fw-700">Free</span>
						<div class="flex">
							<ul class="flex-auto pt-40 check-list fz-20 text-left">
								<li>Add duration <span class="fw-700">(30 days)</span></li>
								<li>1 photo</li>
							</ul>
						</div>
						<a class="btn-blue" href="javascript:void(0)">Choose the Basic Plan</a>
					</div> <!-- /wrapper-plan -->
				</div>
				<div class="col-md-4 pb-20">
					<div class="wrapper-plan text-center plancenter  {{ planSelectedUpdate(2, $sale) }}" data-plan="2">
						<small>Most Popular</small>
						<h3 class="fw-700 fz-28">STANDARD</h3>
						<span class="price fz-24 fw-700">$10</span>
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(90 days)</span></li>
							<li>5 photos</li>
						</ul>
						<a class="btn-blue" href="javascript:void(0)">Choose the Standard Plan</a>
					</div> <!-- /wrapper-plan -->
				</div>
				<div class="col-md-4 pb-20">
					<div class="wrapper-plan text-center plancenter {{ planSelectedUpdate(3, $sale) }}" data-plan="3">
						<h3 class="fw-700 fz-28">PREMIUM</h3>
						<span class="price fz-24 fw-700">$20</span>
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(180 days)</span></li>
							<li>Unlimited photos</li>
						</ul>
						<a class="btn-blue" href="javascript:void(0)">Choose the Premium Plan</a>
					</div> <!-- /wrapper-plan -->
				</div>
			</div> <!-- /row -->
			
			{{-- <div class="listing-homepage">
				<div class="flex between items-center fz-20 text-white"> --}}
					{{-- <label><input type="checkbox" name="hompage" {{ homepageReload() }} value="1">Feature your listing on our Homepage</label> --}}
					<input type="hidden" name="planSelect" value="{{ old("planSelect", $sale->plan_id) }}">
					{{-- <span>$20</span> --}}
				<!--</div>  /flex 
			</div> /listing-homepage -->
			
			<div class="pt-40 pb-20 text-center">
				<a href="#" class="mw-150 btn btn-primary nexts2_plan">Next ></a>
				{!! $errors->paso2->first('planSelect', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
			</div>
		</div> <!-- /container -->


		<div class="wrapper-register container pt-40 pb-40 text-blue step3_plan" {{ stepErrorCard(3) }}>
			<h2 class="fw-700 text-left">Plan Update</h2>
			<div class="pt-40 pb-40 row-plan">
				<h3 class="fw-700 fz-28 text-center plan-title">STANDARD <span>$10</span></h3>
				<ul class="flex-auto pt-40 check-list fz-20 text-left skills">
					<li>Add duration <span class="fw-700">(90 days)</span></li>
					<li>5 photos</li>
					<li>Guide to take the best pictures of your Animal</li>
				</ul>
			</div> <!-- /row-plan -->
			
			{{-- <div class="mb-40 listing-homepage listing-white">
				<div class="flex between items-center fz-20 text-blue">
					<label><input type="checkbox" name="hompage2" {{ homepageReload() }} value="1">Feature your listing on our Homepage</label>
					<span>$20</span>
				</div> <!-- /flex -->
			</div> <!-- /listing-homepage --> --}}
			
			<div class="pt-30 pb-40 row-total">
				<h3 class="fw-700 fz-28 text-center">Total: $30</h3>
				<div class="not-freeplan">
					<div class="form-group required">
						<input type="text" class="form-input" size='4' placeholder="Name on Card">
					</div>
					<div class="form-group required">
						<input type="text" class="form-input card-number" size='20' autocomplete='off' placeholder="Credit Card">
					</div>
					<div class="pt-20 row">
						<div class="col-md-4 required">
							<input type="text" class="form-input card-cvc" autocomplete='off' placeholder="CVV" size='4'>
						</div>
						<div class="col-md-4 required">
							<input type="text" class="form-input card-expiry-month" placeholder="MM" size='2'>
						</div>
						<div class="col-md-4 required">
							<input class='form-input card-expiry-year' placeholder='YYYY' size='4' type='text'>
						</div>
					</div>
					<div class='form-row row pt-20' >
		                <div class='col-md-12 error form-group {{ hasSession() }}'>
		                    <div class='alert-danger alert'>{{ session("card_errors") }}</div>
		                </div>
		            </div>
		        </div>
			</div> <!-- /row-total -->
			
			<div class="pb-20 text-center">
				<button class="finish mw-150 btn btn-primary" type="submit">Pay and post ad ></button>
				<input type="hidden" name="animal_d" value="{{ $id }}">
			</div>
		</div> <!-- /container -->

	</form>

	@section("js-content")
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	@endsection

@endsection