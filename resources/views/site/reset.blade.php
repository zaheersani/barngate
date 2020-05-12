@extends('site.layouts.layout-site')


@section("content")

	<div class="container pt-40 pb-40 text-blue">
				
		<div class="col-md-8 auto">

			<div class="card">
				<p class="fz-20 card-header fw-700 text-center">Reset Password</p> 
				<div class="mt-10 card-body">
					<form method="POST" action="http://localhost:8000/password/email">
						<input type="hidden" name="_token" value="ijJKm4sAADm43gm4ld1v8fHetEb40T344oVsiPoJ"> 
						<div class="form-group row">
							<label for="email" class="col-md-3 col-form-label text-md-right">E-Mail Address</label> 
							<div class="col-md-9">
								<input id="email" type="email" name="email" value="" required="required" autocomplete="email" autofocus="autofocus" class="form-control ">
							</div>
						</div> 
						<div class="form-group row mb-0">
							<div class="mt-10 col-md-12 text-center">
								<button type="submit" class="btn btn-primary">Send Password Reset Link ></button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div> <!-- /col-md-8 -->
		
	</div> <!-- /container -->

@endsection