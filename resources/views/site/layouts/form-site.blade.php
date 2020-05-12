<div class="bg-blue-light pt-40 pb-40">
	<h3 class="mb-40 text-center text-blue fw-700">Is there something we can help you with?</h3>
	<div class="container">
		<form class="forma clearfix" action="{{ route("contact.send") }}" method="POST">
			@csrf
			<div class="row">
				<div class="col-md-6">
					<fieldset>
						<input type="text" class="input" placeholder="First Name*" name="first_name" value="{{ old("first_name") }}">
						<input type="text" class="input" placeholder="Last Name*" name="last_name" value="{{ old("last_name") }}">
					</fieldset>
					<fieldset>
						<input type="email" class="input" placeholder="Email*" name="email_contact" value="{{ old("email_contact") }}">
						<input type="tel" class="input" placeholder="Phone" name="phone" value="{{ old("phone") }}">
					</fieldset>
				</div> <!-- /col-md-6 -->
				<div class="col-md-6">
					<textarea class="input" placeholder="Message" name="questions"> {{ old("questions") }} </textarea>
				</div> <!-- /col-md-6 -->
			</div> <!-- /row -->
			<div class="error" style="display: inline-block; color: red"></div>
			<input class="enviar enviar_contacto" type="submit" value="Submit >">
		</form>
	</div> <!-- /container -->
</div> <!-- /bg-blue-light -->


@if (session()->has("status.success"))
	<div class="shadowbox" id="success.contact" style="display: block;">
		<div class="close"></div>
		<div class="wrapper-form">
			<div class="container-form">
				<h3 class="text-center text-blue fz-30 mb-30">Thanks</h3>
				<p class="mb-15 fz-20"> We will read your message shortly. </p>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endif


@if (session()->has("status.error"))
	<div class="shadowbox" id="error.contact" style="display: block;">
		<div class="close"></div>
		<div class="wrapper-form">
			<div class="container-form">
				<h3 class="text-center text-blue fz-30 mb-30">I'm sorry</h3>
				<p class="mb-15 fz-20"> something went wrong, try again later. </p>
			</div> <!-- /container-form -->
		</div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->
@endif