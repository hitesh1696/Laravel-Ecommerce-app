@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="">
        @component('components.breadcrumbs')
            <a class="text-xl font-bold" href="{{ route('shop.index')}}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span class="text-xl font-bold">Shopping Cart</span>
        @endcomponent
    </div>

    <div class="bg-gray-100 px-10 py-6 mt-10 ">
        <div>
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

            @if (Cart::count() > 0)

                <h2 class="text-xl font-bold text-gray-500 my-4">{{ Cart::count() }} item(s) in Shopping Cart</h2>

                <div class="my-6">
                    @foreach (Cart::content() as $item)
                    <div class="cart-table-row border-b-2 border-gray-300 border-t-2  py-5">
                        <div class="w-full flex justify-evenly">
                            <a href="{{ route('shop.show', $item->model->slug) }}"><img class="" src="{{ asset('/storage/'.$item->model->image) }}" alt="product"></a>
                            <div class="cart-item-details">
                                <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                <div class="cart-table-description">{{ $item->model->details }}</div>
                            </div>
                            <div>
                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
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

              

                <div class="cart-totals flex mt-10 ">
                    <div class="text-xl  w-2/3 -mr-10">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                    </div>

                    <div class="text-lg  w-1/3 flex justify-between">
                        <div class="ml-20">
                            Subtotal <br>
                      
                            Tax ({{config('cart.tax')}}%)<br>
                            <span class="cart-totals-total font-bold">Total</span>
                        </div>
                        <div class="cart-totals-subtotal">
                            {{ presentPrice(Cart::subtotal()) }} <br>
                       
                            {{ presentPrice($newTax) }} <br>
                            <span class="cart-totals-total font-bold">{{ presentPrice($newTotal) }}</span>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->

                <div class="mt-6 flex justify-between mx-5">
                    <a class="px-4 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black" href="{{ route('shop.index') }}" >Continue Shopping</a>
                    <a class="px-4 py-2 bg-green-300 hover:bg-green-700 hover:text-white hover:font-bold " href="{{ route('checkout.index') }}">Proceed to Checkout</a>
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
