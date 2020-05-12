@extends('site.layouts.layout-site')

@section("css-content")
	<link href="/js/filepond.css" rel="stylesheet">
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


@section("content")

	<form action="{{ route("sale.update", $id) }}" id="form-edit_animal" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
		@csrf
		<input type="hidden" name="nick" value="{{ $id }}">
        
		<div class="container pt-40 pb-40 text-blue">
			
			<h2 class="fw-700 text-left">Edit your animal</h2>
			
			<div class="wrapper-sale mt-40">

				<div class="row sale-row">

					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Breed<span>*</span></h3>
						<select name="breeds" class="form-input">
							<option>Make a selection</option>
							@foreach($breeds as $breed)
								<option value="{{ $breed->breed_id }}" @if ($animalprincipal->breed_id == old("breeds", $breed->breed_id)) selected @endif >{{ $breed->name }}</option>
							@endforeach
						</select>
						{!! $errors->paso1->first('breeds', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					@if ($animalprincipal->animal_id == 2 || $animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Color<span>*</span></h3>
							<select name="colors" class="form-input">
								<option>Make a selection</option>
								@foreach($colors as $color)
									<option value="{{ $color->color_id }}" @if ($animalprincipal->color_id == old("colors", $color->color_id)) selected @endif>{{ $color->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('colors', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id != 1)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Gender<span>*</span></h3>
							<select name="genders" class="form-input">
								<option>Make a selection</option>
								@foreach($genders as $gender)
									<option value="{{ $gender->gender_id }}" @if ($animalprincipal->gender_id == old("genders", $gender->gender_id)) selected @endif>{{ $gender->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('genders', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Age<span>*</span></h3>
						<select name="ages" class="form-input">
							<option>Make a selection</option>
							@for ($i = 1; $i <= 15; $i++)
								<option value="{{ $i }}" @if ($animalprincipal->age_id == old("ages", $i)) selected @endif>{{ $i }}</option>
							@endfor	
						</select>
						{!! $errors->paso1->first('ages', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					@if ($animalprincipal->animal_id == 2)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Discipline<span>*</span></h3>
							<select name="discipline" class="form-input">
								<option>Make a selection</option>
								@foreach($disciplines as $discipline)
									<option value="{{ $discipline->discipline_id }}" @if ($animalprincipal->discipline_id == old("discipline", $discipline->discipline_id)) selected @endif>{{ $discipline->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('discipline', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Class<span>*</span></h3>
							<select name="class" class="form-input">
								<option>Make a selection</option>
								@foreach($class as $clas)
									<option value="{{ $clas->class_id }}" @if ($animalprincipal->class_id == old("class", $clas->class_id)) selected @endif>{{ $clas->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('class', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 4)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Type<span>*</span></h3>
							<select name="type" class="form-input">
								<option>Make a selection</option>
								@foreach($type as $typ)
									<option value="{{ $typ->type_id }}" @if ($animalprincipal->type_id == old("type", $typ->type_id)) selected @endif>{{ $typ->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('type', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 6 || $animalprincipal->animal_id == 7)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Size<span>*</span></h3>
							<select name="size" class="form-input">
								<option>Make a selection</option>
								@foreach($size as $siz)
									<option value="{{ $siz->size_id }}" @if ($animalprincipal->size_id == old("size", $siz->size_id)) selected @endif>{{ $siz->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('size', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 7)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Declawed<span>*</span></h3>
							<select name="declawed" class="form-input">
								<option>Make a selection</option>
								<option value="1" @if ($animalprincipal->declawed == old("declawed", 1)) selected @endif>Yes</option>
								<option value="2"  @if ($animalprincipal->declawed == old("declawed", 2)) selected @endif>No</option>
							</select>
							{!! $errors->paso1->first('declawed', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1)
						<div class="col-md-4 pb-20">
							<h3 class="fw-700">Vaccinations<span>*</span></h3>
							<select name="vaccinations" class="form-input">
								<option>Make a selection</option>
								<option value="1" @if ($animalprincipal->vaccinations == old("vaccinations", 1)) selected @endif>Yes</option>
								<option value="2" @if ($animalprincipal->vaccinations == old("vaccinations", 2)) selected @endif>No</option>
							</select>
							{!! $errors->paso1->first('vaccinations', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4)
						<div class="col-md-4 pb-20 select-sale">
							<h3 class="fw-700">Horns<span>*</span></h3>
							<select name="horns" class="form-input">
								<option>Make a selection</option>
								<option value="1" @if ($animalprincipal->horns == old("horns", 1)) selected @endif>Yes</option>
								<option value="2" @if ($animalprincipal->horns == old("horns", 2)) selected @endif>No</option>
								<option value="3" @if ($animalprincipal->horns == old("horns", 3)) selected @endif>Other</option>
								<option value="4" @if ($animalprincipal->horns == old("horns", 4)) selected @endif>Polled</option>
							</select>
							{!! $errors->paso1->first('horns', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1)
						<div class="col-md-4 pb-20 select-sale">
							<h3 class="fw-700">Categories<span>*</span></h3>
							<select name="categories" class="form-input">
								<option>Make a selection</option>
								@foreach($categories as $categorie)
									<option value="{{ $categorie->categorie_id }}" @if ($animalprincipal->categorie_id == old("categories", $categorie->categorie_id)) selected @endif>{{ $categorie->name }}</option>
								@endforeach
							</select>
							{!! $errors->paso1->first('categories', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
						<div class="col-md-4 pb-20 select-sale">
							<h3 class="fw-700">Weight<span>*</span></h3>
							<input type="text" class="form-input" name="weight" value="{{ old("weight", $animalprincipal->weight) }}">
							{!! $errors->paso1->first('weight', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1)
						<div class="col-md-4 pb-20 select-sale">
							<h3 class="fw-700">Conditions<span>*</span></h3>
							<input type="text" class="form-input" name="conditions" value="{{ old("conditions", $animalprincipal->conditions) }}">
							{!! $errors->paso1->first('conditions', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 1 || $animalprincipal->animal_id == 3 || $animalprincipal->animal_id == 4 || $animalprincipal->animal_id == 5)
						<div class="col-md-4 pb-20 select-sale">
							<h3 class="fw-700">Number of head<span>*</span></h3>
							<input type="text" class="form-input" name="number_of_head" value="{{ old("number_of_head", $animalprincipal->number_of_head) }}">
							{!! $errors->paso1->first('number_of_head', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
						</div> <!-- /col-4 -->
					@endif

					@if ($animalprincipal->animal_id == 2)
						<div class="col-md-4 pb-20 temperament-ok">
							<h3 class="fw-700 pb-10">Temperament <small>(1=Calm, 10=Hot)</small></h3>
							<div class="row items-center">	
								<div class="col-md-9">
									<input id="input" type="range" value="" min="0" max="10" autocomplete="off" name="temperament">
									{!! $errors->paso1->first('temperament', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
								</div>
								<div class="col-md-3 text-right">
									<span id="etiqueta"></span> / 10
								</div> 
							</div> <!-- /inputDiv -->
						</div> <!-- /col-4 -->
					@endif

					<div class="col-md-4 pb-20">
						<h3 class="fw-700">Price<span>*</span></h3>
						<input type="text" class="form-input" name="price" value="{{ old("price", $animalprincipal->price) }}">
						{!! $errors->paso1->first('price', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
					</div> <!-- /col-4 -->

					<div class="col-md-12">
						<h3 class="fw-700">Description<span>*</span></h3>
						<textarea class="form-input" name="description"> {{ old("description", $animalprincipal->description) }} </textarea>
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
                                <option value="{{ $estado->id_estado }}" @if ($estado->id_estado == old("region", $animalprincipal->state)) selected @endif > {{ $estado->estado }} </option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-input" name="region" value="{{ old("region") }}"> --}}
                        {!! $errors->paso1->first('region', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
                    </div> <!-- /col-4 -->
                    <div class="col-md-4 pb-20">
                        <h3 class="fw-700">City:<span>*</span></h3>
                        <select class="form-input" name="city">
                            @foreach($ciudades as $ciudad)
                                <option value="{{ $ciudad->id_ciudad }}" @if ($ciudad->id_ciudad == old("city", $animalprincipal->city)) selected @endif >{{ $ciudad->ciudad }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" class="form-input" name="city" value="{{ old("city") }}"> --}}
                        {!! $errors->paso1->first('city', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
                    </div> <!-- /col-4 -->
                    <div class="col-md-4 pb-20">
                        <h3 class="fw-700">ZIP:<span>*</span></h3>
                        <input type="text" class="form-input" name="zip" value="{{ old("zip", $animalprincipal->zip) }}">
                        {!! $errors->paso1->first('zip', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
                    </div> <!-- /col-4 -->
                    <div class="col-md-4 pb-20" style="display: none">
                        <h3 class="fw-700">Country:<span>*</span></h3>
                        <select class="form-input" name="country">
                            <option value="1"> United States </option>
                        </select>
                        {!! $errors->paso1->first('country', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
                    </div> <!-- /col-4 -->

                </div> <!-- /row -->
                
			</div> <!-- /wrapper-sale -->
			
		</div> <!-- /container -->


		<div class="container pb-40 text-center">
			<h3 class="pb-20">Change pictures</h3>

			<fieldset class="form-file mb-20 field-update">
				{{-- <input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple=""> --}}
				<input type="file" class="filepond" multiple name="filepond[]" />
				<label for="upload" style="margin: auto;" ></label>
				{!! $errors->paso1->first('filepond', "<span class='err' style='display:block;margin-bottom:15px;color:red'>:message</span>") !!}
				@if (session()->has("status.error.not.file"))
					<span class='err' style='display:block;margin-bottom:15px;color:red'>{{ session("status.error.not.file") }}</span>
				@endif
			</fieldset>

			<div class="slide-account">

				<div>
					<div class="slide-animal">
						@for($i=0; $i <= count($todasImg) - 1; $i++)							
							<div class="image-slide img-remove_edit" style="background-image: url({{ \Storage::url("images/$todasImg[$i]") }})">
								<i class="far fa-times-circle remove remove_img-edit" data-url="{{ \Storage::url("images/$todasImg[$i]") }}"></i>
							</div> <!-- /img-slide -->
						@endfor
					</div> <!-- /slide-animal -->
				</div>

			</div> <!-- /slide-account -->
			
			<div class="pt-20 pb-20 text-center">
				<button href="#" class="mw-150 btn btn-primary edit_animal-button">Edit animal</button>
			</div>

		</div> <!-- /container -->
	</form>


	<div class="shadowbox" id="remove_img">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> Are you sure you want to delete this image? </h2>
				<button class="enviar accpt_remove-img"> Accept </button>
				<button class="enviar cancel_remove-img"> Cancel </button>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	<div class="shadowbox" id="remove_img-error">
		<div class="close"></div> <!-- /close -->
		<div class="wrapper-form">
			<div class="container-form">
				<h2> An error occurred, please try again later </h2>
			</div>
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

	@if ( session()->has("status.error") )
		@if (session("status.error") == "2")
			<div class="shadowbox" id="sess_error" style="display: block;">
				<div class="close"></div> <!-- /close -->
				<div class="wrapper-form">
					<div class="container-form">
						<h2> check your plan, since you cannot upload more images </h2>
					</div>
				</div> <!-- /wrapper-form -->
			</div> <!-- /shadowbox -->
		@elseif (session("status.error") == "1")
			<div class="shadowbox" id="sess_error" style="display: block;">
				<div class="close"></div> <!-- /close -->
				<div class="wrapper-form">
					<div class="container-form">
						<h2>  An error occurred, please try again later </h2>
					</div>
				</div> <!-- /wrapper-form -->
			</div> <!-- /shadowbox -->
		@endif
	@endif


	@if ( session()->has("status.success") )
		<div class="shadowbox" id="sess_succ" style="display: block;">
			<div class="close"></div> <!-- /close -->
			<div class="wrapper-form">
				<div class="container-form">
					<h2>  The information was saved correctly </h2>
				</div>
			</div> <!-- /wrapper-form -->
		</div> <!-- /shadowbox -->
	@endif

@endsection


@section("js-content")
	<script language="JavaScript" type="text/javascript">
	     
	    //var bPreguntar = true;
	    window.onbeforeunload = preguntarAntesDeSalir;
	     
	    function preguntarAntesDeSalir()
	    {
	      if (bPreguntar)
	        return "¿Seguro que quieres salir?";
	    }
	</script>
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
	<script src="https://unpkg.com/filepond-polyfill"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
	<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript"></script>
@endsection