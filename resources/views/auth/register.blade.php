@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
    <div class="col-md-7 pr-5">
			<img src="/storage/image/cloud-computing.png" class="mx-auto d-block">
			<p class="bg-light border rounded text-center mt-5 text-muted p-3">“Give a man a program, frustrate him for a day.
Teach a man to program, frustrate him for a lifetime.” </p>
		</div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-light">{{ __('Register') }}</div>

                <div class="card-body px-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-2">
                            

                            <div class="col-md-12">
                                <input id="name" type="text" placeholder="Name" class="py-2 f-14 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                        
                            <div class="col-md-12">
                                <input id="surname" type="text" placeholder="Surname" class="py-2 f-14 form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                        
                            <div class="col-md-12">
                                <input id="username" type="text" placeholder="Username" class="py-2 f-14 form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group row mb-2">
                            

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Email" class="py-2 f-14 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                           

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="Password" class="py-2 f-14 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" placeholder="Confirm password" class="py-2 f-14 form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                                <p class="w-100 f-14 text-center mt-4">By signing up, you agree to our <a href="#">Terms</a> & <a href="#">Privacy Policy.</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row p-3 mt-0">
                    <div class="col-md-12 border p-3 px-5 text-center">
                        <span class="py-0">Have an account?</span>
                            <a class="btn btn-link border-0 py-0 px-0" href="/login">
                                    {{ __('Log In') }}
                                </a>
                            </div>
                        </div>
        </div>
    </div>
</div>
@endsection
