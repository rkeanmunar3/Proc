@extends('layouts.index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="container login-container">
    <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <img src="{{ asset('img/logo.png') }}" alt="" style="width:30px; height:30px">
                    {{ __('Login') }}
                </div>

                <div class="card-body">
                    <div class="logo-container">
                        <img src="{{ asset('img/logo.png') }}" alt="" class="logo">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="email" class=" col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-user"></i>
                                </label>
                            </div>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-key"></i>
                                </label>
                            </div>
                            

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <!--<div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group row mt-3 mb-0">
                            <div class="offset-md-4 col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-outline-success" style="width:100%">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
