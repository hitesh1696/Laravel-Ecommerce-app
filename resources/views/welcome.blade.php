@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
    <div class="mt-24">
        <div class="featured-section">
            <div class="container">
                <div class="text-center button-container">
                    <a href="#" class="button">Featured</a>
                    <a href="#" class="button">On Sale</a>
                </div>

                {{-- <div class="tabs">
                    <div class="tab">
                        Featured
                    </div>
                    <div class="tab">
                        On Sale
                    </div>
                </div> --}}

                <div class="grid grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <div class="product  border border-gray-400 px-2 py-2 rounded-lg">
                            <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" class="w-full" alt="product"></a>
                            <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                            <div class="product-price">{{ $product->presentPrice() }}</div>
                        </div>
                    @endforeach

                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{ route('shop.index') }}" class="px-4 py-2 border-2 border-gray-500 bg-gray-100 hover:bg-black hover:text-white hover:font-bold hover:border-black">View more products</a>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->

    </div> <!-- end #app -->
@endscetion

<script src="js/app.js"></script>




