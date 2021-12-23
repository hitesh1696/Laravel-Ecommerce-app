
<style>
.dropdown:focus-within .dropdown-menu {
  opacity:1;
  transform: translate(0) scale(1);
  visibility: visible;
}
    </style>
<header>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <nav class="flex items-center justify-between flex-wrap bg-white py-4 lg:px-12 shadow border-solid border-t-2 border-blue-700  fixed top-0 w-full">
        <div class="flex justify-between lg:w-auto w-full lg:border-b-0 pl-6 pr-2 border-solid border-b-2 border-gray-300 pb-5 lg:pb-0">
            <div class="flex items-center flex-shrink-0 text-gray-800 mr-16">
                <a href="{{ route('shop.index') }}"><span class="font-semibold text-xl tracking-tight">Ecommerce</span></a>
            </div>
            <div class="block lg:hidden ">
                <button
                    id="nav"
                    class="flex items-center px-3 py-2 border-2 rounded text-blue-700 border-blue-700 hover:text-blue-700 hover:border-blue-700">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
        </div>
    
        <div class="menu w-full items-center flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-8 ">
            <div class=" mx-auto text-gray-600 ">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <div class="relative mx-auto text-gray-600 lg:block hidden">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 pl-2 pr-8 rounded-lg text-sm focus:outline-none"
                            type="text" name="search" id="search" value="{{ request()->input('search') }}" placeholder="Search for product" required>
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-2">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    version="1.1" id="Capa_1" x="0px" y="0px"
                                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                    xml:space="preserve"
                                    width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                            </svg>
                        </button>
                    </div>
                
                </form>
            </div>
            <div class="flex mr-14">

          
                @if (! (request()->is('checkout') || request()->is('guestCheckout')))
                    
                    <div x-data="{ cartOpen: false , isOpen: false }" class="bg-white">
                    {{ menu('main', 'partials.menus.main')}}
                        {{-- @foreach($items as $menu_item) 
                            <a class="block text-md px-4 py-2 rounded text-blue-700 ml-2 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0" href="{{ $menu_item->link() }}">
                                {{ $menu_item->title }}
                                @if ($menu_item->title === 'Cart')
                                   
                                @endif
                            </a>
                        @endforeach --}}


                    
                        <header class="fixed top-0 right-0 ">
                            <div class="container mx-auto px-6 py-3">
                                <div class="flex items-center justify-end w-full">
                                   
                                        <button @click="cartOpen = !cartOpen" class="bg-green-500 px-6 py-3 text-white flex">
                                            <svg class="h-6 w-6 " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            @if (Cart::instance('default')->count() > 0)
                                                <p class="ml-2 font-bold text-lg text-center flex items-center">{{ Cart::instance('default')->count() }}</p>
                                            @endif
                                        </button>
                                    
                                    <div class="flex sm:hidden">
                                        @if (Cart::instance('default')->count() > 0)
                                            <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                                                </svg>
                                                <p class="mx-1 font-extrabold text-lg">{{ Cart::instance('default')->count() }}</p>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="bg-gray-100 fixed right-0 top-20 max-w-sm w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto border-l-2 border-gray-300">
                            <div class="flex items-center justify-between">
                                <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
                                <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            @if (Cart::count() > 0)
                                <h2 class="text-xl font-bold text-gray-500 my-4">{{ Cart::count() }} item(s) in Shopping Cart</h2>
                                <hr class="my-3">
                                @foreach (Cart::content() as $item)
                                <div class="flex mt-6 bg-white rounded-lg px-3 py-2 hover:bg-gray-100">
                                    <div class="flex w-full">
                                        <div class="1/5 ">
                                            <a href=""><img class="object-cover rounded w-auto" src="{{ productImage($item->model->image) }}" alt="product"></a>
                                        </div>
                                        <div class="w-3/5  mx-4">
                                            <h3 class="text-lg font-semibold text-gray-600">{{ $item->name }}</h3>
                                            <div class="">
                                            <select class="quantity bg-gray-200 p-2 rounded-lg mt-1" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->quantity }}">
                                                
                                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                                    <option class="bg-white" {{ $item->qty == $i ? 'selected' : '' }}> {{ $i }}</option>
                                                @endfor
                                            </select>
                                            </div>
                                        </div>
                                        <div class="w-1/5 pr-2">
                                            <span class="text-gray-600">{{ presentPrice($item->subtotal) }}</span>
                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class=" hover:text-red-500 font-extrabold text-red-500">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <a  href="{{ route('checkout.index') }}" class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <span>Chechout</span>
                                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>

                            @endif
                        </div>
                    </div>
                @endif

                  

                @guest
                    <a href="/register" class="block text-md px-4 py-2 rounded text-blue-700 ml-2 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0">Sign in</a>
                    <a href="/login" class=" block text-md px-4  ml-2 py-2 rounded text-blue-700 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0">login</a>
                @else
                    
                    <div class=" relative inline-block text-left dropdown">
                        <span class="rounded-md shadow-sm">
                            <button href class="inline-flex justify-center text-md px-4 py-2 text-blue-700 ml-2 font-bold hover:text-black mt-4 lg:mt-0" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </span>
                        <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                            <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="px-4 py-3">         
                                <p class="text-sm leading-5">Signed in as</p>
                                <p class="text-sm font-medium leading-5 text-gray-900 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <div class="py-1">
                                <a href="{{ route('users.edit') }}" tabindex="0" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Account settings</a>
                                <a href="javascript:void(0)" tabindex="2" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left" role="menuitem" >License</a></div>
                                <div class="py-1">
                                <a href="{{ route('logout') }}"
                                    class="block text-md px-4  ml-2 py-2 rounded text-blue-700 font-bold hover:text-black mt-4  lg:mt-0"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                           
                @endguest
                
            </div>
        </div>
    
    </nav>
</header>
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