<nav class="bg-blue-600 border-b border-blue-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="text-white text-xl font-bold">
                <a href="/products">MyShop</a>
            </div>

            <!-- Search -->
            <form action="/products" method="GET" class="flex">
                <input type="text" name="search"
                    placeholder="Search products..."
                    class="px-2 py-1 rounded-l text-black">
                <button class="bg-yellow-400 px-3 rounded-r">Search</button>
            </form>

            <!-- Right Side -->
            <div class="flex items-center gap-4">

            @php
    $cart = session('cart', []);
    $count = count($cart);
@endphp

<a href="/cart" class="relative bg-yellow-400 text-black px-3 py-1 rounded">
    🛒 Cart

    @if($count > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">
            {{ $count }}
        </span>
    @endif
</a>  

                <!-- User Dropdown -->
                <div class="relative">
                    <details class="cursor-pointer">
                        <summary class="text-white">
                            {{ Auth::user()->name }}
                        </summary>

                        <div class="absolute right-0 mt-2 w-40 bg-white shadow rounded">

                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </details>
                </div>

            </div>

        </div>
    </div>
</nav>