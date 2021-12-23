@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
<div class="py-12 mt-20">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="">
        @component('components.breadcrumbs')
            <a class="text-xl font-bold" href="{{ route('shop.index')}}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span class="text-xl font-bold">Shopping Cart</span>
        @endcomponent
    </div>

    <div class="bg-gray-100 px-10 py-6 mt-10 rounded-lg border-2 border-gray-400">
        <div>
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

            @if (Cart::count() > 0)

                <h2 class="text-xl font-bold text-gray-500 my-4">{{ Cart::count() }} item(s) in Shopping Cart</h2>

                <div class="my-6">
                    @foreach (Cart::content() as $item)
                        <div class="cart-table-row border-gray-300 border-b-2  py-5">
                            <div class="w-full flex justify-evenly">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img class="w-20 h-auto " src="{{ productImage($item->model->image) }}" alt="product"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                    <div class="cart-table-description">{{ $item->details }}</div>
                                </div>
                                <div>
                                    <select class="quantity px-3 py-2 bg-white rounded-lg mt-1" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                        @for ($i = 1; $i < 5 + 1 ; $i++)
                                            <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>{{ presentPrice($item->subtotal) }}</div>
                                <div class="">
                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="hover:text-red-500">Remove</button>
                                    </form>
                                    <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="cart-options">Save for Later</button>
                                    </form>
                                </div>
                            </div> 
                        </div> 
                    @endforeach
                </div> 

              
                <div class="flex justify-end border-b-2 border-gray-400 pb-4">
                    @if (! session()->has('coupon'))
                        <div class="mt-3 ">
                            <a href="#" class="py-3 font-bold text-xl text-gray-500">Have a Coupon?</a>
                            <div class="py-4 border-2 px-2 mt-2">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="coupon_code" id="coupon_code" class="px-4 py-2 border-2 border-gray-500 bg-gray-100 w-60 hover:border-black focus:outline-none">
                                    <button type="submit" class="px-4 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">Apply</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="cart-totals flex mt-10 ">
                 
                    <div class="text-xl  w-2/3 mr-6">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                    </div>

                    <div class="text-lg  w-1/3   ml-10">
                        <table class="text-left w-full mt-4">
		                    <tbody class="bg-grey-100 flex flex-col font-bold" >
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-2 border-gray-400">
                                    <td class="p-3 w-1/2">Subtotal</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice(Cart::subtotal()) }}</td>
                                </tr>
                                @if (session()->has('coupon'))
                                    <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-b-2 border-gray-400">
                                        <td class="p-3 w-1/2 ">Discount ( {{ session()->get('coupon')['name'] }} ) :
                                            <form action="{{ route('coupon.destroy') }}" method="POST" class="inline-flex">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" style="font-size:14px;">Remove</button>
                                            </form>
                                        </td>
                                        <td class="p-3 w-1/2 ">-{{ presentPrice($discount) }}</td>
                                    </tr>
                                    <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-b-2 border-gray-400">
                                        <td class="p-3 w-1/2 ">New Subtotal</td>
                                        <td class="p-3 w-1/2 ">{{ presentPrice($newSubtotal) }}</td>
                                    </tr>
                                @endif
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-l-2 border-r-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">Tax ({{config('cart.tax')}}%)</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice($newTax) }}</td>
                                </tr>
                                <tr class="flex w-full divide-x-2 divide-gray-400 border-2 border-gray-400">
                                    <td class="p-3 w-1/2 ">Total</td>
                                    <td class="p-3 w-1/2 ">{{ presentPrice($newTotal) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end cart-totals -->

                <div class="mt-6 flex justify-between mx-5">
                    <a class="px-4 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black" href="{{ route('shop.index') }}" >Continue Shopping</a>
                    <a class="px-4 py-2 bg-green-300 border  hover:bg-green-500 hover:text-white hover:font-bold " href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                </div>
            @else
                <h3>No items in Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <div class="spacer"></div>
            @endif  
            
       
        </div>
    </div> 

    @include('partials.might-like')

    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')

                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>

   
   
@endsection
