@extends('site.layouts.layout-site')

@section("title", "My account| Barngate")

@section("content")

	@if (session()->has("status.success")))
		<div class="shadowbox" id="success.register" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h3 class="text-center text-blue fz-30 mb-30">Congratulations, your plan has been updated correctly</h3>
				</div> <!-- /container-form -->
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->
	@endif

	<div class="container pt-40 pb-40">
		
		<div class="flex flex-account between">
		
			<div class="wrapper-tabs">

				<input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
				<input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
				<input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
				<input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

				<div class="tabs flex-tabs">

					<label for="tab-one" id="tab-one-label" class="tab">Account Info</label>
					<label for="tab-two" id="tab-two-label" class="tab">Settings</label>
					<label for="tab-three" id="tab-three-label" class="tab">My Listing</label>
					<label for="tab-four" id="tab-four-label" class="tab">Inbox</label>

					<div id="tab-one-panel" class="panel active">
						<div class="box-tab">
							<div class="flex">
								<div class="item-flex">
                                    <div class="flex mb-20 flex-picture">
                                        <form enctype="multipart/form-data" id="formupload">
                                            <div class="item-flex">
                                                <fieldset class="form-file">
                                                    <input type="file" name="upload" id="upload" class="cargar-picture">
                                                    <label for="upload">
                                                        <span>Upload picture</span>
                                                        @if (auth()->user()->urlImg != null)
                                                            <div id="imgSalida" width="98%" height="98%" style="display: block; background-image: url('{{ Storage::url(auth()->user()->urlImg) }}')" ></div>
                                                        @else
                                                            <div id="imgSalida" width="98%" height="98%" style="" ></div>
                                                        @endif
                                                        @csrf
                                                    </label>
                                                </fieldset>
                                            </div> <!-- /item-flex -->
                                        </form>
                                        <div>
                                            <h2>Basic Info</h2>
                                            <ul>
                                                <li><p>{{ auth()->user()->email }}</p></li>
                                                <li><p>{{ auth()->user()->username }}</p></li>
                                                <li><p> * * * * * * * * * * * </p></li>
                                            </ul>
                                        </div>
                                    </div>
									
									<h2>Contact Info</h2>
									<ul>
										<li><p>{{ ( auth()->user()->name == null ) ? "Name" :  auth()->user()->name }}</p></li>
										<li><p>{{ ( auth()->user()->phone == null ) ? "Phone" :  auth()->user()->phone }}</p></li>
										<li><p>{{ ( auth()->user()->address == null ) ? "Address" :  auth()->user()->address }}</p></li>
										<li><p>{{ ( auth()->user()->cp_zip == null ) ? "Zip/Postal Code" :  auth()->user()->cp_zip }}</p></li>
										<li><p>{{ ( auth()->user()->state == null ) ? "State" :  auth()->user()->getState()->estado }}</p></li>
									</ul>
									<button class="show-info selector">Edit My Account Info</button>
								</div> <!-- /item-flex -->
								
							</div> <!-- /flex -->
						</div> <!-- /box-tab -->
					</div>

					<div id="tab-two-panel" class="panel">
						<div class="box-tab">
							<ul class="check-option">
								<li><label>Receive Emails about Favorite Animal</label><input type="checkbox" name="email_favorite" {{ auth()->user()->email_favorite == 1 ? "checked" : "" }}></li>
								{{-- <li><label>Receive Text Message Notifications</label><input type="checkbox" name="receive_text" {{ auth()->user()->receive_text == 1 ? "checked" : "" }}></li> --}}
							</ul>
							<div class="pt-20 pb-20 text-center">
								<a href="#" class="mw-150 btn btn-primary save-radio">Save settings ></a>
							</div>
						</div> <!-- /box-tab -->
					</div>

					<div id="tab-three-panel" class="panel">
						<div class="box-tab">
							<h3 class="title-green">Your Listings</h3>
							@if ($animal == null)
								<p> <em> None Currently live </em> </p>
							@endif
							<div class="pt-20 pb-20">
								@for($i=0; $i <= count($animal) - 1; $i++)
									<div class="flex-list items-center">
										<div class="flex between items-center">
											<div class="flex items-center">
												<img src="{{ "/storage/images/".$animal[$i]["img"] }}">
												<div class="txt-list">
													<a href="{{ route("sale.show", $animal[$i]["nickname"]) }}"><p>{{ $animal[$i]["animal_name"] }}</p></a>
													@if ($animal[$i]["disabled"] == 0)
														<span class="active">Active</span>
													@else
														<span class="expired">Expired</span>
													@endif
												</div> <!-- /txt-list -->
											</div>
											<div class="btn-list">
												<a href="{{ route("sale.edit", $animal[$i]["nickname"]) }}" class="mw-150 btn btn-primary">Edit</a>
												@if ($animal[$i]["disabled"] == 0)
													@if ($animal[$i]["sold"] == 1)
														<a href="#" class="mw-150 btn btn-primary botton-public" data-animal="{{ $animal[$i]["nickname"] }}">Post again</a>
														<a href="#" class="mw-150 btn btn-primary botton-remove" data-animal="{{ $animal[$i]["nickname"] }}">Remove</a>
													@else
														<a href="#" class="mw-150 btn btn-primary sold" data-animal="{{ $animal[$i]["nickname"] }}">Sold</a>
														<a href="#" class="mw-150 btn btn-primary botton-remove" data-animal="{{ $animal[$i]["nickname"] }}">Remove</a>
														@if ($animal[$i]["plan_id"] != 3)
															<a href="{{ route("sale.updateplan", $animal[$i]["nickname"]) }}" class="mw-150 btn btn-primary botton-renovate">Update Plan</a>
														@endif
													@endif
												@else
													<a href="{{ route("sale.updateplan", $animal[$i]["nickname"]) }}" class="mw-150 btn btn-primary botton-renovate">Renovate</a>
													<a href="#" class="mw-150 btn btn-primary botton-remove" data-animal="{{ $animal[$i]["nickname"] }}">Remove</a>
												@endif
											</div> <!-- /item-flex -->
										</div> <!-- /flex -->
									</div> <!-- /flex-list -->
								@endfor
							</div>
                            <div class="pb-20 text-center">
								<a href="{{ route("sale") }}" class="mw-150 btn btn-primary">Sale New Animal ></a>
							</div>
						</div> <!-- /box-tab -->
					</div>

					<div id="tab-four-panel" class="panel">
						<div class="box-tab">
							<div class="pt-20 pb-20">

								@if ($listado != null)
									@for ($i = 0; $i <= count($listado) - 1; $i++)

										<div class="flex flex-inbox items-center between">
											<div class="flex items-center">
												<img class="icon" src="images/buy-horse-online-barngate-message-icon.png">
												<a href=" {{ route("chat.index", $listado[$i]["token"]) }} ">
													<div class="txt-inbox">
														{{-- <p>Animal</p> --}}
														<p> {{ $listado[$i]["nombre_user"] }} </p>
														<p style="opacity: 0.5;"> {{ $listado[$i]["ultimo_mensaje"] }} </p>
													</div> <!-- /txt-list -->
												</a>
											</div>
											<div class="txt-inbox">
												@php $fecha = explode(" ", $listado[$i]["fecha"]); @endphp

												<p> {{ $fecha[0] }} </p>
												<p> {{ $fecha[1] }} </p>
											</div>
										</div> <!-- /flex -->

									@endfor
								@else
									<p><em>No chats</em></p>
								@endif
							</div>
						</div> <!-- /box-tab -->
					</div>

				</div> <!-- /tabs -->

			</div> <!-- /wrapper-tabs -->
			
			<div class="wrapper-stars">
				<div class="flex items-center">
					@if (auth()->user()->urlImg == null)
						<div style="background-image: url('/images/sin_foto.jpeg')" class="img_mini"></div>
					@else
						<div style="background-image: url('{{ Storage::url(auth()->user()->urlImg) }}')" class="img_mini"></div>
					@endif
					<div class="txt-list">
						<div class="flex items-center">
							<p class="fw-700">{{ auth()->user()->username }}</p>
							<ul class="rating">
								@if ($promedio != null)
									@php $bandera = 5; @endphp
									@for($j=1; $j <= $promedio; $j++)
										<li><i class="fa fa-star" style="color: #FFBA5C;"></i></li>
										@php $bandera--; @endphp
									@endfor
									@if ($bandera > 0)
										@for($i=1; $i <= $bandera; $i++)
											<li><i class="fa fa-star"></i></li>
										@endfor
									@endif
								@else
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
								@endif
							</ul>
						</div>
					</div> <!-- /txt-list -->
				</div>
			</div> <!-- /item-flex -->
		
		</div> <!-- /flex -->
			
	</div> <!-- /container -->

	@if($misFavoritos != null)

	<div class="bg-blue-light pt-40 pb-40">

		<div class="container">

			<h3 class="text-blue text-center fw-700 pb-20">Favorites</h3>

			<div class="slide-account">

				@for($i = 0; $i <= count($misFavoritos) - 1; $i++)
					<div>
						<div class="slide-animal">							
							<div class="image-slide" style="background-image: url({{ "/storage/images/".$misFavoritos[$i]["img"] }})"></div>
						</div> <!-- /slide-animal -->
						<p class="pt-10">{{ $misFavoritos[$i]["animal_name"] }}</p>
						<a href="{{ route("sale.show", $misFavoritos[$i]["nickname"]) }}">See more</a>
					</div>
				@endfor

			</div> <!-- /slide-account -->

		</div> <!-- /container -->
		
	</div> <!-- /bg-blue -->

	@endif


	<div class="shadowbox" id="editinfo">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			
			<div>
				<div class="flex w-100">

					<div class="container-form item-flex">
						{{-- {{ var_dump($errors->all()) }} --}}
						<h3 class="text-center text-blue fz-30 mb-30">Basic Info</h3>
						<form class="forma" action="" method="POST">
							@csrf
							<input type="text" class="input" name="email" value="{{ old("email", auth()->user()->email) }}" placeholder="Name">
							<input type="text" class="input" name="username" value="{{ old("username", auth()->user()->username) }}" placeholder="Username (what others see when you comment)">
							<input type="password" class="input" name="password_register" placeholder="Password">
						</form>
					</div> <!-- /item-flex -->

					<div class="container-form item-flex">
						{{-- {{ var_dump($errors->all()) }} --}}
						<h3 class="text-center text-blue fz-30 mb-30">Contact Info</h3>
						<form class="forma" action="" method="POST">
							<input type="text" class="input" name="name_contact" value="{{ old("name_contact", auth()->user()->name) }}" placeholder="Name">
							<input type="tel" class="input" name="phone" value="{{ old("phone", auth()->user()->phone) }}" placeholder="Phone">
							<input type="text" class="input" name="address" value="{{ old("address", auth()->user()->address) }}" placeholder="Address">
							<input type="text" class="input" name="postal" value="{{ old("postal", auth()->user()->cp_zip) }}" placeholder="Zip Code">
							{{-- <input type="text" class="input" name="country" value="{{ old("country", auth()->user()->country) }}" placeholder="Country"> --}}
							<select class="input" name="state">
								<option value=""> Select a state </option>
								@foreach($estados as $estado)
									<option value="{{ $estado->id_estado }}" @if( auth()->user()->state == $estado->id_estado ) selected @endif> {{ $estado->estado }} </option>
								@endforeach
							</select>
						</form>
					</div> <!-- /item-flex -->

				</div> <!-- /flex -->

				<div class="text-center pt-20 pb-20">
					<input class="mw-150 btn btn-primary edit-info_user" type="submit" value="Save changes >">
				</div>
			</div>

		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->



	@if (session()->has("myaccount"))
		<div class="shadowbox" id="incompletep" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h2>You need to fill in your contact information before selling!</h2>
				</div>
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->
	@endif


	<div class="shadowbox" id="img_changue">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2>Your profile picture was changed correctly!</h2>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="animal_remove">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> Are you sure you want to delete this post? </h2>
				<button class="enviar accpt_remove"> Accept </button>
				<button class="enviar cancel_remove"> Cancel </button>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->



	<div class="shadowbox" id="animal_again-post">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> Are you sure you want to republish your animal? </h2>
				<button class="enviar accpt_again"> Accept </button>
				<button class="enviar cancel_again"> Cancel </button>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="option_qualify">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> did you sell through? </h2>
				<button class="enviar barngate_qualify"> Barngate </button>
				<button class="enviar other_way"> Other way </button>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="calificacion">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3>Who did you sell it to?</h3>
				<div>
					@if ($listado != null)
						<ul>
							@for ($i = 0; $i <= count($listado) - 1; $i++)

								<li class="lista-calificacion">
									<div class="flex flex-inbox items-center between">
										<div class="flex">
											<img class="icon" src="images/buy-horse-online-barngate-message-icon.png">
											<a>
												<div class="txt-inbox">
													<p> {{ $listado[$i]["nombre_user"] }} </p>
												</div> <!-- /txt-list -->
											</a>
										</div>
										<div class="txt-inbox">
											<ul class="rating" data-user="{{ $listado[$i]["username"] }}">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
											</ul>
											<input type="hidden" class="qualify_calc">
											<button class="enviar qualify" style="cursor: pointer;"> Qualify </button>
										</div>
									</div> <!-- /flex -->
								</li>

							@endfor
						</ul>
					@else
						<h3> No Chats </h3>
					@endif
				</div>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	<div class="shadowbox" id="error_report">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h3></h3>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->


	@if (session()->has("session_succes-qualify"))

		<div class="shadowbox" id="session_succes-qualify" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h3> {{ session("session_succes-qualify") }} </h3>
				</div>
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->

	@endif


@endsection
