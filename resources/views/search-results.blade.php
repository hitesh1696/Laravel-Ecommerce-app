@extends('layout')

@section('title', 'Search Results Algolia')


@section('content')
<div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-xl text-center items-center my-2 font-semibold py-4">{{ $products->count() }} results for "{{ $result }}"</h1>
            <div class="flex bg-white overflow-hidden shadow-xl sm:rounded-lg  px-12 py-8">
               <div class="below-pagination grid grid-cols-4 gap-4 mt-4">
                    @forelse($products as $product)
                        <div class="border border-gray-300 rounded-md px-4 py-2">
                            <a class="text-xl mt-3 font-bold text-gray-900" href="{{ route('shop.show', $product->slug)}}"><img class="px-2 py-4" src="{{asset('img/products/'.$product->slug.'.jpg') }}" alt="product"></a>
                            <a class="text-xl mt-3 font-bold text-gray-900" href="{{ route('shop.show', $product->slug)}}">{{ $product->name }}</a>
                            <h2 class="text-sm py-1">{{ $product->details }}</h2>
                            
                            <span class="text-xl font-extrabold">{{ $product->presentPrice() }}</span>
                        </div>  
                        
                    @empty
                        <div class="">No Items Found</div>
                    @endforelse
                </div>
            </div>
    </div>
</div>

@endsection
