<ul class="flex">
    @foreach($items as $menu_item)
        <li>
            <a href="{{ $menu_item->link() }}" class="block text-md px-4 py-2 text-blue-700 ml-2 font-bold hover:text-black mt-4 lg:mt-0">
                {{ $menu_item->title }}
                    @if ($menu_item->title === 'Cart')
                        @if (Cart::instance('default')->count() > 0)
                        <span class="bg-blue-800 px-2 py-1 rounded-full text-white"><span>{{ Cart::instance('default')->count() }}</span></span>
                        @endif
                    @endif
            </a>
        </li>
    @endforeach
</ul>
