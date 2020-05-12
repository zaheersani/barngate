@extends('site.layouts.layout-site')


@section("content")

    <div class="container pt-40 pb-40 text-blue">
                
        <div class="col-md-8 auto">

            <div class="card">
                <p class="fz-20 card-header fw-700 text-center">{{ __('Reset Password') }}</p> 
                <div class="mt-10 card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row mb-0">
                            <div class="mt-10 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link >') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div> <!-- /col-md-8 -->
        
    </div> <!-- /container -->

@endsection
