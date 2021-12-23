@extends('layout')

@section('content')
<div class="py-12 bg-gray-100 font-serif mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg  px-12 py-8">
            <div class=" py-5 ">
                <div class="text-2xl font-semibold flex justify-center">{{ __('Register') }}</div>

                <div class="card-body flex justify-center">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="border-2 border-gray-400 w-full px-4 py-1 @error('name') is-invalid @enderror focus:outline-none" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="border-2 border-gray-400 w-full px-4 py-1 @error('email') is-invalid @enderror focus:outline-none" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="border-2 border-gray-400 w-full px-4 py-1 @error('password') is-invalid @enderror focus:outline-none" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="border-2 border-gray-400 w-full px-4 py-1 focus:outline-none" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="px-5 py-1 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <span>Already have account ?</span>
                                <button type="submit" class="px-5 py-1 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
