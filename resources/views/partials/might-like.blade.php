<div class="my-6">
    <h2 class="text-xl font-extrabold py-6 text-center">Might Also Like</h2>
    <div class="grid grid-cols-4 gap-4 bg-white overflow-hidden shadow-xl sm:rounded-lg px-12 py-8">
        @foreach($mightAlsoLike as $product)
        <div class="border border-gray-300 rounded-md px-4 py-2" >
            <img class="px-2 py-4" src="{{ asset('/storage/'.$product->image) }}" alt="product">
            <a class="text-xl mt-3 font-bold text-gray-900" href="{{route('shop.show', $product->slug)}}">{{ $product->name }}</a>
            <h2 class="text-sm py-1">{{ $product->details }}</h2>
            <span class="text-xl font-extrabold">{{ $product->presentPrice() }}</span>
        </div> 
        @endforeach   
    </div>
</div>
