@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">

    <div class="grid grid-cols-2 gap-6">

        <!-- IMAGE -->
        <div>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-full h-96 object-cover rounded">
            @endif
        </div>

        <!-- DETAILS -->
        <div>
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

            <p class="text-2xl text-green-600 mb-4">
                ₹{{ $product->price }}
            </p>

            <p class="text-gray-600 mb-6">
                {{ $product->description }}
            </p>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-4">

                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf
                    <button class="bg-blue-500 text-white px-6 py-2 rounded">
                        Add to Cart
                    </button>
                </form>

                <a href="/products"
                   class="bg-gray-400 text-white px-6 py-2 rounded">
                    Back
                </a>

            </div>
        </div>

    </div>

</div>

@endsection