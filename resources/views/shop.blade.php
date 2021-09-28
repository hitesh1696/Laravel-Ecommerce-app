@extends('layout')
<style>
    .navigation-links{
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
    }
</style>
@section('content')
<div class="py-12 bg-gray-100 font-serif">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class=" text-3xl uppercase text-center items-center mb-6 font-semibold">Products</h1>
        <div class="flex bg-white overflow-hidden shadow-xl sm:rounded-lg  px-12 py-8">
            <div class="w-1/5">
                <h3 class="text-xl font-bold uppercase py-2">By Category</h3>
                <ul>
                    @foreach($categories as $category)
                    <li class="py-2"><a href="{{ route('shop.index', ['category' => $category->slug]) }}" >{{ $category->name }}</a></li>
                        <!-- <li class="py-2"><a href="{{ route('shop.index', ) }}" class="text-lg  uppercase">{{$category->name}}</a></li> -->
                    @endforeach
                </ul>
            </div>
            <div class="w-4/5">
                <div class="flex justify-between">
                    <h3 class="text-xl font-bold uppercase py-1 border-t-4 border-black border-b-4 pr-20 pl-2">{{ $categoryName }}</h3>
                    <div class="">
                        <strong>Price :</strong>
                        <a class="font-bold mx-1" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low to High</a>|
                        <a class="font-bold mx-1" href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                    </div>
                </div>
             
                <div class="below-pagination grid grid-cols-3 gap-4 mt-4">
                    @forelse($products as $product)
                        <div class="border border-gray-300 rounded-md px-4 py-2">
                            <a class="text-xl mt-3 font-bold text-gray-900" href="{{ route('shop.show', $product->slug)}}"><img class="px-2 py-4" src="{{ asset('/storage/'.$product->image) }}" alt="product"></a>
                            <a class="text-xl mt-3 font-bold text-gray-900" href="{{ route('shop.show', $product->slug)}}">{{ $product->name }}</a>
                            <h2 class="text-sm py-1">{{ $product->details }}</h2>
                            
                            <span class="text-xl font-extrabold">{{ $product->presentPrice() }}</span>
                        </div>  
                       
                    @empty
                        <div class="">No Items Found</div>
                    @endforelse
                
                   
                </div>
                <div class="navigation-links mt-6">
                    {{ $products->links() }}
                   
                </div>
            </div>
           
        </div>
        
    </div>
</div>
@endsection