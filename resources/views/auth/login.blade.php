@extends('layout')

@section('content')
<div class="py-12 bg-gray-100 font-serif mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  px-12 py-8">
            <div class="flex py-5">
                <div class="w-1/2 ">
                    <div class="text-2xl font-semibold flex justify-center">{{ __('Login') }}</div>
                    <div class="card-body flex justify-center mt-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6 mt-2">
                                    <input id="email" type="email" class="border-2 border-gray-400 w-full px-4 py-1 @error('email') is-invalid @enderror focus:outline-none" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6 ">
                                    <input id="password" type="password" class="border-2 border-gray-400 w-full px-4 py-1 @error('password') is-invalid @enderror focus:outline-none" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-2">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="px-5 py-1 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="text-blue-500 font-semibold" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="auth-right">
                        <h2 class="text-xl font-bold mt-3">New Customer ?</h2>
                        <div class="mt-2">
                            <p><strong>Save time now.</strong></p>
                            <p class="my-2">You don't need an account to checkout.</p>
                            <a href="{{ route('guestCheckout.index') }}" class="mt-2 px-5 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">Continue as Guest</a>                      
                        </div>
                        
                        <div class="mt-5">
                            <p><strong>Save time later.</strong></p>
                            <p class="my-2">Create an account for fast checkout and easy access to order history.</p>
                            <a href="{{ route('register') }}" class="px-5 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">Create Account</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
