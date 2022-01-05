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
<div class="py-12 mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success_message'))
                <div class="text-xl text-gray-500  my-4 bg-green-200 py-2 px-6 rounded-lg border border-gray-200">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="text-xl text-gray-500  my-4 bg-red-200 py-2 px-6 rounded-lg border border-gray-200">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="">
                <div class="flex">
                    <h1 class="font-bold uppercase text-center py-6">Thank You, </h1>
                    <p class="font-bold uppercase text-center py-6">  Your Order has been received</p>
                </div>
                <div class="flex w-full">
                    <div class="border-r-2 border-dashed border-black w-1/5 p-2 ml-2">
                        <p class="uppercase">order placed</p>
                        <p> #123456789 </p> 
                    </div>
                    <div class="border-r-2 border-dashed border-black w-1/5 p-2 ml-2">
                        <p class="uppercase">Date</p>
                        <p> December 31, 2021 </p> 
                    </div>
                    <div class="border-r-2 border-dashed border-black w-1/5 p-2 ml-2">
                        <p class="uppercase">Email</p>
                        <p>hitesh.patil1696@gmail.com</p> 
                    </div>
                    <div class="border-r-2 border-dashed border-black w-1/5 p-2 ml-2">
                        <p class="uppercase">Order Total</p>
                        <p>₹ 12000</p> 
                    </div>
                    <div class="border-r-2 border-dashed border-black w-1/5 p-2 ml-2">
                        <p class="uppercase">Payment method</p>
                        <p>Cash On Delivery</p> 
                    </div>
                </div>
                <div class="mt-6"> 
                <table class="text-left w-full border-2 border-gray-200 rounded-xl"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light border-r-2">products</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2 ">Stone Bracelate x <strong>2</strong></td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    ₹ 360
                                </td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2 ">Stone Bracelate x <strong>2</strong></td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                ₹ 360
                                </td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2 ">Subtotal:</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    ₹ 360
                                </td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2">Shipping:</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    ₹ 360
                                </td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2">Payment Method:</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    Cash On Delivery
                                </td>
                            </tr>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light border-r-2">Total:</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    ₹ 360
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
    </div>
    <div class="">
        <div class="bg-white shadow-md rounded my-6">
                 
        </div>
        </div>
    </div>
</div>
@endsection