
<style>
.dropdown:focus-within .dropdown-menu {
  opacity:1;
  transform: translate(0) scale(1);
  visibility: visible;
}
    </style>
<header>
    <nav class="flex items-center justify-between flex-wrap bg-white py-4 lg:px-12 shadow border-solid border-t-2 border-blue-700">
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
    
        <div class="menu w-full items-center flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-8">
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
            <div class="flex ">

          
            @if (! (request()->is('checkout') || request()->is('guestCheckout')))
                    

                   {{ menu('main', 'partials.menus.main')}}
                    {{-- @foreach($items as $menu_item) 
                        <a class="block text-md px-4 py-2 rounded text-blue-700 ml-2 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0" href="{{ $menu_item->link() }}">
                            {{ $menu_item->title }}
                            @if ($menu_item->title === 'Cart')
                                @if (Cart::instance('default')->count() > 0)
                                <span class="bg-white text-blue rounded-full px-2 py-1"><span>{{ Cart::instance('default')->count() }}</span></span>
                                @endif
                            @endif
                        </a>
                    @endforeach --}}
                @endif

                  

                @guest
                    <a href="/register" class="block text-md px-4 py-2 rounded text-blue-700 ml-2 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0">Sign in</a>
                    <a href="/login" class=" block text-md px-4  ml-2 py-2 rounded text-blue-700 font-bold hover:text-white mt-4 hover:bg-blue-700 lg:mt-0">login</a>
                @else
                    
                    <div class=" relative inline-block text-left dropdown">
                        <span class="rounded-md shadow-sm">
                            <button href class="inline-flex justify-center text-md px-4 py-2 text-blue-700 ml-2 font-bold hover:text-black mt-4 lg:mt-0" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                                <span>My Account</span>
                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                        </span>
                        <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                            <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="px-4 py-3">         
                                <p class="text-sm leading-5">Signed in as</p>
                                <p class="text-sm font-medium leading-5 text-gray-900 truncate">tom@example.com</p>
                                </div>
                                <div class="py-1">
                                <a href="javascript:void(0)" tabindex="0" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Account settings</a>
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
