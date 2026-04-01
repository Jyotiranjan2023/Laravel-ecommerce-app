@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4">

    <h2 class="text-2xl font-bold mb-6">My Cart</h2>

    @if(count($cart) > 0)

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT: CART ITEMS -->
        <div class="md:col-span-2 space-y-4">

            @foreach($cart as $id => $item)

            <div class="bg-white p-4 rounded shadow flex gap-4 items-center">

                <!-- IMAGE -->
                <div class="w-24 h-24 bg-gray-100 flex items-center justify-center overflow-hidden">
                    @if($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}"
                             class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- DETAILS -->
                <div class="flex-grow">
                    <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                    <p class="text-gray-600">₹{{ $item['price'] }}</p>
                    <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                </div>

                <!-- REMOVE BUTTON -->
                <form action="/cart/remove/{{ $id }}" method="POST">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                        Remove
                    </button>
                </form>

            </div>

            @endforeach

        </div>

        <!-- RIGHT: PRICE SUMMARY -->
        <div class="bg-white p-6 rounded shadow h-fit">

            <h3 class="text-xl font-semibold mb-4">Price Details</h3>

            @php $total = 0; @endphp

            @foreach($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
            @endforeach

            <div class="flex justify-between mb-2">
                <span>Total Items</span>
                <span>{{ count($cart) }}</span>
            </div>

            <div class="flex justify-between mb-2">
                <span>Total Price</span>
                <span>₹{{ $total }}</span>
            </div>

            <hr class="my-3">

            <div class="flex justify-between font-bold text-lg">
                <span>Amount</span>
                <span>₹{{ $total }}</span>
            </div>

            <!-- CHECKOUT -->
            <form action="/cart/checkout" method="POST" class="mt-4">
                @csrf
                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded">
                    Proceed to Checkout
                </button>
            </form>

        </div>

    </div>

    @else

        <div class="text-center mt-20">
            <h3 class="text-xl text-gray-600">Your cart is empty 🛒</h3>
            <a href="/products" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                Continue Shopping
            </a>
        </div>

    @endif

</div>

@endsection