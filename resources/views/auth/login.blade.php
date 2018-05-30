@extends('layouts.app')

@section('content')
<div class="container p-0">
<div class="row mt-5">
<div class="col-md-7 pr-5">
			<img src="/storage/image/cube.png" class="mx-auto d-block">
			<p class="bg-light border rounded text-center mt-5 text-muted p-3">“Give a man a program, frustrate him for a day.
Teach a man to program, frustrate him for a lifetime.” </p>
		</div>
    
        <div class="col-md-5">
            <div class="card border-0">
                <div class="card-header border bg-light">{{ __('Login') }}</div>

                <div class="card-body border-bottom border-left border-right px-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-2">
                            

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Email" class="py-2 f-14 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                           

                            <div class="col-md-12">
                                <input id="password" placeholder="Password" type="password" class="py-2 f-14 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link border-0 w-100" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>

                                
                            </div>

                            

                        </div>
                    </form>
                    
                </div>
                
        
        
        
       
        </div>
       
        <div class="row p-3 mt-0">
                    <div class="col-md-12 border p-3 px-5 text-center">
                        <span class="py-0">Don't have an account?</span>
                            <a class="btn btn-link border-0 py-0 px-0" href="/register">
                                    {{ __('Sign Up') }}
                                </a>
                            </div>
                        </div>
    </div>
    
</div>
</div>
@endsection
