@extends('layout')
<link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
<style>
    ul {
        list-style: none outside none;
        padding-left: 0;
        margin-bottom: 0
    }

    li {
        display: block;
        float: left;
        margin-right: 6px;
        cursor: pointer;
       
    }

    img {
        display: block;
        height: auto;
        width: 100%;
        margin-bottom: 10px;
        
    }

    label.radio {
        cursor: pointer
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.radio span {
        border: 2px solid #8f37aa;
        display: inline-block;
        color: #8f37aa;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        text-transform: uppercase;
        transition: 0.5s all
    }

    label.radio .red {
        background-color: red;
        border-color: red
    }

    label.radio .blue {
        background-color: blue;
        border-color: blue
    }

    label.radio .green {
        background-color: green;
        border-color: green
    }

    label.radio .orange {
        background-color: orange;
        border-color: orange
    }

    label.radio input:checked+span {
        color: #fff;
        position: relative
    }

    label.radio input:checked+span::before {
        opacity: 1;
        content: '\2713';
        position: absolute;
        font-size: 13px;
        font-weight: bold;
        left: 4px
    }

    .dot {
    height: 10px;
    width: 10px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px
}
   
</style>
@section('content')
<div class="py-12 bg-gray-100 font-serif">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-4 text-xl font-extrabold">
            <a href="route('shop')">Products / {{$product->name}}</a>
        </div>
        <div class="flex">
            <div class="w-1/2">
                <div class="card bg-white p-8 mr-6 rounded-lg">
                    <div class="demo">
                        <ul id="lightSlider">
                            @if ($product->images)
                                @foreach (json_decode($product->images, true) as $image)
                                    <li data-thumb="{{ productImage($image) }}"> <img  src="{{ productImage($image) }}" /> </li>
                                @endforeach
                            @else
                            <img src="{{ productImage($product->image)}}" alt="">
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card mt-5 bg-white p-8 mr-6 rounded-lg">
                    <div class="card mt-2">
                        <h6>Reviews</h6>
                        <div class="flex my-3">
                            <div class="stars"> 
                                <i class="fa fa-star text-yellow-400"></i> 
                                <i class="fa fa-star text-yellow-400"></i> 
                                <i class="fa fa-star text-yellow-400"></i> 
                                <i class="fa fa-star text-yellow-400"></i> 
                            </div> 
                            <span class="font-bold ml-4">4.6</span>
                        </div>
                   
                        <div class="border-t border-b border-gray-300 py-3"> 
                            <span class="mx-2 bg-black px-1 py-2 rounded-lg text-white font-semibold">All (230)</span> 
                            <span class="mx-2 bg-yellow-400 px-1 py-2 rounded-lg text-white font-semibold"> <i class="fa fa-image"></i> 23 </span> 
                            <span class="mx-2 bg-yellow-400  px-1 py-2 rounded-lg text-white font-semibold" <i class="fa fa-comments-o"></i> 23 </span> 
                            <span class="mx-2 bg-yellow-400  px-1 py-2 rounded-lg text-white font-semibold"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="ml-1">2,123</span> </span> 
                        </div>
               
                        <div class="comment-section my-3">
                            <div class="">
                                <div class="flex justify-between border-b border-gray-300 py-2"> 
                                    <div class="flex">
                                        <img class="w-10 h-10" src="{{ productImage($product->image) }}" class="rounded-circle profile-image">
                                        <div class="d-flex flex-column ml-1 comment-profile">
                                            <div class="comment-ratings"> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400">

                                                </i> </div> <span class="username">Lori Benneth</span>
                                        </div>
                                    </div>
                                    <div class="date"> <span class="text-muted">2 May</span> </div>
                                </div>
                                <div class="flex justify-between border-b border-gray-300 py-2"> 
                                    <div class="flex">
                                        <img class="w-10 h-10" src="{{ productImage($product->image) }}" class="rounded-circle profile-image">
                                        <div class="d-flex flex-column ml-1 comment-profile">
                                            <div class="comment-ratings"> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400"></i> 
                                                <i class="fa fa-star text-yellow-400">

                                                </i> </div> <span class="username">Lori Benneth</span>
                                        </div>
                                    </div>
                                    <div class="date"> <span class="text-muted">2 May</span> </div>
                                </div>
                            </div>
                      
                           
                        </div>
                    </div>
                </div>
            </div>  
            <div class="w-1/2 ">
                <div class="bg-white p-8 rounded-lg">
                    <div class="flex my-3">
                        <div class="stars"> 
                            <i class="fa fa-star text-yellow-400 text-xl"></i> 
                            <i class="fa fa-star text-yellow-400 text-xl"></i> 
                            <i class="fa fa-star text-yellow-400 text-xl"></i> 
                            <i class="fa fa-star text-yellow-400 text-xl"></i> 
                        </div> 
                        <span class="font-bold ml-4">4.6</span>
                    </div>
                    <div class="">
                        <a class="text-xl mt-3 font-bold text-gray-700 uppercase">{{ $product->name }}</a> <br>
                        <p class=" font-bold text-2xl">{{ $product->presentPrice() }}</p>
                    </div>
                    <div class="mt-6 flex border-b-2 border-gray-300 pb-4">
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="px-6 py-2 border-2 border-red-300 rounded-lg hover:bg-red-300 hover:text-white hover:font-bold">Add to Cart</button>
                        </form>    
                        <form class="ml-6" action="{{ route('cart.store', $product) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="px-6 py-2 bg-red-300 border-2 border-red-300 rounded-lg hover:bg-red-500 hover:text-white hover:font-bold">Buy It Now</button>
                        </form>       
                        <form class="ml-6" action="{{ route('cart.store', $product) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="px-4 py-2  border-2 border-red-300 rounded-lg hover:bg-red-500 hover:text-white hover:font-bold"><i class="fa fa-heart text-red-400 hover:text-white"></i> </button>
                        </form>        
                    </div>
                    <div class="">
                        <div><strong>Color:</span><strong> blue</span></div>
                        <div class="my-color"> 
                            <label class="radio"> <input type="radio" class="bg-blue-400 border-none" name="gender" value="MALE" checked> <span class="red"></span> </label> 
                            <label class="radio"> <input type="radio" class="bg-blue-400 border-none" name="gender" value="FEMALE"> <span class="blue"></span> </label> 
                            <label class="radio"> <input type="radio" class="bg-blue-400 border-none" name="gender" value="FEMALE"> <span class="green"></span> </label> 
                            <label class="radio"> <input type="radio" class="bg-blue-400 border-none" name="gender" value="FEMALE"> <span class="orange"></span> </label> 
                        </div>
                    </div>
                    <div class="mt-2">
                        <h1 class="uppercase font-bold text-xl">description :</h1>
                        <p class="text-justify text-lg font-normal py-2">{{ $product->description }}</p>
                        <h1 class="uppercase font-bold text-xl mt-2">product details :</h1>

                        <h2 class="text-xl font-medium  py-2">{{ $product->details }}</h2>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">Best in Quality</span> </div>
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">Anti-creak joinery</span> </div>
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">Sturdy laminate surfaces</span> </div>
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">Relocation friendly design</span> </div>
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">High gloss, high style</span> </div>
                        <div class="flex items-center"> <span class="dot"></span> <span class="bullet-text">Easy-access hydraulic storage</span> </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-lg mt-4">
                    <div class="">
                        <h2 class="text-xl font-extrabold pb-3 text-center">Might Also Like</h2>
                        <div class="grid grid-cols-4 gap-4 shadow-xl sm:rounded-lg">
                            @foreach($mightAlsoLike as $product)
                                <div class="border border-gray-300 rounded-md px-4 py-2 " >
                                    <div class="flex justify-center py-2">
                                        <img class=" h-16 w-16" src="{{ asset('/storage/'.$product->image) }}" alt="product">
                                    </div>
                                    <a class="text-base mt-3 font-bold text-gray-900" href="{{route('shop.show', $product->slug)}}">{{ $product->name }}</a>
                                </div> 
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div> 
        </div>

       
    
       
       
       
    </div>
</div>

@endsection


@section('extra-js')
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script>
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 9
    });
</script>

@endsection
