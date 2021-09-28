@extends('layout')

@section('title', 'Checkout')

@section('extra-css')
    <style>
        .mt-32 {
            margin-top: 32px;
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success_message'))
                <div class="text-xl font-bold text-gray-500 my-4 bg-green-300 py-2 px-6">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="text-xl font-bold text-gray-500 my-4 bg-red-300 px-6 py-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-3xl font-bold uppercase text-center py-6">Thank You</h1>
            <p class="text-xl font-bold uppercase text-center py-6">Check your Email for more details</p>

    </div>
</div>
@endsection