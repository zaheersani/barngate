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
		<h2 class="fw-700 text-left">Sell your animal with Farmgate</h2>
		<p class="fz-20 fw-700 pt-20 pb-20">Drag and drop images here or click to select images</p>
		<fieldset class="form-file">
			<input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple="">
			<label for="upload"></label>
		</fieldset>
		<p class="fz-18 pt-20 pb-20">Please upload some photos of your vehicle using the box below - pick ones that offer a good sense of the Animals. The more, and the higher the quality, the better. Click here to review our photo guide. Please use the box above to provide any video are not supported in the photo uploader below.</p>
		<p class="fz-20 fw-700 pt-20 pb-10">Please provide any links to videos (Youtube or Vimeo) here</p>
		<textarea class="form-input"></textarea>
		
		<div class="wrapper-congrats text-center">
			<p class="fz-26">Congratulation, you just posted your Horse</p>
			<a class="mw-150 btn-red" href="#">Review Post</a>
		</div> <!-- /wrapper-congrats -->
		
		<div class="pt-40 pb-20 text-center">
			<a href="#" class="mw-150 btn btn-primary">Post</a>
		</div>
		
	</div>

@endsection