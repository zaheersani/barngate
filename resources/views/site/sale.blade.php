@extends('site.layouts.layout-site')


@section("css-content")
	<link href="js/filepond.css" rel="stylesheet">
	<style type="text/css">
		.has-error .form-input {
			border-color: #a94442;
		    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		}

		.oculto {
			display: none;
		}

	</style>
@endsection

@section("title", "Register for sale | Barngate")
@section("description", "Complete your profile so you can start selling in Barngate.")

@section("content")

	@if (session()->has("status.success")))
		<div class="shadowbox" id="success.register" style="display: block;">
			<div class="wrapper-form">
				<div class="container-form">
					<h3 class="text-center text-blue fz-30 mb-30">Congratulations!</h3>
					<p class="mb-15 fz-20">You have successfully published your animal.</p>
					<a class="enviar" href="{{ route('myaccount') }}">My account</a>
					<a class="enviar" href="{{ route('sale') }}">Register new animal</a>
				</div> <!-- /container-form -->
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->
	@endif

	<div class="banner-sale"></div> <!-- /banner-sale -->

	<form role="form" action="{{ route("sale.store") }}" method="POST" id="form_sale" accept-charset="UTF-8" class="require-validation" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
		@csrf

		<div class="wrapper-register container pt-40 pb-40 text-blue step1" {{ stepShow(1, $errors) }} {{ stepErrorCard(1) }}>
			<h2 class="fw-700 text-left">Sell your animal with Barngate</h2>
			<p class="fz-16 pt-20">Barngate is the best way to sell your animals online. Great Cattle, Horses and more for great prices thanks to a massive audience and a friendly format that helps buyers find exactly what their looking for with confidence.</p>
			<p class="fz-16 pt-20 pb-40">What Animal would you like to sell? Please fill out the form below.</p>
			
			<div class="wrapper-sale">

				<div class="row sale-row">
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Animal<span>*</span></h3>
						<select size="5" name="animals">
							<option value="">Make a selection</option>
							@foreach($animals as $animal)
								<option value="{{ $animal->animal_id }}" {{ selectOld("animals", $animal->animal_id) }}>{{ $animal->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('animals', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Breed<span>*</span></h3>
						<select size="5" name="breeds">
							<option>Make a selection</option>
							@foreach($breeds as $breed)
								<option value="{{ $breed->breed_id }}" {{ selectOld("breeds", $breed->breed_id) }}>{{ $breed->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('breeds', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Color<span>*</span></h3>
						<select size="5" name="colors">
							<option>Make a selection</option>
							@foreach($colors as $color)
								<option value="{{ $color->color_id }}" {{ selectOld("colors", $color->color_id) }}>{{ $color->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('colors', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
				
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Gender<span>*</span></h3>
						<select size="5" name="genders">
							<option>Make a selection</option>
							@foreach($genders as $gender)
								<option value="{{ $gender->gender_id }}" {{ selectOld("genders", $gender->gender_id) }}>{{ $gender->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('genders', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Age<span>*</span></h3>
						<select size="5" name="ages">
							<option>Make a selection</option>
							@for ($i = 1; $i <= 15; $i++)
								<option value="{{ $i }}" {{ selectOld("ages", $i) }} >{{ $i }}</option>
							@endfor
							
						</select>
						{!! $errors->paso1->first('ages', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Discipline<span>*</span></h3>
						<select size="5" name="discipline">
							<option>Make a selection</option>
							@foreach($disciplines as $discipline)
								<option value="{{ $discipline->discipline_id }}" {{ selectOld("discipline", $discipline->discipline_id) }}>{{ $discipline->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('discipline', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Class<span>*</span></h3>
						<select size="5" name="class">
							<option>Make a selection</option>
							@foreach($class as $clas)
								<option value="{{ $clas->class_id }}" {{ selectOld("class", $clas->class_id) }}>{{ $clas->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('class', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Type<span>*</span></h3>
						<select size="5" name="type">
							<option>Make a selection</option>
							@foreach($type as $typ)
								<option value="{{ $typ->type_id }}" {{ selectOld("type", $typ->type_id) }}>{{ $typ->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('type', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Size<span>*</span></h3>
						<select size="5" name="size">
							<option>Make a selection</option>
							@foreach($size as $siz)
								<option value="{{ $siz->size_id }}" {{ selectOld("size", $siz->size_id) }}>{{ $siz->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('size', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Declawed<span>*</span></h3>
						<select size="5" name="declawed">
							<option>Make a selection</option>
							<option value="1" {{ selectOld("declawed", 1) }}>Yes</option>
							<option value="2"  {{ selectOld("declawed", 2) }}>No</option>
						</select>
						{!! $errors->paso1->first('declawed', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Vaccinations<span>*</span></h3>
						<select size="5" name="vaccinations">
							<option>Make a selection</option>
							<option value="1"  {{ selectOld("vaccinations", 1) }}>Yes</option>
							<option value="2" {{ selectOld("vaccinations", 2) }}>No</option>
						</select>
						{!! $errors->paso1->first('vaccinations', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Horns<span>*</span></h3>
						<select size="5" name="horns">
							<option>Make a selection</option>
							<option value="1" {{ selectOld("horns", 1) }}>Yes</option>
							<option value="2" {{ selectOld("horns", 2) }}>No</option>
							<option value="3" {{ selectOld("horns", 3) }}>Other</option>
							<option value="4" {{ selectOld("horns", 4) }}>Polled</option>
						</select>
						{!! $errors->paso1->first('horns', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
				
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Categories<span>*</span></h3>
						<select size="5" name="categories">
							<option>Make a selection</option>
							@foreach($categories as $categorie)
								<option value="{{ $categorie->categorie_id }}" {{ selectOld("categories", $categorie->categorie_id) }}>{{ $categorie->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('categories', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

				
					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Weight<span>*</span></h3>
						<input type="text" class="form-input" name="weight" value="{{ old("weight") }}">
						{!! $errors->paso1->first('weight', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Conditions<span>*</span></h3>
						<input type="text" class="form-input" name="conditions" value="{{ old("conditions") }}">
						{!! $errors->paso1->first('conditions', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-4 pb-20 select-sale">
						<h3 class="fw-700">Number of head<span>*</span></h3>
						<input type="text" class="form-input" name="number_of_head" value="{{ old("number_of_head") }}">
						{!! $errors->paso1->first('number_of_head', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
				
					<div class="col-md-4 pb-20 temperament-ok">
						<h3 class="fw-700 pb-10">Temperament <small>(1=Calm, 10=Hot)</small></h3>
						<div class="row items-center">	
							<div class="col-md-9">
								<input id="input" type="range" value="{{ old("temperament", 0) }}" min="0" max="10" autocomplete="off" name="temperament">
								{!! $errors->paso1->first('temperament', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
							</div>
							<div class="col-md-3 text-right">
								<span id="etiqueta"></span> / 10
							</div> 
						</div> <!-- /inputDiv -->
					</div> <!-- /col-4 -->
				
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Price<span>*</span></h3>
						<input type="text" class="form-input" name="price" value="{{ old("price") }}">
						{!! $errors->paso1->first('price', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
				
					<div class="col-md-12">
						<h3 class="fw-700">Description<span>*</span></h3>
						<textarea class="form-input" name="description">{{ old("description") }}</textarea>
						{!! $errors->paso1->first('description', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						<p class="text-red">Do not enter any contact information here (email or phone). Based on your preferences, it will be available to valid buyers al the bottom of the detail page.</p>
					</div> <!-- /col-12 -->
				
				</div> <!-- /row -->
				
				<h3 class="fw-700 pt-20">Location</h3>
				
				<div class="row pt-20">
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">State/Province/Region:<span>*</span></h3>
						<select class="form-input" name="region">
							@foreach($estados as $estado)
								<option value="{{ $estado->id_estado }}"> {{ $estado->estado }} </option>
							@endforeach
						</select>
						{{-- <input type="text" class="form-input" name="region" value="{{ old("region") }}"> --}}
						{!! $errors->paso1->first('region', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">City:<span>*</span></h3>
						<select class="form-input" name="city"></select>
						{{-- <input type="text" class="form-input" name="city" value="{{ old("city") }}"> --}}
						{!! $errors->paso1->first('city', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-4 pb-20">
						<h3 class="fw-700">ZIP:<span>*</span></h3>
						<input type="text" class="form-input" name="zip" value="{{ old("zip") }}">
						{!! $errors->paso1->first('zip', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->
					<div class="col-md-3 pb-20" style="display: none">

						<h3 class="fw-700">Country:<span>*</span></h3>
						<select class="form-input" name="country">
							<option value="1"> United States </option>
						</select>
						{{-- <input type="text" class="form-input" name="country" value="{{ old("country") }}">
						{!! $errors->paso1->first('country', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!} --}}
					</div> <!-- /col-4 -->
				</div>
				
				<div class="pt-40 pb-20 text-center">
					<a href="#" class="mw-150 btn btn-primary nexts1">Next ></a>
				</div>
			</div> <!-- /wrapper-sale -->
		</div> <!-- /container -->

		<div class="wrapper-register container pt-40 pb-40 text-blue step2" {{ stepShow(2, $errors) }} {{ stepErrorCard(2) }}>
			<h2 class="fw-700 text-left">Sell your animal with Barngate</h2>
			<p class="fz-20 fw-700 pt-20 pb-20">Select your plan</p>
			
			<div class="row">
				<div class="col-md-4 pb-20">
					<div class="wrapper-plan text-center plancenter {{ planSelected(1) }}" data-plan="1">
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
					<div class="wrapper-plan text-center plancenter {{ planSelected(2) }} {{ planSelectDefault() }}" data-plan="2">
						<small>Most Popular</small>
						<h3 class="fw-700 fz-28">STANDARD</h3>
						<span class="price fz-24 fw-700 standard">$10</span>
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(90 days)</span></li>
							<li>5 photos</li>
						</ul>
						<a class="btn-blue" href="javascript:void(0)">Choose the Standard Plan</a>
					</div> <!-- /wrapper-plan -->
				</div>
				<div class="col-md-4 pb-20">
					<div class="wrapper-plan text-center plancenter {{ planSelected(3) }}" data-plan="3">
						<h3 class="fw-700 fz-28">PREMIUM</h3>
						<span class="price fz-24 fw-700 premium">$20</span>
						<ul class="flex-auto pt-40 check-list fz-20 text-left">
							<li>Add duration <span class="fw-700">(180 days)</span></li>
							<li>Unlimited photos</li>
							{{-- <li>Guide to take the best pictures of your Animal</li> --}}
							{{-- <li>Upload Videos</li> --}}
							{{--<li>Guide to take the best Videos of your Animal</li> --}}
						</ul>
						<a class="btn-blue" href="javascript:void(0)">Choose the Premium Plan</a>
					</div> <!-- /wrapper-plan -->
				</div>
			</div> <!-- /row -->
			
			{{-- <div class="listing-homepage">
				<div class="flex between items-center fz-20 text-white">
					<label><input type="checkbox" name="hompage" {{ homepageReload() }} value="1">Feature your listing on our Homepage</label>
					<input type="hidden" name="planSelect" value="{{ old("planSelect", 2) }}">
					<span>$20</span>
				</div>  /flex -->
			</div>  /listing-homepage --> --}}
			
			<div class="pt-40 pb-20 text-center">
				<a href="#" class="mw-150 btn btn-primary nexts2">Next ></a>
				<input type="hidden" name="planSelect" value="{{ old("planSelect", 2) }}">
				{!! $errors->paso2->first('planSelect', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
			</div>
		</div> <!-- /container -->

		<div class="wrapper-register container pt-40 pb-40 text-blue step3" {{ stepShow(3, $errors) }} {{ stepErrorCard(3) }}>
			<h2 class="fw-700 text-left">Sell your animal with Barngate</h2>
			<p class="fz-20 fw-700 pt-20 pb-20">Drag and drop images here or click to select images</p>
			<fieldset class="form-file">
				<input type="file" class="filepond" multiple name="filepond[]" />
				{!! $errors->paso3->first('filepond', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
				@if (session()->has("status.error.not.file"))
					<span class='err' style='display:block;margin-bottom:15px;color:red;text-align:left;'>{{ session("status.error.not.file") }}</span>
				@endif
				{{-- <input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple=""> --}}
				{{-- <label for="upload"><span></span></label> --}}
			</fieldset>
			<p class="fz-18 pt-20 pb-20">Please upload some photos of your animal using the box above - pick ones that offer a good sense of the animal. The more, and the higher the quality, the better.</p>
			<p class="fz-20 fw-700 pt-20 pb-10">Please provide any links to videos (Youtube or Vimeo) here</p>
			<textarea class="form-input" name="url-videos">{{ old("url-videos") }}</textarea>
			{!! $errors->paso3->first('url-videos', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
			
			{{-- <div class="wrapper-congrats text-center">
				<p class="fz-26">Congratulation, you just posted your Horse</p>
				<a class="mw-150 btn-red" href="#">Review Post</a>
			</div> --}} <!-- /wrapper-congrats -->
			
			<div class="pt-40 pb-20 text-center">
				<a href="#" class="mw-150 btn btn-primary next3">Next ></a>
			</div>
		</div> <!-- /container -->

		<div class="wrapper-register container pt-40 pb-40 text-blue step4" {{ stepErrorCard(4) }}>
			<h2 class="fw-700 text-left">Sell your animal with Barngate</h2>
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
					<div class="pt-20 row ">
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
			</div>
		</div> <!-- /container -->

	</form>


	<div class="shadowbox" id="loading-sale">
		<div class="wrapper-form">
            <div>
            	<h2 class="mb-15">We are publishing your animal.</h2>
                <img src="/images/loading.gif" alt="loading">
            </div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

@endsection


@section("js-content")
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
	<script src="https://unpkg.com/filepond-polyfill"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
	<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection


