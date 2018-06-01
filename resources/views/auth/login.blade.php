@extends('layouts.main')

@section('content')

 <div class="grid grid-wide grid-top grid-wrap">
        <c-header></c-header>
        <div class="grid grid-col grid-wide">
        <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="form-group row loginform">
                            <!-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                            <div class="col-md-6">
                                <input  placeholder="Your email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row loginform">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->
                            <div class="col-md-6">
                                <input placeholder="Your password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 top-paddable">
                            <div class="col-md-8 offset-md-4 grid grid-wrap">
                                <button type="submit" id="login-button" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a id="login-button" class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('Register now') }}
                                </a>
                            </div>
                        </div>
                    </form>
        </div>
    </div>



@endsection
